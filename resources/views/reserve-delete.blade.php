@php
    $title = env('APP_NAME');
@endphp
@extends('layouts.parent')
@section('content')
<div class="container">
	<div class="row justify-content-center reserve-delete-title">
			<h3>{{ __('Are you sure you want to cancel this reservation?') }}</h3>
	</div>
	
</div>
	
	<div class="reserve-delete-contents">
		<div class="row justify-content-center">
			
			<label for="facility_name" class="col-md-4 offset-md-1 text-md-right">{{ __('Facility Name' )}}</label>

			<div class="col-md-6">
				{{ __($facility_name) }}
			</div>
		
		</div>
		
		<div class="row justify-content-center">
			<label for="start_time" class="col-md-4 offset-md-1  text-md-right">{{ __('Start Time' )}}</label>
			
			<div class="col-md-6">
				{{ $reserve->start_time }}
			</div>
			
		</div>
		
		<div class="row justify-content-center">
			<label for="end_time" class="col-md-4 offset-md-1  text-md-right">{{ __('End Time' )}}</label>
			
			<div class="col-md-6">
				{{ $reserve->end_time }}
			</div>
		</div>
	</div>
		
	<div class="text-md-center reserve-delete-button">
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reservationdeleteModal">
			{{ __('Yes') }}
		</button>

		<button type="button" class="btn btn-secondary">
			<a class="btn-back-index" href="{{ route('reserve.index') }}"> {{ __('Back') }}</a>
		</button>

	</div>
	

	<div class="modal" id="reservationdeleteModal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
			    <h5 class="modal-title" id="reservationdeleteModalLabel">{{ __('Delete Reservation') }}</h5>
			    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			      <span aria-hidden="true">&times;</span>
			    </button>
			  </div>
			  <div class="modal-body">
			    <p>{{ __('Are you really sure?') }}</p>
			  </div>
			  <div class="modal-footer">
			    @component('components.btn-del')
             		@slot('id', $reserve->id)
         		@endcomponent
			    <button type="button" class="btn btn-secondary btn-close" data-dismiss="modal">{{ __('Close') }}</button>
			  </div>
			</div>
		</div>
	</div>
@endsection