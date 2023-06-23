@extends('layout')

@section('content')
    <div class="card-container layout">
        <div class="catalog-path">
            <p class="path" onclick="redirect('/')">Домашня сторінка</p>
            <p class="path">&nbsp;/&nbsp;</p>
            <p class="path" onclick="redirect('/catalog')">Каталог</p>
            <p class="path">&nbsp;/&nbsp;</p>
            @if (empty($group))
                <p class="path" onclick="redirect('/catalog')">"Всі букети"</p>
            @else
                <p class="path" onclick="redirect('/catalog?{{http_build_query(['filter' => [array_key_first($group) => array_values($group)[0]]])}}')">{{array_values($group)[0]}}</p>
            @endif
        </div>
        <h2>Букет "{{$bouquet->name}}"</h2>
        <div class="card">
            <img src="/images/{{$bouquet->img_name}}">
            <div class="background">
                <div class="card-content">
                    <h2>Букет "{{$bouquet->name}}"</h2>
                    <h3>Ціна: {{$bouquet->price}} грн</h3>
                    <hr class="thin">
                    <h3>
                        Опис букету:<br>
                        {{$bouquet->description}}
                    </h3>
                    <h3>
                        Склад:<br>
                        {{$bouquet->composition}}
                    </h3>
                    <div class="region">
                        <h3>Доставка в Київ (</h3>
                        <p>змінити регіон</p>
                        <h3>)</h3>
                    </div>
                    <hr class="thin">
                    <p>Найближча дата доставки: {{$shipping_date}}</p>
                    <div class="button-section">
                        <a class="order-button" onclick="update_cart('{{csrf_token()}}', {{$bouquet->id}})">
                            <img src="/images/cart_dark.svg">
                            Замовити
                        </a>
                        <a class="order-button" id="hidden_cart_button" href="/cart">
                            Перейти&nbsp;до&nbsp;кошика
                        </a>
                    </div>
                    <h3 id="success_text">Букет додано до кошику</h3>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function update_cart(csrf_token, id) {
            $.ajax({
                url: '/add_to_cart',
                type: 'patch',
                data: {
                    _token: csrf_token,
                    id: id
                },
                success: function (response) {
                    if (response === 'add to cart successfully') {
                        show_hidden_card_button();
                    }
                }
            });
        }
    </script>
@endpush
