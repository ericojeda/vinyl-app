@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>{{$record->title}}</h1>
                <h3>{{$record->year}}</h3>
                <img src="{{$record->thumb}}" />
            </div>
        </div>
    </div>
@endsection
