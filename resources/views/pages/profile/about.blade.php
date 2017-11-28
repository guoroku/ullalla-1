@extends('layouts.app')

@section('title', 'About Me')

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
            {!! parseEditProfileMenu('about_me') !!}
        </div>
        <div class="col-sm-10 profile-info" >
            <h3>About Me</h3>
            <div class="row">
                {!! Form::model($user, ['url' => '@' . $user->username . '/about_me/store', 'method' => 'put']) !!}
                <div class="form-group">
                    <label for="comment">Text Area</label>
                    <textarea class="form-control" rows="5" id="comment" name="about_me">{{ $user->about_me }}</textarea>
                </div>
                <button type="submit" class="btn btn-default">Save Changes</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@stop




