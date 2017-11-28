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
								<input type="text" class="package_activation" id="package_activation{{ $counter }}">
							</td>
							<td>

								<label>
									<input type="radio" class="option-input radio ullalla-package-radio" name="ullalla_package"/>
								</label>
							</td>
						</tr>
						<?php $counter++; ?>
						@endforeach
					</tbody>
				</table>
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
								<input type="text" class="package_month_girl_activation" id="package_month_activation{{ $counter }}">
							</td>
							<td>
								<label>
									<input type="checkbox" class="option-input checkbox ullalla-package-checkbox" name="ullalla_package_month_girl" />
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
			<div class="chosen-package">
				<input type="hidden" name="package_activation_date">
				<input type="hidden" name="package_month_girl_activation_date">
			</div>
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

<!-- Pacakges script -->
<script>
	$(function () {
		// my checkbox act like a radio button
		$("input.ullalla-package-checkbox:checkbox").on('change', function() {
			$('input.ullalla-package-checkbox:checkbox').not(this).prop('checked', false);
		});

		$('.package_activation, .package_month_girl_activation').on('keyup blur', function () {
			var that = $(this);
			var thatRowCheckbox = that.parent('td').next().find('input');
			if (thatRowCheckbox.prop('checked')) {
				if (thatRowCheckbox.is(':radio')) {
					$('.chosen-package input[name="package_activation_date"]').val(that.val());
				} else if (thatRowCheckbox.is(':checkbox')) {
					$('.chosen-package input[name="package_month_girl_activation_date"]').val(that.val());
				}
			}
		});

		$('input.ullalla-package-checkbox, input.ullalla-package-radio').on('change', function () {
			var that = $(this);
			var token = $('input[name="_token"]').val();
			var thatRowActivationDate = that.closest('td').prev().find('input');

			if (that.is(':radio')) {
				var url = getUrl('/ajax/store_default_package');
				var package = that.closest('tr').index() + 1;
				$.ajax({
					url: url,
					data: {_token: token, package_id: package, radioState: that.val()},
					type: 'post',
					success: function (data) {
						return true;
					}
				});
			// update package activation date hidden input
			if (that.prop('checked')) {
				$('.chosen-package input[name="package_activation_date"]').val(thatRowActivationDate.val());
			} else {
				$('.chosen-package input[name="package_activation_date"]').val('');
			}
		} else if (that.is(':checkbox')) {
			var url = getUrl('/ajax/store_month_girl_package');
			var package = that.closest('tr').index() + 1;
			$.ajax({
				url: url,
				data: {_token: token, package_id: package, radioState: that.prop('checked') ? that.val() : 'off'},
				type: 'post',
				success: function (data) {
					return true;
				}
			});
			// update package activation date hidden input
			if (that.prop('checked')) {
				$('.chosen-package input[name="package_month_girl_activation_date"]').val(thatRowActivationDate.val());
			} else {
				$('.chosen-package input[name="package_month_girl_activation_date"]').val('');
			}
		}
	});
	});
</script>
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
					$('div.packages-errors').addClass('alert alert-danger').text('Default package is required');
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
@stop