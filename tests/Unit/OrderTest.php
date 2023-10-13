<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\Category;
use App\Models\Component;
use App\Models\OrderList;
use Tests\TestCase;

class OrderTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate:fresh');

        // Create a dummy info
        $this->order = Order::create([
            'id' => 1,
            'customer_name' => 'Test Customer',
        ]);

        $this->category1 = Category::create([
            'category' => 'Electronics'
        ]);

        $this->category2 = Category::create([
            'category' => 'Not Electronics'
        ]);

        $this->component1 = Component::create([
            'sku' => 'Test01',
            'description' => 'Test description for 01',
            'category_id' => $this->category1->id,
            'weight' => 2.6,
        ]);

        $this->component2 = Component::create([
            'sku' => 'Test02',
            'description' => 'Test description for 02',
            'category_id' => $this->category1->id,
            'weight' => 7.2,
        ]);

        // Associate components with the order and specify quantities
        $this->componentOrder1 = OrderList::create([
            'order_id' => $this->order->id,
            'component_id' => $this->component1->id,
            'quantity' => 8
        ]);

        $this->componentOrder2 = OrderList::create([
            'order_id' => $this->order->id,
            'component_id' => $this->component2->id,
            'quantity' => 1
        ]);
    }

    public function test_the_calculate_total_weight_function()
    {
        $totalWeight = $this->order->calculateTotalWeight();
        $this->assertEquals(2.6 * 8 + 7.2 * 1, $totalWeight);
    }

    public function test_the_calculate_most_prevalent_category_function()
    {
        $bestCategory = $this->order->calculateMostPrevalentCategory();
        $this->assertEquals(1, $bestCategory);
    }

    public function test_the_generate_robot_name_function()
    {
        $coolRobotName = $this->order->generateRobotName();
        $check = false;

        if (str_contains($coolRobotName, 'Micro') || str_contains($coolRobotName, 'Machina') || str_contains($coolRobotName, 'RAM') || str_contains($coolRobotName, 'Automata'))
            $check = true;

        $this->assertTrue($check);
    }
}
