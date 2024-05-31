@extends('layouts.layout')

@section('header')
    @include('header')
@endsection

@section('content')

    <livewire:cart-show xmlns:livewire=""/>

@endsection
@section('footer')
    @include('footer')
@endsection
