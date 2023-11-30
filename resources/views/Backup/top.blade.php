@php
    $title = env('APP_NAME');
@endphp

@extends('layouts.my')
@section('title', 'demo-laravel-crud')
@section('content')
<div class="container">
    <h1>{{ $title }}</h1>
    <p>
        {{ __('This is my first web application for applying for a facility reservation.') }}
    </p>
    <ul>
        @guest
        <p>{{ __('Member registration or login is required to use this site.') }}</p>
        
        @else
        <li>
            {{ __('Sample Function') }}1:
            <a href="/get-reservation" target="_blank">
                {{ __('Reserve') }}
            </a>
        </li>
        <li>
            {{ __('Sample Function') }}2:
            <a href="/confirm-reservation" target="_blank">
                {{ __('Confirm Reservation') }}
            </a>
        </li>
        <li>
            {{ __('Sample Function') }}3:
            <a href="/delete-reservation" target="_blank">
                {{ __('Cancel your reservation') }}
            </a>
        </li>
        @endguest
    
    </ul>
    <h2>{{ __('Feature') }}</h2>
    <ul>
        <li>{{ __('All visitors can sign up. OAuth authentication with Google account is also possible.') }}</li>
        <li>{{ __('Each the logged in user can reserve facilities, confirm reservation and delete.') }}</li>
    </ul>
</div>
@endsection