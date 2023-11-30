@php
    $title = env('APP_NAME');
@endphp
@extends('layouts.parent')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 reserve-form">
                <div class="card">
                    <div class="card-title">
                        {{ __('Your reservation is complete.')}}
                    </div>
                        <div class="card-body text-md-center">
                            <div class="col-md-12">
                                {{ __('Please note the following reservation number, as it will be required for inquiry.') }}<br><br>
                            </div>

                            <div class="col-md-12">
                                {{ __('Reservation Number')}}: {{ $reserve_number }}
                            </div>
                        </div>
                        
                        <div class="col-md-6 offset-md-3 back-top">
                            <a class="back-top btn btn-primary" href="{{ route('reserve.top') }}">{{ __('Back to Top') }}</a>
                        </div>
                        
                </div>
            </div>
        </div>
    </div>
@endsection