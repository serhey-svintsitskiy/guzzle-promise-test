<?php

use GuzzlePromise\Test1;

require __DIR__ . '/../vendor/autoload.php';


$test1 = new Test1();
try {
    $test1->__invoke();
} catch (Exception $e) {
    print_r($e->getMessage());
}
