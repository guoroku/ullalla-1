<header>
    <div class="header-area home-1 shop-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <div class="logo-img home-1">
                        <a href="/"><img src="/img/logo/logo2.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                    <div class="top-menu-area">
                        <div class="mainmenu hidden-sm hidden-xs">
                            <nav>
                                <ul style="text-align: center;">
                                    <li><a href="/">Home</a></li>
                                    <li><a href="{{ url('local') }}">Lokale</a></li>
                                    <li><a href="{{ url('profile') }}">Private</a></li>
                                    <li><a href="{{ url('faq') }}">FAQ</a></li>
                                    @if(!Auth::check())
                                    <li><a href="{{ url('signin') }}">Sign In</a></li>
                                    <li><a href="{{ url('signup') }}">Sign Up</a></li>
                                    @else
                                    <li><a href="{{ url('signout') }}">Sign Out</a></li>
                                    @endif
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="flag-icon flag-icon-en{{-- {{ tran() }} --}}"></span>
                                            <span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="/de"><span class="flag-icon flag-icon-de"></span> De</a></li>
                                                <li><a href="/en"><span class="flag-icon flag-icon-en"></span> En</a></li>
                                                <li><a href="/it"><span class="flag-icon flag-icon-it"></span> It</a></li>
                                                <li><a href="/fr"><span class="flag-icon flag-icon-fr"></span> Fr</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile-menu-area visible-sm visible-xs">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 visible-sm visible-xs">
                            <div class="mobile-menu">
                                <nav id="dropdown">
                                    <ul>
                                        <li><a href="/{{-- {{tran()}} --}}">Home</a></li>
                                        <li><a href="/{{-- {{tran()}} --}}/local/">Lokale</a></li>
                                        <li><a href="/{{-- {{tran()}} --}}/profile/">{{-- {{ tran('Private') }} --}}</a></li>
                                        <li><a href="/{{-- {{tran()}} --}}/faq/">FAQ</a></li>
                                        <li><a href="/{{-- {{tran()}} --}}">Login</a></li>
                                        <li class="dropdown">
                                            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="flag-icon flag-icon-{{-- {{ tran() }} --}}"></span>
                                                <span class="caret"></span></a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="/de"><span class="flag-icon flag-icon-de"></span> De</a></li>
                                                    <li><a href="/en"><span class="flag-icon flag-icon-en"></span> En</a></li>
                                                    <li><a href="/it"><span class="flag-icon flag-icon-it"></span> It</a></li>
                                                    <li><a href="/fr"><span class="flag-icon flag-icon-fr"></span> Fr</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>