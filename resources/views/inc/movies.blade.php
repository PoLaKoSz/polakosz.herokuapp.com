<div class="row">
    @foreach($movies as $movie)
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">
            <div class="row">
                <div class="view overlay hm-black-strong">
                    <img src="{{ $movie->image }}" onError="showNotFoundImage(this)" alt="{{ $movie->name }}">
                    <div class="mask flex-center">
                        <div>
                            <p class="white-text">{{ trans('movies.star.'.$movie->rating) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row text-center">
                <h4>
                    <a href="{{ $movie->url }}" target="_blank">{{ $movie->name }}</a>
                </h4>
            </div>
        </div>
    @endforeach
</div>
