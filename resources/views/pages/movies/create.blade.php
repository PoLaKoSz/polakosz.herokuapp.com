@extends('layouts.app')

@section('content')
    @include('inc.navbar');

    <div class="container-fluid section-padding">
        <div class="row">
            <div id="searchResults_" class="col-xs-12 col-md-8">
                <div class="row">
                    <div id="portSearchResults" class="col-xs-4">
                        <input type="text" name="port_search_query" class="form-control" placeholder="{{ trans('movies.search_on_port') }}">

                        <div id="port"></div>
                    </div>
                    <div id="mafabSearchResults" class="col-xs-4">
                        <input type="text" name="mafab_search_query" class="form-control" placeholder="{{ trans('movies.search_on_mafab') }}">
                        <div id="mafab"></div>
                    </div>
                    <div id="imdbSearchResults" class="col-xs-4">
                        <input type="text" name="imdb_search_query" class="form-control" placeholder="{{ trans('movies.search_on_imdb') }}">
                        <div id="imdb"></div>
                    </div>
                </div>
            </div>

            <form action="{{ LaravelLocalization::localizeURL('movies') }}" method="POST" class="col-xs-12 col-md-2">
                <input type="text" name="search_query" class="form-control" placeholder="{{ trans('movies.general_search') }}">

                <input type="text" name="title_hu" class="form-control" placeholder="{{ trans('movies.title_hu') }}" readonly>

                <input type="text" name="title_en" class="form-control" placeholder="{{ trans('movies.title_en') }}" readonly>

                <fieldset>
                    <input id="hideShowDateFieldCheckBox" type="checkbox" checked style="width:auto;">
                    <label for="hideShowDateFieldCheckBox"><p>{{ trans('movies.watched_today_chkBox') }}</p></label>
                    <span class="hideshow" style="display: none;">
                        <input type="text" name="date" class="form-control datepicker" placeholder="{{ trans('movies.date') }}" data-date-format="{{ trans('movies.date_format') }}">
                    </span>
                </fieldset>

                <input type="hidden" name="rating" class="form-control" placeholder="{{ trans('movies.rating') }}">

                <input type="text" name="port_id" class="form-control" placeholder="{{ trans('movies.port_id_hu_placeholder') }}" readonly>

                <input type="text" name="mafab_id" class="form-control" placeholder="{{ trans('movies.mafab_id_hu_placeholder') }}" readonly>

                <input type="text" name="imdb_id" class="form-control" placeholder="{{ trans('movies.imdb_id_en_placeholder') }}" readonly>

                <input type="text" name="cover_image" class="form-control" placeholder="{{ trans('movies.cover_img_placeholder') }}" readonly>

                <div class="dropdown form-group">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">{{ trans('movies.rating') }}<span class="caret"></span></button>

                    <ul class="dropdown-menu">
                        <li data-value="3"><a href="#">{{ trans('movies.star.3') }}</a></li>
                        <li data-value="4"><a href="#">{{ trans('movies.star.4') }}</a></li>
                        <li data-value="5"><a href="#">{{ trans('movies.star.5') }}</a></li>
                        <li data-value="6"><a href="#">{{ trans('movies.star.6') }}</a></li>

                        <li role="separator" class="divider"></li>

                        <li data-value="101"><a href="#">{{ trans('movies.star.101') }}</a></li>

                        <li role="separator" class="divider"></li>

                        <li data-value="0"><a href="#">{{ trans('movies.star.0') }}</a></li>
                    </ul>
                </div>

                <input type="text" name="comment_hu" class="form-control" placeholder="{{ trans('movies.comment_hu') }}">

                <input type="text" name="comment_en" class="form-control" placeholder="{{ trans('movies.comment_en') }}">
                
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <button type="submit" class="btn btn-default">{{ trans('movies.save_btn') }}</button>
            </form>

            <div id="moviePoster" class="col-xs-12 col-md-2"></div>
        </div>
    </div>
@endsection
