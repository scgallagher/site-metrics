<?php

require_once("Test_Security_ScanController.php");
include_once("firephp-core-0.4.0/lib/FirePHPCore/fb.php");

$scanController = new Test_Security_ScanController("https://www.nhl.com");
$results = $scanController->scan();
echo "Done\n";

?>
