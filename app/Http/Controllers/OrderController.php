<?php

namespace App\Http\Controllers;

use App\Models\Bouquet;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public static function show(Request $request, $id) {
        $cart = session()->get('cart');
        $bouquets = Bouquet::query()
            ->wherein('id', array_keys($cart))
            ->get();
        return view('order', compact('cart', 'bouquets', 'id'));
    }

    public static function save(Request $request, $id) {
        $decoded_id = base64_decode($id);
        $card_num = null;
        $expiration_date = null;
        $CVV = null;
        $payment_method = null;
        foreach($request->all() as $key => $value) {
            switch ($key) {
                case 'card':
                    $payment_method = 'card';
                    break;
                case 'google_pay':
                    $payment_method = 'google_pay';
                    break;
                case 'liqpay':
                    $payment_method = 'liqpay';
                    break;
            }
        }
        if($request->get('payment_method') === 'card') {
            $card_num = $request->get('card_num');
            $expiration_date = $request->get('expiration_date');
            $CVV = $request->get('CVV');
        }
        $order = Order::find($decoded_id);
        $order->name = $request->get('name');
        $order->surname = $request->get('surname');
        $order->email = $request->get('email');
        $order->phone = $request->get('phone');
        $order->region = $request->get('region');
        $order->city = $request->get('city');
        $order->address = $request->get('address');
        $order->payment_method = $request->get('payment_method');
        $order->card_num = $card_num;
        $order->expiration_date = $expiration_date;
        $order->CVV = $CVV;
        $order->save();
        session()->put('cart', []);
        return redirect('/');
    }

    public static function test() {
        $cart = session()->get('cart');
        $bouquets = Bouquet::query()
            ->wherein('id', array_keys($cart))
            ->get();
        return view('order', compact('cart', 'bouquets'));
    }
    public static function test_save(Request $request) {
            dd(request()->all());
    }
}
