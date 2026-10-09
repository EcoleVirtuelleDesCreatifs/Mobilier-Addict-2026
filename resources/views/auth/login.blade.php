@extends('maquette.layout')

@section('content')
    <div class="login-page mt-100">
        <div class="container">
            <form action="{{ route('login') }}" method="POST" class="login-form common-form mx-auto">
                @csrf
                <div class="section-header mb-3">
                    <h2 class="section-heading text-center">Connexion</h2>
                </div>
                <div class="row">
                    <div class="col-12">
                        <fieldset>
                            <label class="label">Adresse e-mail</label>
                            <input type="email" name="email" value="{{ old('email') }}" required autofocus />
                            @error('email')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset>
                            <label class="label">Mot de passe</label>
                            <input type="password" name="password" required />
                            @error('password')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </fieldset>
                    </div>
                    <div class="col-12 mt-3">
                        <a href="{{ route('password.request') }}" class="text_14 d-block">Mot de passe oublié ?</a>
                        <button type="submit" class="btn-primary d-block mt-4 btn-signin">SE CONNECTER</button>
                        <a href="{{ route('register') }}" class="btn-secondary mt-2 btn-signin">CRÉER UN COMPTE</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
