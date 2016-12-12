CREATE DATABASE site_metrics;
USE site_metrics;

CREATE TABLE scan (
  scan_id INT UNSIGNED PRIMARY KEY,
  email VARCHAR(200) NOT NULL,
  url VARCHAR(200) NOT NULL,
  time TIMESTAMP NOT NULL
);

CREATE TABLE seo (
  scan_id	INT PRIMARY KEY,
  heading_h1Count	INT NOT NULL,
  heading_h2Count	INT NOT NULL,
  heading_h3Count	INT NOT NULL,
  heading_rating	VARCHAR(100) NOT NULL,
  metaDescription_charCount	INT NOT NULL,
  metaDescription_rating	VARCHAR(100) NOT NULL,
  pageTitle_hasTitle	BOOLEAN NOT NULL,
  pageTitle_charCount	INT NOT NULL,
  pageTitle_rating	VARCHAR(100) NOT NULL
);

CREATE TABLE mobile (
  scan_id	INT	PRIMARY KEY,
  responsiveness_hasBootstrap	VARCHAR(100) NOT NULL,
  responsiveness_hasMediaQueries	VARCHAR(100) NOT NULL,
  responsiveness_rating	VARCHAR(100) NOT NULL,
  viewportOptimization_usesContentViewport	VARCHAR(100) NOT NULL,
  viewportOptimization_rating	VARCHAR(100) NOT NULL
);
--
CREATE TABLE security (
  scan_id	INT	PRIMARY KEY,
  ssl_hasCert	BOOLEAN NOT NULL,
  ssl_certExpired	BOOLEAN NOT NULL,
  ssl_rating	VARCHAR(100) NOT NULL,
  sqlInjection_preparedStatements	INT NOT NULL,
  sqlInjection_nonPreparedStatements	INT NOT NULL,
  sqlInjection_rating	VARCHAR(100)
);

CREATE TABLE performance (
  scan_id	INT	PRIMARY KEY,
  browserCaching_cookiesSizeInBytes	INT NOT NULL,
  browserCaching_cookiesCount	INT NOT NULL,
  browserCaching_rating	VARCHAR(100) NOT NULL,
  compression_compressionPercentage	INT NOT NULL,
  compression_rating	VARCHAR(100) NOT NULL,
  httpRequests_requestCount	INT NOT NULL,
  httpRequests_rating	VARCHAR(100) NOT NULL,
  pageLoad_loadTimeInSeconds	INT NOT NULL,
  pageLoad_rating	VARCHAR(100) NOT NULL,
  pageRedirects_redirectCount	INT NOT NULL,
  pageRedirects_rating	VARCHAR(100) NOT NULL,
  pageSize_pageSizeInBytes	INT NOT NULL,
  pageSize_rating	VARCHAR(100) NOT NULL,
  renderBlocking_cssImportResult	VARCHAR(100) NOT NULL,
  renderBlocking_linkTagsWithMediaAttributeResult	VARCHAR(100) NOT NULL,
  renderBlocking_multipleCssResult	VARCHAR(100) NOT NULL,
  renderBlocking_scriptTagsInHeadResult	VARCHAR(100) NOT NULL,
  renderBlocking_onLoadResult	VARCHAR(100) NOT NULL,
  renderBlocking_rating	VARCHAR(100)
);
