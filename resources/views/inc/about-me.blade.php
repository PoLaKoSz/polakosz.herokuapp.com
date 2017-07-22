<section id="about-me" class="container">
    <div class="row section-padding">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-padding">
                <div class="row v-middle">
                    <div class="col-xs-3 remove-padding">
                        <img src="{{asset('images/past.png')}}" alt="{{ trans('about-me.past_image_alt') }}">
                    </div>

                    <div class="col-xs-9">
                        <h2 class="uppercase-text bold-text">{{ trans('about-me.past_title') }}</h2>
                    </div>
                </div>

                <div class="row">
                    <p class="big-text">{{ trans('about-me.past_text') }}</p>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-padding">
                <div class="row v-middle">
                    <div class="col-xs-3 remove-padding">
                        <img src="{{asset('images/present.png')}}" alt="{{ trans('about-me.present_image_alt') }}">
                    </div>

                    <div class="col-xs-9">
                        <h2 class="uppercase-text bold-text">{{ trans('about-me.present_title') }}</h2>
                    </div>
                </div>

                <div class="row">
                    <p class="big-text">{{ trans('about-me.present_text') }}</p>
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-padding">
                <div class="row v-middle">
                    <div class="col-xs-3 remove-padding">
                        <img src="{{asset('images/future.png')}}" alt="{{ trans('about-me.future_image_alt') }}">
                    </div>

                    <div class="col-xs-9">
                        <h2 class="uppercase-text bold-text">{{ trans('about-me.future_title') }}</h2>
                    </div>
                </div>

                <div class="row">
                    <p class="big-text">{{ trans('about-me.future_text') }}</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-padding text-center">
                    <button class="btn btn-orange">{{ trans('about-me.btn_read_more') }}</button>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-padding text-center">
                    <button class="btn btn-orange">{{ trans('about-me.btn_read_more') }}</button>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-padding text-center">
                    <button class="btn btn-orange">{{ trans('about-me.btn_read_more') }}</button>
            </div>
        </div>
    </div>
</section>