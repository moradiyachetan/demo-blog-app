{{--<x-header componentName="Users"/>--}}
{{--<h2>Hello </h2>--}}
{{--@include('inner');--}}
{{--@include('partials.header');--}}
{{--<ul>--}}
{{--    @foreach($names as $name)--}}
{{--        <li>{{$name}}</li>--}}
{{--        @endforeach--}}

{{--</ul>--}}
{{--<script>--}}
{{--    var data =@json($names);--}}
{{--    console.warn(data);--}}
{{--</script>--}}
@extends('layouts.app')
@section('title','User page')
@push('style')
    <style>
        h2{
            color: blue;
        }
    </style>
@endpush
@section('content')
    <h2>User Page Content...</h2>
@endsection

