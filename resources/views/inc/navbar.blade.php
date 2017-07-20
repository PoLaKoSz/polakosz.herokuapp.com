<header id="contact-header">
    <div class="container">
        <div class="row">
            <div class="col-xs-3">
                FaceBook<!--<div class="fb-like" data-href="https://facebook.com/polakosz" data-layout="button" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div>-->
            </div>
            <div class="col-xs-9 text-right">
                <img src="{{asset('images/email.png')}}" alt="Send an email here">polakosz@freemail.hu
            </div>
        </div>
    </div>
</header>

<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand signature" href="#">PoLáKoSz</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="/">Kezdőlap <span class="sr-only">(current)</span></a></li>
                <li><a href="/about-me">Rólam</a></li>
                <li><a href="/projects">Projektek</a></li>
                <li><a href="/movies">Filmek</a></li>
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @else
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @endif
                <li><a href="/contact">Kapcsolat</a></li>
            </ul>
        </div>
    </div>
</nav>