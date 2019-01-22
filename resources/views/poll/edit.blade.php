@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Edit poll '{{$poll->title}}'</h3>
        <div class="row">
            <div class="col-md-8">
                {!! Form::open(['route'=>['polls.update',$poll->id], 'method'=>'PUT']) !!}
                @include('errors')

                <div class="form-group">
                    Name
                    <input type="text" class="form-control" name="title" value="{{$poll->title}}">
                    <br>
                    Description
                    <textarea type="text" class="form-control"name="text" cols="30" rows="10" >{{$poll->text}}
                    </textarea>
                    <br>
                    Date of creation - {{$poll->created_at}}
                    <br>
                    <button class="btn button-secondary">Save</button>


                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection