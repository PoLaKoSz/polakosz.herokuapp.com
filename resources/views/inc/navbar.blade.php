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
            <ul class="nav navbar-nav navbar-right fixed-nav">
                <li class="active"><a href="#{{ trans('navbar.menu_home') }}">{{ trans('navbar.menu_home') }} <span class="sr-only">(current)</span></a></li>
                <li><a href="#{{ trans('navbar.menu_about-me') }}">{{ trans('navbar.menu_about-me') }}</a></li>
                <li><a href="#{{ trans('navbar.menu_projects') }}">{{ trans('navbar.menu_projects') }}</a></li>
                <li><a href="#{{ trans('navbar.menu_movies') }}">{{ trans('navbar.menu_movies') }}</a></li>
                @if (Auth::guest())
                    <li><a href="#modalLoginReg" data-toggle="modal" id="LoginRegMenu" data-target="#modalLoginReg">{{ trans('navbar.menu_login') }}</a></li>
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

<div class="container">
    <div id="modalLoginReg" class="modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    
                    <div id="BootstrapTab" class="col-xs-">	
                        <ul  class="nav nav-pills">
                            <li class="active"><a  href="#1b" data-toggle="tab">Login</a></li>
                            <li><a href="#2b" data-toggle="tab">Registration</a></li>
                        </ul>

                        <div class="tab-content clearfix">
                            <div class="tab-pane active" id="1b">
                                @include('inc.login')
                            </div>
                            <div class="tab-pane" id="2b">
                                @include('inc.register')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>