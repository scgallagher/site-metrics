<?php

class DataManager {

  private $host = "localhost";
  private $username = "site-metrics";
  private $password = "site-metrics";
  private $dbName = "site_metrics";
  private $connection;

  private $url;
  private $email;
  private $results;

  public function __construct($url, $email, $results){
    $this->url = $url;
    $this->email = $email;
    $this->results = $results;
    //$connection = new mysqli($this->host, $this->username, $this->password, $this->dbName);
    $connection = new PDO("mysql:host=$this->host;dbname=$this->dbName",
      $this->username, $this->password);
    $connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->connection = $connection;
  }

  private function getTimeStamp(){
    return date("Y-m-d H:i:s");
  }

  private function generateScanID(){
    return rand(10000000, 99999999);
  }

  public function write(){
    $scanID = $this->generateScanID();
    $time = $this->getTimeStamp();

    // Write general scan info
    $this->write_scan($scanID, $this->email, $this->url, $time);

    // Write SEO results
    $this->write_seo($scanID, $this->results->resultsSEO->resultsHeading->h1Count,
      $this->results->resultsSEO->resultsHeading->h2Count,
      $this->results->resultsSEO->resultsHeading->h3Count,
      $this->results->resultsSEO->resultsHeading->rating,
      $this->results->resultsSEO->resultsMetaDescription->charCount,
      $this->results->resultsSEO->resultsMetaDescription->rating,
      $this->results->resultsSEO->resultsPageTitle->hasTitle,
      $this->results->resultsSEO->resultsPageTitle->charCount,
      $this->results->resultsSEO->resultsPageTitle->rating);

    // Write Mobile results
    $this->write_mobile($scanID, $this->results->resultsMobile->resultsResponsiveness->hasBootstrap,
      $this->results->resultsMobile->resultsResponsiveness->hasMediaQueries,
      $this->results->resultsMobile->resultsResponsiveness->rating,
      $this->results->resultsMobile->resultsViewportOptimization->usesContentViewport,
      $this->results->resultsMobile->resultsViewportOptimization->rating);

    // Write Security results
    $this->write_security($scanID, $this->results->resultsSecurity->resultsSSL->hasCert,
      $this->results->resultsSecurity->resultsSSL->certExpired,
      $this->results->resultsSecurity->resultsSSL->rating,
      $this->results->resultsSecurity->resultsSQLInjection->prepared_statements,
      $this->results->resultsSecurity->resultsSQLInjection->non_prepared_statements,
      $this->results->resultsSecurity->resultsSQLInjection->rating);

    // Write Performance results
    $this->write_performance($scanID,
      $this->results->resultsPerformance->resultsBrowserCaching->cookiesSizeInBytes,
      $this->results->resultsPerformance->resultsBrowserCaching->cookiesCount,
      $this->results->resultsPerformance->resultsBrowserCaching->rating,
      $this->results->resultsPerformance->resultsCompression->compressionPercentage,
      $this->results->resultsPerformance->resultsCompression->rating,
      $this->results->resultsPerformance->resultsHTTPRequests->requestCount,
      $this->results->resultsPerformance->resultsHTTPRequests->rating,
      $this->results->resultsPerformance->resultsPageLoad->loadTimeInSeconds,
      $this->results->resultsPerformance->resultsPageLoad->rating,
      $this->results->resultsPerformance->resultsPageRedirects->redirectCount,
      $this->results->resultsPerformance->resultsPageRedirects->rating,
      $this->results->resultsPerformance->resultsPageSize->pageSizeInBytes,
      $this->results->resultsPerformance->resultsPageSize->rating,
      $this->results->resultsPerformance->resultsRenderBlocking->cssImportResult,
      $this->results->resultsPerformance->resultsRenderBlocking->linkTagsWithMediaAttributeResult,
      $this->results->resultsPerformance->resultsRenderBlocking->multipleCssResult,
      $this->results->resultsPerformance->resultsRenderBlocking->scriptTagsInHeadResult,
      $this->results->resultsPerformance->resultsRenderBlocking->onLoadResult,
      $this->results->resultsPerformance->resultsRenderBlocking->rating);

  }

  private function write_scan($scanID, $email, $url, $time){
    $stmt = $this->connection->prepare("INSERT INTO scan (scan_id, email, url, time)
      VALUES (:scan_id, :email, :url, :time)");
    $stmt->bindParam(":scan_id", $scanID);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":url", $url);
    $stmt->bindParam(":time", $time);
    try{
      $stmt->execute();
    }
    catch(PDOException $e){
      FB::log($e->getMessage());
    }
  }

