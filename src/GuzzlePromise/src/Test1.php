<?php

namespace GuzzlePromise;

use GuzzleHttp\Promise\Promise;

use function \GuzzleHttp\Promise\promise_for;
use function GuzzleHttp\Promise\rejection_for;

class Test1
{
    public function __invoke()
    {
        $log = [];
        $promise = new Promise();
        $promise->then(function ($reason) use (&$log) {
            $log[] = 'First then fullfilled';
            return rejection_for($reason);
        }, function ($reason) use (&$log) {
            $log[] = 'First then rejected';
            //print_r($log);
            //throw new Exception($reason);
            return promise_for($reason);
        })->then(function ($reason) use (&$log) {
            $log[] = 'Second then fullfilled';
            print_r($log);
            //return 'FullfIlled 2!' . $reason;

            return rejection_for('FullfIlled 2! - ' . $reason);
        }, function ($reason) use (&$log) {
            $log[] = 'Second then rejected';
            print_r($log);
            return promise_for('Rejected 2! - ' . $reason);
        })->then(function ($reason) use (&$log) {
            $log[] = 'Third then fullfilled';
            print_r($log);
            return promise_for('FullfIlled 3! - ' . $reason);
        }, function ($reason) use (&$log) {
            $log[] = 'Third then rejected';
            print_r($log);
            return rejection_for('Rejected 3! - ' . $reason);
        });

        try {
            $promise->reject('Error!');
            $result = $promise->wait(false);
        } catch (\Exception $e) {
            print_r($e->getMessage());
        }


    }

}