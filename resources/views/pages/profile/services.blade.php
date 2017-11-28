@extends('layouts.app')

@section('title', 'Services')

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
			{!! parseEditProfileMenu('services') !!}
		</div>
		<div class="col-sm-10 profile-info">
			<h3>Services</h3>
			{!! Form::model($user, ['url' => '@' . $user->username . '/services/store', 'method' => 'put']) !!}
			<div class="row" style="margin-top: 20px;">
				@foreach ($services->chunk(13) as $chunkedServices)
				<div class="col-sm-4">
					<div class="layout-list">
						<ul>
							<li>
								@foreach ($chunkedServices as $service)
								<label class="control control--checkbox"><a>{{ $service->service_name }}</a>
									<input type="checkbox" name="services[]" {{ in_array($service->id, $user->services->pluck('id')->toArray()) ? 'checked' : '' }} value="{{ $service->id }}">
									<div class="control__indicator"></div>
								</label>
								@endforeach
							</li>
						</ul>
					</div>
				</div>
				@endforeach
			</div>
				<button type="submit" class="btn btn-default">Save Changes</button>
			
			{!! Form::close() !!}
		</div>
	</div>
</div>
@stop
