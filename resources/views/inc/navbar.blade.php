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
                @if ( !Auth::guest() )
                    @include('inc.navbar-types.authenticated')
                @else
                    @include('inc.navbar-types.unauthenticated')
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
                            <li class="active"><a  href="#1b" data-toggle="tab">{{ trans('navbar.menu_login') }}</a></li>
                            <li><a href="#2b" data-toggle="tab">{{ trans('navbar.menu_register') }}</a></li>
                        </ul>

                        <div class="tab-content clearfix">
                            <div class="tab-pane active" id="1b">
                                @include('auth.login')
                            </div>
                            <div class="tab-pane" id="2b">
                                @include('auth.register')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>