<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	<title>test</title>

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

	 <!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<!-- flatpickr -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@latest/dist/plugins/monthSelect/style.css">
	<script src="https://cdn.jsdelivr.net/npm/flatpickr@latest/dist/plugins/monthSelect/index.js"></script>

	<!-- moment.js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/ja.js"></script>
	<!-- Headタグ内に足す -->
	<link rel="stylesheet" href="{{ mix('/css/app.css') }}">
	<link rel="stylesheet" href="{{ mix('/css/original.css') }}">


</head>
<body>
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
</body>
</html>