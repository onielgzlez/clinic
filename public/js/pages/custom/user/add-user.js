"use strict";

// Class Definition
var KTAddUser = function () {
  // Private Variables
  var _wizardEl;
  var _formEl;
  var _wizardObj;
  var _avatar;
  var _validations = [];

  // Private Functions
  var _initWizard = function () {
    // Initialize form wizard
    _wizardObj = new KTWizard(_wizardEl, {
      startStep: 1, // initial active step number
      clickableSteps: false  // allow step clicking
    });   

    // Validation before going to next page
    _wizardObj.on('change', function (wizard) {
      if (wizard.getStep() > wizard.getNewStep()) {
        return; // Skip if stepped back
      }

      // Validate form before change wizard step
      var validator = _validations[wizard.getStep() - 1]; // get validator for currnt step

      if (validator) {
        validator.validate().then(function (status) {
          if (status == 'Valid') {
            wizard.goTo(wizard.getNewStep());

            KTUtil.scrollTop();
          } else {
            Swal.fire({
              text: translate("locale.Sorry, looks like there are some errors detected, please try again"),
              icon: "error",
              buttonsStyling: false,
              confirmButtonText: translate("locale.Ok, got it!"),
              customClass: {
                confirmButton: "btn font-weight-bold btn-light"
              }
            }).then(function () {
              KTUtil.scrollTop();
            });
          }
        });
      } else {
        wizard.goTo(wizard.getNewStep())
      }

      return false;  // Do not change wizard step, further action will be handled by he validator
    });

    // Change event
    _wizardObj.on('changed', function (wizard) {
      KTUtil.scrollTop();
    });

    // Submit event
    _wizardObj.on('submit', function (wizard) {
      Swal.fire({
        text: translate("locale.All is good! Please confirm the form submission"),
        icon: "success",
        showCancelButton: true,
        buttonsStyling: false,
        confirmButtonText: translate("locale.Yes, submit!"),
        cancelButtonText: translate("locale.No, cancel"),
        customClass: {
          confirmButton: "btn font-weight-bold btn-primary",
          cancelButton: "btn font-weight-bold btn-default"
        }
      }).then(function (result) {
        if (result.value) {
          _formEl.submit(); // Submit form
        } else if (result.dismiss === 'cancel') {
          Swal.fire({
            text: translate("locale.Your form has not been submitted!"),
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: translate("locale.Ok, got it!"),
            customClass: {
              confirmButton: "btn font-weight-bold btn-primary",
            }
          });
        }
      });
    });
  }

  var _initValidations = function () {
    // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/

    // Validation Rules For Step 1
    _validations.push(FormValidation.formValidation(
      _formEl,
      {
        fields: {
          first_name: {
            validators: {
              notEmpty: {
                message: translate('validation.required', { attribute: 'primer nombre' })
              }
            }
          },
          last_name: {
            validators: {
              notEmpty: {
                message: translate('validation.required', { attribute: 'primer apellido' })
              }
            }
          },
          last_name2: {
            validators: {
              notEmpty: {
                message: translate('validation.required', { attribute: 'segundo apellido' })
              }
            }
          },
          document: {
            validators: {
              notEmpty: {
                message: translate('validation.required', { attribute: 'cedula' })
              }
            }
          },
        },
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          // Bootstrap Framework Integration
          bootstrap: new FormValidation.plugins.Bootstrap({
            //eleInvalidClass: '',
            eleValidClass: '',
          })
        }
      }
    ));

    _validations.push(FormValidation.formValidation(
      _formEl,
      {
        fields: {
          // Step 2
          email: {
            validators: {
              notEmpty: {
                message: translate('validation.required', { attribute: 'correo' })
              },
              emailAddress: {
                message: translate('validation.email', { attribute: 'correo' })
              }
            }
          },
          password: {
            validators: {
              notEmpty: {
                message: translate('validation.required', { attribute: 'contraseña' }),
              },
              stringLength: {
                min: 6,
                message: translate('validation.gte.string', { attribute: 'contraseña', value: 6 }),
              },
            },
          },
          'confirm-password': {
            validators: {
              identical: {
                compare: function () {
                  return _formEl.querySelector('[name="password"]').value;
                },
                message: translate('validation.confirmed', { attribute: 'contraseña' }),
              }
            }
          },
        },
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          // Bootstrap Framework Integration
          bootstrap: new FormValidation.plugins.Bootstrap({
            //eleInvalidClass: '',
            eleValidClass: '',
          }),
          /*passwordStrength: new FormValidation.plugins.PasswordStrength({
            field: 'password',
            message: 'The password is weak',
            minimalScore: 3,
          }),*/
        }
      }
    ));
  }

  var _initAvatar = function () {
    _avatar = new KTImageInput('kt_user_add_avatar');
  }

  return {
    // public functions
    init: function () {
      _wizardEl = KTUtil.getById('kt_wizard');
      _formEl = KTUtil.getById('kt_form');

      _initWizard();
      _initValidations();
      _initAvatar();
    }
  };
}();

$('#userType').on('change', function () {
  if (this.value == 'worker') {
    $('.workerData').css('visibility', 'visible');
  } else {
    $('.workerData').css('visibility', 'hidden');
  }
})

function fillTimezones() {
  axios.get('/api/timezones').then(function (response) {
    $('#tz').empty();
    var options = '<option value="">' + translate('locale.Select') + '...</option>';       
    response.data.forEach(element => {
      options += '<option value="' + element + '" >' + element + '</option>';
    });
    $('#tz').append(options);       
  })
}

jQuery(document).ready(function () {
  KTAddUser.init();
  $('#userType').trigger('change');  
  fillTimezones();
});