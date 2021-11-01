
@extends('layouts.app')
@section('title','About page')
@push('style')
    <style>
        h2{
            color: red;
        }
    </style>
@endpush

@section('content')
    <h2>About Us Page Content...</h2>

    <x-header componentName="About">
        This is testing
        <x-slot name="title">
            This is testing title
        </x-slot>
    </x-header>
@endsection
