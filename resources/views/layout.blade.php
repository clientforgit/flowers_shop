<!DOCTYPE html>
<html lang="uk">
<head>
    <title>FRESH FLOWERs</title>
    <link href="/css/style.css" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<body>
<div class="container">
    <header class="layout header">
        <div class="top-header">
            <img src="/images/logo_dark.svg" class="header-logo" alt="Logo" onclick="redirect('/')">
            <div class="title-header-nav">
                <a href="#about_us">Про нас</a>
                <a href="/catalog">Каталог</a>
                <a href="#FAQ">FAQ</a>
                <div class="title-header-icon">
                    <img src="/images/cart_dark.svg" onclick="check_cart()">
                    <img src="/images/user_dark.svg">
                    <dev class="hidden-cart-state" id="hidden_cart_state">
                        <p>Кошик порожній</p>
                    </dev>
                </div>
            </div>
            <div class="menu" onclick="open_hidden_header()">
                <img src="/images/menu_dark.svg">
            </div>
        </div>
        <div class="hidden-header" id="hidden_header">
            <a href="#about_us">Про нас</a>
            <a href="/catalog">Каталог</a>
            <a href="#FAQ">FAQ</a>
            <h3>Особистий кабінет</h3>
            <a onclick="check_cart()">Кошик</a>
            <dev class="hidden-cart-state" id="hidden_cart_state_mobile">
                <p>Кошик порожній</p>
            </dev>
            <hr class="thin">
        </div>
    </header>
    @yield('content')
</div>
<footer class="layout">
    <h2>FRESH FLOWERs</h2>
    <div class="links">
        <p>Про нас</p>
        <p>Магазин</p>
        <p>Контакти</p>
        <p>Кошик</p>
        <p>Доставка</p>
    </div>
    <div class="icons">
        <img src="/images/mail_white.svg" alt="Mail">
        <img src="/images/facebook_white.svg" alt="Facebook">
        <img src="/images/instagram_white.svg" alt="Instagram">
    </div>
    <p class="copyright">2023 FRESH FLOWERS</p>
    <img src="/images/scroll_button.svg" class="scroll-button" alt="To the top" onclick="redirect('#')">
</footer>
<script src="/js/script.js"></script>
<script>
    function check_cart() {
        $.ajax({
            url: '/check_cart',
            type: 'get',
            success: function (response) {
                if(response === 'cart not empty') {
                    redirect('/cart');
                } else {
                    show_cart_state();
                }
            }
        })
    }
    function show_cart_state() {
        let state = null;
        if (window.screen.availWidth > 1080) {
            state = document.getElementById('hidden_cart_state');
        } else {
            state = document.getElementById('hidden_cart_state_mobile');
        }
        state.style.maxHeight = '51px';
        setTimeout(() => {
            state.style.maxHeight = '0';
        }, 2000);
    }
</script>
@stack('script')
</body>
</html>
