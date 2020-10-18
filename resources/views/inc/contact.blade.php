<footer id="{{ trans('navbar.menu_contact') }}" class="container-fluid pt-5">
    <div class="container">
        <?php
            $title  = trans('contact.title');
            $design = 'dark';
        ?>
        @include('inc.section-header')

        <div class="row pb-5">
            <div class="col-12 col-md-6 my-auto pb-3 pb-md-0">
                <div class="row">
                    <div class="col-6 text-right">
                        <img src="{{asset('images/facebook-logo.png')}}" alt="{{ trans('contact.fb_image_alt') }}">
                    </div>
                    <div class="col-6 my-auto">
                        <a href="https://www.facebook.com/PoLaKoSz" class="font-weight-bold facebook-color">Facebook</a>
                    </div>
                    <div class="col-6 text-right">
                        <img src="{{asset('images/youtube-logo.png')}}" alt="{{ trans('contact.yt_image_alt') }}">
                    </div>
                    <div class="col-6 my-auto">
                        <s class="font-weight-bold youtube-color">YouTube</s>
                    </div>
                    <div class="col-6 text-right">
                        <img src="{{asset('images/github-logo.png')}}" alt="{{ trans('contact.github_image_alt') }}">
                    </div>
                    <div class="col-6 my-auto">
                        <a href="https://github.com/PoLaKoSz" class="font-weight-bold github-color">GitHub</a>
                    </div>
                    <div class="col-6 text-right">
                        <img src="{{asset('images/email-logo.png')}}" alt="{{ trans('contact.email_image_alt') }}">
                    </div>
                    <div class="col-6 my-auto">
                        <a href="mailto:polakosz@freemail.hu" class="font-weight-bold email-color">polakosz@freemail.hu</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <form action="{{ LaravelLocalization::localizeURL('contact') }}" method="POST">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <input type="email" name="email" required placeholder="{{ trans('contact.email_field') }}" autocomplete="email" class="form-control" aria-describedby="emailHelp">
                        <small id="emailHelp" class="form-text text-muted">{{ trans('contact.email_info') }}</small>
                    </div>

                    <div class="form-group">
                        <input type="text" name="name" required minlength="3" placeholder="{{ trans('contact.name_field') }}"  autocomplete="name" class="form-control" aria-label="Full name">
                    </div>

                    <div class="form-group">
                        <textarea name="message" required minlength="10" class="form-control" aria-label="Type here your suggestion or question"></textarea>
                    </div>

                    <button type="submit" class="btn btn-orange">{{ trans('contact.send_button') }}</button>
                </form>
            </div>
        </div>

        <div class="row text-center">
            <div class="col-12 pb-3">
                <small class="text-muted">{{ trans('contact.copyright_text', ['year' => date("Y")]) }}</small>
            </div>
            <div class="col-6">
                <p><img src="{{ asset('/images/HU_flag.png') }}" alt="Magyar zászló"><a href="{{ LaravelLocalization::localizeURL(null, 'hu') }}">Magyar</a></p>
            </div>
            <div class="col-6">
                <p><img src="{{ asset('/images/UK_flag.png') }}" alt="English flag"><a href="{{ LaravelLocalization::localizeURL(null, 'en') }}">English</a></p>
            </div>
        </div>
    </div>
</footer>
