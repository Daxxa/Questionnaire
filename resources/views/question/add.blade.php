@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Add a new question</h3>
        <div class="row">
            <div class="col-md-8">
                {!! Form::open(['route'=>['questions.store',$poll->id]]) !!}
                @include('errors')

                <div class="form-group">
                    <input type="hidden" class="form-control" name="poll_id" value="{{$poll->id}}" >
                    Title
                    <input type="text" class="form-control" name="title" value="{{old('title')}}">
                    <br>
                    Text
                    <textarea type="text" class="form-control"name="text" cols="30" rows="10" value="{{old('text')}}">
                    </textarea>
                    <br>
                    <button class="btn button-secondary">Add</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection