@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="container">
        <h2>Questions</h2>
        <button onclick="location.href='{{route('questions.create',$poll->id)}}'" type="button" class="btn btn-secondary">Add a new question</button>
            <br><br>
            @foreach($questions as $question)
                <div style="position: relative">
                <div style="position: absolute;right: 15px;top: 8px;">
                {!! Form::open(['method'=>'DELETE',
                       'route'=>['questions.destroy',$question->id,$question->id]]) !!}
                <button onclick="return confirm('Do you want to delete?')" class="btn btn-secondary del">Delete</button>
                {!! Form::close()!!}
                </div>

                {!! Form::open(['route'=>['questions.update',$question->id,'id1'=>$question->id], 'method'=>'PUT']) !!}
                <input type="hidden" class="form-control" name="poll_id" value="{{$poll->id}}" >

            <table class="table" style="border: 1px solid silver;">

            <tbody>
                <tr style="text-align: center">
                    <td style="border: none"><input type="text" class="form-control" name="title" value="{{$question->title}}"></td>
                    <td style="width: 10%;border: none;">

                    </td>
                </tr>
                <tr>
                    <td colspan="2"><textarea type="text" class="form-control"name="text" cols="10" rows="5" >{{$question->text}}
                    </textarea></td>
                </tr>
                <tr>
                    <td >The last modification: {{$question->updated_at}}</td>
                    <td style="width: 10%;border: none;">
                        <button class="btn button-secondary">Save</button>
                    </td>
                </tr>


            </tbody>
        </table>
                {!! Form::close() !!}
                </div>

            @endforeach


    </div>
    </div>
@endsection