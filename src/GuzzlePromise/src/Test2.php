<?php

namespace GuzzlePromise;

use GuzzleHttp\Promise\Promise;

use function \GuzzleHttp\Promise\promise_for;
use function GuzzleHttp\Promise\rejection_for;

class Test2
{
    public function __invoke()
    {
        $log = [];
        $promise = new Promise();
        $p2 = $promise->then(function ($reason) use (&$log) {
            $log[] = 'then() #1: fullfilled';
            return rejection_for($reason);
        }, function ($reason) use (&$log) {
            $log[] = 'then() #1: ejected';
            //throw new Exception($reason);
            return promise_for($reason);
        })->then(function ($reason) use (&$log) {
            $log[] = 'then() #2: fullfilled';
            return rejection_for('FullfIlled 2! - ' . $reason);
        }, function ($reason) use (&$log) {
            $log[] = 'then() #2: rejected';
            return promise_for('Rejected 2! - ' . $reason);
        })->then(function ($reason) use (&$log) {
            $log[] = 'then() #3: fullfilled';
            return promise_for('FullfIlled 3! - ' . $reason);
        }, function ($reason) use (&$log) {
            $log[] = 'then() #3: rejected';
            return promise_for('Rejected 3! - ' . $reason);
        });

        try {
            $promise->reject('Error!');
            $result = $promise->wait(false);
            $r2 = $p2->wait();
            print_r($r2);
            print_r("\n");
            print_r($log);
        } catch (\Exception $e) {
            print_r("\nThrown exception:\n");
            print_r($e->getMessage());
        }


    }

}