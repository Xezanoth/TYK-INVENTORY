<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('database seeding creates repeatable demo inventory records', function () {
    $this->seed();
    $this->seed();

    $this->assertDatabaseCount('categories', 3);
    $this->assertDatabaseCount('suppliers', 3);
    $this->assertDatabaseCount('products', 10);
    $this->assertDatabaseCount('users', 1);
    $this->assertDatabaseHas('products', [
        'sku' => 'DEMO-BIKE-TRAIL29',
        'name' => '29-inch Trail Hardtail',
        'stock_quantity' => 8,
    ]);
});
