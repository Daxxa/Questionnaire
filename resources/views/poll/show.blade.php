@extends('layouts.app')
@section('tops')

    @endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">


                @include('errors')

                <br>
                {!! form($form) !!}
                <div class="included-div">
                <h2>Included questions</h2>
                {!! form($included_form) !!}
                </div>
            </div>
        </div>
    </div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
@endsection
@section('script')
    <script>



            $('.chart-btn').on('click',function(){


                var question_id = $(this).attr('id').replace('chart-',"");
                if ($('#chartContainer-'+question_id).length) {$('#chartContainer-'+question_id).remove()}
                else {

                    var token = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({

                        type: 'POST',
                        url: "{{ route('questions.chart') }}",
                        dataType: 'JSON',
                        data: {
                            "_method": 'POST',
                            "_token": token,
                            "question_id": question_id,
                            "poll_id":{{$poll->id}}
                        },
                        headers: {

                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')

                        },
                        success: function (data) {
                            console.log(data);
                            $('#chart-' + question_id).after($('<div id="chartContainer-' + question_id + '"  style="height: 370px; width: 100%;"></div>'));

                            var chart = new CanvasJS.Chart("chartContainer-" + question_id, {
                                animationEnabled: true,
                                theme: "light2",
                                title: {
                                    text: " "
                                },
                                axisY: {
                                    title: "Count"
                                },
                                data: [{
                                    type: "column",
                                    yValueFormatString: "#",
                                    dataPoints: data
                                }]
                            });
                            chart.render();

                        },
                        error: function (err) {
                            alert('fail');
                        },
                    });


                }
            });


    </script>
    @endsection
