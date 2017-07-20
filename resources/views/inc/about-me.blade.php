<section id="about-me" class="container">
    <div class="row section-margin">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-padding">
            <div class="row">
                <div class="col-xs-3 remove-padding">
                    <img src="{{asset('images/leaf.png')}}" alt="A picture about a leaf.">
                </div>

                <div class="col-xs-9">
                    <h1 class="bigger-text">{{ trans('about-me.past_title') }}</h1>
                </div>
            </div>

            <div class="row">
                <p class="big-text">{{ trans('about-me.past_text') }}</p>
            </div>

            <div class="row text-center">
                <button class="btn btn-orange">{{ trans('about-me.btn_read_more') }}</button>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-padding">
            <div class="row">
                <div class="col-xs-3 remove-padding">
                    <img src="{{asset('images/mobile.png')}}" alt="A picture about a mobile.">
                </div>

                <div class="col-xs-9">
                    <h1 class="bigger-text">{{ trans('about-me.present_title') }}</h1>
                </div>
            </div>

            <div class="row">
                <p class="big-text">{{ trans('about-me.present_text') }}</p>
            </div>

            <div class="row text-center">
                <button class="btn btn-orange">{{ trans('about-me.btn_read_more') }}</button>
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-padding">
            <div class="row">
                <div class="col-xs-3 remove-padding">
                    <img src="{{asset('images/battery.png')}}" alt="A picture about a battery.">
                </div>

                <div class="col-xs-9">
                    <h1 class="bigger-text">{{ trans('about-me.future_title') }}</h1>
                </div>
            </div>

            <div class="row">
                <p class="big-text">{{ trans('about-me.future_text') }}</p>
            </div>

            <div class="row text-center">
                <button class="btn btn-orange">{{ trans('about-me.btn_read_more') }}</button>
            </div>
        </div>
    </div>
</section>