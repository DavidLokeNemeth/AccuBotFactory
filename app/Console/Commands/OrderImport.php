<?php

namespace App\Console\Commands;

use App\Models\Component;
use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Throwable;

class OrderImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:import {filePath}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import orders from a CSV file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //Get the file path from the command line
        $filePath = $this->argument('filePath');

        //Check the file is existing or not
        if (!Storage::exists($filePath)) {
            $this->error('The specified file does not exist.');
            return Command::FAILURE;
        }

        //open the file or give error if we can't
        $file = fopen(storage_path('app/' . $filePath), 'r');
        if ($file !== false) {
            //Get first line for the header
            $headers = fgetcsv($file);

            //Going through all line and link to the header as key
            while (($row = fgetcsv($file)) !== false) {
                $item = [];
                foreach ($row as $key => $value) {
                    $item[$headers[$key]] = $value ?: null;
                }

                // Find or create an order based on 'Order ID'
                $order = Order::firstOrCreate(
                    ['id' => $item['Order ID']],
                    [
                        'customer_name' => $item['Customer Name']
                    ]
                );

                // Find the component based on 'SKU' or inform the user need update
                try {
                    $component = Component::where('sku', $item['SKU'])->firstOrFail();
                } catch (Throwable $e) {
                    $this->error('We have no record of component SKU:' . $item['SKU'] . '. Please run order:components and if it is not help, contact supplier');
                    return Command::FAILURE;
                }

                // Find or create an order item based on the order and the component
                OrderList::firstOrCreate(
                    ['order_id' => $order->id, 'component_id' => $component->id],
                    ['quantity' => $item['Quantity']]
                );

            }

            fclose($file);
        } else {
            $this->error('Unable to open the file.');
            return Command::FAILURE;
        }

        $this->info('Orders imported successfully.');
        return Command::SUCCESS;
    }
}
