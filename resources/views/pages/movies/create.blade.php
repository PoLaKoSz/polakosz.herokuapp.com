@extends('layouts.app')

@section('content')
    @include('inc.navbar');

    <div class="container section-padding">
        <form>
            <div class="form-group">
                <label for="exampleInputEmail1">Film címe</label>
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Film angol vagy magyar címe">
            </div>
            <div class="row">
                <label class="col-xs-1">
                    <input type="checkbox" checked>
                </label>
                <label class="col-xs-11">
                    Ma néztem meg
                </label>

                <p>Date: <input type="text" class="datepicker"></p>
            </div>

            <button type="submit" class="btn btn-default">Mentés</button>
        </form>
    </div>
@endsection