  private function write_seo($scanID, $heading_h1Count, $heading_h2Count, $heading_h3Count,
    $heading_rating, $metaDescription_charCount, $metaDescription_rating,
    $pageTitle_hasTitle, $pageTitle_charCount, $pageTitle_rating){

    $stmt = $this->connection->prepare("INSERT INTO seo (scan_id, heading_h1Count,
      heading_h2Count, heading_h3Count, heading_rating, metaDescription_charCount,
      metaDescription_rating, pageTitle_hasTitle, pageTitle_charCount, pageTitle_rating)
      VALUES (:scan_id, :heading_h1Count, :heading_h2Count, :heading_h3Count, :heading_rating,
        :metaDescription_charCount, :metaDescription_rating, :pageTitle_hasTitle,
        :pageTitle_charCount, :pageTitle_rating)");

    $stmt->bindParam(":scan_id", $scanID);
    $stmt->bindParam(":heading_h1Count", $heading_h1Count);
    $stmt->bindParam(":heading_h2Count", $heading_h2Count);
    $stmt->bindParam(":heading_h3Count", $heading_h3Count);
    $stmt->bindParam(":heading_rating", $heading_rating);
    $stmt->bindParam(":metaDescription_charCount", $metaDescription_charCount);
    $stmt->bindParam(":metaDescription_rating", $metaDescription_rating);
    $stmt->bindParam(":pageTitle_hasTitle", $pageTitle_hasTitle);
    $stmt->bindParam(":pageTitle_charCount", $pageTitle_charCount);
    $stmt->bindParam(":pageTitle_rating", $pageTitle_rating);

    try{
      $stmt->execute();
    }
    catch(PDOException $e){
      FB::log($e->getMessage());
    }

  }

  private function write_mobile($scanID, $responsiveness_hasBootstrap,
    $responsiveness_hasMediaQueries, $responsiveness_rating,
    $viewportOptimization_usesContentViewport, $viewportOptimization_rating){

    $stmt = $this->connection->prepare("INSERT INTO mobile (scan_id,
      responsiveness_hasBootstrap, responsiveness_hasMediaQueries, responsiveness_rating,
      viewportOptimization_usesContentViewport, viewportOptimization_rating)
      VALUES (:scan_id, :responsiveness_hasBootstrap, :responsiveness_hasMediaQueries,
        :responsiveness_rating, :viewportOptimization_usesContentViewport, :viewportOptimization_rating)");

    $stmt->bindParam(":scan_id", $scanID);
    $stmt->bindParam(":responsiveness_hasBootstrap", $responsiveness_hasBootstrap);
    $stmt->bindParam(":responsiveness_hasMediaQueries", $responsiveness_hasMediaQueries);
    $stmt->bindParam(":responsiveness_rating", $responsiveness_rating);
    $stmt->bindParam(":viewportOptimization_usesContentViewport", $viewportOptimization_usesContentViewport);
    $stmt->bindParam(":viewportOptimization_rating", $viewportOptimization_rating);

    try{
      $stmt->execute();
    }
    catch(PDOException $e){
      FB::log($e->getMessage());
    }

  }

  private function write_security($scan_id, $ssl_hasCert, $ssl_certExpired,
    $ssl_rating, $sqlInjection_preparedStatements, $sqlInjection_nonPreparedStatements,
    $sqlInjection_rating){

    $stmt = $this->connection->prepare("INSERT INTO security (scan_id, ssl_hasCert, ssl_certExpired,
      ssl_rating, sqlInjection_preparedStatements, sqlInjection_nonPreparedStatements,
      sqlInjection_rating) VALUES (:scan_id, :ssl_hasCert, :ssl_certExpired,
        :ssl_rating, :sqlInjection_preparedStatements, :sqlInjection_nonPreparedStatements,
        :sqlInjection_rating)");

    $stmt->bindParam(":scan_id", $scan_id);
    $ssl_hasCert = intval($ssl_hasCert);
    $stmt->bindParam(":ssl_hasCert", $ssl_hasCert);
    $ssl_certExpired = intval($ssl_certExpired);
    $stmt->bindParam(":ssl_certExpired", $ssl_certExpired);
    $stmt->bindParam(":ssl_rating", $ssl_rating);
    $stmt->bindParam(":sqlInjection_preparedStatements", $sqlInjection_preparedStatements);
    $stmt->bindParam(":sqlInjection_nonPreparedStatements", $sqlInjection_nonPreparedStatements);
    $stmt->bindParam(":sqlInjection_rating", $sqlInjection_rating);

    try{
      $stmt->execute();
    }
    catch(PDOException $e){
      FB::log($e->getMessage());
    }

  }

