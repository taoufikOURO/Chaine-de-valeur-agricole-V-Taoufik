@extends('layout.layout')

@section('title', 'Tableau de bord')

@section('content')
    @if (session('showErrorModal'))
        @include('components.error-modal')
    @endif
    <h2>Bienvenue sur la page d'accueil</h2>
    <p>Ceci est le contenu de la page d'accueil.</p>
@endsection
