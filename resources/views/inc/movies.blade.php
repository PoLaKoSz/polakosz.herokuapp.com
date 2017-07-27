<section id="movies" class="container">
    <div class="row section-padding">
        <div class="row">
            <div class="section-header dark-section-header">
                <div class="section-header-line"></div>
                <div class="section-header-name">
                    <h2>{{ trans('movies.title') }}</h2>
                </div>
                <div class="section-header-line"></div>
            </div>
        </div>

        @foreach($movies as $movie)
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">
                <div class="row">
                    <div class="view overlay hm-black-strong">
                        <img src="{{asset('images/imagenotfound.svg')}}" alt="All projects">
                        <div class="mask flex-center">
                            <div>
                                <p class="white-text">{{ trans('movies.star.'.$movie->csillag) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row text-center">
                    <h4><a href="#">{{ $movie->filmcim }}</a></h4>
                </div>
            </div>
        @endforeach
    </div>
</section>