  private function write_performance($scan_id, $browserCaching_cookiesSizeInBytes,
    $browserCaching_cookiesCount, $browserCaching_rating, $compression_compressionPercentage,
    $compression_rating, $httpRequests_requestCount, $httpRequests_rating, $pageLoad_loadTimeInSeconds,
    $pageLoad_rating, $pageRedirects_redirectCount, $pageRedirects_rating, $pageSize_pageSizeInBytes,
    $pageSize_rating, $renderBlocking_cssImportResult, $renderBlocking_linkTagsWithMediaAttributeResult,
    $renderBlocking_multipleCssResult, $renderBlocking_scriptTagsInHeadResult,
    $renderBlocking_onLoadResult, $renderBlocking_rating){

    $stmt = $this->connection->prepare("INSERT INTO performance (scan_id, browserCaching_cookiesSizeInBytes,
      browserCaching_cookiesCount, browserCaching_rating, compression_compressionPercentage,
      compression_rating, httpRequests_requestCount, httpRequests_rating, pageLoad_loadTimeInSeconds,
      pageLoad_rating, pageRedirects_redirectCount, pageRedirects_rating, pageSize_pageSizeInBytes,
      pageSize_rating, renderBlocking_cssImportResult, renderBlocking_linkTagsWithMediaAttributeResult,
      renderBlocking_multipleCssResult, renderBlocking_scriptTagsInHeadResult,
      renderBlocking_onLoadResult, renderBlocking_rating) VALUES (:scan_id, :browserCaching_cookiesSizeInBytes,
        :browserCaching_cookiesCount, :browserCaching_rating, :compression_compressionPercentage,
        :compression_rating, :httpRequests_requestCount, :httpRequests_rating, :pageLoad_loadTimeInSeconds,
        :pageLoad_rating, :pageRedirects_redirectCount, :pageRedirects_rating, :pageSize_pageSizeInBytes,
        :pageSize_rating, :renderBlocking_cssImportResult, :renderBlocking_linkTagsWithMediaAttributeResult,
        :renderBlocking_multipleCssResult, :renderBlocking_scriptTagsInHeadResult,
        :renderBlocking_onLoadResult, :renderBlocking_rating)");

    $stmt->bindParam(":scan_id", $scan_id);
    $stmt->bindParam(":browserCaching_cookiesSizeInBytes", $browserCaching_cookiesSizeInBytes);
    $stmt->bindParam(":browserCaching_cookiesCount", $browserCaching_cookiesCount);
    $stmt->bindParam(":browserCaching_rating", $browserCaching_rating);
    $stmt->bindParam(":compression_compressionPercentage", $compression_compressionPercentage);
    $stmt->bindParam(":compression_rating", $compression_rating);
    $stmt->bindParam(":httpRequests_requestCount", $httpRequests_requestCount);
    $stmt->bindParam(":httpRequests_rating", $httpRequests_rating);
    $stmt->bindParam(":pageLoad_loadTimeInSeconds", $pageLoad_loadTimeInSeconds);
    $stmt->bindParam(":pageLoad_rating", $pageLoad_rating);
    $stmt->bindParam(":pageRedirects_redirectCount", $pageRedirects_redirectCount);
    $stmt->bindParam(":pageRedirects_rating", $pageRedirects_rating);
    $stmt->bindParam(":pageSize_pageSizeInBytes", $pageSize_pageSizeInBytes);
    $stmt->bindParam(":pageSize_rating", $pageSize_rating);
    $stmt->bindParam(":renderBlocking_cssImportResult", $renderBlocking_cssImportResult);
    $stmt->bindParam(":renderBlocking_linkTagsWithMediaAttributeResult", $renderBlocking_linkTagsWithMediaAttributeResult);
    $stmt->bindParam(":renderBlocking_multipleCssResult", $renderBlocking_multipleCssResult);
    $stmt->bindParam(":renderBlocking_scriptTagsInHeadResult", $renderBlocking_scriptTagsInHeadResult);
    $stmt->bindParam(":renderBlocking_onLoadResult", $renderBlocking_onLoadResult);
    $stmt->bindParam(":renderBlocking_rating", $renderBlocking_rating);

    try{
      $stmt->execute();
    }
    catch(PDOException $e){
      FB::log($e->getMessage());
    }

  }

  private function write_scan_mysqli($scanID, $email, $url, $time){
    $stmt = $this->connection->prepare("INSERT INTO scan (scan_id, email, url, time)
      VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $scanID, $email, $url, $time);
    $stmt->execute();
    $stmt->close();
  }

}

?>
