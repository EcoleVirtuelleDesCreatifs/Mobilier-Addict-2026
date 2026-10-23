@extends('maquette.layout')

@section('content')
    <div class="login-page mt-100">
        <div class="container">
            <form action="{{ route('password.email') }}" method="POST" class="login-form common-form mx-auto">
                @csrf
                <div class="section-header mb-3">
                    <h2 class="section-heading text-center">Mot de passe oublié</h2>
                    <p class="text-center text_14" style="color:#666;max-width:420px;margin:10px auto 0;">
                        Indique ton adresse e-mail et nous t'enverrons un lien pour choisir un nouveau mot de passe.
                    </p>
                </div>

                @if (session('status'))
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-success" role="alert" style="font-size:14px;">
                                {{ session('status') }}
                            </div>
                        </div>
                    </div>
                @endif

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
                    <div class="col-12 mt-3">
                        <button type="submit" class="btn-primary d-block mt-4 btn-signin">ENVOYER LE LIEN</button>
                        <a href="{{ route('login') }}" class="btn-secondary mt-2 btn-signin">RETOUR À LA CONNEXION</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
