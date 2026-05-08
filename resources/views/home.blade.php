@extends('layouts.front')

@section('title', 'Mobilier Addict | Fabricant et distributeur officiel de matelas Orthopédique authentique de qualité premium')
@section('meta_description', 'Mobilier Addict : literie, mobilier et équipements pour la maison. Profitez de nos univers, meilleures ventes et inspirations déco pour équiper votre intérieur.')
@section('canonical', url('/'))
@section('og_image', asset('assets/logo/mobile/logo.png'))
@section('twitter_image', asset('assets/logo/mobile/logo.png'))

@section('content')
@include('sections.hero')
@include('sections.explore-categories')
@include('sections.guarantees')
@include('sections.new-products')
@include('sections.spaces')
@include('sections.collection')
@include('sections.accessories')
@include('sections.brands')
@include('sections.blog')
@endsection
