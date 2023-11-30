@php
    $title = env('APP_NAME');
@endphp
@extends('layouts.parent')
@section('title', 'demo-laravel-crud')
@section('content')
<div id="app">
	<div claas="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class='card-hearder'>{{ __('get-reservation' )}}</div>

					<div class="card-body">
						<form method="POST" id="test">
							@csrf
							<div class="form-group row">
								<label for="facility_name" class="col-md-4 col-form-label text-md-right">{{ __('facility_name' )}}</label>

								<div class="col-md-6">
									<select class="form-control" id="facility_name" name="facility_name">
										<option value="blank" selected="selected">選択してください</option>
										<option value="多目的ホールA">多目的ホールA</option>
										<option value="多目的ホールB">多目的ホールB</option>
										<option value="柔道場">柔道場</option>
										<option value="レクリエーションルーム">レクリエーションルーム</option>
									</select>
									
								</div>
							</div>

							<div class="form-group row">
								<label for="dates" class="col-md-4 col-form-label text-md-right">{{ __('dates' )}}</label>

								<div class="col-md-6">
									<input type="text" class="form-control dateinfo" placeholder="Select Date.." id="dateinfo" name="dateinfo" readonly="readonly">
									
								</div>
							</div>	

							<div class="form-group row">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary" data-action='javascript:void(0);' id="date-select">
                                    {{ __('submit') }}
                                </button>
						
							</div>
							</div>

							<div class="form-group row js-timeselectform" >
								<label for="start_time" class="col-md-4 col-form-label text-md-right">{{ __('start_time' )}}</label>

								<div class="col-md-6">
									<input type="text" class="form-control time" placeholder="Select Time.." id="start_time" name="start_time" readonly="readonly">
									
								</div>
							</div>

							<div class="form-group row js-timeselectform">
								<label for="end_time" class="col-md-4 col-form-label text-md-right">{{ __('end_time' )}}</label>

								<div class="col-md-6">
									<input type="text" class="form-control time" placeholder="Select Time.." id="end_time" name="end_time" readonly="readonly">
									
								</div>
							</div>

							<div class="form-group row js-timeselectform">
                            	<div class="col-md-8 offset-md-4">
                                	<button type="submit" class="btn btn-primary" data-action="{{ route('reserve.confirm') }}" id="reserve-settle">
                                   		 {{ __('reserve-settle') }}
                                	</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<!-- 予約時間重複によるエラーメッセージ表示 -->
				@if ($errors->any())
				<ul id = "error" class="error">
				@foreach ($errors->all() as $error)

				<li>{{ $error }}</li>

				@endforeach
				</ul>
				@endif
			</div>
		</div>
	</div>
</div>
<!-- holiday-jp これだけは直読みさせる（ブラウザ反映のため）-->
<script src="./js/holiday_jp.js"></script>
<script src=" {{ mix('js/app.js') }} "></script>
<script src=" {{ mix('js/original.js') }} "></script>
@endsection