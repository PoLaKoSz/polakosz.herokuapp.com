<footer id="{{ trans('navbar.menu_contact') }}" class="footer">
    <div class="container">    
        <?php
            $title  = trans('contact.title');
            $design = 'dark-section-header';
        ?>
        @include('inc.section-header')

        <div class="row">
            <div class="col-xs-12 col-sm-8 hidden-xs">
                <div class="row vh-middle">
                    <div class="col-xs-6 text-right">
                        <img src="{{asset('images/facebook-logo.png')}}" alt="{{ trans('contact.fb_image_alt') }}">
                    </div>
                    <div class="col-xs-6 text-left">
                        <p><a href="https://www.facebook.com/PoLaKoSz" class="big-text facebook-color">Facebook</a></p>
                    </div>
                </div>

                <div class="row vh-middle">
                    <div class="col-xs-6 text-right">
                        <img src="{{asset('images/youtube-logo.png')}}" alt="{{ trans('contact.yt_image_alt') }}">
                    </div>
                    <div class="col-xs-6 text-left">
                         <p><a href="" class="big-text youtube-color">YouTube</a></p>
                    </div>
                </div>

                <div class="row vh-middle">
                    <div class="col-xs-6 text-right">
                        <img src="{{asset('images/github-logo.png')}}" alt="{{ trans('contact.github_image_alt') }}">
                    </div>
                    <div class="col-xs-6 text-left">
                        <p><a href="https://github.com/PoLaKoSz" class="big-text github-color">GitHub</a></p>
                    </div>
                </div>

                <div class="row vh-middle">
                    <div class="col-xs-6 text-right">
                        <img src="{{asset('images/email-logo.png')}}" alt="{{ trans('contact.email_image_alt') }}">
                    </div>
                    <div class="col-xs-6 text-left">
                        <p><a href="mailto:polakosz@freemail.hu" class="big-text freemail-color">polakosz@freemail.hu</a></p>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-8 visible-xs text-center">
                <div class="row text-center">
                        <img src="{{asset('images/facebook-logo.png')}}" alt="{{ trans('contact.fb_image_alt') }}">
                </div>
                <div class="row text-center">
                    <p><a href="https://www.facebook.com/PoLaKoSz" class="big-text facebook-color">Facebook</a></p>
                </div>

                <div class="row text-center">
                    <img src="{{asset('images/youtube-logo.png')}}" alt="{{ trans('contact.yt_image_alt') }}">
                </div>
                <div class="row text-center">
                    <p><a href="" class="big-text youtube-color">YouTube</a></p>
                </div>

                <div class="row text-center">
                    <img src="{{asset('images/github-logo.png')}}" alt="{{ trans('contact.github_image_alt') }}">
                </div>
                <div class="row text-center">
                    <p><a href="https://github.com/PoLaKoSz" class="big-text github-color">GitHub</a></p>
                </div>

                <div class="row text-center">
                    <img src="{{asset('images/email-logo.png')}}" alt="{{ trans('contact.email_image_alt') }}">
                </div>
                <div class="row text-center">
                    <p><a href="mailto:polakosz@freemail.hu" class="big-text freemail-color">polakosz@freemail.hu</a></p>
                </div>
            </div>

            <div class="col-xs-12 col-sm-4">
                <form action="{{ LaravelLocalization::localizeURL('contact') }}" method="POST">
                    <input type="text" name="name" placeholder="{{ trans('contact.name_field') }}"><br>
                    <input type="text" name="email" placeholder="{{ trans('contact.email_field') }}"><br>
                    <textarea name="message"></textarea><br>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button class="btn btn-orange">{{ trans('contact.send_button') }}</button>
                </form>
            </div>
        </div>

        <div class="row text-center section-padding">
            <h4>{{ trans('contact.copyright_text', ['year' => date("Y")]) }}</h4>
        </div>

        <div class="row text-center">
            <div class="col-xs-6">
                <p><img src="{{ asset('/images/HU_flag.png') }}" alt="Magyar zászló"><a href="{{ LaravelLocalization::localizeURL(null, 'hu') }}">Magyar</a></p>
            </div>
            <div class="col-xs-6">
                <p><img src="{{ asset('/images/UK_flag.png') }}" alt="English flag"><a href="{{ LaravelLocalization::localizeURL(null, 'en') }}">English</a></p>
            </div>
        </div>
    </div>
</footer>
