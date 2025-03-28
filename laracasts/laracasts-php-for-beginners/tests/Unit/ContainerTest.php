<?php

//test('example', function () {
//    expect(true)->toBeTrue();
//});

use Core\Container;

test('it can resolve something out of the container', function () {
    $container = new Container();

    $container->bind('foo', fn() => 'bar');

    $result = $container->resolve('foo');

    expect($result)->toEqual('bar');
});