<?php

namespace App\Http\Controllers;

use App\Models\Bouquet;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function show() {
        $cart = session()->get('cart');
        $bouquets = Bouquet::query()
            ->wherein('id', array_keys($cart))
            ->get();
        $bouquets_price = $bouquets->sum(function (Bouquet $bouquet) {
            return $bouquet->price * session()->get('cart')[$bouquet->id];
        });
        return view('cart', compact('bouquets', 'cart', 'bouquets_price'));
    }

    public function save_cart(Request $request) {
        if ($request->cart) {
            session()->put('cart', $request->cart);
            $order = Order::create(['name',
                        'surname',
                        'email',
                        'phone',
                        'region',
                        'city',
                        'address',
                        'payment_method',
                        'card_num',
                        'expiration_date',
                        'CVV']);
            foreach($request->cart as $bouquet_id => $amount) {
                DB::table('orders_bouquets')->insert(
                    ['order_id' => $order->id, 'bouquet_id' => $bouquet_id, 'amount' => $amount]
                );
            }
            echo base64_encode(strval($order->id));
        }
    }

    public static function add_to_cart(Request $request) {
        if ($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                $cart[$request->id] += 1;
            } else {
                $cart[$request->id] = 1;
            }
            session()->put('cart', $cart);
            echo 'add to cart successfully';
        }
    }

    public function check_cart() {
        if(!empty(session()->get('cart'))) {
            echo 'cart not empty';
        }
    }
}
