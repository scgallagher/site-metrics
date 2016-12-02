<?php

require_once("Test_Performance_ScanController.php");
include_once("firephp-core-0.4.0/lib/FirePHPCore/fb.php");

echo "Starting...\n";
$scanController = new Test_Performance_ScanController("https://github.com");
//$scanController = new Test_Performance_ScanController("https://www.nhl.com");
//$scanController = new Test_Performance_ScanController("https://website.grader.com");
//$scanController = new Test_Performance_ScanController("http://localhost/wordpress");
//$scanController = new Test_Performance_ScanController("http://localhost/TestData/Performance/httpRequests/test1.html");
$results = $scanController->scan();
echo "Done\n";

?>
