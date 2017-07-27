<header id="contact-header">
    <div class="container">
        <div class="row">
            <div class="col-xs-3">
                <div class="fb-like" data-href="https://www.facebook.com/PoLaKoSz/" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div>
            </div>
            <div class="col-xs-9 text-right">
                <img src="{{asset('images/email.png')}}" alt="{{ trans('navbar.email_image_alt') }}">polakosz@freemail.hu
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
                <li class="active"><a href="#{{ trans('navbar.menu_home') }}">{{ trans('navbar.menu_home') }} <span class="sr-only">(current)</span></a></li>
                <li><a href="#{{ trans('navbar.menu_about-me') }}">{{ trans('navbar.menu_about-me') }}</a></li>
                <li><a href="#{{ trans('navbar.menu_projects') }}">{{ trans('navbar.menu_projects') }}</a></li>
                <li><a href="#{{ trans('navbar.menu_movies') }}">{{ trans('navbar.menu_movies') }}</a></li>
                @if (Auth::guest())
                    <li><a href="{{ LaravelLocalization::localizeURL('login') }}">{{ trans('navbar.menu_login') }}</a></li>
                    <li><a href="{{ LaravelLocalization::localizeURL('register') }}">{{ trans('navbar.menu_register') }}</a></li>
                @else
                    <li>
                        <a href="{{ LaravelLocalization::localizeURL('logout') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            {{ trans('navbar.menu_logout') }}
                        </a>

                        <form id="logout-form" action="{{ LaravelLocalization::localizeURL('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<div id="navbar-helper"></div>