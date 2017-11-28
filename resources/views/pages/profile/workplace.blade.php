@extends('layouts.app')

@section('title', 'Workplace')

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
			{!! parseEditProfileMenu('workplace') !!}
		</div>
		<div class="col-sm-10 profile-info">
			{!! Form::model($user, ['url' => '@' . $user->username . '/workplace/store', 'method' => 'put']) !!}
			<h3>Workplace</h3>
			<div class="row">
				<div class="col-sm-4">
					<div class="region">
						<select class="input-select" id="Canton" name="canton">
							<option value="">Canton</option>
							@foreach($cantons as $canton)
								<option value="{{ $canton->id }}" {{ getSelectedOption($user->canton_id, $canton->id) }}>{{ $canton->canton_name }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="col-3 input-effect">
						<input class="effect-16" type="text" placeholder="" name="city" value="{{ $user->city }}">
						<label>City</label>
						<span class="focus-border"></span>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="col-3 input-effect">
						<input class="effect-16" type="text" placeholder="" name="address" value="{{ $user->address }}">
						<label>Address</label>
						<span class="focus-border"></span>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="col-3 input-effect">
						<input class="effect-16" type="text" placeholder="" name="zip_code" value="{{ $user->zip_code }}">
						<label>Zip Code</label>
						<span class="focus-border"></span>
					</div>
				</div>
			</div>
			<button type="submit" class="btn btn-default">Save Changes</button>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@stop