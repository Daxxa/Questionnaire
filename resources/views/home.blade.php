@extends('layouts.app')

@section('content')
    <div class="fh5co-hero">
        <div class="fh5co-overlay"></div>
        <div class="fh5co-cover text-center" style="background-image: url(images/work-1.jpg);">
            <div class="desc animate-box">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <h2>You are logged in!</h2>
            </div>
        </div>

    </div>

@endsection
