"use strict";

// Class definition
var KTUserEdit = function () {
  // Base elements
  var avatar;
  var _formEl;
  const saveButton = document.getElementById('saveButton');

  var initUserForm = function () {
    avatar = new KTImageInput('kt_user_edit_avatar');
  }

  var _initValidations = function () {
    // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/

    // Validation Rules For Step 1
    var fv = FormValidation.formValidation(
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
                url: '/api/patients/s/'+ KTUtil.getById('ktId').value,
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
          // Bootstrap Framework Integration
          bootstrap: new FormValidation.plugins.Bootstrap({
            //eleInvalidClass: '',
            eleValidClass: '',
          }),
          // Validate fields when clicking the Submit button
          submitButton: new FormValidation.plugins.SubmitButton(),

          // Submit the form when all fields are valid
          defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
          trigger: new FormValidation.plugins.Trigger({
            delay: {
              document: 1,
            },
          }),
        }
      }
    ).on('core.form.validating', function () {
      saveButton.innerHTML = translate('locale.Validating ...');
    });

    saveButton.addEventListener('click', function () {
      fv.validate().then(function (status) {
        // Update the login button content based on the validation status
        saveButton.innerHTML = (status === 'Valid')
          ? translate('locale.Form is validated. Savind in ...')
          : translate('locale.Please try again');
      });
    });
  
  }

  return {
    // public functions
    init: function () {
      _formEl = KTUtil.getById('kt_form');
      _initValidations();
      initUserForm();
    }
  };
}();

jQuery(document).ready(function () {
  KTUserEdit.init();
});
