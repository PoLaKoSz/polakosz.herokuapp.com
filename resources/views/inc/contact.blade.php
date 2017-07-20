<footer id="footer">
    <div class="container">    
        <div class="row">
            <div class="row">
                <div class="section-header dark-section-header">
                    <div class="section-header-line"></div>
                    <div class="section-header-name bigger-text">
                        {{ trans('contact.title') }}
                    </div>
                    <div class="section-header-line"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-8">
                <div class="row vh-middle">
                    <div class="col-xs-6 text-right">
                        <img src="{{asset('images/facebook-logo.png')}}" alt="{{ trans('contact.fb_image_alt') }}">
                    </div>
                    <div class="col-xs-6 text-left">
                        <a href="" class="big-text facebook-color">Facebook</a>
                    </div>
                </div>

                <div class="row vh-middle">
                    <div class="col-xs-6 text-right">
                        <img src="{{asset('images/youtube-logo.png')}}" alt="{{ trans('contact.yt_image_alt') }}">
                    </div>
                    <div class="col-xs-6 text-left">
                         <a href="" class="big-text youtube-color">YouTube</a>
                    </div>
                </div>

                <div class="row vh-middle">
                    <div class="col-xs-6 text-right">
                        <img src="{{asset('images/email-logo.png')}}" alt="{{ trans('contact.email_image_alt') }}">
                    </div>
                    <div class="col-xs-6 text-left">
                        <a href="" class="big-text freemail-color">polakosz@freemail.hu</a>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-4">
                <form>
                    <input type="text" name="contactName" placeholder="{{ trans('contact.name_field') }}"><br>
                    <input type="text" name="email" placeholder="{{ trans('contact.email_field') }}"><br>
                    <textarea name="message"></textarea><br>
                    <button class="btn btn-orange">{{ trans('contact.send_button') }}</button>
                </form>
            </div>
        </div>

        <div class="row text-center section-margin">
            {{ trans('contact.copyright_text', ['year' => '2017']) }}
        </div>
    </div>
</footer>