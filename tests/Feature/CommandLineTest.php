<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommandLineTest extends TestCase
{

    protected static bool $initialized = false;

    public function setUp(): void
    {
        parent::setUp();

        if (!self::$initialized) {
            $this->artisan('migrate:fresh');
            self::$initialized = true;
        }
    }

    /**
     * Test a console commands.
     */
    public function test_importing_without_a_file(): void
    {
        $this->artisan('order:import notgood.csv')
            ->expectsOutput('The specified file does not exist.')
            ->assertFailed();
    }

    public function test_import_orders_command_without_components()
    {
        $this->artisan('order:import orders.csv')
            ->expectsOutputToContain('We have no record of component SKU:')
            ->assertFailed();
    }

    public function test_importing_components(): void
    {
        $this->artisan('order:components')
            ->expectsOutput('Components imported successfully.')
            ->assertSuccessful();
    }

    public function test_import_orders_command_after_components_import()
    {
        $this->artisan('order:import orders-test.csv')
            ->expectsOutputToContain('Orders imported successfully.')
            ->assertSuccessful();
    }


    /**
     * Test a browser response
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_the_order_returns_a_successful_response(): void
    {
        $response = $this->get('/order/1');

        $response->assertStatus(200);
    }

    public function test_the_order_returns_a_failed_response(): void
    {
        $response = $this->get('/order/asdf');

        $response->assertStatus(404);
    }

    public function test_the_order_edit_returns_a_successful_response(): void
    {
        $response = $this->get('/order/1/edit');

        $response->assertStatus(200);
    }

    public function test_the_order_edit_returns_a_failed_response(): void
    {
        $response = $this->get('/order/asdf/edit');

        $response->assertStatus(404);
    }
}
