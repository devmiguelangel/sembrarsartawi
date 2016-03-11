@extends('layout')

@section('class-container', 'login-container')

@section('content')
    <div class="container">
        <div class="row">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="text-center">
                                {!! Html::image('images/assets/abrenet-logo.png', '', ['width' => '160']) !!}

                                <h3 class="text-center">Cambia tu contraseña</h3>
                                <p>Si ha olvidado su contraseña - restablescala aquí</p>
                                <div class="panel-body">
                                    {!! Form::open(['route' => 'password.create', 'method' => 'post']) !!}
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i
                                                            class="glyphicon glyphicon-envelope color-blue"></i></span>

                                                {!! Form::text('email', old('email'), [
                                                    'class'        => 'form-control',
                                                    'placeholder'  => 'Dirección de correo electronico',
                                                    'autocomplete' => 'off'
                                                ]) !!}
                                            </div>
                                            <label id="location-error" class="validation-error-label"
                                                   for="location">{{ $errors->first('email') }}</label>
                                        </div>
                                        <div class="form-group">
                                            <input class="btn btn-lg btn-primary btn-block" value="Continuar"
                                                   type="submit">
                                        </div>
                                    </fieldset>
                                    {!! Form::close() !!}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('status'))
        <script>
            $(function () {
                messageAction('succes', "{{ session('status') }}");
            });
        </script>
    @endif
@endsection