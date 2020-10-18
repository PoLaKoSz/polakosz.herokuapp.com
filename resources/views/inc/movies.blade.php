<div class="row text-center">
    @foreach($movies as $movie)
        <div class="col-6 col-md-4 col-lg-2">
            <div class="view overlay hm-black-strong">
                <img src="{{ $movie->image }}" onError="showNotFoundImage(this)" alt="{{ $movie->name }}" class="img-fluid">
                <div class="mask text-white d-flex">
                    <div class="align-self-center w-100">{{ trans('movies.star.'.$movie->rating) }}</div>
                </div>
            </div>
            <a href="{{ $movie->url }}" target="_blank">{{ $movie->name }}</a>
        </div>
    @endforeach
</div>
