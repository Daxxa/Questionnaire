@extends('layouts.app')
@section('content')

    <h1>POLLS</h1>
    <hr>

    <a href='{{route('polls.create')}}' type="button" class="btn btn-secondary">Create a new poll</a>
    <br><br>
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
        @foreach($polls as $poll)

            <tr>
                <a href="polls/{{$poll->id}}">
                    <th scope="row">{{$poll->title}}</th>
                    <td>{{$poll->text}}</td>
                    <td>{{$poll->created_at}}</td>
                    <td>
                        <button onclick="location.href='{{route('questions.index',$poll)}}'" type="button"
                                class="btn btn-secondary">Questions
                        </button>
                    </td>
                    <td>
                        <button onclick="location.href='{{route('polls.link',$poll)}}'" type="button"
                                class="btn btn-secondary">Generete a link
                        </button>
                    </td>
                    <td>
                        <button onclick="location.href='{{route('polls.edit',$poll)}}'" type="button"
                                class="btn btn-secondary">Edit
                        </button>
                    </td>
                    <td>
                        {!! Form::open(['method'=>'DELETE',
                        'route'=>['polls.destroy',$poll]]) !!}
                        <button type="submit" class="btn btn-secondary" id="delete-{{$poll->id}}">Delete</button>
                        {!! Form::close() !!}
                    </td>
                    <td>
                        <button onclick="location.href='{{route('polls.show',$poll)}}'" type="button"
                                class="btn btn-secondary">Results
                        </button>
                    </td>
                    <td>
                        <select class="form-control btn" style="width: 140px" onchange="location.href=this.value">
                            <option value="" selected disabled hidden>REPORT</option>
                            <option value='{{route('polls.report1',$poll)}}'>Report 1</option>
                            @if($poll->questions()->get()->first() != null && $poll->questions()->get()->first()->answers()->get()->first() != null)
                                <option value='{{route('polls.report2',[$poll, $poll->questions()->get()->first()])}}'>Report 2</option>
                                @if($poll->questions()->get()->first()->answers()->get()->first() != null)
                                    <option value='{{route('polls.report3',[$poll, $poll->questions()->get()->first(), $poll->questions()->get()->first()->answers()->get()->first()])}}'>Report 3</option>
                                @endif
                            @endif
                        </select>

                    </td>
                </a>
            </tr>

        @endforeach
        </tbody>
    </table>



@endsection