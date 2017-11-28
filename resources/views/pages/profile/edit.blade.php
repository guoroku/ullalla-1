@extends('layouts.app')

@section('title', 'Edit Profile')

@section('styles')
	<link rel="stylesheet" href="{{ asset('css/components/edit_profile.css') }}">
@stop

@section('content')
<div class="wrapper section-edit-profile">
	<div class="container theme-cactus">
		<div class="ui-tabgroup left-side">
			<input class="ui-tab1" type="radio" id="tgroup_c2_tab1" name="tgroup_c2" checked />
			<input class="ui-tab2" type="radio" id="tgroup_c2_tab2" name="tgroup_c2" />
			<input class="ui-tab3" type="radio" id="tgroup_c2_tab3" name="tgroup_c2" />
			<input class="ui-tab4" type="radio" id="tgroup_c2_tab4" name="tgroup_c2" />
			<input class="ui-tab5" type="radio" id="tgroup_c2_tab5" name="tgroup_c2" />
			<input class="ui-tab6" type="radio" id="tgroup_c2_tab6" name="tgroup_c2" />
			<input class="ui-tab7" type="radio" id="tgroup_c2_tab7" name="tgroup_c2" />
			<input class="ui-tab8" type="radio" id="tgroup_c2_tab8" name="tgroup_c2" />
			<input class="ui-tab9" type="radio" id="tgroup_c2_tab9" name="tgroup_c2" />
			<input class="ui-tab10" type="radio" id="tgroup_c2_tab10" name="tgroup_c2" />
			<input class="ui-tab11" type="radio" id="tgroup_c2_tab11" name="tgroup_c2" />
			<div class="ui-tabs">
				<label class="ui-tab1" for="tgroup_c2_tab1">Bio</label>
				<label class="ui-tab2" for="tgroup_c2_tab2">About</label>
				<label class="ui-tab3" for="tgroup_c2_tab3">Gallery</label>
				<label class="ui-tab4" for="tgroup_c2_tab4">Contact</label>
				<label class="ui-tab5" for="tgroup_c2_tab5">Services</label>
				<label class="ui-tab6" for="tgroup_c2_tab6">Workplace</label>
				<label class="ui-tab7" for="tgroup_c2_tab7">Price</label>
				<label class="ui-tab8" for="tgroup_c2_tab8">Job offers</label>
				<label class="ui-tab9" for="tgroup_c2_tab9">Packages</label>
				<label class="ui-tab10" for="tgroup_c2_tab10">Banners</label>
				<label class="ui-tab11" for="tgroup_c2_tab11">Checkout</label>
			</div>
			<div class="ui-panels">
				<div class="ui-tab1">
					<h3>Personal info</h3>
					{!! Form::model($user, ['url' => '@' . $user->username . '/bio/store', 'method' => 'put']) !!}
					<div class="row">
						<div class="col-sm-12">
							<div class="row">
								<div class="col-sm-4">
									<div class="col-3 input-effect {{ $errors->has('nickname') ? 'has-error' : ''  }}">
										<input class="effect-16" type="text" placeholder="" name="nickname" value="{{ $user->nickname }}">
										<label>Nickname</label>
										<span class="focus-border"></span>
										@if ($errors->has('nickname'))
										<span class="help-block">{{ $errors->first('nickname') }}</span>
										@endif
									</div>
								</div>
								<div class="col-sm-4">
									<div class="col-3 input-effect {{ $errors->has('first_name') ? 'has-error' : ''  }}">
										<input class="effect-16" type="text" name="first_name" placeholder="">
										<label>First name</label>
										<span class="focus-border"></span>
										@if ($errors->has('first_name'))
										<span class="help-block">{{ $errors->first('first_name') }}</span>
										@endif
									</div>
								</div>
								<div class="col-sm-4">
									<div class="col-3 input-effect {{ $errors->has('first_name') ? 'has-error' : ''  }}">
										<input class="effect-16" type="text" name="last_name" placeholder="">
										<label>Last name</label>
										<span class="focus-border"></span>
										@if ($errors->has('last_name'))
										<span class="help-block">{{ $errors->first('last_name') }}</span>
										@endif
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="row">
								<div class="col-sm-4">
									<div class="region">
										<select id="Nationality" name="nationality" class="form-control">
											@foreach ($countries as $country)
											<option value="{{ $country->id }}" {{ $user->country_id == $country->id ? 'selected' : '' }}>{{ $country->citizenship }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="col-3 input-effect {{ $errors->has('date_of_birth') ? 'has-error' : ''  }}">
										<input class="effect-16" type="text" placeholder="" id="date_of_birth" name="date_of_birth" value="{{ date("d/m/Y", strtotime($user->date_of_birth)) }}">
										<label>Birthdate</label>
										<span class="focus-border"></span>
										@if ($errors->has('date_of_birth'))
										<span class="help-block">{{ $errors->first('date_of_birth') }}</span>
										@endif
									</div>
								</div>
								<div class="col-sm-4">
									<div class="col-3 input-effect" id="wh">
										<input class="effect-16" type="text" placeholder="" name="height" value="{{ $user->height }}">
										<label>Height (cm)</label>
										<span class="focus-border"></span>
									</div>
									<div class="col-3 input-effect" id="wh">
										<input class="effect-16" type="text" placeholder="" name="weight" value="{{ $user->weight }}">
										<label>Weight (kg)</label>
										<span class="focus-border"></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="row">
								<div class="col-sm-4">
									<div class="info">
										<select id="sex" name="sex" class="form-control">
											@foreach (getSexes() as $sex)
											<option value="{{ $sex }}"></option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="info">
										<select id="sex orientation" name="sex_orientation" class="form-control">
											@foreach (getSexOrientations() as $sexOrientation)
											<option value="{{ $sexOrientation }}"></option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="info">
										<select id="Ancestry" name="ancestry" class="form-control">
											@foreach (getTypes() as $type)
											<option value="{{ $type }}"></option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="row">
								<div class="col-sm-4">
									<div class="info">
										<select id="Figure" name="figure" class="form-control">
											@foreach (getFigures() as $figure)
											<option value="{{ $figure }}"></option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="info">
										<select id="Breast Size" class="form-control" name="breast_size">
											@foreach(getBreastSizes() as $breastSize)
											<option value="{{ $breastSize }}"></option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="info">
										<input list="Eye Color" placeholder="Eye Color" name="">
										<select id="Eye Color">
											@foreach(getEyeColors() as $eyeColor)
											<option value="{{ $eyeColor }}"></option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="row">
								<div class="col-sm-4">
									<div class="info">
										<input list="Hair Color" placeholder="Hair Color">
										<select id="Hair Color">
											@foreach(getHairColors() as $hairColor)
											<option value="{{ $hairColor }}"></option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="info">
										<input list="Tattos" placeholder="Tattos" name="tattos" value="{{ $user->tattoos }}">
										<select id="Tattos">
											<option value="Yes">
											</option><option value="No">
											</option>
										</select>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="info">
										<input list="Piercings" placeholder="Piercings">
										<select id="Piercings">
											<option value="Yes">
											</option><option value="No">
											</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="row">
								<div class="col-sm-4">
									<div class="info">
										<input list="Body Hair" placeholder="Body Hair">
										<select id="Body Hair">
											<option value="Shaved">
											</option><option value="Partial">
											</option><option value="Hairy">
											</option>
										</select>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="info">
										<input list="Intimate" placeholder="Intimate">
										<select id="Intimate">
											<option value="Shaved">
											</option><option value="Partial">
											</option><option value="Hairy">
											</option>
										</select>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="info">
										<input list="Smoker" placeholder="Smoker">
										<select id="Smoker">
											<option value="Yes">
											</option><option value="No">
											</option><option value="Occasionally">
											</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="row">
								<div class="col-sm-4">
									<div class="info">
										<input list="Alcohol" placeholder="Alcohol">
										<select id="Alcohol">
											<option value="Yes">
											</option><option value="No">
											</option><option value="Occasionally">
											</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-default">Save Changes</button>
					{!! Form::close() !!}
				</div>

				<div class="ui-tab2">
					<h3>About Me</h3>
					<div class="row">
						<div class="col-sm-12">
							<label for="comment">Text Area</label>
							<textarea class="form-control" rows="5" id="comment"></textarea>
							<button type="button" class="btn btn-default">Save Changes</button>							
						</div>
					</div>

				</div>
				<div class="ui-tab3">
					<h3 style="margin-bottom: 40px;">Gallery</h3>
					<div class="row">
						<div class="col-sm-4">
							<label>Set profile picture</label><br>
							<button class="input-file">
								<input type="file" id="file-input">
								<label for="file-input" style="margin-bottom: 0px;">UPLOAD</label>
							</button>
						</div>
						<div class="col-sm-4">
							<label>Add new picture</label><br>
							<button class="input-file">
								<input type="file" id="file-input">
								<label for="file-input" style="margin-bottom: 0px;">UPLOAD</label>
							</button>
						</div>
						<div class="col-sm-4">
							<label>Add video</label><br>
							<button class="input-file">
								<input type="file" id="file-input">
								<label for="file-input" style="margin-bottom: 0px;">UPLOAD</label>
							</button>
						</div>
					</div>
					<button type="button" class="btn btn-default">Save Changes</button>
				</div>
				<div class="ui-tab4">
					<h3>Contact</h3>
					<div class="row">
						<div class="col-sm-4">
							<div class="col-3 input-effect">
								<input class="effect-16" type="text" placeholder="">
								<label>Email</label>
								<span class="focus-border"></span>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="col-3 input-effect">
								<input class="effect-16" type="text" placeholder="">
								<label>Phone number</label>
								<span class="focus-border"></span>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="col-3 input-effect">
								<input class="effect-16" type="text" placeholder="">
								<label>Mobile number</label>
								<span class="focus-border"></span>
							</div>
						</div>

					</div>

					<button type="button" class="btn btn-default">Save Changes</button>
				</div>

				<div class="ui-tab5">
					<h3>Services</h3>
					<div class="row" style="margin-top: 20px;">
						<div class="col-sm-4"><div class="layout-list">
							<ul>
								<li>
									<label class="control control--checkbox"><a>Position 69</a>
										<input type="checkbox">
										<div class="control__indicator"></div>
									</label>
								</li>
							</ul>
						</div>
					</div>

					<div class="col-sm-4">
						<div class="layout-list">
							<ul>
								<li>
									<label class="control control--checkbox"><a>Spanisch</a>
										<input type="checkbox">
										<div class="control__indicator"></div>
									</label>
								</li>
							</ul>
						</div>
					</div>



					<div class="col-sm-4">
						<div class="layout-list">
							<ul>
								<li>
									<label class="control control--checkbox"><a>Analmassage (aktiv)</a>
										<input type="checkbox">
										<div class="control__indicator"></div>
									</label>
								</li>
							</ul>
						</div>
					</div>
				</div>

				<button type="button" class="btn btn-default">Save Changes</button>
			</div>



			<div class="ui-tab6">
				<h3>Workplace</h3>
				<div class="row">
					<div class="col-sm-4">
						<div class="region">
							<input list="Canton" placeholder="Canton">
							<datalist id="Canton">
								<option value="Novi Sad">
								</option><option value="Beograd">
								</option><option value="Nis">
								</option><option value="Subotica">
								</option></datalist>
							</div>
						</div>

						<div class="col-sm-4">
							<div class="region">
								<input list="City" placeholder="City">
								<datalist id="City">
									<option value="Novi Sad">
									</option><option value="Beograd">
									</option><option value="Nis">
									</option><option value="Subotica">
									</option></datalist>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="col-3 input-effect">
									<input class="effect-16" type="text" placeholder="">
									<label>Street name and No.</label>
									<span class="focus-border"></span>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="col-3 input-effect">
									<input class="effect-16" type="text" placeholder="">
									<label>Zip</label>
									<span class="focus-border"></span>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="col-3 input-effect">
									<input class="effect-16" type="text" placeholder="">
									<label>Working time</label>
									<span class="focus-border"></span>
								</div>
							</div>


						</div>

						<button type="button" class="btn btn-default">Save Changes</button>
					</div>


					<div class="ui-tab7">
						<h3>Available prices</h3>
						<div class="row">
							<div class="table-responsive">          
								<table class="table">
									<thead>
										<tr>
											<th>#</th>
											<th>Price</th>
											<th>Duration</th>
											<th>Remark</th>
											<th>Services</th>
										</tr>
									</thead>

								</table>
							</div>

						</div>


					</div>

					<div class="ui-tab8">
						<h3>Available prices</h3>
						<div class="row">
							<div class="table-responsive">          
								<table class="table">
									<thead>
										<tr>
											<th>#</th>
											<th>Club name</th>
											<th>Club location</th>
											<th>Offer text</th>
											<th>Accept / Decline</th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>

					<div class="ui-tab9">
						
					</div>
					<div class="ui-tab10">
						<h3>Banners</h3>
					</div>
					<div class="ui-tab11">
						<h3>Checkout</h3>
						<div class="row">
							<div class="table-responsive">          
								<table class="table">
									<thead>
										<tr>
											<th>#</th>
											<th>Package name</th>
											<th>Type</th>
											<th>Start date</th>
											<th>End date</th>
											<th>Quantity</th>
											<th>Price</th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
						<button type="button" class="btn btn-default">Checkout</button> 
					</div>
				</div>
			</div>
		</div>
	</div>
	@stop
	@section('perPageScripts')
	<!-- Include Date Range Picker -->
	<script type="text/javascript" src="{{ url('js/jquery.datetimepicker.full.min.js') }}"></script>
	<script type="text/javascript">
		// set min and max date
		var start = new Date();
		start.setFullYear(start.getFullYear() - 70);
		var end = new Date();
		end.setFullYear(end.getFullYear() - 18);
		// implement daterangepicker on birthday
		$('#date_of_birth').datepicker({
			changeMonth: true,
			changeYear: true,
			minDate: start, 
			maxDate: end,
			yearRange: start.getFullYear() + ':' + end.getFullYear()
		})
	</script>
	@stop



