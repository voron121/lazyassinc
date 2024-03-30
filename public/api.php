<?php
require_once 'vendor/autoload.php';

use App\Models\DemoDataGenerator\DemoIssuesDataGenerator;

try {
    $DemoDataGenerator = new DemoIssuesDataGenerator();
    echo json_encode($DemoDataGenerator->getDemoData());
} catch (Throwable $throwable) {
    echo $throwable->getMessage();
}
?>