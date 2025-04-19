@extends('layout.layout')

@section('title', 'Tableau de bord')

@section('content')
    @if (session('showErrorModal'))
        @include('components.error-modal')
    @endif
    <h2>Bienvenue sur la page d'accueil</h2>
    <p>Ceci est le contenu de la page d'accueil.</p>
  
    <a href="{{route('stats.global')}}"
                            class=" mt-5 w-full group relative overflow-hidden bg-gradient-to-r from-emerald-600 to-emerald-700 text-white rounded-xl px-4 py-5 font-medium hover:from-emerald-700 hover:to-emerald-800 transition duration-300 shadow-lg hover:shadow-emerald-200/50 cursor-pointer">
                            <div class="absolute inset-0 bg-white/10 group-hover:bg-white/0 transition duration-300"></div>
                            <i class="fas fa-plus-circle mr-2"></i>
                            <span class="relative">télécharger</span>
 </a>
@endsection
