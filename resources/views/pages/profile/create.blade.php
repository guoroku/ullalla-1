@extends('layouts.app')

@section('title', 'Create Profile')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/components/create_profile.css') }}">
@stop

@section('content')
<div class="wrapper section-create-profile">
	<div id="create_profile_modal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					{!! Form::open(['url' => '@' . $user->username . '/store', 'class' => 'form-horizontal wizard', 'id' => 'profileForm', 'method' => 'PUT']) !!}
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
								<label class="control-label">date</label>
								<select name="ancestry" class="form-control">
									@foreach(getTypes() as $type)
									<option value="{{ $type }}">{{ $type }}</option>
									@endforeach
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
								<label class="control-label">Age*</label>
								<select name="age" id="age" class="form-control">
									@for ($age=18; $age <= 60 ; $age++) 
										<option value="{{ $age }}">{{ $age }}</option>
									@endfor
								</select>
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
						<div class="col-xs-12">
							<div class="form-group">
								<label class="control-label">About Me</label>
								<textarea name="about_me" class="form-control"></textarea>
							</div>
						</div>
					</section>
					<h2>Gallery</h2>
					<section data-step="1">
						<div class="form-group">
							<div class="image-preview-multiple">
								<input type="hidden" role="uploadcare-uploader" name="photos" data-crop="490x560 minimum" data-images-only="" data-multiple="">
								<div class="_list"></div>
							</div>
						</div>
						<div class="form-group upload-video">
							<input type="hidden" role="uploadcare-uploader-video" name="video" id="uploadcare-file" data-crop="true" data-file-types="avi mp4 ogv mov wmv mkv"/>
							<video id="video" width="320" height="240" loop style="display: block;"></video>
						</div>
					</section>
					<h2>Contact</h2>
					<section data-step="2">
						<div class="col-xs-6">
							<div class="form-group">
								<label class="control-label">Email*</label>
								<input type="text" class="form-control" name="email" value="{{ $user->email }}" />
							</div>
						</div>
						<div class="col-xs-6">
							<div class="form-group">
								<label class="control-label">Website URL</label>
								<input type="text" class="form-control" name="website"/>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="form-group">
								<label class="control-label">Telephone</label>
								<input type="text" class="form-control" name="phone"/>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="form-group">
								<label class="control-label">Mobile Phone</label>
								<input type="text" class="form-control" name="mobile"/>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="form-group">
								<label class="control-label" style="display: block; text-align: left;">Available Apps</label>
								@foreach($contactOptions as $contactOption)
								<label class="control control--checkbox" style="margin-right: 20px;"><a>{{ ucfirst($contactOption->contact_option_name) }}</a>
									<input type="checkbox" name="contact_options[]" value="{{ $contactOption->id }}" id="{{ $contactOption->contact_option_name == 'skype' ? 'skype_contact' : '' }}">
									<div class="control__indicator"></div>
								</label>
								@endforeach
							</div>
						</div>
						<div class="col-xs-6">
							<div class="form-group">
								<label class="control-label" style="display: block; text-align: left;">I Prefer</label>
								@foreach(getPreferedOptions() as $key => $preferedOption)
								<div class="col-xs-6" style="padding: 0px; margin: 0px;">
									<label style="margin-right: 20px;">
										<input type="radio" name="prefered_contact_option" value="{{ $key }}" style="display: inline-block;">
										{{ $preferedOption }}
									</label>
								</div>	
								@endforeach
								<div class="col-xs-6" style="padding: 0px; margin: 0px;">
									<label class="control control--checkbox" style="margin-right: 20px;">
										<input type="checkbox" name="no_withheld_numbers" value="1" style="display: inline-block;"><a>No Withheld Numbers</a>
										<div class="control__indicator"></div>
									</label>
								</div>
							</div>
						</div>
						<div class="col-xs-6 skype-name" style="display: none;">
							<div class="form-group">
								<input type="text" name="skype_name" placeholder="Skype Name" class="form-control">
							</div>
						</div>
					</section>
					<h2>Workplace</h2>
					<section data-step="3">
						<div class="col-xs-6">
							<div class="form-group">
								<label class="control-label">Canton</label>
								<select name="canton" class="form-control">
									<option value=""></option>
									@foreach($cantons as $canton)
									<option value="{{ $canton->id }}">{{ $canton->canton_name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-xs-4">
							<div class="form-group">
								<label class="control-label">City</label>
								<input type="text" class="form-control" name="city"/>
							</div>
						</div>
						<div class="col-xs-2">
							<div class="form-group">
								<label class="control-label">Zip Code</label>
								<input type="text" class="form-control" name="zip_code"/>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="form-group">
								<label class="control-label">Address</label>
								<input type="text" class="form-control" name="address"/>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="form-group">
								<label class="control-label">Club Name</label>
								<input type="text" class="form-control" name="club_name"/>
							</div>
						</div>
						<h3>Available For:</h3>
						<div class="col-xs-6">
							<div class="form-group">
								<label class="control control--checkbox">
									<input type="checkbox" name="incall" value="1" id="incall_availability"><a>Incall</a>
									<div class="control__indicator"></div>
								</label>
								<div class="incall-options" style="display: none;">
									@foreach(getIncallOptions() as $key => $incallOption)
									<label style="margin-left: 30px; display: block;">
										<input type="radio" name="incall_option" value="{{ $key }}" id="{{ $key == 'define_yourself' ? 'incall_define_yourself' : '' }}" style="display: inline-block;">
										{{ $incallOption }}
									</label>
									@endforeach
									<input type="text" name="incall_define_yourself" style="display: none; margin-left: 45px;">
								</div>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="form-group">
								<label class="control control--checkbox">
									<input type="checkbox" name="outcall" value="1" id="outcall_availability"><a>Outcall</a>
									<div class="control__indicator"></div>
								</label>
								<div class="outcall-options" style="display: none;">
									@foreach(getOutcallOptions() as $key => $outcallOption)
									<label style="margin-left: 30px; display: block;"">
										<input type="radio" name="outcall_option" value="{{ $key }}" id="{{ $key == 'define_yourself' ? 'outcall_define_yourself' : '' }}" style="display: inline-block;">
										{{ $outcallOption }}
									</label>
									@endforeach
									<input type="text" name="outcall_define_yourself" style="display: none; margin-left: 45px;">
								</div>
							</div>
						</div>
					</section>
					<h2>Working Hours</h2>
					<section data-step="4">
						<div class="col-xs-12">
							<div class="form-group">
								<div id="available_24_7">
									<label class="control control--checkbox"><a>Available 24/7</a>
										<input type="checkbox" name="available_24_7">
										<div class="control__indicator"></div>
									</label>
									<label class="control control--checkbox working-times-disabled" style="margin-left: 20px;"><a>Show As Night Escort</a>
										<input type="checkbox" name="available_24_7_night_escort" value="1" disabled="">
										<div class="control__indicator"></div>
									</label>
								</div>
								<table class="table working-times-table">
									<thead>
										<tr>
											<th>
												<label class="control control--checkbox"><a>Mark All</a>
													<input type="checkbox" id="select_all_days">
													<div class="control__indicator"></div>
												</label>
											</th>
											<th>From</th>
											<th>To</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php $counter = 1; ?>
										@foreach(getDaysOfTheWeek() as $dayOfTheWeek)
										<tr class="working-times-disabled">
											<td>
												<label class="control control--checkbox"><a>{{ $dayOfTheWeek }}</a>
													<input type="checkbox" name="days[{{ $counter }}]" value="{{ $dayOfTheWeek }}">
													<div class="control__indicator"></div>
												</label>
											</td>
											<td>
												<select name="time_from[{{ $counter }}]" class="form-control" disabled="">
													@foreach(getHoursList() as $hour)
													<option value="{{ $hour }}">{{ $hour }}</option>
													@endforeach
												</select>
												<span>hrs</span>
												<select name="time_from_m[{{ $counter }}]" class="form-control" disabled="">
													@foreach(getMinutesList() as $minute)
													<option value="{{ $minute }}">{{ $minute }}</option>
													@endforeach
												</select>
												<span>min</span>
											</td>
											<td>
												<select name="time_to[{{ $counter }}]" class="form-control" disabled="">
													@foreach(getHoursList() as $hour)
													<option value="{{ $hour }}">{{ $hour }}</option>
													@endforeach
												</select>
												<span>hrs</span>
												<select name="time_to_m[{{ $counter }}]" class="form-control" disabled="">
													@foreach(getMinutesList() as $minute)
													<option value="{{ $minute }}">{{ $minute }}</option>
													@endforeach
												</select>
												<span>min</span>
											</td>
											<td>
												<label class="control control--checkbox"><a>Night Escort</a>
													<input type="checkbox" name="night_escorts[{{ $counter }}]" value="{{ $counter }}" disabled="">
													<div class="control__indicator"></div>
												</label>
											</td>
										</tr>
										<?php $counter++; ?>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</section>
					<h2>Services</h2>
					<section data-step="5" class="services-section">
						<h3>Services Offered For:</h3>
						<div class="col-xs-12">
							@foreach($serviceOptions as $serviceOption)
							<label class="control control--checkbox"><a>{{ ucfirst($serviceOption->service_option_name) }}</a>
								<input type="checkbox" name="service_options[]" value="{{ $serviceOption->id }}">
								<div class="control__indicator"></div>
							</label>
							@endforeach
						</div>
						<div class="service-list">
							<h3>Service List</h3>
							@foreach ($services->chunk(19) as $chunkedServices)
							<div class="col-xs-6">
								@foreach($chunkedServices as $service)
								<div class="form-group">
									<label class="control control--checkbox" style="display: block;"><a>{{ $service->service_name }}</a>
										<input type="checkbox" class="form-control" name="services[]" value="{{ $service->id }}" />
										<div class="control__indicator"></div>
									</label>
								</div>
								@endforeach
							</div>
							@endforeach
						</div>
					</section>
					<h2>Prices</h2>
					<section data-step="6">
						<div class="price_section">
							<div class="col-xs-3">
								<div class="form-group">
									<label class="control-label">Duration</label>
									<input type="text" class="form-control" name="service_duration"/>
									<div class="help-block"></div>
								</div>
							</div>
							<div class="col-xs-2">
								<div class="form-group">
									<label class="control-label">Unit</label>
									<select name="service_price_unit" class="form-control">
										@foreach(getUnits() as $unit)
										<option value="{{ $unit }}">{{ ucfirst($unit) }}</option>
										@endforeach
									</select>
									<div class="help-block"></div>
								</div>
							</div>
							<div class="col-xs-3">
								<div class="form-group">
									<label class="control-label">Price</label>
									<input type="text" class="form-control" name="service_price"/>
									<div class="help-block"></div>
								</div>
							</div>
							<div class="col-xs-2">
								<div class="form-group">
									<label class="control-label">Currency</label>
									<select name="service_price_currency" class="form-control">
										@foreach(getCurrencies() as $currency)
										<option value="{{ $currency }}">{{ strtoupper($currency) }}</option>
										@endforeach
									</select>
									<div class="help-block"></div>
								</div>
							</div>
							<div class="col-xs-2">
								<div class="form-group">
									<label class="control-label">Type</label>
									<select name="price_type" id="price_type" class="form-control">
										@foreach(getPriceTypes() as $priceType)
										<option value="{{ $priceType }}">{{ ucfirst($priceType) }}</option>
										@endforeach
									</select>
									<div class="help-block"></div>
								</div>
							</div>
							<div class="col-xs-12">
								<input type="hidden" name="add_price_token" value="{{ csrf_token() }}">
								<button type="submit" class="add-new-price btn btn-default">Add New Price</button>
							</div>
						</div>
						<div class="col-xs-12 price-table-container">
							<table class="{{ $prices->count() == 0 ? 'is-hidden' : '' }}">
								<thead>
									<tr>
										<th>Type</th>
										<th>Duration</th>
										<th>Price</th>
										<th>Remove</th>
									</tr>
								</thead>
								<tbody id="prices_body">
									@foreach ($prices as $price)
									<tr>
										<td>{{ $price->price_type }}</td>
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
					<h2>Languages</h2>
					<section data-step="7">
						<table class="table language-table">
							<thead>
								<tr>
									<th>Language</th>
									<th>Level</th>
								</tr>
							</thead>
							<tbody class="language-list">
								@foreach($spokenLanguages->take(7) as $language)
								<tr>
									<td>
										<img src="{{ asset('flags/4x3/' . $language->spoken_language_code . '.svg') }}" alt="" height="20" width="30">
										{{ $language->spoken_language_name }}
									</td>
									<td>
										<div class="slider"></div>
										<input type="hidden" class="spoken-language-input" name="spoken_language[{{ $language->spoken_language_code }}]" value="">
									</td>
								</tr>
								@endforeach
							</tbody>
							<tbody class="language-list" style="display: none;">
								@foreach($spokenLanguages->splice(7) as $language)
								<tr>
									<td>
										<img src="{{ asset('flags/4x3/' . $language->spoken_language_code . '.svg') }}" alt="" height="20" width="30">
										{{ $language->spoken_language_name }}
									</td>
									<td>
										<div class="slider"></div>
										<input type="hidden" name="spoken_language[{{ $language->spoken_language_code }}]" value="0">
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						<div class="show-more text-center">
							<a href="#" class="btn btn-default">Show More</a>
						</div>
					</section>
					<h2>Packages</h2>
					<section data-step="8">
						<div class="col-xs-12 default-packages-section" id="default-packages-section">
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
						</div>
					</section>
					<input type="hidden" name="stripeToken" id="stripeToken">
					<input type="hidden" name="stripeEmail" id="stripeEmail">
					{!! Form::close() !!}
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
<script src="{{ asset('js/billing.js') }}"></script>
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script>
////////// 1. MODAL, DATERANGE PICKER, ////////
// show modal on page load
$(window).on('load',function(){
	$('#create_profile_modal').modal('show');
	$('.slider').slider({
		range: "min",
		value: 0,
		step: 1,
		min: 0,
		max: 5,
		slide: function( event, ui ) {
			console.log(ui.value);
			$(this).next('input.spoken-language-input').val(ui.value);
		}
	});
});

// if user changes the value of input field (in some cases can be useful)
// $(function () {
// 	$('input[name="spoken_language"]').change(function () {
// 		var value = this.value.substring(1);
// 		console.log(value);
// 		$(this).siblings('.slider').slider('value', parseInt(value));
// 	});
// });

$(function () {
	$('.show-more a').on('click', function(e){
		var that = $(this);
		e.preventDefault();
		that.text(that.text() == 'Show More' ? 'Show Less' : 'Show More');
		$('table.language-table').find('.language-list:last-child').toggle();
	});
});

$(function () {
// disabled modal closing on outside click and escape
$('#create_profile_modal').modal({
	backdrop: 'static',
	keyboard: false
});
// make modal content scrolablle
$('#profileForm').find('.content').addClass('is-scrollable');
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
	});
});
});
////////// 2. UPLOAD CARE ////////
// const widget = uploadcare.Widget('[role=uploadcare-uploader-videos]');
// preview uploaded images function
function installWidgetPreviewMultiple(widget, list) {
	widget.onChange(function(fileGroup) {
		list.empty();
		if (fileGroup) {
			$.when.apply(null, fileGroup.files()).done(function() {
				$.each(arguments, function(i, fileInfo) {
					var src = fileInfo.cdnUrl;
					list.append(
						$('<div/>', {'class': '_item'}).append(
							[$('<img/>', {src: src})])
						);
				});
			});
		}
		$('#profileForm').formValidation('revalidateField', 'photos');
	});
}

