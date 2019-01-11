@extends('layouts.app')

@section('content')
    @include('inc.navbar');

    <div class="container-fluid section-padding">
        <div class="row">
            <div id="searchResults_" class="col-xs-12 col-md-8">
                <div class="row">
                    <div id="portSearchResults" class="col-xs-4">
                        <input type="text" name="port_search_query" value="{{ $data->hu->title }}" class="form-control" placeholder="{{ trans('movies.search_on_port') }}">
                        <div id="port"></div>
                    </div>
                    <div id="mafabSearchResults" class="col-xs-4">
                        <input type="text" name="mafab_search_query" value="{{ $data->hu->title }}" class="form-control" placeholder="{{ trans('movies.search_on_mafab') }}">
                        <div id="mafab"></div>
                    </div>
                    <div id="imdbSearchResults" class="col-xs-4">
                        <input type="text" name="imdb_search_query" value="{{ $data->en->title }}" class="form-control" placeholder="{{ trans('movies.search_on_imdb') }}">
                        <div id="imdb"></div>
                    </div>
                </div>
            </div>

            <form action="{{ LaravelLocalization::localizeURL('movies/' . $data->id) }}" method="POST" class="col-xs-12 col-md-2">
                <input name="_method" type="hidden" value="PATCH">

                <input type="text" value="{{ $data->old_title }}" readonly class="form-control">

                <p><a href="{{ $data->old_port_URL }}" target="_blank">Port.hu URL</a></p>

                <input name="rating" type="text" value="{{ $data->rating }}" readonly>

                <input type="text" value="{{ $data->old_comment }}" readonly class="form-control">

                <div class="row row-no-padding">
                    <div class="col-xs-2">
                        <img src="{{ asset('/images/HU_flag.png') }}" alt="Magyar zászló" class="movie-details-provider-image">
                    </div>
                    <div class="col-xs-10">
                        <input type="text" name="title_hu" value="{{ $data->hu->title }}" class="form-control" placeholder="{{ trans('movies.title_hu') }}">
                    </div>
                </div>

                <div class="checkbox">
                    <label>
                        <input type="checkbox" id="is_tv_series"> Has Series?
                    </label>
                </div>

                <div id="seasonContinainer" style="display: none">
                    <div class="col-xs-4">
                        SEASON {number}
                        <input type="number" class="form-control" min="1" id="season_number">
                    </div>
                    <div class="col-xs-4">
                        FIRST EP. {number}
                        <input type="number" class="form-control" min="0" id="ep_first_number">
                    </div>
                    <div class="col-xs-4">
                        LAST EP. {number}
                        <input type="number" class="form-control" min="1" id="ep_last_number">
                    </div>
                </div>

                <div class="row row-no-padding">
                    <div class="col-xs-2">
                        <img src="{{ asset('/images/UK_flag.png') }}" alt="English flag" class="movie-details-provider-image">
                    </div>
                    <div class="col-xs-10">
                    <input type="text" name="title_en" value="{{ $data->en->title }}" class="form-control" placeholder="{{ trans('movies.title_en') }}">
                    </div>
                </div>

                <div class="row row-no-padding">
                    <div class="col-xs-2">
                        <img src="{{ asset('images/movies/favicon.port.ico') }}" alt="Port.hu" class="movie-details-provider-image">
                    </div>
                    <div class="col-xs-10">
                        <input type="text" name="port_id" value="{{ $data->hu->port->id }}" class="form-control" placeholder="{{ trans('movies.port_id_hu_placeholder') }}">
                    </div>
                </div>

                <div class="row row-no-padding">
                    <div class="col-xs-2">
                        <img src="{{ asset('images/movies/favicon.mafab.ico') }}" alt="Mafab.hu" class="movie-details-provider-image">
                    </div>
                    <div class="col-xs-10">
                        <input type="text" name="mafab_id" value="{{ $data->hu->mafab->id }}" class="form-control" placeholder="{{ trans('movies.mafab_id_hu_placeholder') }}">
                    </div>
                </div>

                <div class="row row-no-padding">
                    <div class="col-xs-2">
                        <img src="{{ asset('images/movies/favicon.imdb.ico') }}" alt="IMDb.com" class="movie-details-provider-image">
                    </div>
                    <div class="col-xs-10">
                        <input type="text" name="imdb_id" value="{{ $data->en->imdb->id }}" class="form-control" placeholder="{{ trans('movies.imdb_id_en_placeholder') }}">
                    </div>
                </div>

                <input type="text" name="cover_image" value="{{ $data->cover_image }}"  class="form-control" placeholder="{{ trans('movies.cover_img_placeholder') }}" readonly>

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <button type="submit" class="btn btn-success">{{ trans('movies.save_btn') }}</button>

                <a href="{{ LaravelLocalization::localizeURL('movies/'.($data->id+1).'/edit') }}" class="btn btn-danger">Next</a>
            </form>

            <div id="moviePoster" class="col-xs-12 col-md-2">
                <img src="{{ $data->cover_image }}">
            </div>
        </div>
    </div>
@endsection
