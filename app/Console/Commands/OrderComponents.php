<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Component;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Throwable;

class OrderComponents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:components';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import components list from the supplier by API';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        //Define the starting url
        $url = env('COMPONENT_API_URL');

        //Grab every page and import or update the component data
        do {
            try {
                $request = Http::get($url);
            } catch (Throwable $e) {
                $this->error('We was not able connect to the service provider.');
                return Command::FAILURE;
            }

            $data = $request->json();
            $components = $data['value'];
            foreach ($components as $component){
                $category = Category::firstOrCreate(
                    ['category' => $component['category']]
                );

                // create or update the component
                try {
                    Component::updateOrCreate(
                        ['sku' => $component['sku']],
                        [
                            'description' => $component['product_name'],
                            'category_id' => $category->id,
                            'weight' => $component['weight'],
                        ]
                    );
                } catch (Throwable $e) {
                    $this->error('Validation issue with SKU:' . $component['sku']);
                    return Command::FAILURE;
                }
            }

            // Check if there are more pages of data.
            $url = $data['@odata.nextLink'] ?? null;
        } while ($url);

        $this->info('Components imported successfully.');
        return Command::SUCCESS;
    }
}
