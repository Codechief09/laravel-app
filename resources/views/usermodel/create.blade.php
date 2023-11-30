@php
    $title = __('Regist');
@endphp
@extends('usermodel.layout')
@section('content')
@include('usermodel/registform', ['target' => 'store'])
@endsection