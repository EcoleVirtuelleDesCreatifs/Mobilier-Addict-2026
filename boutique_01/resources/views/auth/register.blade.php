@extends('maquette.layout')

@section('content')
    <div class="login-page mt-100">
        <div class="container">
            <form action="{{ route('register') }}" method="POST" class="login-form common-form mx-auto">
                @csrf
                <div class="section-header mb-3">
                    <h2 class="section-heading text-center">Inscription</h2>
                </div>
                <div class="row">
                    <div class="col-12">
                        <fieldset>
                            <label class="label">Prénom</label>
                            <input type="text" name="firstname" value="{{ old('firstname') }}" required />
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset>
                            <label class="label">Nom</label>
                            <input type="text" name="lastname" value="{{ old('lastname') }}" required />
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset>
                            <label class="label">Adresse e-mail</label>
                            <input type="email" name="email" value="{{ old('email') }}" required />
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
                    <div class="col-12">
                        <fieldset>
                            <label class="label">Confirmer le mot de passe</label>
                            <input type="password" name="password_confirmation" required />
                        </fieldset>
                    </div>
                    <div class="col-12 mt-3">
                        <button type="submit" class="btn-primary d-block mt-3 btn-signin">CRÉER</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
