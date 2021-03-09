<?php

namespace App\Console\Commands;

use App\Http\Controllers\CurrencyController;
use App\Models\Currency;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class CurrenciesList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currencies:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Getting list of currencies';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $collection = http::get('https://openexchangerates.org/api/currencies.json?app_id=1ad10453b3734f0e8f7bba39a658a500');
        foreach ($collection->json() as $key=> $value){
            Currency::firstOrCreate(
                ['code' => $key],
                ['name' => $value]
            );
        }
    }
}
