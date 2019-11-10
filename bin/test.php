<?php

use GuzzlePromise\Test1;
use GuzzlePromise\Test2;

require __DIR__ . '/../vendor/autoload.php';


$test1 = new Test1();
$test2 = new Test2();
try {
    print_r("\n\n Test 1 \n");
    $test1->__invoke();
    print_r("\n\n Test 2 \n");
    $test2->__invoke();
} catch (Exception $e) {
    print_r($e->getMessage());
}
