{{-- @extends('adminlte::auth.login') --}}
@extends('adminlte::master')

@section('adminlte_css')
    
    <style>
    .login-box {
        /* position: absolute;
        top: 40%;
        left: 50%;
        transform: translate(-50%, -50%); */
        width: 500px; 
        margin: auto;
        margin-top: 6%; 
        background-color: #d8d8d8; 
        padding: 30px; 
        border-radius: 8px; 
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
    }
    .check{
        width: 20px;
        height: 20px;
        cursor: pointer;
    }
   

    .cor{
        background-color: #00A2E8;
    }

    </style>
@stop

@section('body_class', 'login-page')

    @section('body')
    
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('/') }}"><img width="200" height="160" src="{{asset('vendor/adminlte/dist/img/invokevendas_m.png')}}" alt=""></a>
            <h3 class="col-md-12 p-3">Entrar no sistema</h3>
        </div>
        <!-- /.login-logo -->
        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        <div class="row" >
            <div class="col-md-12">
                <div class="row">
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <form action="{{route('login.auth')}}" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="Senha" name="password" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-block p-3">Entrar</button>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-12 pt-4 pb-3">
                                    <div>
                                        <input type="checkbox" id="remember" class="check">
                                        <label for="remember" class="ml-2">
                                            Manter-me Conectado
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </form>
        
                        <p class="mb-1">
                            <a href="" class="btn btn-primary">Esqueci minha senha</a>
                        </p>
                    </div>
                </div>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
@stop
