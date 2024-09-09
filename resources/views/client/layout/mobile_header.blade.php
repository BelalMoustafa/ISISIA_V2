
    <button id="scroll-top" title="Back to Top"><i class="fas fa-arrow-up-long"></i></button>
    <div class="mobile-menu-overlay"></div>
    <div class="mobile-menu-container mobile-menu-light">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><b class="text-dark">X</b></span>
            @if (session('logged_in'))
            <form action="#" method="get" class="mobile-search">
                <label for="mobile-search" class="sr-only">Search</label>
                <input type="search" class="form-control" name="mobile-search" id="mobile-search"
                    placeholder="Search product ..." required>
                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
            </form>
            @endif
            <div class="tab-content">
                <div class="tab-pane fade show active" id="mobile-menu-tab" role="tabpanel"
                    aria-labelledby="mobile-menu-link">
                    <nav class="mobile-nav">
                        <ul class="mobile-menu">
                            <li class="@if(Request::segment(1)=='') active @endif">
                                <a href="{{route('main')}}">Home</a>
                            </li>
                            @if (session('logged_in'))
                            <li class="@if(Request::segment(1)=='shop') active @endif">
                                <a href="{{route('shop')}}">Shop</a>
                            </li>
                            @endif
                            <li class="@if(Request::segment(1)=='about') active @endif">
                                <a href="{{route('about')}}">About</a>
                            </li>
                            <li class="@if(Request::segment(1)=='contact') active @endif">
                                <a href="{{route('contact')}}">Contact</a>
                            </li>
                            @if (!session('logged_in'))
                            <li>
                                <a href="{{route('login')}}">Login</a>
                            </li>
                            <li>
                                <a href="{{route('register')}}">Sign up</a>
                            </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="social-icons">
                <a href="https://www.facebook.com/profile.php?id=61564877156777" class="social-icon" target="_blank" title="Facebook"><i class="fab fa-facebook"></i></a>
                <a href="https://www.instagram.com/isisia.brand/" class="social-icon" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
