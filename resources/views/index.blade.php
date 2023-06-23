<!DOCTYPE html>
<html lang="uk">
<head>
    <title>FRESH FLOWERs</title>
    <link href="css/style.css" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<body>
<div class="title-container">
    <header class="header main-layout">
        <div class="top-header">
            <img src="images/logo.svg" class="header-logo" alt="Logo">
            <div class="title-header-nav">
                <a href="#about_us">Про нас</a>
                <a href="/catalog">Каталог</a>
                <a href="#FAQ">FAQ</a>
                <div class="title-header-icon">
                    <img src="images/cart.svg" onclick="check_cart()">
                    <img src="images/user.svg">
                        <dev class="hidden-cart-state" id="hidden_cart_state">
                            <p>Кошик порожній</p>
                        </dev>
                </div>
            </div>
            <div class="menu" onclick="open_hidden_header()">
                <img src="images/menu.svg">
            </div>
        </div>
        <div class="main-hidden-header" id="hidden_header">
            <a href="#about_us">Про нас</a>
            <a href="/catalog">Каталог</a>
            <a href="#FAQ">FAQ</a>
            <a>Особистий кабінет</a>
            <a onclick="check_cart()">Кошик</a>
            <dev class="hidden-cart-state" id="hidden_cart_state_mobile">
                <p>Кошик порожній</p>
            </dev>
            <hr class="thin">
        </div>
    </header>
    <div class="title-text-container">
        <h1 class="title-text">
            FRESH<span id="first" class="mobile-space1">&nbsp;</span>
            <span id="second" class="mobile-space2">&nbsp;</span>FLOWERs</h1>
        <h2 class="title-subtext">Квіти, замість тисячі слів</h2>
        <button class="buy_button_mobile" onclick="redirect('/catalog')">Придбати</button>
    </div>
    <div class="title-bottom">
        <img class="buy_button" onclick="redirect('/catalog')" src="images/buy_button.svg" alt="Buy now">
    </div>
</div>
<div class="index-dark-line">
    <p>Хочете знати що робити, якщо ви зробили щось не так?</p>
    <p>Вiдповiдь: Не кажiть нiчого. Надiшлiть Квiти. Без листiв.</p>
    <p>Тiльки Квiти. Вони все покривають.</p>
    <p style="transform: translateX(415px)">Erih Maria <span style="color: white;">Remarque</span></p>
</div>
<div class="best-offers">
    <h2>Найкращі пропозиції</h2>
    <a href="/catalog"><h2>Більше</h2></a>
    <div class="best-offers-row">
        @foreach($bouquets as $bouquet)
            <div class="best-offers-item">
                <img src="images/{{$bouquet->img_name}}" alt="Flowers {{$bouquet->id}}">
                <div class="subtitle">
                    <p>Букет "{{$bouquet->name}}"</p>
                    <p class="price">{{$bouquet->price}}₴</p>
                </div>
            </div>
        @endforeach
        <img class="next-button" src="images/start-page-decoration.svg" alt="Start page decoration">
    </div>
    <div class="bottom-line"></div>
</div>
<div class="introduction" id="about_us">
    <div class="sub">
        <img src="images/olga.png" class="photo" alt="Olga, the florist">
        <div class="text-container">
            <p>
                Мене звати Ольга, я флорист-декоратор.<br>
                Букети для мене це не просто квіти - це емоції,<br>
                радість, увага та любов. Я завжди щиро рада за<br>
                дівчат, жінок, іноді навіть чоловіків, для яких<br>
                я творю ці букети. Коли клієнт задоволений це<br>
                приносить мені неймовірні емоції - найкраща<br>
                мотивація для мене
            </p>
            <a class="more-info-mobile"><h2>Дізнатись&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>більше</h2></a>
        </div>
        <img class="more-info" src="images/more_info.svg" alt="More info">
    </div>
</div>
<div class="right-present">
    <h2 class="title">Оберіть правильний подарунок</h2>
    <div class="presents-section">
        <div class="item" onclick="redirect('{{$weddingURL}}')">
            <img src="images/present1.png" alt="Present 1">
            <div class="description">
                <p class="title">Весільні букети</p>
                <hr class="separator">
                <p class="text">
                    Ідеальні квіти для особливого дня!
                </p>
            </div>
        </div>
        <div class="item" onclick="redirect('{{$mixURL}}')">
            <img src="images/present2.png" alt="Present 2">
            <div class="description">
                <p class="title">Мікс букети</p>
                <hr class="separator">
                <p class="text">Найкраще поєднання кольору та краси</p>
            </div>
        </div>
        <div class="item" onclick="redirect('{{$monoURL}}')">
            <img src="images/present3.png" alt="Present 3">
            <div class="description">
                <p class="title">Моно букети</p>
                <hr class="separator">
                <p class="text">Один колір, нескінченна елегантність</p>
            </div>
        </div>
        <img class="buy-now" src="images/buy_now.svg" alt="Buy now" onclick="redirect('/catalog')">
        <h2 class="buy-now-mobile">Придбай&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>вже зараз</h2>
    </div>
    <div class="feedback-screen" id="FAQ">
        <img class="feedback-photo" src="images/feedback.png" alt="Photo for the feedback form">
        <div class="feedback">
            <h2>Виникли питання? Напишіть нам:</h2>
            <div class="feedback-icons">
                <img src="images/mail.svg" alt="Mail" onmouseover="showContact('freshflowers56@gmail.com')">
                <img src="images/facebook.svg" alt="Facebook" onclick="redirect('https://www.facebook.com/freshflowers.berezne')">
                <img src="images/instagram.svg" alt="Instagram" onclick="redirect('https://www.instagram.com/fresh_flowers_berezne/')">
                <img src="images/viber.svg" alt="Viber" onmouseover="showContact('+380674790712')">
                <img src="images/telegram.svg" alt="Telegram">
            </div>
            <h2 id="hidden_contact"></h2>
        </div>
    </div>
</div>
<footer>
    <h2>FRESH FLOWERs</h2>
    <div class="links">
        <p>Про нас</p>
        <p>Магазин</p>
        <p>Контакти</p>
        <p>Кошик</p>
        <p>Доставка</p>
    </div>
    <div class="icons">
        <img src="images/mail_white.svg" alt="Mail">
        <img src="images/facebook_white.svg" alt="Facebook">
        <img src="images/instagram_white.svg" alt="Instagram">
    </div>
    <p class="copyright">2023 FRESH FLOWERS</p>
    <a href="#"><img src="images/scroll_button.svg" class="scroll-button" alt="To the top" onclick="scrollToTop()"></a>
</footer>
<script src="js/script.js"></script>
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
</body>
</html>
