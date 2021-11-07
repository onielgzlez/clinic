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
                message: translate('validation.required', { attribute: translate('locale.fields.first_name') })
              }
            }
          },
          last_name: {
            validators: {
              notEmpty: {
                message: translate('validation.required', { attribute: translate('locale.fields.last_name') })
              }
            }
          },
          last_name2: {
            validators: {
              notEmpty: {
                message: translate('validation.required', { attribute: translate('locale.fields.last_name2') })
              }
            }
          },
          document: {
            validators: {
              notEmpty: {
                message: translate('validation.required', { attribute: translate('locale.fields.document') })
              },
              remote: {
                message: translate('validationd.unique', { attribute: translate('locale.fields.document') }),
                method: 'GET',
                url: '/api/patients/s',
              }
            }
          },
          birthdate: {
            validators: {
              notEmpty: {
                message: translate('validation.date', { attribute: translate('locale.fields.birthdate') })
              },
            }
          },
          email: {
            validators: {
              notEmpty: {
                message: translate('validation.required', { attribute: translate('locale.fields.email') })
              },
              emailAddress: {
                message: translate('validation.email', { attribute: translate('locale.fields.email') })
              }
            }
          },
          organizations: {
            validators: {
              notEmpty: {
                message: translate('validation.required', { attribute: translate('locale.fields.organization') })
              },
            }
          },
        },
        plugins: {
          // Bootstrap Framework Integration
          bootstrap: new FormValidation.plugins.Bootstrap({
            //eleInvalidClass: '',
            eleValidClass: '',
          }),
          trigger: new FormValidation.plugins.Trigger({
            delay: {
              document: 1,
            },
          }),
        }
      }
    ));

    _validations.push(FormValidation.formValidation(
      _formEl,
      {
        fields: {
          // Step 2          
          address: {
            validators: {
              notEmpty: {
                message: translate('validation.required', { attribute: translate('locale.fields.address') }),
              },
            },
          },
          city_id: {
            validators: {
              notEmpty: {
                message: translate('validation.required', { attribute: translate('locale.fields.city') }),
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

jQuery(document).ready(function () {
  KTAddUser.init();
});