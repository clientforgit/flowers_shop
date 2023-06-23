@extends('layout')

@section('content')
    <div class="confirm-order-container layout">
        <div class="order-path">
            <h3>Картка покупок</h3>
            <img src="images/arrow_right.svg">
            <p>Доставка</p>
            <img id="inactive" src="images/arrow_right.svg">
            <p>Оплата</p>
        </div>
        <div class="order-content">
            <div class="order">
                <h2>Карта покупок</h2>
                <hr>
                @foreach($bouquets as $bouquet)
                    <div class="item">
                        <img src="images/{{$bouquet->img_name}}">
                        <div class="text">
                            <h3>Букет "{{$bouquet->name}}"</h3>
                            <p>Ціна: {{$bouquet->price}} грн</p>
                            <p>Склад: {{$bouquet->consistance}}</p>
                            <div class="select-container" onclick="show_hidden_section({{$bouquet->id}})">
                                <p id="select_number{{$bouquet->id}}">Кількість: {{$cart[$bouquet->id]}}&nbsp;&nbsp;</p>
                                <img id="select_arrow{{$bouquet->id}}" src="images/arrow_down.svg">
                            </div>
                            <div class="hidden-select" id="hidden_select{{$bouquet->id}}">
                                <div class="select-options">
                                    @foreach(range(1, 20) as $number)
                                        <p onclick="change_selected_number({{$number}}, {{$bouquet->id}})">{{$number}}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
            <div class="total">
                <h2>Всього</h2>
                <hr>
                <div class="wide-text">
                    <h3>Проміжний підсумок</h3>
                    <h3 id="bouquets_price">{{$bouquets_price}} грн</h3>
                </div>
                <div class="wide-text">
                    <h3>Доставка</h3>
                    <h3>—</h3>
                </div>
                <hr>
                <div class="wide-text">
                    <h3>Всього</h3>
                    <h3 id="result_price">{{$bouquets_price}} грн</h3>
                </div>
                <div class="wide-text">
                    <h3>Знижка</h3>
                    <img src="images/arrow_right.svg">
                </div>
                <hr>
                <button class="order-now-button" onclick="save_cart('{{csrf_token()}}')">
                    Оформити замовлення
                </button>
                <a href="/catalog" class="continue-shopping"><h3>Продовжити покупки</h3></a>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        let cart = {@foreach($cart as $id => $amount)
            {{$id.':'.$amount.','}}
            @endforeach};
        let bouquets = {@foreach($bouquets as $bouquet)
            {{$bouquet->id.':'.$bouquet->price.','}}
        @endforeach};
        let price = 0;
        function result_price_update(number, bouquet_id) {
            let bouquets_price = document.getElementById('bouquets_price');
            let result_price = document.getElementById('result_price');
            cart[bouquet_id] = number;
            for (let id in bouquets) {
                price += bouquets[id]*cart[id];
            }
            bouquets_price.innerHTML = price + ' грн';
            result_price.innerHTML = price + ' грн';
        }

        function save_cart(csrf_token) {
            $.ajax({
                url: '/save_cart',
                type: 'patch',
                data: {
                    _token: csrf_token,
                    cart: cart
                },
                success: function (response) {
                    redirect('/order/' + response);
                }
            })
        }
    </script>
@endpush
