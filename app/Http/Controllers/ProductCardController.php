<?php

namespace App\Http\Controllers;

use App\Models\Bouquet;
use Illuminate\Http\Request;

class ProductCardController extends Controller
{
    public static function show($id) {
        $bouquet = Bouquet::find($id);
        date_default_timezone_set('Europe/Kyiv');
        $shipping_date = date('d.m.y', time() + 3*86400); // 3 days of shipping
        $group = session()->get('filter');
        return view('product_card', compact('bouquet', 'shipping_date', 'group'));
    }
}
