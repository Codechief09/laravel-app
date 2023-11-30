@php
    $title = env('APP_NAME');
@endphp
@extends('layouts.parent')
@section('content')
<div class="container">
	<h1>{{ __('Your Reservation Index') }}</h1>
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>{{ __('ID') }}</th>
					<th>{{ __('Facility Name') }}</th>
					<th>{{ __('Start Time') }}</th>
					<th>{{ __('End Time') }}</th>
					<th>{{ __('Delete Reservation') }}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($reserves as $reserve)
				<tr>
					<td>{{ __($reserve->id) }}</td>
					<td>{{ __($reserve->facility_code) }}</td>
					<td>{{ __($reserve->start_time) }}</td>
					<td>{{ __($reserve->end_time) }}</td>
					<td><a class="btn btn-sm btn-danger" href="{{ url('reserve-delete/'.$reserve->id) }}">{{ __('Cancel your reservation') }}</a></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection