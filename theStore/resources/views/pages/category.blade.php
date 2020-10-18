@extends('layout.master')

@section('title', 'Categories')

@section('content')
  <div class="container">
    <h1>{!! $page_name !!}</h1>
    <p>{{$page_desc}}</p>
    <div>{{$my_id}}</div>
  </div>
@stop
