<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CurrencyController extends Controller
{
    public function index()
    {
        return DB::table('currencies')->get();
    }

    public function show(Request $request)
    {
        $singleCurrency = (array) DB::table('currencies')->where('id', $request->id)->first();

        return $singleCurrency;
    }
}
