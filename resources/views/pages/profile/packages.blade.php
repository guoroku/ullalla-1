@extends('layouts.app')

@section('title', 'Packages')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/components/edit_profile.css') }}">
@stop

@section('content')
<div class="shop-header-banner">
	<span><img src="img/banner/profil-banner.jpg" alt=""></span>
</div>

<div class="container theme-cactus">
	<div class="row">
		<div class="col-sm-2 vertical-menu">
			{!! parseEditProfileMenu('packages') !!}
		</div>
		<?php $counter = 1; ?>
		<div class="col-sm-10 profile-info">
			
			@if($user->is_active_d_package || $user->is_active_gotm_package)
			<h3>Active Packages</h3>
			<table class="table">
				<thead>
					<tr>
						<th>Type</th>
						<th>Activation Date</th>
						<th>Expiry Date</th>
					</tr>
				</thead>	
				<tbody>
					@if($user->is_active_d_package)
					<tr>
						<td>Default Package</td>
						<td>{{ date('d-m-Y', strtotime($user->package1_activation_date)) }}</td>
						<td>{{ date('d-m-Y', strtotime($user->package1_expiry_date)) }}</td>
					</tr>
					@endif
					@if($user->is_active_gotm_package)
					<tr>
						<td>Girl Of The Month Package</td>
						<td>{{ date('d-m-Y', strtotime($user->package2_activation_date)) }}</td>
						<td>{{ date('d-m-Y', strtotime($user->package2_expiry_date)) }}</td>
					</tr>
					@endif
				</tbody>
			</table>
			@endif
			<div class="col-xs-12">
				@if(Session::has('success'))
				<div class="alert alert-success">{{ Session::get('success') }}</div>
				@endif
				<div class="packages-errors"></div>
			</div>
			@if($showDefaultPackages || $showGotmPackages)
			{!! Form::model($user, ['url' => '@' . $user->username . '/packages/store', 'id' => 'profileForm', 'method' => 'PUT']) !!}
			@if($showDefaultPackages)
			<div class="col-xs-12 default-packages-section" id="default-packages-section">
				<h3>Default Packages</h3>
				<div class="has-error">
					<div id="alertPackageMessage" class="help-block"></div>
				</div>
				@if($errors->has('ullalla_package'))
				<p class="has-error">Default package is required</p>
				@endif
				<table class="table packages-table">
					<thead>
						<tr>
							<th>Name</th>
							<th>Duration</th>
							<th>Price</th>
							<th>Activation Date</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach ($packages as $package)
						<tr>
							<td>{{ $package->package_name }}</td>
							<td>{{ $package->package_duration }}</td>
							<td>{{ $package->package_price }}</td>
							<td>
								<input type="text" name="default_package_activation_date[{{ $package->id }}]" class="package_activation" id="package_activation{{ $counter }}">
							</td>
							<td>
								<label>
									<input type="radio" class="option-input radio ullalla-package-radio" name="ullalla_package[]" value="{{ $package->id }}" />
								</label>
							</td>
						</tr>
						<?php $counter++; ?>
						@endforeach
					</tbody>
				</table>
				@if(!$showGotmPackages)
				<button type="submit" class="btn btn-default">Save Changes</button>
				@endif
			</div>
			@endif

			@if($showGotmPackages)
			<div class="col-xs-12">
				<h3>Girl of the Month</h3>
				<table class="table packages-table package-girl-month">
					<thead>
						<tr>
							<th>Name</th>
							<th>Duration</th>
							<th>Price</th>
							<th>Activation Date</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach ($packages->take(3) as $package)
						<tr>
							<td>{{ $package->package_name }}</td>
							<td>{{ $package->package_duration }}</td>
							<td>{{ $package->package_price }}</td>
							<td>
								<input type="text" name="month_girl_package_activation_date[{{ $package->id }}]" class="package_month_girl_activation" id="package_month_activation{{ $counter }}">
							</td>
							<td>
								<label>
									<input type="checkbox" class="option-input checkbox ullalla-package-checkbox" name="ullalla_package_month_girl[]" value="{{ $package->id }}"/>
								</label>
							</td>
						</tr>
						<?php $counter++; ?>
						@endforeach
					</tbody>
				</table>
				<button type="submit" class="btn btn-default">Save Changes</button>
			</div>
			@endif
			<input type="hidden" name="stripeToken" id="stripeToken">
			<input type="hidden" name="stripeEmail" id="stripeEmail">
			{!! Form::close() !!}
			@endif
		</div>
	</div>
