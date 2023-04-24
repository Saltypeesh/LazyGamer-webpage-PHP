<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LazyGamer</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <link rel="stylesheet" href="{{ asset('plugins/OwlCarousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/OwlCarousel/dist/assets/owl.theme.default.min.css') }}">

    {{-- Select 2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- Alpine.js --}}
    <script src="//unpkg.com/alpinejs" defer></script>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/partials.css') }}">
</head>

<body>
    <div class="space"></div>
    <nav class="header-container">
        <div class="logo">
            <a href={{ route('home') }}><img class="w-100" src="{{ asset('images/logo.png') }}" alt="" /></a>
        </div>
        <div class="menu">
            <div class="product-menu">
                <div class="links">
                    <div class="nav pc">
                        <a href="/listings/?platform=1">
                            <div class="icon-pc icon-sx d-sm-inline-block">
                                <img class="w-100" src="{{ asset('icon/icon-pc.svg') }}" alt="" />
                            </div>
                            <span class="nav-title">PC</span>
                        </a>
                    </div>

                    <div class="nav playstation">
                        <a href="/listings/?platform=2">
                            <div class="icon-play icon-sx d-sm-inline-block">
                                <img class="w-100" src="{{ asset('icon/icon-play.svg') }}" alt="" />
                            </div>
                            <span class="nav-title">Playstation</span>
                        </a>
                    </div>

                    <div class="nav xbox">
                        <a href="/listings/?platform=3">
                            <div class="icon-xbox icon-sx d-sm-inline-block">
                                <img class="w-100" src="{{ asset('icon/icon-xbx.svg') }}" alt="" />
                            </div>
                            <span class="nav-title">Xbox</span>
                        </a>
                    </div>

                    <div class="nav switch">
                        <a href="/listings/?platform=4">
                            <div class="icon-switch icon-sx d-sm-inline-block">
                                <img class="w-100" src="{{ asset('icon/icon-swt.svg') }}" alt="" />
                            </div>
                            <span class="nav-title">Nintendo</span>
                        </a>
                    </div>
                </div>

                <div class="space d-md-none"></div>
            </div>
        </div>

        <div class="header-right">
            @auth
                <div class="manage-container d-flex pe-3">
                    <div class="me-4 d-none d-xl-flex" style="font-weight: bold; font-size: 16px; text-transform:uppercase">
                        Welcome
                        <a class="ms-3"
                            style="display: inline-block; max-width: 150px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"
                            href="{{ route('users.edit') }}"> {{ auth()->user()->username }}</a>
                    </div>
                    @if (auth()->user()->role == 'admin')
                        <a href="{{ route('admin.manage') }}">
                            <span class="d-none d-xxl-inline"></span>
                            <i class="fa-solid fa-gear"></i>
                        </a>
                    @endif
                </div>

                <div class="cart-container pe-3">
                    <a href="{{ route('users.cart') }}">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                </div>
                <div class="logout-container">
                    <form method="POST" action="/users/logout">
                        @csrf
                        <button type="submit">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </button>
                    </form>
                </div>
            @else
                <div class="cart-container pe-3">
                    <a href="{{ route('users.cart') }}">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                </div>
                <div class="login-container">
                    <a href="{{ route('login-view') }}">
                        <div class="avatar">
                            <img class="w-100" src="{{ asset('icon/avatar.svg') }}" alt="" class="icon-cart" />
                        </div>
                    </a>
                </div>
            @endauth
        </div>

        @auth
            @if (auth()->user()->role == 'admin')
                <div class="create-listing d-flex">
                    <a class="d-inline" href="{{ route('admin.create') }}">
                        <i class="fa-solid fa-plus"></i>
                    </a>
                </div>
            @endif
        @endauth
    </nav>

    <main>
        {{ $slot }}
    </main>

    <footer class="footer-container">
        <div class="container">
            <div class="content">
                <div class="links">
                    <div class="row">
                        <div class="logo-footer col-lg-4 d-lg-inline-block">
                            <a href="/"><img class="w-100" src="{{ asset('images/logo.png') }}" /></a>
                        </div>

                        <div class="list-container col-12 col-lg-4">
                            <ul class="list">
                                <li>
                                    <a class="sublinks" href="/feedbacks">Feedback</a>
                                </li>
                                <li>
                                    <a class="sublinks" href="{{ route('terms_of_Use') }}">Terms of Use</a>
                                </li>
                                <li>
                                    <a class="sublinks" href="{{ route('privacy_Policy') }}">Privacy policy</a>
                                </li>
                                <li>
                                    <a class="sublinks" href="">Contact us</a>
                                </li>
                                <li>
                                    <a class="sublinks" href="{{ route('faq') }}">FAQ</a>
                                </li>
                                <li>
                                    <a class="sublinks" href="">
                                        <i class="fa-solid fa-gift" style="color:#FF5400"></i> Our gift card</a>
                                </li>
                            </ul>
                        </div>

                        <div class="medias-container col-12 col-lg-4">
                            <div class="medias">
                                <div class="icons">
                                    <a href="#" class="twitter"><i class="fa-brands fa-twitter"></i></a>
                                    <a href="#" class="instagram"><i class="fa-brands fa-instagram"></i></a>
                                    <a href="#" class="facebook"><i class="fa-brands fa-facebook-f"></i></a>
                                    <a href="#" class="youtube"><i class="fa-brands fa-youtube"></i></a>
                                    <a href="#" class="twitch"><i class="fa-brands fa-twitch"></i></a>
                                    <a href="#" class="extension d-lg-inline-block"><i
                                            class="fa-solid fa-puzzle-piece"></i></i></a>
                                </div>

                                <div class="apps">
                                    <a href="#" class="me-4">
                                        <div class="apps-img"><img class="w-100"
                                                src="{{ asset('icon/apple.svg') }}" />
                                        </div>
                                    </a>
                                    <a href="#">
                                        <div class="apps-img"><img class="w-100"
                                                src="{{ asset('icon/android.svg') }}" />
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="copyright-container">
                    <div class="copyright">Copyright © 2023 Instant Gaming - All rights reserved</div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="{{ asset('plugins/OwlCarousel/dist/owl.carousel.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/a9e40c9b1b.js" crossorigin="anonymous"></script>

    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/submitOrders.js') }}"></script>

    <x-flash-message />
</body>

</html>
