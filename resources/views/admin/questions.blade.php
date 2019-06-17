@extends('admin.app')
@section('content')

    <h1>QUESTIONS</h1>
    <h2>User - <b>{{$user->name}}</b></h2>
    <hr>

    <table class="table">
        <thead class="thead-light">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Date of creation</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($questions as $question)

            <tr>
                <a href="questions/{{$question->id}}">
                    <th scope="row">{{$question->title}}</th>
                    <td>{{$question->text}}</td>
                    <td>{{$question->created_at}}</td>
                    <td>
                        <button onclick="location.href='{{route('admin.answers',[$poll, $question, $user])}}'" type="button"
                                class="btn btn-secondary">Answers
                        </button>
                    </td>

                    <td>
                        {!! Form::open(['method'=>'DELETE',
                        'route'=>['questions.destroy',$poll, $question]]) !!}
                        <button type="submit" class="btn btn-secondary" id="delete-{{$question->id}}">Delete</button>
                        {!! Form::close() !!}
                    </td>


                </a>
            </tr>

        @endforeach
        </tbody>
    </table>



@endsection