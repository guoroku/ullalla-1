@extends('layouts.app')

@section('title', 'Gallery')

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
    {!! parseEditProfileMenu('gallery') !!}
</div>
<div class="col-sm-10 profile-info">
    {!! Form::model($user, ['url' => '@' . $user->username . '/gallery/store', 'method' => 'PUT']) !!}
    <h3 style="margin-bottom: 40px;">Gallery</h3>
    <div class="row">
        <h1>Photos</h1>
        <div class="form-group">
            <div class="image-preview-multiple">
                <input type="hidden" role="uploadcare-uploader" name="photos" data-crop="490x560 minimum" data-images-only="" data-multiple="">
                <div class="_list">
                    @for ($i = 0; $i < substr($user->photos, -2, 1); $i++)
                    <div class="_item">
                        <img src="{{ $user->photos . 'nth/' . $i . '/-/resize/250x200/' }}">
                    </div>
                    @endfor
                </div>
            </div>
        </div>
        <h1>Videos</h1>
        <div class="form-group upload-video">
            <input type="hidden" role="uploadcare-uploader-video" name="video" id="uploadcare-file" data-crop="true" data-file-types="avi mp4 ogv mov wmv mkv"/>
            <video id="video" width="320" height="240" loop style="display: block;"></video>
        </div>
    </div>
    <button type="submit" class="btn btn-default">Save Changes</button>
    {!! Form::close() !!}
</div>
</div>
@stop

@section('perPageScripts')
<script>

////////// 2. UPLOAD CARE ////////
const widget = uploadcare.Widget('[role=uploadcare-uploader]')
widget.value('{{ $user->photos }}')

// preview uploaded images function
function installWidgetPreviewMultiple(widget, list) {
    widget.onChange(function(fileGroup) {
        list.empty();
        if (fileGroup) {
            $.when.apply(null, fileGroup.files()).done(function() {
                $.each(arguments, function(i, fileInfo) {
                    var src = fileInfo.cdnUrl;
                    console.log(src);

                    list.append(
                        $('<div/>', {'class': '_item'}).append(
                            [$('<img/>', {src: src, style: "width: 250px; height: 200px;"})])
                        );
                });
            });
        }
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
    widget.value('{{ $user->videos }}')
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
});

</script>
@stop