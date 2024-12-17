<?php

namespace Tests\Unit;
use App\Models\Product;
use PHPUnit\Framework\TestCase;

class ProductControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }
    public function test_add_product()
{
    $product = Product::create([
        'name' => 'Test Product',
        'price' => 100.00,
        'quantity' => 10,
    ]);

    $this->assertDatabaseHas('products', ['name' => 'Test Product']);
}

}
