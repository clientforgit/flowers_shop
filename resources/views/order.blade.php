@extends('layout')

@section('content')
    <div class="order-shipping-container layout">
        <div class="order-path">
            <p>Картка покупок</p>
            <img id="inactive" src="{{url('images/arrow_right.svg')}}">
            <h3>Доставка</h3>
            <img src="{{url('images/arrow_right.svg')}}">
            <p>Оплата</p>
        </div>
        <div class="order-content">
            <form name="user_input" action="{{Request::url()}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="user-content">
                    <div class="user-information">
                        <h2>Контакти</h2>
                        <div class="information-grid">
                            <div class="item">
                                <input name="name" type="text" placeholder="Ім'я">
                            </div>
                            <div class="item">
                                <input name="surname" type="text" placeholder="Прізвище">
                            </div>
                            <div class="item">
                                <input name="email" type="text" placeholder="Email">
                            </div>
                            <div class="item">
                                <input name="phone" type="text" placeholder="Номер телефону">
                            </div>
                        </div>
                        <p>Адреса доставки</p>
                        <div class="information-grid">
                            <div class="item">
                                <input name="region" type="text" placeholder="Область">
                            </div>
                            <div class="item">
                                <input name="city" type="text" placeholder="Місто">
                            </div>
                            <div class="item">
                                <input name="address" type="text" placeholder="Адреса">
                            </div>
                        </div>
                    </div>
                    <div class="payment-container">
                        <div class="order-path">
                            <p>Картка покупок</p>
                            <img src="{{url('images/arrow_right.svg')}}">
                            <p>Доставка</p>
                            <img src="{{url('images/arrow_right.svg')}}">
                            <h3>Оплата</h3>
                        </div>
                        <h2>Метод оплати</h2>
                        <div class="payment-methods">
                            <p class="payment-item" onclick="setCheckbox('card')">
                                <input type="radio" id="card" name="card" checked>
                                <label for="card">Карта Visa/MasterCard</label>
                            </p>
                            <p class="payment-item" onclick="setCheckbox('google_pay')">
                                <input type="radio" id="google_pay" name="google_pay">
                                <label for="google_pay">Google Pay</label>
                            </p>
                            <p class="payment-item" onclick="setCheckbox('liqpay')">
                                <input type="radio" id="liqpay" name="liqpay">
                                <label for="liqpay">LiqPay</label>
                            </p>
                        </div>
                        <div class="information-grid" id="payment_grid">
                            <div class="item">
                                <input name="card_num" type="text" placeholder="Номер карти">
                            </div>
                            <div class="item">
                                <input name="expiration_date" type="text" placeholder="Термін дії">
                            </div>
                            <div class="item">
                                <input name="CVV" type="text" placeholder="CVV">
                            </div>
                        </div>
                        <input type="submit" class="pay" value="Оплатити замовлення">
                        <a href="/cart"><p id="back-label">Назад до кошика</p></a>
                    </div>
                </div>
            </form>
            <div class="order-cart">
                <div class="order">
                    <h2>Карта покупок</h2>
                    <hr>
                    @foreach($bouquets as $bouquet)
                    <div class="item">
                        <img src="{{url('images/'.$bouquet->img_name)}}">
                        <div class="text">
                            <h3>Букет '{{$bouquet->name}}'</h3>
                            <p>Ціна: {{$bouquet->price}} грн</p>
                            <p>Cклад: {{$bouquet->composition}}</p>
                            <p>Кількість: {{$cart[$bouquet->id]}}</p>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
