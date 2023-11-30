@php
    $title = __('Edit');
@endphp
@extends('usermodel.layout')
@section('content')
@include('usermodel/registform', ['target' => 'update'])
@endsection