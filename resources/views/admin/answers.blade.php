@extends('admin.app')
@section('content')

    <h1>ANSWERS ({{$poll->title}})</h1>
    <h2>User - <b>{{$user->name}}</b></h2>
    <hr>
    <table class="table">
        <thead class="thead-light">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Type</th>
            <th scope="col">Date of creation</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($answers as $answer)

            <tr>
                <a href="answers/{{$answer->id}}">
                    <th scope="row">{{$answer->title}}</th>
                    <td>{{$answer->type}}</td>
                    <td>{{$answer->created_at}}</td>
                    <td>
                        {!! Form::open(['method'=>'DELETE',
                        'route'=>['answers.destroy',$poll, $question, $answer]]) !!}
                        <button type="submit" class="btn btn-secondary" id="delete-{{$answer->id}}">Delete</button>
                        {!! Form::close() !!}
                    </td>


                </a>
            </tr>

        @endforeach
        </tbody>
    </table>



@endsection