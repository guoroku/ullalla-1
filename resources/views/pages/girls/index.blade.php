@extends('layouts.app')

@section('title', 'Girls')

@section('styles')
<link rel="stylesheet" href="{{ url('css/components/girls.css') }}">
@stop

@section('content')
<div class="wrapper section-girls">
	<div class="single-product-menu">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="shop-menu">
						<ul>
							<li><a href="{{ url('/') }}">Home</a></li>
							<li class="separator"><i class="fa fa-angle-right"></i></li>
							<li>search results</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="shop-product-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
					<div class="left-sidebar-title">
						<h2>Search Filter</h2>
					</div>
					<div class="left-sidebar">
						<div class="shop-layout">
							<div class="layout-title">
								<h2>Service</h2>
							</div>
							<div class="layout-list">
								<ul>
									<li>
										<?php $num = 1; ?>
										@foreach($services as $service)
										<label class="control control--checkbox">
											<a href="{{ urldecode(route('girls', getUrlWithFilters(request('services'), request()->query() , $num, 'services', $service), false)) }}">{{ $service->service_name }}
												<span>({{ $service->users()->payed()->count() }})</span>
											</a>
											<input type="checkbox" name="services[]" value="{{ $service->id }}" {{ request('services') && in_array($service->id, request('services')) ? 'checked' : '' }}/>
											<div class="control__indicator"></div>
										</label>
										<?php $num++; ?>
										@endforeach
									</li>
								</ul>
							</div>
						</div>
						<div class="shop-layout">
							<div class="layout-title">
								<h2>Type</h2>
							</div>
							<div class="layout-list">
								<ul>
									<li>
										<?php $num = 1; ?>
										@foreach(getTypes() as $key => $type)
										<label class="control control--checkbox">
											<a href="{{ urldecode(route('girls', getUrlWithFilters(request('type'), request()->query() , $num, 'type', $type), false)) }}">{{ $type }}
												<span>({{ \App\Models\User::approved()->payed()->where('type', strtolower($type))->count() }})</span>
											</a>
											<input type="checkbox" name="type[]" value="{{ $type }}" {{ request('type') && in_array($type, request('type')) ? 'checked' : '' }}/>
											<div class="control__indicator"></div>
										</label>
										<?php $num++; ?>
										@endforeach
									</li>
								</ul>
							</div>
						</div>
						<div class="shop-layout">
							<div class="layout-title">
								<h2>Hair Color</h2>
							</div>
							<div class="layout-list">
								<ul>
									<li>
										@foreach(getHairColors() as $hairColor)
										<label class="control control--checkbox">
											<a href="{{ urldecode(route('girls', getUrlWithFilters(request('hair_color'), request()->query() , $num, 'hair_color', $hairColor), false)) }}">{{ $hairColor }}
												<span>({{ \App\Models\User::approved()->payed()->where('hair_color', strtolower($hairColor))->count() }})</span>
											</a>
											<input type="checkbox" name="hair_color[]" value="{{ $hairColor }}" {{ request('hair_color') && in_array($hairColor, request('hair_color')) ? 'checked' : '' }}/>
											<div class="control__indicator"></div>
										</label>
										@endforeach
									</li>
								</ul>
							</div>
						</div>
						<div class="shop-layout">
							<div class="layout-title">
								<h2>Breast Size</h2>
							</div>
							<div class="layout-list">
								<ul>
									<li>
										@foreach(getBreastSizes() as $breastSize)
										<label class="control control--checkbox">
											<a href="{{ urldecode(route('girls', getUrlWithFilters(request('breast_size'), request()->query() , $num, 'breast_size', $breastSize), false)) }}">{{ $breastSize }}
												<span>({{ \App\Models\User::approved()->payed()->where('breast_size', strtolower($breastSize))->count() }})</span>
											</a>
											<input type="checkbox" name="breast_size[]" value="{{ $breastSize }}" {{ request('breast_size') && in_array($breastSize, request('breast_size')) ? 'checked' : '' }}/>
											<div class="control__indicator"></div>
										</label>
										@endforeach
									</li>
								</ul>
							</div>
						</div>
						<div class="shop-layout">
							<div class="layout-title">
								<h2>Age</h2>
							</div>
							<div class="layout-list">
								<ul>
									<?php $num = 1; ?>
									@foreach (getFilterYears() as $startAge => $endAge)
									<li>
										<label class="control control--checkbox">
											<a href="{{ urldecode(route('girls', getUrlWithFilters(request('age'), request()->query() , $num, 'age', makeStringFromFilterYears($startAge, $endAge)), false)) }}">
												{{ makeStringFromFilterYears($startAge, $endAge) }} Years
												<span>({{ \App\Models\User::approved()->payed()->whereBetween('age', [$startAge, $endAge])->count() }})</span>
											</a>
											<input type="checkbox" name="age[]" value="18" {{ request('age') && in_array(makeStringFromFilterYears($startAge, $endAge), request('age')) ? 'checked' : '' }}/>
											<div class="control__indicator"></div>
										</label>
									</li>
									<?php $num++; ?>
									@endforeach
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
					<div class="shop-product-view">
						<div class="product-tab-area">
							<div class="tab-bar">
								<div class="tab-bar-inner">
									<ul role="tablist" class="nav nav-tabs">
										<li class="active"><a title="Grid" data-toggle="tab" href="shop.html#shop-product"><i class="fa fa-th-large"></i><span class="grid" title="Grid">Grid</span></a></li>
										<li><a  title="List" data-toggle="tab" href="shop.html#shop-list"><i class="fa fa-list"></i><span class="list">List</span></a></li>
									</ul>
								</div>
								<div class="toolbar">
									<div class="sorter">
										<div class="sort-by">
											<label class="sort-none">Sort By</label>
											<select name="order_by" onchange="location=this.value;"">
												@foreach(getOrderBy() as $key => $order)
												<option value="{{ urldecode(route('girls', array_merge(request()->query(), ['order_by' => $key]), false)) }}" {{ request('order_by') == $key ? 'selected' : '' }}>{{ $order }}</option>
												@endforeach
											</select>
											<a class="up-arrow" href="shop.html#"><i class="fa fa-long-arrow-up"></i></a>
										</div>
									</div>
									<div class="pager-list">
										<div class="limiter">
											<label>Show</label>
											<select name="show" onchange="location=this.value">
												@foreach(getShowNumbers() as $number)
												<option value="{{ urldecode(route('girls', array_merge(request()->query(), ['show' => $number]), false)) }}" {{ request('show') == $number ? 'selected' : '' }}>{{ $number }}</option>
												@endforeach
											</select>
											per page
										</div>
									</div>
								</div>
							</div>
							<div class="tab-content">
								@if ($users->count())
								<div id="shop-product" class="tab-pane active">
									<div class="row">
										@foreach($users as $user)
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
											<div class="single-product">
												<div class="product-img">
													<a class="a-img"><img class="primary-img" src="http://www.ucarecdn.com/465dc041-0b41-4b96-9f66-2240f4637843~7/nth/2/-/resize/263x300/" alt="" />
													</a>
												</div>
												<div class="product-content">
													<a class="shop-name">{{ $user->nickname }}</a>
													<div class="pro-price">
														<p>short info</p>
													</div>
													<a href="{{ url('girls/' . $user->nickname) }}">
														<div class="product-cart">
															<button class="button">View Profile</button>
														</div>
													</a>
												</div>
											</div>
										</div>
										@endforeach
									</div>
								</div>
								<div id="shop-list" class="tab-pane">
									@foreach($users as $user)
									<div class="single-shop single-product">
										<div class="row">
											<div class="single-shop">
												<div class="single-product">
													<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
														<div class="product-img">
															<a class="a-img" href="shop.html#"><img class="primary-img" src="http://www.ucarecdn.com/465dc041-0b41-4b96-9f66-2240f4637843~7/nth/2/-/resize/263x300/" alt="" />
															</a>
														</div>
													</div>
													<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
														<div class="product-content-shop">
															<h2><a class="shop-name">{{ $user->nickname }}</a></h2>
															<div class="pro-deal-text-shop">
																<p>Nunc facilisis sagittis ullamcorper. Proin lectus ipsum, gravida et mattis vulputate, tristique ut lectus. Sed et lorem nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean eleifend laoreet congue. Viva... </p>
															</div>
															<a href="{{ url('girls/' . $user->nickname) }}">
																<div class="product-cart">
																	<button class="button">View Profile</button>
																</div>
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									@endforeach
								</div>
								@else
								<h1>No Users Found</h1>
								@endif
							</div>
							<div class="tab-bar tab-bar-bottom">
								<div class="tab-bar-inner">
									<ul role="tablist" class="nav nav-tabs">
										<li class="active"><a title="Grid" data-toggle="tab" href="shop.html#shop-product"><i class="fa fa-th-large"></i><span class="grid" title="Grid">Grid</span></a></li>
										<li><a  title="List" data-toggle="tab" href="shop.html#shop-list"><i class="fa fa-list"></i><span class="list">List</span></a></li>
									</ul>
								</div>
								<div class="toolbar">
									<div class="sorter">
										<div class="sort-by">
											<label class="sort-none">Sort By</label>
											<select name="order_by" onchange="location=this.value;"">
												@foreach(getOrderBy() as $key => $order)
												<option value="{{ urldecode(route('girls', array_merge(request()->query(), ['order_by' => $key]), false)) }}" {{ request('order_by') == $key ? 'selected' : '' }}>{{ $order }}</option>
												@endforeach
											</select>
											<a class="up-arrow" href="shop.html#"><i class="fa fa-long-arrow-up"></i></a>
										</div>
									</div>
									<div class="pages">
										{{ $users->appends(request()->input())->links('vendor.pagination.custom-girls') }}
									</div>
								</div>
							</div>
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
								<img src="img/banner/fullwide-banner-4.jpg" alt="">
							</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div> 
</div>
@stop

@section('perPageScripts')
{{-- <script>
	function updateQueryStringParameter(uri, key, value) {
		var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
		var separator = uri.indexOf('?') !== -1 ? "&" : "?";
		if (uri.match(re)) {
			return uri.replace(re, '$1' + key + "=" + value + '$2');
		}
		else {
			return uri + separator + key + "=" + value;
		}
	}

	$(function () {
		$('select').on('change', function () {

		});
	});

</script> --}}
@stop