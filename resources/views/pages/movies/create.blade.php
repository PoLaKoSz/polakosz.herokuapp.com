@extends('layouts.app')

@section('content')
    @include('inc.navbar')

    <div class="container py-5">
        <div class="row">
            <div id="searchResults_" class="col-12 col-md-6 col-lg-5">
                <div class="row">
                    <div id="mafabSearchResults" class="col">
                        <div class="form-group mb-2">
                            <label for="mafabSearch" class="sr-only">{{ trans('movies.search_on_mafab') }}</label>
                            <input type="text" name="mafab_search_query" id="mafabSearch" autocomplete="off" placeholder="{{ trans('movies.search_on_mafab') }}" class="form-control">
                        </div>
                        <div id="mafab"></div>
                    </div>
                    <div id="imdbSearchResults" class="col">
                        <div class="form-group mb-2">
                            <label for="imdbSearch" class="sr-only">{{ trans('movies.search_on_imdb') }}</label>
                            <input type="text" name="imdb_search_query" id="imdbSearch" autocomplete="off" placeholder="{{ trans('movies.search_on_imdb') }}" class="form-control">
                        </div>
                        <div id="imdb"></div>
                    </div>
                </div>
            </div>

            <form action="{{ LaravelLocalization::localizeURL('movies') }}" method="POST" class="col-12 col-md-6 col-lg-4 mb-3 mb-md-0" autocomplete="off">
                {{ csrf_field() }}

                <div class="form-group mb-2">
                    <label for="generalSearch" class="sr-only">{{ trans('movies.general_search') }}</label>
                    <input type="text" name="search_query" id="generalSearch" placeholder="{{ trans('movies.general_search') }}" class="form-control">
                </div>

                <div class="form-group mb-2">
                    <label for="huTitle" class="sr-only">{{ trans('movies.title_hu') }}</label>
                    <input type="text" name="title_hu" id="huTitle" placeholder="{{ trans('movies.title_hu') }}" readonly class="form-control">
                </div>

                <input type="hidden" name="title_en" placeholder="{{ trans('movies.title_en') }}" class="form-control">

                <div class="form-check">
                    <input type="checkbox" id="is_tv_series" class="form-check-input">
                    <label for="is_tv_series" class="form-check-label">
                        {{ trans('movies.series_chkBox') }}
                    </label>
                </div>

                <fieldset>
                    <div id="seasonContinainer" class="row d-none">
                        <div class="col-12 form-group mb-2">
                            <label for="season_number" class="sr-only">{{ trans('movies.season') }}</label>
                            <input type="number" id="season_number" min="1" placeholder="{{ trans('movies.season') }}" class="form-control">
                        </div>
                        <div class="col-6 form-group mb-2">
                            <label for="ep_first_number" class="sr-only">{{ trans('movies.first_episode') }}</label>
                            <input type="number" id="ep_first_number" min="0" placeholder="{{ trans('movies.first_episode') }}" class="form-control">
                        </div>
                        <div class="col-6 form-group mb-2">
                            <label for="ep_last_number" class="sr-only">{{ trans('movies.last_episode') }}</label>
                            <input type="number" id="ep_last_number" min="1" placeholder="{{ trans('movies.last_episode') }}" class="form-control">
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-check">
                        <input type="checkbox" id="isWatchedToday" checked class="form-check-input">
                        <label for="isWatchedToday">{{ trans('movies.watched_today_chkBox') }}</label>
                    </div>

                    <div class="form-group mb-2">
                        <label for="datepicker" class="sr-only">{{ trans('movies.date') }}</label>
                        <input type="text" name="date" id="datepicker" data-date-format="{{ trans('movies.date_format') }}" placeholder="{{ trans('movies.date') }}" class="datepicker form-control d-none">
                    </div>
                </fieldset>

                <input type="hidden" name="rating" class="form-control" placeholder="{{ trans('movies.rating') }}">

                <input type="hidden" name="mafab_id" class="form-control" placeholder="{{ trans('movies.mafab_id_hu_placeholder') }}" readonly>

                <input type="hidden" name="imdb_id" class="form-control" placeholder="{{ trans('movies.imdb_id_en_placeholder') }}" readonly>

                <input type="hidden" name="cover_image" class="form-control" placeholder="{{ trans('movies.cover_img_placeholder') }}" readonly>

                <div class="form-group">
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ trans('movies.rating') }}
                        </button>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a data-value="3" href="#" class="dropdown-item">{{ trans('movies.star.3') }}</a>
                            <a data-value="4" href="#" class="dropdown-item">{{ trans('movies.star.4') }}</a>
                            <a data-value="5" href="#" class="dropdown-item">{{ trans('movies.star.5') }}</a>
                            <a data-value="6" href="#" class="dropdown-item">{{ trans('movies.star.6') }}</a>
                            <div class="dropdown-divider"></div>
                            <a data-value="101" href="#" class="dropdown-item">{{ trans('movies.star.101') }}</a>
                            <div class="dropdown-divider"></div>
                            <a data-value="0" href="#" class="dropdown-item">{{ trans('movies.star.0') }}</a>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="comment_hu" class="form-control" placeholder="{{ trans('movies.comment_hu') }}">

                <input type="hidden" name="comment_en" class="form-control" placeholder="{{ trans('movies.comment_en') }}">

                <button type="submit" class="btn btn-orange">{{ trans('movies.save_btn') }}</button>
            </form>

            <div id="moviePoster" class="col"></div>
        </div>
    </div>
@endsection
