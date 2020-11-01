@extends('layouts.guest')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-12 col-sm-12" style="margin-right:auto;margin-left:auto">
            <x-slot name="logo">
                <x-jet-authentication-card-logo />
            </x-slot>

            @error('email')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <x-jet-validation-errors class="mb-4" />
            </div>
            @enderror

            @error('password')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <x-jet-validation-errors class="mb-4" />
            </div>
            @enderror

            @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
            @endif
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card-group mb-0">
                            <div class="card p-0">
                                <div class="card-body">
                                    <h1>Acceder</h1>
                                    <p class="text-muted">Control de acceso al sistema</p>
                                    <div class="input-group mb-3">
                                        <span class="input-group-addon"><i class="icon-user"></i></span>
                                        <input type="email" name="email" id="email" class="form-control" :value="old('email')" required autofocus placeholder="Correo Electrónico">
                                    </div>
                                    <div class="input-group mb-4">
                                        <span class="input-group-addon"><i class="icon-lock"></i></span>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña">
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-primary px-4">Acceder</button>
                                        </div>
                                        <div class="col-6 text-right">
                                            @if (Route::has('password.request'))
                                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">Olvidaste tu password?</a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="block mt-4">
                                        <label for="remember_me" class="flex items-center">
                                            <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                                            <span class="ml-2 text-sm text-gray-600">{{ __('Recuérdame') }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
                                <div class="card-body text-center">
                                    <div>
                                        <h2>Sistema Hospitalario | León Becerra</h2>
                                        <p>El Hospital León Becerra, ubicado al sur de la ciudad de Guayaquil (Eloy Alfaro y Bolivia), brinda servicios de salud integral a la comunidad de escasos recursos.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
