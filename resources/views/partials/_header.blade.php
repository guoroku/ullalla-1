<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Ullalla | @yield('title')</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Lato:400,700,300' rel='stylesheet' type='text/css'>
<link rel="shortcut icon" type="images/png" href="img/icon1.png">
<link rel="stylesheet" href="{{ asset('css/formValidation.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery.steps.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery.datetimepicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<link rel="stylesheet" href="/style.css">
<link rel="stylesheet" href="{{ url('css/jquery-ui.css') }}">
@yield('styles')
<link href="/css/flag-icon.min.css" rel="stylesheet">
<script src="/js/vendor/modernizr-2.8.3.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>
<script>
	UPLOADCARE_LIVE = false;
	UPLOADCARE_CLEARABLE = true;
	UPLOADCARE_LOCALE_TRANSLATIONS = {
        buttons: {
            choose: {
                files: {
                    one: 'Upload Video'
                },
                images: {
                    one: 'Upload Photos',
                    other: 'Upload Photos'
                }
            }
        },
    	// messages for widget
    	errors: {
    		'fileMaximumSize': 'File is too large',
            'fileType': 'This type of files is not allowed.',
    		'minDimensions': 'Minimum dimension of a photo should be 490x560'
    	},
    	// messages for dialog’s error page
    	dialog: {
    		tabs: { 
    			preview: { 
    				error: {
    					'fileMaximumSize': {
    						title: 'Maximum Size Error.',
    						text: 'File too large.',
    						back: 'Back'
    					},
    					'fileType': {
    						title: 'File Type Error.',
    						text: 'Incorrect file type.',
    						back: 'Back'
    					}
    				}
    			}
    		}
    	},
    };
</script>
<script>UPLOADCARE_PUBLIC_KEY = "c3f04780a8cb0f9153fe";</script>
<script src="https://ucarecdn.com/libs/widget/3.2.0/uploadcare.full.min.js" charset="utf-8"></script>