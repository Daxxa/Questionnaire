            <br>
            <br>
            <div class="report">
                <h1>REPORT</h1>
                <hr>
                <h2>{{ $reports->first()->Question }}</h2>
                <table class="table cellspacing='0'">
                    <thead>
                    <tr style="    background-color: #ddd5d0;
    font-size: 20px;">
                        <th scope="col">Answer</th>
                        <th scope="col">Count</th>
                        <th scope="col">Percent</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($reports as $report)
                        @if($prev == $report->Qid)
                            <tr>
                        @else
                            <tr style="border-top: 5px solid #00dd16;">
                                @endif
                                <td>{{ $report->Answer }}</td>
                                <td>{{ $report->Count }}</td>
                                <td><b>{{ $report->Co }} %</b></td>
                            </tr>
                            @php
                                $prev = $report->Qid
                            @endphp

                            @endforeach


                    </tbody>
                </table>
                <hr>

                <h2>Count of respondents: {{$anonCount}}</h2>
                <img src="{{$img1}}" />
                <img src="{{$img2}}" />

            </div>

<style>
    table{
        width: 100%;
        padding: 20px;
        border: 1px solid rgba(0, 0, 0, 0.29);
        border-collapse: collapse;
        border-spacing: 0;
    }
    tr{
        font-size: 10px;
    }
    th{
        border: 1px solid rgba(0, 0, 0, 0.29);
        padding: 10px;
        font-size: 15px;
    }
    td{
        border: 1px solid rgba(0, 0, 0, 0.29);
        padding: 10px;
        font-size: 15px;
        color: #555555;
    }
    .report{
        font-family: "Source Sans Pro", Arial, sans-serif;

    }

</style>

