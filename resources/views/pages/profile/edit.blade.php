@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="wrapper section-edit-profile">
edit profile
</div>
@stop

@section('perPageScripts')
<!-- Form Validation -->
<script src="js/formValidation.min.js"></script>
<script src="js/framework/bootstrap.min.js"></script>
<script src="js/jquery.steps.min.js"></script>
<script src="js/profileValidation.js"></script>
<script type="text/javascript">
	$(window).on('load',function(){
		$('#myModal').modal('show');

	});
	$(function () {
		$('#myModal').modal({
			backdrop: 'static',
			keyboard: false
		});
	})
</script>
@stop



