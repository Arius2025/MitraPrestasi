@extends('layouts.app')
@section('title', 'Beranda')


@section('content')
    @include('partials.home._hero')
    @include('partials.home._info')
    @include('partials.home._gallery')
    @include('partials.home.blog-list')
@endsection
