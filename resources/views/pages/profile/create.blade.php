@extends('layouts.app')

@section('title', 'Create Profile')

@section('content')
<div class="wrapper section-create-profile">
	<div id="create_profile_modal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<form id="profileForm" method="post" class="form-horizontal wizard">
						<h2>Bio</h2>
						<section data-step="0">
							<div class="col-xs-6">
								<div class="form-group">
									<label class="control-label">First Name*</label>
									<input type="text" class="form-control" name="first_name" />
								</div>
								<div class="form-group">
									<label class="control-label">Last Name*</label>
									<input type="text" class="form-control" name="last_name" />
								</div>
								<div class="form-group">
									<label class="control-label">Nickname*</label>
									<input type="text" class="form-control" name="nickname" />
								</div>
								<div class="form-group">
									<label class="control-label">Nationality</label>
									<select name="nationality_id" class="form-control">
										<option value=""></option>
										@foreach ($countries as $country)
										<option value="{{ $country->id }}">{{ $country->citizenship }}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">Sex*</label>
									<select name="sex" class="form-control">
										<option value="male">Male</option>
										<option value="female">Female</option>
										<option value="transsexual">Transsexual</option>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">Sex Orientation</label>
									<select name="sex_orientation" class="form-control">
										<option value=""></option>
										<option value="heterosexual">Heterosexual</option>
										<option value="bisexual">Bisexual</option>
										<option value="homosexual">Homosexual</option>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">Height</label>
									<input type="text" class="form-control" name="height" />
								</div>
								<div class="form-group">
									<label class="control-label">Weight</label>
									<input type="text" class="form-control" name="weight" />
								</div>
								<div class="form-group">
									<label class="control-label">Ancestry</label>
									<select name="ancestry" class="form-control">
										<option value=""></option>
										<option value="south_african">South African</option>
										<option value="african">African</option>
										<option value="asian">Asian</option>
										<option value="oriental">Oriental</option>
										<option value="mixed">Mixed</option>
										<option value="other">Other</option>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">Figure</label>
									<select name="figure" class="form-control">
										<option value=""></option>
										<option value="normal">Normal</option>
										<option value="slim">Slim</option>
										<option value="athletic">Athletic</option>
										<option value="chubby">Chubby</option>
										<option value="other">Other</option>
									</select>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label class="control-label">Date of Birth*</label>
									<input type="text" class="form-control" name="date_of_birth" id="date_of_birth"/>
								</div>
								<div class="form-group">
									<label class="control-label">Breast Size</label>
									<select name="breast_size" class="form-control">
										<option value=""></option>
										<option value="a">A</option>
										<option value="b">B</option>
										<option value="c">C</option>
										<option value="d">D</option>
										<option value="E">E</option>
										<option value="F">F</option>
										<option value="G">G</option>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">Eye Color</label>
									<select name="eye_color" class="form-control">
										<option value=""></option>
										<option value="black">Black</option>
										<option value="Brown">Brown</option>
										<option value="green">Green</option>
										<option value="blue">Blue</option>
										<option value="gray">Gray</option>
										<option value="other">Other</option>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">Hair Color</label>
									<select name="hair_color" class="form-control">
										<option value=""></option>
										<option value="black">Black</option>
										<option value="brunette">Brunette</option>
										<option value="blond">Blond</option>
										<option value="red">Red</option>
										<option value="other">Other</option>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">Tattoos</label>
									<select name="tattoos" class="form-control">
										<option value=""></option>
										<option value="yes">Yes</option>
										<option value="no">No</option>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">Piercings</label>
									<select name="piercings" class="form-control">
										<option value=""></option>
										<option value="yes">Yes</option>
										<option value="no">No</option>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">Body Hair</label>
									<select name="body_hair" class="form-control">
										<option value=""></option>
										<option value="shaved">Shaved</option>
										<option value="hairy">Hairy</option>
										<option value="partial">Partial</option>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">Intimate</label>
									<select name="intimate" class="form-control">
										<option value=""></option>
										<option value="shaved">Shaved</option>
										<option value="hairy">Hairy</option>
										<option value="partial">Partial</option>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">Smoker</label>
									<select name="smoker" class="form-control">
										<option value=""></option>
										<option value="yes">Yes</option>
										<option value="no">No</option>
										<option value="occasionally">Occasionally</option>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">Alcohol</label>
									<select name="alcohol" class="form-control">
										<option value=""></option>
										<option value="yes">Yes</option>
										<option value="no">No</option>
										<option value="occasionally">Occasionally</option>
									</select>
								</div>
							</div>
						</section>
						<h2>About</h2>
						<section data-step="1">
							<div class="col-xs-12">
								<label class="control-label">About Me</label>
								<textarea name="about_me" class="form-control"></textarea>
							</div>
						</section>
						<h2>Gallery</h2>
						<section data-step="2">
							<div class="form-group">
								<div class="image-preview-multiple">
									<input type="hidden" role="uploadcare-uploader" data-crop="400x460" data-images-only="" data-multiple="">
									<div class="_list"></div>
								</div>
							</div>
							<div class="form-group">
								<div class="image-preview-multiple">
									<input type="hidden" role="uploadcare-uploader-videos" data-multiple="">
									<div class="_list"></div>
								</div>
							</div>
						</section>
						<h2>Contact</h2>
						<section data-step="3">
							<div class="col-xs-12">
								<div class="form-group">
									<label class="control-label">Email*</label>
									<input type="text" class="form-control" name="email" value="{{ $user->email }}" />
								</div>
								<div class="form-group">
									<label class="control-label">Telephone</label>
									<input type="text" class="form-control" name="phone"/>
								</div>
								<div class="form-group">
									<label class="control-label">Mobile Phone</label>
									<input type="text" class="form-control" name="mobile"/>
								</div>
							</div>
						</section>
						<h2>Workplace</h2>
						<section data-step="4">
							<div class="col-xs-12">
								<div class="form-group">
									<label class="control-label">Canton</label>
									<select name="canton" class="form-control">
										<option value=""></option>
										@foreach($cantons as $canton)
										<option value="{{ $canton->id }}">{{ $canton->canton_name }}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">City</label>
									<input type="text" class="form-control" name="city"/>
								</div>
								<div class="form-group">
									<label class="control-label">Zip Code</label>
									<input type="text" class="form-control" name="zip_code"/>
								</div>
								<div class="form-group">
									<label class="control-label">Address</label>
									<input type="text" class="form-control" name="address"/>
								</div>
								<div class="form-group">
									<label class="control-label">Working Time</label>
									<input type="text" class="form-control" name="working_time"/>
								</div>
							</div>
						</section>
						<h2>Services</h2>
						<section data-step="5" class="services-section">
							@foreach ($services->chunk(19) as $chunkedServices)
							<div class="col-xs-6">
								@foreach($chunkedServices as $service)
								<div class="form-group">
									<label class="control-label" style="display: block;">
										<input type="checkbox" class="form-control" name="services[]" value="{{ $service->id }}" />
										{{ $service->service_name }}
									</label>
								</div>
								@endforeach
							</div>
							@endforeach
						</section>
						<h2>Prices</h2>
						<section data-step="6">
							<div class="price_section">
								<div class="col-xs-6">
									<div class="form-group">
										<label class="control-label">Duration</label>
										<input type="text" class="form-control" name="service_duration"/>
										<div class="help-block"></div>
									</div>
								</div>
								<div class="col-xs-6">
									<div class="form-group">
										<label class="control-label">Price</label>
										<input type="text" class="form-control" name="service_price"/>
										<div class="help-block"></div>
									</div>
								</div>
								<div class="col-xs-12">
									<input type="hidden" name="token" value="{{ csrf_token() }}">
									<button type="submit" class="add-new-price">Add New Price</button>
								</div>
							</div>
							<div class="col-xs-12 price-table-container">
								<table class="{{ $prices->count() == 0 ? 'is-hidden' : '' }}">
									<thead>
										<tr>
											<th>Duration</th>
											<th>Price</th>
											<th>Remove</th>
										</tr>
									</thead>
									<tbody id="prices_body">
										@foreach ($prices as $price)
										<tr>
											<td>{{ $price->service_duration }}</td>
											<td>{{ $price->service_price }}</td>
											<td>
												<a href="{{ url('ajax/delete_price/' . $price->id) }}" class="text-danger delete-price" onclick="return confirm('Are you sure?');">
													<span class="glyphicon glyphicon-trash"></span>
												</a>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</section>
						<h2>Packages</h2>
						<section data-step="7">
							<div class="col-xs-12 default-packages-section">
								<h3>Default Packages</h3>
								<div class="has-error">
									<div id="alertPackageMessage" class="help-block"></div>
								</div>
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
										<?php $counter = 1; ?>
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
							</div>
						</section>
						{{ csrf_field() }}
						<div class="chosen-package">
							<input type="hidden" name="package_activation_date">
							<input type="hidden" name="package_month_girl_activation_date">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@stop

