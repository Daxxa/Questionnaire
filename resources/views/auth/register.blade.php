@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-3">
                <h3>REGISTER</h3>
                <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                        <div class="col-md-8">
                            <hr>

                            <input id="name" type="text" placeholder="Name" class="form-control" name="name"
                                   value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                        <div class="col-md-8">
                            <input id="email" type="email" placeholder="Email" class="form-control" name="email"
                                   value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                        <div class="col-md-8">
                            <input id="password" type="password" placeholder="Password" class="form-control"
                                   name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">

                        <div class="col-md-8">
                            <input id="password-confirm" type="password" placeholder="Confirm Password"
                                   class="form-control" name="password_confirmation" required>
                        </div>
                    </div>
                    <div class="padding-10">When you click this button you accept an <a class="btn btn-secondary open-included">AGREEMENT (click this)</a></div>

                    <div  type="button"  class="col-md-12 included-poll hidden">
                        <div id="included-polls" class="col-md-8">
text
                            <div class="col-md-offset-10">
                                <a  type="button" class="btn btn-secondary close-included"><span class="glyphicon glyphicon-remove"></span></a>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-primary">
                                Register
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
@section('script')
    <script>
    $('.close-included').on('click',function(){
    $('.included-poll').addClass("hidden");
    });
    $('.open-included').on('click',function(){
    $('.included-poll').removeClass('hidden');
    });
    </script>
    @endsection
