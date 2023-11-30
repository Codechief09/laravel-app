@php
    $title = env('APP_NAME');
@endphp
@extends('layouts.parent')
@section('content')
	<div claas="container">
		<div class="row justify-content-center">
			<div class="col-md-8 reserve-form">
				<div class="card">
					<div class='card-title'>

						{{ __('Reserve Form' )}}
						
						<br>
						<!-- エラーメッセージ表示 -->
						@if ($errors->any())
						<span id = "error-message" class="error">
						@foreach ($errors->all() as $error)
						<strong>{{ __($error) }}</strong>
						</span>
						@endforeach
						@endif

					</div>

					<div class="card-body">
						<form method="POST" id="test">
							@csrf
							<div class="form-group row">
								<label for="facility_name" class="col-md-4 col-form-label text-md-right">{{ __('Facility Name' )}}</label>

								<div class="col-md-6">
									<select class="form-control" id="facility_name" name="facility_name">
										<option value="blank" selected="selected">{{ __('Please Select' )}}</option>
										<option value="多目的ホールA">{{ __('Multipurpose Hall A' )}}</option>
										<option value="多目的ホールB">{{ __('Multipurpose Hall B')}}</option>
										<option value="柔道場">{{ __('Dojo' )}}</option>
										<option value="レクリエーションルーム">{{ __('Recreation Room' )}}</option>
									</select>
									
								</div>
							</div>

							<div class="form-group row">
								<label for="dates" class="col-md-4 col-form-label text-md-right">{{ __('Date' )}}</label>

								<div class="col-md-6">
									<input type="text" class="form-control dateinfo" placeholder="Select Date.." id="dateinfo" name="dateinfo" readonly="readonly">
									
								</div>
							</div>	

							<div class="form-group row">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary" data-action='javascript:void(0);' id="date-select">
                                    {{ __('Submit') }}
                                </button>
						
							</div>
							</div>

							<div class="form-group row js-timeselectform" >
								<label for="start_time" class="col-md-4 col-form-label text-md-right">{{ __('Start Time' )}}</label>

								<div class="col-md-6">
									<input type="text" class="form-control time" placeholder="Select Time.." id="start_time" name="start_time" readonly="readonly">
									
								</div>
							</div>

							<div class="form-group row js-timeselectform">
								<label for="end_time" class="col-md-4 col-form-label text-md-right">{{ __('End Time' )}}</label>

								<div class="col-md-6">
									<input type="text" class="form-control time" placeholder="Select Time.." id="end_time" name="end_time" readonly="readonly">
									
								</div>
							</div>

							<div class="form-group row js-timeselectform">
                            	<div class="col-md-8 offset-md-4">
                                	<button type="submit" class="btn btn-primary" data-action="{{ route('reserve.confirm') }}" id="reserve-settle">
                                   		 {{ __('Confirm a reservation') }}
                                	</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection