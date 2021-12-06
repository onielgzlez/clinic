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
        /* locale: 'es_ES',
         localization: FormValidation.locales.en_ES,*/
        fields: {
          first_name: {
            validators: {
              notEmpty: {
                message: translate('validation.required',{attribute: 'primer nombre'})
              }
            }
          },
          last_name: {
            validators: {
              notEmpty: {
                message: translate('validation.required',{attribute: 'primer apellido'})
              }
            }
          },
          last_name2: {
            validators: {
              notEmpty: {
                message: translate('validation.required',{attribute: 'segundo apellido'})
              }
            }
          },
          email: {
            validators: {
              notEmpty: {
                message: translate('validation.required',{attribute: 'correo'})
              },
              emailAddress: {
                message: translate('validation.email',{attribute: 'correo'})
              }
            }
          },
          password: {
            validators: {
              notEmpty: {
                enabled: false,
                message: translate('validation.required', { attribute: 'contraseña' }),
              },
              stringLength: {
                min: 6,
                message: translate('validation.gte.string', { attribute: 'contraseña', value: 6 }),
              }
            }
          },
          'confirm-password': {
            validators: {
              notEmpty: {
                enabled: false,
                message: translate('validation.required', { attribute: 'contraseña' }),
              },
              identical: {
                enabled: false,
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
          // Validate fields when clicking the Submit button
          submitButton: new FormValidation.plugins.SubmitButton(),

          // Submit the form when all fields are valid
          defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
        }
      }
    ).on('core.form.validating', function () {
      saveButton.innerHTML = translate('locale.Validating');
    });

    saveButton.addEventListener('click', function () {
      fv.validate().then(function (status) {
        // Update the login button content based on the validation status
        saveButton.innerHTML = (status === 'Valid')
          ? translate('locale.Form is validated, savind in')
          : translate('locale.Please try again');
      });
    });

    let enabled = false;
    _formEl.querySelector('[name="password"]').addEventListener('input', function (e) {
      const password = e.target.value;
      if (password === '' && enabled) {
        enabled = false;
        fv.disableValidator('password').disableValidator('confirm-password');
      } else if (password != '' && !enabled) {
        enabled = true;
        fv.enableValidator('password').enableValidator('confirm-password');
      }

      // Revalidate the confirmation password when the new password is changed
      if (password != '' && enabled) {
        fv.revalidateField('confirm-password');
      }
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

function fillTimezones(tz = null) {
  axios.get('/api/timezones').then(function (response) {
    $('#tz').empty();
    var options = '<option value="">' + translate('locale.Select') + '...</option>';       
    response.data.forEach(element => {
      var selected = (tz == element) ? 'selected' : '';
      options += '<option value="' + element + '" ' + selected + '>' + element + '</option>';
    });
    $('#tz').append(options);       
  })
}

jQuery(document).ready(function () {
  KTUserEdit.init();
  fillTimezones($('#tzVal').val());
});
