@extends('layouts.app')

@section('content')
    @include('inc.navbar');

    <div class="container section-padding">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg4"></div>

            <form action="{{ LaravelLocalization::localizeURL('movies') }}" method="POST" class="col-xs-12 col-sm-12 col-md-4 col-lg4">
                <input type="text" name="title" class="form-control" placeholder="{{ trans('movies.movie_title_placeholder') }}">

                <fieldset>
                    <input id="testCheckbox" name="testCheckbox" type="checkbox" checked style="width:auto;">
                    <label for="testCheckbox"><p>{{ trans('movies.watched_today_chkBox') }}</p></label>
                    <span class="hideshow" style="display: none;">
                        <input type="text" name="date" class="form-control datepicker" placeholder="{{ trans('movies.date') }}" data-date-format="{{ trans('movies.date_format') }}">
                    </span>
                </fieldset>

                <input type="hidden" name="rating" class="form-control" placeholder="{{ trans('movies.rating') }}">

                <input type="number" name="portId" class="form-control" placeholder="{{ trans('movies.port_id_placeholder') }}">

                <input type="text" name="coverImage" class="form-control" placeholder="{{ trans('movies.cover_img_placeholder') }}">

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

                <input type="text" name="comment" class="form-control" placeholder="{{ trans('movies.comment_placeholder') }}">
                
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <button type="submit" class="btn btn-default">{{ trans('movies.save_btn') }}</button>
            </form>

            <div class="col-xs-12 col-sm-12 col-md-4 col-lg4"></div>
        </div>
    </div>
@endsection