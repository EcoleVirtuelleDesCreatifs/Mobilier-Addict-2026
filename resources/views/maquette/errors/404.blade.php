@extends('maquette.layout')

@section('content')

            <div class="error-page mt-100">
                <div class="container">
                    <div class="error-content text-center">
                        <div class="error-img mx-auto">
                            <img loading="lazy" decoding="async" src="{{ asset('assets/maquette/') }}/img/error/error.png" alt="erreur">
                        </div>
                        <p class="error-subtitle">Page introuvable</p>
                        <a href="{{ route('home') }}" class="btn-primary mt-4">RETOUR À L'ACCUEIL</a>
                    </div>
                </div>
            </div>            
        
@endsection
