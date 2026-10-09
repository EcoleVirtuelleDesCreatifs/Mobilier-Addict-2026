@extends('maquette.layout')

@section('content')

            <div class="login-page mt-100">
                <div class="container">
                    <form action="register.php#" class="login-form common-form mx-auto">
                        <div class="section-header mb-3">
                            <h2 class="section-heading text-center">Inscription</h2>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <fieldset>
                                    <label class="label">Prénom</label>
                                    <input type="text" />
                                </fieldset>
                            </div>
                            <div class="col-12">
                                <fieldset>
                                    <label class="label">Nom</label>
                                    <input type="text" />
                                </fieldset>
                            </div>
                            <div class="col-12">
                                <fieldset>
                                    <label class="label">Adresse e-mail</label>
                                    <input type="email" />
                                </fieldset>
                            </div>
                            <div class="col-12">
                                <fieldset>
                                    <label class="label">Mot de passe</label>
                                    <input type="password" />
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
