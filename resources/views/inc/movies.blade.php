<section id="{{ trans('navbar.menu_movies') }}" class="container">
    <div class="row section-padding">
        <?php
            $title  = trans('movies.title');
            $design = 'dark-section-header';
        ?>
        @include('inc.section-header');

        @foreach($movies as $movie)
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">
                <div class="row">
                    <div class="view overlay hm-black-strong">
                        <img src="{{ $movie->cover_image }}" onError="showNotFoundImage(this)" alt="{{ $movie->filmcim }}">
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