@section('perPageScripts')
<!-- Form Validation -->
<script src="{{ asset('js/formValidation.min.js') }}"></script>
<script src="{{ asset('js/framework/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.steps.min.js') }}"></script>
<script src="{{ asset('js/profileValidation.js') }}"></script>
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script>
////////// 1. MODAL, DATERANGE PICKER, ////////
// show modal on page load
$(window).on('load',function(){
	$('#create_profile_modal').modal('show');
});
$(function () {
// disabled modal closing on outside click and escape
$('#create_profile_modal').modal({
	backdrop: 'static',
	keyboard: false
});
$('#profileForm').find('.content').addClass('is-scrollable');
// set min and max date
var start = new Date();
start.setFullYear(start.getFullYear() - 70);
var end = new Date();
end.setFullYear(end.getFullYear() - 18);
// implement daterangepicker on birthday
$('#date_of_birth').daterangepicker({
	singleDatePicker: true,
	timepicker: false,
	showDropdowns: true,
	opens: 'left',
	minDate: start,
	maxDate: end,
	locale: {
		format: 'DD-MM-YYYY'
	},
}).on('change', function(e) {
	$("#date_of_birth").val($('#date_of_birth').data('daterangepicker').startDate.format('DD-MM-YYYY'));
	$('#profileForm').formValidation('revalidateField', 'date_of_birth')
});
// initially set default value to empty
$('#date_of_birth').val('');
// get new start and end year
var start = new Date();
start.setFullYear(start.getFullYear());
var end = new Date();
end.setFullYear(end.getFullYear() + 1);
// implement datarange picker on package activation input
$('.package_month_girl_activation').each(function () {
	$(this).daterangepicker({
		singleDatePicker: true,
		timepicker: false,
		showDropdowns: true,
		minDate: start,
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
		minDate: start,
		maxDate: end,
		locale: {
			format: 'DD-MM-YYYY'
		},
	});;
});
});
////////// 2. UPLOAD CARE ////////
// const widget = uploadcare.Widget('[role=uploadcare-uploader-videos]');
// preview uploaded images
function installWidgetPreviewMultiple(widget, list) {
	widget.onChange(function(fileGroup) {
		list.empty();
		if (fileGroup) {
			$.when.apply(null, fileGroup.files()).done(function() {
				$.each(arguments, function(i, fileInfo) {
					var src = fileInfo.cdnUrl + '-/scale_crop/160x160/center/';
					list.append(
						$('<div/>', {'class': '_item'}).append(
							[$('<img/>', {src: src})])
						);
				});
			});
		}
	});
}
$(function() {
	$('.image-preview-multiple').each(function() {
		installWidgetPreviewMultiple(
			uploadcare.MultipleWidget($(this).children('input')),
			$(this).children('._list')
			);
	});
});
</script>
<script>
/////////// 3. MY JQUERY ////////////
$(function () {
	// add new price
	$('button.add-new-price').on('click', function (e) {
		e.preventDefault();
		var serviceDuration = $('input[name="service_duration"]').val();
		var servicePrice = $('input[name="service_price"]').val();
		var token = $(this).siblings('input').val();
		$.ajax({
			url: location.protocol + '//' + location.host + '/ajax/add_new_price',
			type: 'post',
			data: {service_duration: serviceDuration, service_price: servicePrice, _token: token},
			success: function (data) {
				var priceSection = $('.price_section');
				var errors = data.errors;
				if ($.isEmptyObject(errors)) {
	            // remove error messages if there are any and remove the has-error class
	            var input = priceSection.find('input:visible');
	            input.next().text('');
	            input.val('');
	            input.closest('.form-group').removeClass('has-error');
	            // find table and table body
	            var table = $('.price-table-container').find('table');
	            var tBody = table.find('tbody#prices_body');
	            // add row
	            var row = $('<tr></tr>');
	            // add tds to newly created row
	            var td1 = $('<td></td>', {
	            	text: data.serviceDuration
	            });
	            var td2 = $('<td></td>', {
	            	text: data.servicePrice
	            });
	            var td3 = $('<td></td>');
	            var glyphiconSpan = $('<span></span>', {
	            	class: 'glyphicon glyphicon-trash'
	            });
	            var deleteButton = $('<a></a>', {
	            	href: location.protocol + '//' + location.host + '/ajax/delete_price/' + data.newPriceID,
	            	class: 'text-danger delete-price'
	            }).on('click', function() {
	            	return confirm('Are You Sure?');
	            }).append(glyphiconSpan).appendTo(td3);

	            row.append(td1, td2, td3).appendTo(tBody);

	            if (table.hasClass('is-hidden')) {
	            	table.removeClass('is-hidden').addClass('is-active-table');
	            }
	        } else {
	            // print the errors
	            $.each(errors, function (key, val) {
	            	var input = priceSection.find('[name="'+ key +'"]');
	            	input.closest('div.form-group').addClass('has-error');
	            	input.next().text(val);
	            });
	        }
	    }
	});
	});
});
// delete price
$(function () {
	$(".price-table-container").on("click", "a.delete-price", function(e) {
		e.preventDefault();
		var that = $(this);
		var url = that.attr('href');
		var priceID = url.split('/').pop();
		$.ajax({
			url: url,
			type: 'get',
			data: {price_id: priceID},
			success: function (data) {
				var tBody = that.closest('tbody');
				that.closest('tr').remove();
				if (tBody.children().length == 0) {
					tBody.parent('table').removeClass('is-active-table').addClass('is-hidden');
				}
			}
		});
	});
});

// my checkbox act like a radio button
$(function () {
	$("input.ullalla-package-checkbox:checkbox").on('change', function() {
		$('input.ullalla-package-checkbox:checkbox').not(this).prop('checked', false);
	});
});

$(function () {
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
		var thatRowActivationDate = that.closest('td').prev().find('input');
		console.log(thatRowActivationDate);
		if (that.prop('checked')) {
			if (that.is(':radio')) {
				$('.chosen-package input[name="package_activation_date"]').val(thatRowActivationDate.val());
			} else if (that.is(':checkbox')) {
				$('.chosen-package input[name="package_month_girl_activation_date"]').val(thatRowActivationDate.val());
			}
		}
	});
});
</script>
@stop