function minDimensions(width, height) {
	return function(fileInfo) {
		var imageInfo = fileInfo.originalImageInfo;
		if (imageInfo !== null) {
			console.log();
			if (imageInfo.width < width || imageInfo.height < height) {
				throw new Error('dimensions');
			}
		}
	};
}

// file maximum size
function maxFileSize(size) {
	return function (fileInfo) {
		if (fileInfo.size !== null && fileInfo.size > size) {
			throw new Error("fileMaximumSize");
		}
	}
}
// file type limit
function fileTypeLimit(types) {
	types = types.split(' ');
	return function(fileInfo) {
		if (fileInfo.name === null) {
			return;
		}
		var extension = fileInfo.name.split('.').pop();
		if (types.indexOf(extension) == -1) {
			throw new Error("fileType");
		}
	};
}

$(function() {
	// preview images initialization
	$('.image-preview-multiple').each(function() {
		installWidgetPreviewMultiple(
			uploadcare.MultipleWidget($(this).children('input')),
			$(this).children('._list')
			);
	});

	$('[role=uploadcare-uploader]').each(function() {
		var widget = uploadcare.Widget(this);
		widget.validators.push(minDimensions(490, 560));
	});

	var video = document.getElementById('video');
	var source = document.createElement('source');
	var widget = uploadcare.Widget('[role=uploadcare-uploader-video]');
	widget.validators.push(fileTypeLimit($('[role=uploadcare-uploader-video]').data('file-types')));	
	widget.validators.push(maxFileSize(20000000));
	// preview single video
	widget.onUploadComplete(function (fileInfo) {
		source.setAttribute('src', fileInfo.cdnUrl);
		video.appendChild(source);
		// video.play();
	});
	// remove video element
	$('.upload-video').find('button.uploadcare--widget__button_type_remove').on('click', function () {
		$('.upload-video').find('#video').remove();
	});

	// 	<input type="hidden" role="uploadcare-uploader" name="video" data-multiple="true"/>
	// <div id="preview"></div>
	// preview multiple videos
	// var preview = document.getElementById('preview');
	// var widget = uploadcare.MultipleWidget('[role=uploadcare-uploader]');
	// widget.onDialogOpen(function (dialog) {
	// 	dialog.fileColl.onAnyDone(function (file) {
	// 		file.done(function (fileInfo) {
	// 			var video = document.createElement('video');
	// 			video.width = 320;
	// 			video.height = 240;
	// 			video.loop = true;
	// 			var source = document.createElement('source');
	// 			source.setAttribute('src', fileInfo.cdnUrl);
	// 			video.appendChild(source);
	// 			preview.appendChild(video);
 //     			// video.play();
 //     		})
	// 	})
	// })
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
		var priceType = $('select[name="price_type"]').val();
		var servicePriceUnit = $('select[name="service_price_unit"]').val();
		var servicePriceCurrency = $('select[name="service_price_currency"]').val();
		var token = $(this).siblings('input').val();
		$.ajax({
			url: location.protocol + '//' + location.host + '/ajax/add_new_price',
			type: 'post',
			data: {
				service_duration: serviceDuration, 
				service_price: servicePrice, 
				price_type: priceType,
				service_price_unit: servicePriceUnit,
				service_price_currency: servicePriceCurrency,
				_token: token
			},
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
	            var priceType = data.priceType;
	            var td = $('<td></td>', {
	            	text: capitalizeFirstLetter(priceType)
	            });
	            var td1 = $('<td></td>', {
	            	text: data.serviceDuration + ' ' + data.servicePriceUnit
	            });
	            var currency = data.servicePriceCurrency;
	            var td2 = $('<td></td>', {
	            	text: data.servicePrice + ' ' + currency.toUpperCase()
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

	            row.append(td, td1, td2, td3).appendTo(tBody);

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
</script>

<!-- Contact script -->
<script>
	$(function () {
		$('input#skype_contact').on('click', function () {
			$('.skype-name').toggle();
		});
	});
</script>


<!-- Workplace script -->
<script>
	$(function () {
		var incallDefineYourself = $('input[name="incall_define_yourself"]');
		var outcallDefineYourself = $('input[name="outcall_define_yourself"]');

		$('input#incall_availability').on('click', function () {
			$('.incall-options').toggle();
			incallDefineYourself.val('');
			$('input[name="incall_option"]').prop('checked', false);
		});
		$('input#outcall_availability').on('click', function () {
			$('.outcall-options').toggle();
			outcallDefineYourself.val('');
			$('input[name="outcall_option"]').prop('checked', false);
		});

		$('input#incall_define_yourself').on('click', function () {
			incallDefineYourself.show();
		});
		$('.incall-options label input').not('#incall_define_yourself').on('click', function () {
			incallDefineYourself.hide();
			incallDefineYourself.val('');
		});

		$('input#outcall_define_yourself').on('click', function () {
			outcallDefineYourself.show();
		});
		$('.outcall-options label input').not('#outcall_define_yourself').on('click', function () {
			outcallDefineYourself.hide();
			outcallDefineYourself.val('');
		});
	});
</script>

<script>
	$(function () {
		var selectAllDays = $('#select_all_days');
		var workingTimesRows = $('table.working-times-table').find('tr');
		var workingTimesBodyRows = $('table.working-times-table tbody').find('tr');

		$('.working-times-table tr td:first-child input').on('click', function () {
			var that = $(this);
			var closestTr = that.closest('tr');
			if (closestTr.hasClass('working-times-disabled')) {
				closestTr.removeClass('working-times-disabled');
				closestTr.find('select, input').attr('disabled', false);
			} else {
				closestTr.addClass('working-times-disabled');
				closestTr.find('select, td:last-child input').attr('disabled', true);
				closestTr.find('input').prop('checked', false);
			}
		});

		$('#available_24_7 label:first-child input').on('click', function () {
			var that = $(this);
			if (that.prop('checked')) {
				that.closest('label')
				.next('label')
				.removeClass('working-times-disabled')
				.find('input')
				.attr('disabled', false);
				$('table.working-times-table').addClass('working-times-disabled').find('select, input').attr('disabled', true);
			} else {
				that.closest('label')
				.next('label')
				.addClass('working-times-disabled')
				.find('input')
				.attr('disabled', true)
				.prop('checked', false);

				selectAllDays.attr('disabled', false);
				$('table.working-times-table').removeClass('working-times-disabled');		
				$('table.working-times-table').find('input').attr('disabled', false);
				workingTimesBodyRows.each(function () {
					if (!$(this).hasClass('working-times-disabled')) {
						$(this).find('select').attr('disabled', false);
					}
				});
			}
		});

		selectAllDays.on('click', function () {
			var that = $(this);
			if (that.prop('checked')) {
				$('#available_24_7').addClass('working-times-disabled').find('input').attr('disabled', true);
				that.closest('table').removeClass('working-times-disabled').find('tr').removeClass('working-times-disabled');
				that.closest('table').find('select, input').attr('disabled', false).prop('checked', true);
			} else {
				$('#available_24_7').removeClass('working-times-disabled').find('label:first-child input').attr('disabled', false);
				that.attr('disabled', false).closest('tr').removeClass('working-times-disabled');
				workingTimesBodyRows.addClass('working-times-disabled').find('select').attr('disabled', true).prop('checked', false);
				workingTimesBodyRows.find('input').attr('disabled', false).prop('checked', false);
			}
		});
	});
</script>

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
			var url = getUrl('/@' + username + '/store');
			var token = $('input[name="_token"]').val();
			var form = $('#profileForm');
			var data = form.serialize();
			// fire ajax post request
			$.post(url, data)
			.done(function (data) {
				window.location.href = "http://ullalla.app";
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

