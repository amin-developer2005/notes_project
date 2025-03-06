<?php
require_once __DIR__ . '/../Core/Session.php';

use Core\Session;

$products = ['id' => 17, 'name' => 'computer'];



test('The put() method should store values to the $_SESSION', function () use ($products) {
    Session::start();

    Session::put(['user', 'cart', 'items'], ['products' => $products]);

    expect($_SESSION['user']['cart']['items'])->toBe(['products' => $products])->toBeArray();
});
