@extends('layouts.app')

@section('title', 'Languages')

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
			{!! parseEditProfileMenu('languages') !!}
		</div>
		<div class="col-sm-10 profile-info">
			<h3>Languages</h3>
			<div class="row">
				{!! Form::model($user, ['url' => '@' . $user->username . '/languages/store', 'method' => 'put']) !!}
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
								<img src="{{ asset('flags/4x3/' . $language->id . '.svg') }}" alt="" height="20" width="30">
								{{ $language->spoken_language_name }}
							</td>
							<td>
								<div class="slider"></div>
								<input type="hidden" class="spoken-language-input" name="spoken_language[{{ $language->id }}]" value="">
							</td>
						</tr>
						@endforeach
					</tbody>
					<tbody class="language-list" style="display: none;">
						@foreach($spokenLanguages->splice(7) as $language)
						<tr>
							<td>
								<img src="{{ asset('flags/4x3/' . $language->id . '.svg') }}" alt="" height="20" width="30">
								{{ $language->spoken_language_name }}
							</td>
							<td>
								<div class="slider"></div>
								<input type="hidden" name="spoken_language[{{ $language->id }}]" value="0">
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<div class="show-more text-center">
					<a href="#" class="btn btn-default">Show More</a>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@stop

@section('perPageScripts')
<script>
	$(function () {
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

	$(function () {
	$('.show-more a').on('click', function(e){
		var that = $(this);
		e.preventDefault();
		that.text(that.text() == 'Show More' ? 'Show Less' : 'Show More');
		$('table.language-table').find('.language-list:last-child').toggle();
	});
});
</script>
@stop