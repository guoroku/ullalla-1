@extends('layouts.app')

@section('title', 'Contact')

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
            {!! parseEditProfileMenu('contact') !!}
        </div>
        <div class="col-sm-10 profile-info">
            {!! Form::model($user, ['url' => '@' . $user->username . '/contact/store', 'method' => 'put']) !!}
            <h3>Contact</h3>
            <div class="row">
                <div class="col-sm-4">
                    <div class="col-3 input-effect">
                        <input class="effect-16" type="text" placeholder="" name="email" value="{{ $user->email }}">
                        <label>Email</label>
                        <span class="focus-border"></span>
                    </div>
                </div>
                <div class="col-sm-4"> 
                    <div class="col-3 input-effect">
                        <input class="effect-16" type="text" placeholder="" name="phone">
                        <label>Phone number</label>
                        <span class="focus-border"></span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="col-3 input-effect">
                        <input class="effect-16" type="text" placeholder="" name="mobile" value="{{ $user->mobile }}">
                        <label>Mobile number</label>
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