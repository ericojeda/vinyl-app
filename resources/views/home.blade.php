@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Records List</h1>
            <p>{{$count}} Records</p>
            @foreach($records as $artist => $record_list)
                <h3>{{$artist}}</h3>
                <ul>
                @foreach($record_list as $record)
                    <li><a href="{{route('record', [$record->id])}}">{{$record->title}}</a></li>
                @endforeach
                </ul>
            @endforeach
        </div>
    </div>
</div>
@endsection
