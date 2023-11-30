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
						{{ __('Are your selections as follows?')}}
					</div>
						<div class="card-body">
							<form method="POST" action="{{ route('reserve.complete') }}">
							@csrf
								<div class="form-group row">
									<label for="facility_name" class="col-md-4 col-form-label text-md-right">{{ __('Facility Name' )}}</label>

									<div class="col-md-6 confirm-contents">
										{{ __($data['facility_name']) }}
										<input
										    name="facility_name"
										    value="{{ $data['facility_name'] }}"
										    type="hidden">
									</div>
								
								</div>
								
								<div class="form-group row">
									<label for="dates" class="col-md-4 col-form-label text-md-right">{{ __('Date' )}}</label>

									<div class="col-md-6 confirm-contents">
										{{ $data['dateinfo'] }}
										<input
									    name="dateinfo"
									    value="{{ $data['dateinfo'] }}"
									    type="hidden">
									</div>
									
								</div>
								
								<div class="form-group row">
									<label for="start_time" class="col-md-4 col-form-label text-md-right">{{ __('Start Time' )}}</label>
									
									<div class="col-md-6 confirm-contents">
										{{ $data['start_time'] }}
										<input
									    name="start_time"
									    value="{{ $data['start_time'] }}"
									    type="hidden">
									</div>
									
								</div>
								
								<div class="form-group row">
									<label for="end_time" class="col-md-4 col-form-label text-md-right">{{ __('End Time' )}}</label>
									
									<div class="col-md-6 confirm-contents">
										{{ $data['end_time'] }}
										<input
									    name="end_time"
									    value="{{ $data['end_time'] }}"
									    type="hidden">
									</div>
						
								</div>

								<div class="col-md-12 confirm-back">
									<button class="btn btn-warning btn-block" type="submit" name="action" value="back">
								    {{ __('Back to Form' )}}
									</button>
								</div>

								<div class="col-md-12 confirm-submit">
									<button class="btn btn-primary btn-block" type="submit" name="action" value="submit">
								    {{ __('Submit') }}
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
@endsection