</div>
@stop

@section('perPageScripts')
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script>
	// get new start and end year
	var end = new Date();
	end.setFullYear(end.getFullYear() + 1);

	var defaultPackageStartDate = JSON.parse('{!! json_encode([$user->package1_expiry_date]) !!}');
	var defaultPackageStartDate = new Date(defaultPackageStartDate[0].date);
	var defaultPackageStartDate = new Date() > defaultPackageStartDate ? new Date() : defaultPackageStartDate;
	
	var gotmPackageStartDate = JSON.parse('{!! json_encode([$user->package2_expiry_date]) !!}');
	var gotmPackageStartDate = new Date(gotmPackageStartDate[0].date);
	var gotmPackageStartDate = new Date() > gotmPackageStartDate ? new Date() : gotmPackageStartDate;

	$(function () {
		$('.package_month_girl_activation').each(function () {
			$(this).daterangepicker({
				singleDatePicker: true,
				timepicker: false,
				showDropdowns: true,
				minDate: gotmPackageStartDate,
				maxDate: end,
				locale: {
					format: 'DD-MM-YYYY'
				},
			});;
		});
		// implement datarange picker on package activation input
		$('.package_activation').each(function () {
			$(this).daterangepicker({
				singleDatePicker: true,
				timepicker: false,
				showDropdowns: true,
				minDate: defaultPackageStartDate,
				maxDate: end,
				locale: {
					format: 'DD-MM-YYYY'
				},
			});
		});
	});
</script>

<!-- Stripe integration -->
<script src="https://checkout.stripe.com/checkout.js"></script>
<script>
	let stripe = StripeCheckout.configure({
		key: '{{ config('services.stripe.key') }}',
		image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
		locale: 'auto',
		token: function (token) {
			var stripeEmail = $('#stripeEmail');
			var stripeToken = $('#stripeToken');
			stripeEmail.val(token.email);
			stripeToken.val(token.id);
			// submit the form
			var username = '{{ $user->username }}';
			var url = getUrl('/@' + username + '/packages/store');
			var token = $('input[name="_token"]').val();
			var form = $('#profileForm');
			var data = form.serialize();
			// fire ajax post request
			$.post(url, data)
			.done(function (response, textStatus) {
				var errors = response.errors;
				if (errors) {
					if (typeof errors.default_package_error !== 'undefined') {
						$('div.packages-errors').addClass('alert alert-danger').text('Default package is required');
					} else if (typeof errors.month_girl_package_error !== 'undefined') {
						$('div.packages-errors').addClass('alert alert-danger').text('Please, choose the package');
					} else {
						window.location.href = 'http://ullalla.app/@' + username  + '/packages';
					}
				} else {
					window.location.href = 'http://ullalla.app/@' + username  + '/packages';
				}
			})
			.fail(function(data, textStatus) {
				$('.default-packages-section').find('.help-block').text(data.responseJSON.status);
			});
		}
	});
	$('#profileForm').on('submit', function (e) {
		stripe.open({
			name: 'Ullalla',
			description: '{{ $user->email }}',
		});
		e.preventDefault();	
	});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.6/sweetalert2.all.min.js"></script>
@if(Session::has('expired_package_info'))
<script>
	swal(
		'Oops...',
		'{{ Session::get('expired_package_info') }}',
		'error'
	);
</script>
@endif
@stop