<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Promise\Promise;


class GuzzlePromiseTest extends TestCase
{
    public function testPromise()
    {
        $log = [];
        $promise = new Promise();
        $promise->then(function ($reason) use (&$log) {
            $log[] = 'First then fullfilled';
        }, function ($reason) use (&$log) {
            $log[] = 'First then rejected';
            print_r($log);
            //throw new Exception($reason);
            return \GuzzleHttp\Promise\promise_for($reason);
        })->then(function ($reason) use (&$log) {
            $log[] = 'Second then fullfilled';
            print_r($log);
            return 'FullFIlled!';
        }, function ($reason) use (&$log) {
            $log[] = 'Second then rejected';
            print_r($log);
            assert($reason->getMessage() === 'Error!');
        });

        //$this->expectException(\GuzzleHttp\Promise\RejectionException::class);
        $promise->reject('Error!');
        $result = $promise->wait();
        $expectedLog = [];
        $this->assertEquals($expectedLog, $log);

    }
}


