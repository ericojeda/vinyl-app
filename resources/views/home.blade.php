@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Records List</h1>
            <ul>
                @foreach($records as $record)
                    <li><a href="{{route('record', [$record->id])}}">{{$record->title}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
