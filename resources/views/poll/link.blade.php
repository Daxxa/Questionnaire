@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>New link for '{{$poll->title}}'</h3>
        <div class="row">
            <div class="col-md-8">
                {{$link}}
            </div>
        </div>
    </div>
@endsection