@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @include('errors')


                <br>
                {!! form($form) !!}
            </div>
        </div>
    </div>
@endsection