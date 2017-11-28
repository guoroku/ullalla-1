@extends('layouts.app')

@section('title', 'Private')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/components/girls.css') }}">
@stop

@section('content')
<div class="wrapper section-single-girl">
	<div class="shop-header-banner">
		<span><img src="{{ url('img/banner/profil-banner.jpg') }}" alt=""></span>
	</div>
	<div class="single-product-menu">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="shop-menu">
						<ul>
							<li><a href="single-product.html#">Home</a></li>
							<li class="separator"><i class="fa fa-angle-right"></i></li>
							<li>profil</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="product-essential">
		<div class="container">
			<div class="row">
				<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
					<div class="zoomWrapper">
						<div id="img-1" class="zoomWrapper single-zoom">
							<a>
								<img id="zoom1" src="{{ $user->photos . 'nth/2/-/resize/490x560/' }}" data-zoom-image="{{ $user->photos . 'nth/2/-/resize/1044x1200/' }}" alt="b-1">
							</a>
						</div>
						<div class="single-zoom-thumb">
							<ul class="bxslider" id="gallery_01">
								@for ($i = 0; $i < substr($user->photos, -2, 1); $i++)
								<li>
									<a href="single-product.html#" class="elevatezoom-gallery active" data-update="" data-image="{{ $user->photos . 'nth/' . $i . '/-/resize/490x560/' }}" data-zoom-image="{{ $user->photos . 'nth/' . $i . '/-/resize/1044x1200/' }}"><img src="{{ $user->photos . 'nth/' . $i . '/-/resize/127x145/' }}" alt="zo-th-1" /></a>
								</li>
								@endfor
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
					<div class="product-details shop-review single-pro-zoom">
						<div class="product-name">
							<h3><a>{{ $user->nickname }}</a></h3>
						</div>
						<div class="product-reveiw">
							<p>{{ Str::words($user->about_me, 40) }}</p>
						</div>
						<table class="info-table">{{ parseSingleUserData(getBioFields(), $user) }}</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="single-product-description">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="product-description-tab custom-tab">
						<ul class="nav nav-tabs" role="tablist">
							@if ($user->about_me)
							<li class="active"><a href="#girl-description" data-toggle="tab">About Me</a></li>
							@endif
							@if($user->services->count())
							<li><a href="#girl-services" data-toggle="tab">Services</a></li>
							@endif
							@if($user->hasContact())
							<li><a href="#girl-contact" data-toggle="tab">Contact</a></li>
							@endif
							@if($user->working_time)
							<li><a href="#girl-workinghours" data-toggle="tab">Work Time</a></li>
							@endif
						</ul>
						<div class="tab-content">
							@if ($user->about_me)
							<div class="tab-pane active" id="girl-description">
								<p>{{ $user->about_me }}</p>
							</div>
							@endif
							@if($user->services()->count())
							<div class="tab-pane" id="girl-services">
								<table class="services-table">{{ parseChunkedServices($user) }}</table>
							</div>
							@endif
							@if($user->hasContact())
							<div class="tab-pane" id="girl-contact">

							</div>
							@endif
							@if($user->working_time)
							<div class="tab-pane" id="girl-workinghours">
								<table class="table working-times-table">
									<thead>
										<tr>
											<th>Day</th>
											<th>From</th>
											<th>To</th>
										</tr>
									</thead>
									<tbody>
										<?php $workingTimes = json_decode($user->working_time); ?>
										@foreach($workingTimes as $workingTime)
											<tr>
												<td>{{ explode('|', $workingTime)[0] }}</td>
												<td>{{ explode(' - ', explode('|', $workingTime)[1])[0] }}</td>
												<td>{{ explode(' - ', explode('|', $workingTime)[1])[1] }}</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="banner-area-2 home-4">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="single-banner">
						<a class="last-banner" href="index.html">
							<span>
								<img src="{{ asset('img/banner/fullwide-banner-4.jpg') }}" alt="">
							</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div> 
</div>
@stop