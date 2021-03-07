<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CurrencyController extends Controller
{
    public function index(){
        $collection = http::get('https://openexchangerates.org/api/latest.json?app_id=1ad10453b3734f0e8f7bba39a658a500');
        foreach ($collection['rates'] as $elem => $value){
            Currency::firstOrCreate(
                ['name' => $elem],
                ['rate' => $value]
            );
        }
    }

    public function update(){
        $collection = http::get('https://openexchangerates.org/api/latest.json?app_id=1ad10453b3734f0e8f7bba39a658a500');
        Currency::where('name', 'USD')->update(['rate' => $collection['rates']['USD']]);
    }

}
