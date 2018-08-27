<div class="row">
    @foreach($movies as $movie)
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">
            <div class="row">
                <div class="view overlay hm-black-strong">
                    <img src="{{ $movie->cover_image }}" onError="showNotFoundImage(this)" alt="{{ $movie->title }}">
                    <div class="mask flex-center">
                        <div>
                            <p class="white-text">{{ trans('movies.star.'.$movie->rating) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row text-center">
                <h4>
                    @if ( isset($movie->port) )
                        <a href="http://port.hu/adatlap/film/tv/-/movie-{{ $movie->port }}" target="_blank">{{ $movie->title }}</a>
                    @else
                        {{ $movie->title }}
                    @endif
                </h4>
            </div>
        </div>
    @endforeach
</div>
