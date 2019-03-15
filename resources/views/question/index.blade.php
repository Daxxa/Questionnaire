@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="container">
        <h2>Questions</h2>
            @include('errors')
        <button onclick="location.href='{{route('questions.create',$poll)}}'" type="button" class="btn btn-secondary">Add a new question</button>
            <a  type="button" class="btn btn-secondary open-included">Include another poll</a>

            <div class="col-md-12 included-poll hidden">
            <div id="included-polls" class="col-md-offset-2 col-md-8">
                @foreach($polls as $one)
                    <div class="padding-10 border-bottom">
                    <div class="col-md-10 lh-40">{{$one->title}}</div>
                    <button id="{{$one->id}}" class="btn btn-secondary include" >@if((count($included_polls->where('included_poll_id',$one->id)->toArray()))!=0)<span class="glyphicon glyphicon-ok"></span>
                        @else Add @endif</button>
                    <br>
                    </div>
                    @endforeach
                <div class="col-md-offset-10">
                    <a  type="button" class="btn btn-secondary close-included"><span class="glyphicon glyphicon-remove"></span></a>
                </div>

            </div>
            </div>
            <br><br>
            @foreach($questions as $question)
                <div class="container-rel">
                <div class="container-abs">
                {!! Form::open(['method'=>'DELETE',
                       'route'=>['questions.destroy',$poll,$question]
                       ]) !!}
                <button onclick="return confirm('Do you want to delete?')" class="btn btn-secondary del">Delete</button>
                {!! Form::close()!!}
                </div>

                @include('questionEdit')
                    <div class="awr-btn">
                        <button onclick="location.href='{{route('answers.index',[$poll,$question])}}'" type="button" class="btn btn-secondary">Answers</button>
                    </div>
                </div>

            @endforeach
            <div class="included-div">
            <h2>Included questions</h2>

            @foreach($included_questions as $question)
                <div class="container-rel">

                    <div class="awr-btn">
                        <button onclick="location.href='{{route('answers.index',[\App\Models\Poll::all()->where('id',$question->poll_id)->first(),$question])}}'" type="button" class="btn btn-secondary">Answers</button>
                    </div>
                    <table class="table tbl-question" >

                        <tbody>
                        <tr class="row-title">
                            <td  class="qtn-title" >{{$question->title}}</td>
                            <td ></td>
                        </tr>
                        <tr>
                            <td colspan="2">{{$question->text}}</td>
                        </tr>
                        <tr>
                            <td >The last modification: {{$question->updated_at}}</td>
                            <td class="qtn-button">


                            </td>
                        </tr>


                        </tbody>
                    </table>
                </div>



            @endforeach
            </div>


    </div>
    </div>
@endsection
@section('script')
    <script>

        $(function() {

            $('.include').on('click',function(){


                var included_poll_id = $(this).attr('id');
                if($(this).html()==" Add ")
                    $(this).html('<span class="glyphicon glyphicon-ok"></span>')
                    else $(this).html(' Add ');
                var poll_id = '{{$poll->id}}'
                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({

                    type:'POST',
                    url:"{{ route('polls.include') }}",
                    dataType: 'JSON',
                    data: {
                        "_method": 'POST',
                        "_token": token,
                        "included_poll_id":included_poll_id,
                        "poll_id":poll_id
                    },
                    headers: {

                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')

                    },
                    success:function(data){
                        alert('success');
                        $('.included-div').load(location.href+' .included-div*','');

                    },
                    error: function(err)
                    {
                        alert('fail');
                    },
                });




            });

        })
        $('.close-included').on('click',function(){
            $('.included-poll').addClass("hidden");
        });
        $('.open-included').on('click',function(){
            $('.included-poll').removeClass('hidden');
        });
    </script>
@endsection