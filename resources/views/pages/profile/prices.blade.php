@extends('layouts.app')

@section('title', 'Prices')

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
            {!! parseEditProfileMenu('prices') !!}
        </div>
        <div class="col-sm-10 profile-info">
            <div class="col-sm-12">
                <h2>Prices</h2>
            </div>
            {!! Form::model($user, ['url' => '@' . $user->username . '/prices/store', 'method' => 'put']) !!}
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
                <div class="col-xs-6">
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
                    <div class="form-group">
                        <input type="hidden" name="add_price_token" value="{{ csrf_token() }}">
                        <button type="submit" class="add-new-price btn btn-default">Add New Price</button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
            <div class="col-xs-12 price-table-container" style="margin-top: 30px;">
                <table class="{{ $user->prices->count() == 0 ? 'is-hidden' : '' }}">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Duration</th>
                            <th>Price</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody id="prices_body">
                        @foreach ($user->prices as $price)
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
        </div>
    </div>
</div>
@stop
