@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-md-12">
        <h2>New link for '{{$poll->title}}'</h2>
        <div class="row" id="fh5co-contact">

                <div class="form-group">
                <input class="form-control" type="text" value="{{$link}}">
                </div>
            </div>
        </div>
    </div>
@endsection