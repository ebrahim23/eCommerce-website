@extends('layout.master')

@section('title', 'About_Me')

@section('content')
  <div class="container">
    <h1>{!! $page_name !!}</h1>
    <p>{{$page_desc}}</p>
  </div>
@stop
