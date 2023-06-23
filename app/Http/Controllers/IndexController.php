<?php

namespace App\Http\Controllers;

use App\Models\Bouquet;
use App\Models\Order;

class IndexController extends Controller
{
    public function show () {
        $bouquets = Bouquet::query()->where('best_offer', true)->limit(4)->get();
        $monoURL = "/catalog?".http_build_query([
            'filter' => ['category' => 'моно']
        ]);
        $mixURL = "/catalog?".http_build_query([
            'filter' => ['category' => 'мікс']
        ]);
        $weddingURL = "/catalog?".http_build_query([
            'filter' => ['category' => 'весільні']
        ]);
        return view('index', compact('bouquets', 'monoURL', 'mixURL', 'weddingURL'));
    }
}
