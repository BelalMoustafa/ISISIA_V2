
        <header class="header header-2 header-intro-clearance">
            <div class="header-top">
                <div class="container">
                    <div class="header-left">
                        <button class="mobile-menu-toggler">
                            <span class="sr-only">Toggle mobile menu</span>
                            <i class="fas fa-bars"></i>
                        </button>
                        <a href="index.html" class="logo">
                            <img src="{{url('assets/images/Logo.png')}}" alt="Molla Logo" width="105" height="25">
                        </a>
                        <nav class="main-nav">
                            <ul class="menu sf-arrows">
                                <li class="megamenu-container @if(Request::segment(1)=='') active @endif">
                                    <a href="{{route('main')}}">Home</a>
                                </li>
                                @if (session('logged_in'))
                                <li class="@if(Request::segment(1)=='shop') active @endif">
                                    <a href="{{route('shop')}}">Shop</a>
                                </li>
                                @endif
                                <li class="@if(Request::segment(1)=='about') active @endif"><a href="{{route('about')}}">About</a></li>
                                <li class="@if(Request::segment(1)=='contact') active @endif"><a href="{{route('contact')}}">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="header-right">
                        @if (session('logged_in'))
                        <div class="header-search">
                            <a href="#" class="search-toggle" role="button" title="Search"><i class="fas fa-search text-primary"></i></a>
                            <form action="#" method="get">
                                <div class="header-search-wrapper">
                                    <label for="q" class="sr-only">Search</label>
                                    <input type="search" class="form-control" name="q" id="q" placeholder="Search in..." required>
                                </div>
                            </form>
                        </div>
                        <div class="account">
                            <a href="dashboard.html" title="My account">
                                <div class="icon">
                                    <img src="{{url('assets/images/woman.png')}}" alt="" width="33" height="33">
                                </div>
                                <p>Account</p>
                            </a>
                        </div>
                        <div class="wishlist">
                            <a href="{{route('wishlist.view')}}" title="Wishlist">
                                <div class="icon">
                                    <img src="{{url('assets/images/shopping-cart (1).png')}}" alt="" width="33" height="33">
                                </div>
                                <p>Wishlist</p>
                            </a>
                        </div>
                        <div class="dropdown cart-dropdown">
                            <a href="{{route('cart.view')}}">
                                <div class="icon">
                                    <img src="{{url('assets/images/shopping-cart.png')}}" alt="" width="33" height="33">
                                </div>
                                <p>Cart</p>
                            </a>
                        </div>
                        @endif
                        @if (!session('logged_in'))
                        <div class="account">
                            <a href="{{route('register')}}" title="sign up">
                                <div class="icon">
                                    <img src="{{url('assets/images/user.png')}}" alt="" width="33" height="33">
                                </div>
                                <p>sign up</p>
                            </a>
                        </div>
                        <div class="account">
                            <a href="{{route('login')}}" title="Login">
                                <div class="icon">
                                    <img src="{{url('assets/images/key.png')}}" alt="" width="33" height="33">
                                </div>
                                <p>Login</p>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </header>
