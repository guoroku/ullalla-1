
$(document).ready(function() {
    // IMPORTANT: You must call .steps() before calling .formValidation()
    $('#profileForm')
    .steps({
        headerTag: 'h2',
        bodyTag: 'section',
            // Triggered when clicking the Previous/Next buttons
            onStepChanging: function(e, currentIndex, newIndex) {
                var fv = $('#profileForm').data('formValidation'), // FormValidation instance
                    // The current step container
                    $container = $('#profileForm').find('section[data-step="' + currentIndex +'"]');

                // Validate the container
                fv.validateContainer($container);

                var isValidStep = fv.isValidContainer($container);
                if (isValidStep === false || isValidStep === null) {
                    // Do not jump to the next step
                    return false;
                }

                return true;
            },
            // Triggered when clicking the Finish button
            onFinishing: function(e, currentIndex) {
                var fv         = $('#profileForm').data('formValidation'),
                $container = $('#profileForm').find('section[data-step="' + currentIndex +'"]');

                // Validate the last step container
                fv.validateContainer($container);

                var isValidStep = fv.isValidContainer($container);
                if (isValidStep === false || isValidStep === null) {
                    return false;
                }

                return true;
            },
            onFinished: function(e, currentIndex) {
                // Uncomment the following line to submit the form using the defaultSubmit() method
                $('#profileForm').find('.actions li').attr('aria-disabled', true);      
                $('#profileForm').formValidation('defaultSubmit');

                // For testing purpose
                // $('#welcomeModal').modal();
            }
        })
    .formValidation({
        framework: 'bootstrap',
        icon: {
            // valid: 'glyphicon glyphicon-ok',
            // invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
            // This option will not ignore invisible fields which belong to inactive panels
            excluded: [':disabled', ':hidden'],
            fields: {
                first_name: {
                    validators: {
                        notEmpty: {
                            message: 'First name is required'
                        },
                    }
                },
                last_name: {
                    validators: {
                        notEmpty: {
                            message: 'Last name is required'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z\s]+$/,
                            message: 'The first name can only consist of alphabetical and space'
                        }
                    }
                },
                nickname: {
                    validators: {
                        notEmpty: {
                            message: 'Nickname is required'
                        },
                    }
                },
                sex: {
                    validators: {
                        notEmpty: {
                            message: 'Sex is required'
                        }
                    }
                },
                age: {
                    validators: {
                        notEmpty: {
                            message: 'Birthday is required'
                        },
                        between: {
                            min: 18,
                            max: 60,
                            message: 'You must be at least 18 years old'
                        }
                    }
                },

                about_me: {
                    validators: {
                        stringLength: {
                            max: 200,
                            message: 'The bio must be less than 200 characters'
                        }
                    }
                },
                phone: {
                    validators: {
                        numeric: {
                            message: 'This field must be numeric'
                        }
                    }
                },
                mobile: {
                    validators: {
                        numeric: {
                            message: 'This field must be numeric'
                        }
                    }
                },
                skype_name: {
                    validators: {
                        notEmpty: {
                            message: 'This field is required'
                        }
                    }
                },
                website: {
                    validators: {
                        uri: {
                            message: 'The URL is not valid'
                        }
                    }
                },
                'ullalla_package[]': {
                    err: '#alertPackageMessage',
                    validators: {
                        notEmpty: {
                            message: 'Please choose at least one of the default packages'
                        }
                    }
                },
                photos: {
                    excluded: false,
                    validators: {
                        callback: {
                            message: 'You must select at least 4 files',
                            callback: function(value, validator, $field) {
                                var numOfFiles = $field.closest('.image-preview-multiple').find('._list ._item').length;
                                return (numOfFiles != null && numOfFiles >= 4);
                            }
                        }
                    }
                }
            }
        })
});