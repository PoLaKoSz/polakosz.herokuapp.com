<header id="contact-header">
    <div class="container">
        <div class="row">
            <div class="col-3">
                <div class="fb-like" data-href="https://www.facebook.com/PoLaKoSz/" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div>
            </div>
            <div class="col-9 text-right">
                <small>
                    <img src="{{asset('images/email.png')}}" alt="{{ trans('navbar.email_image_alt') }}">
                    polakosz@freemail.hu
                </small>
            </div>
        </div>
    </div>
</header>

<nav class="navbar navbar-expand-md navbar-default navbar-light bg-light py-4">
    <div class="container">
        <a class="navbar-brand signature" href="#">PoLáKoSz</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav ml-auto mt-2 mt-md-0">
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