{!! Form::open(['route'=>['questions.update',$poll,$question], 'method'=>'PUT']) !!}
<input type="hidden" class="form-control" name="poll_id" value="{{$poll->id}}" >

<table class="table tbl-question" >

    <tbody>
    <tr class="row-title">
        <td  class="qtn-title" ><input type="text" class="form-control" name="title" value="{{$question->title}}"></td>
        <td ></td>
    </tr>
    <tr>
        <td colspan="2"><textarea type="text" class="form-control"name="text" cols="10" rows="5" >{{$question->text}}
                    </textarea></td>
    </tr>
    <tr>
        <td colspan="2"><textarea class="editor-body" name="extra">{{$question->extra}}</textarea></td>
    </tr>
    <tr>
        <td >The last modification: {{$question->updated_at}}</td>
        <td class="qtn-button">
            <button class="btn button-secondary">Save</button>

        </td>
    </tr>


    </tbody>
</table>
{!! Form::close() !!}