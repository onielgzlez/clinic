"use strict";

// Class Definition
var KTAddEdit = function () {
  // Private Variables
  var _formEl;

  const saveButton = document.getElementById('saveButton');

  var _initValidations = function () {
    // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/

    // Validation Rules For Step 1
    var fv = FormValidation.formValidation(
      _formEl,
      {
        fields: {
          organization_id: {
            validators: {
              notEmpty: {
                message: translate('validation.required', { attribute: translate('locale.fields.organization') })
              }
            }
          },
          area_job_id: {
            validators: {
              notEmpty: {
                message: translate('validation.required', { attribute: translate('locale.fields.area_job') })
              }
            }
          },
          observation: {
            validators: {
              notEmpty: {
                message: translate('validation.required', { attribute: translate('locale.fields.observation') })
              }
            }
          },

          init: {
            validators: {
              notEmpty: {
                message: translate('validation.required', { attribute: translate('locale.fields.start_date') })
              },
              date: {
                message: translate('validation.date', { attribute: translate('locale.fields.start_date') }),
                format: 'YYYY-MM-DD HH:mm:ss'
              },
              callback: {
                message: translate('validation.before', { attribute: translate('locale.fields.start_date'), date: _formEl.querySelector('[name="end"]').value }),
                callback: function (input) {
                  const value = input.value;
                  const m = new moment(value, 'YYYY-MM-DD HH:mm:ss', true);
                  return m.isValid() && m.isBefore(_formEl.querySelector('[name="end"]').value);
                },
              }
            }
          },
          end: {
            validators: {
              notEmpty: {
                message: translate('validation.required', { attribute: translate('locale.fields.end_date') })
              },
              date: {
                message: translate('validation.date', { attribute: translate('locale.fields.end_date') }),
                format: 'YYYY-MM-DD HH:mm:ss'
              },
              callback: {
                message: translate('validation.after', { attribute: translate('locale.fields.end_date'), date: _formEl.querySelector('[name="init"]').value }),
                callback: function (input) {
                  const value = input.value;
                  const m = new moment(value, 'YYYY-MM-DD HH:mm:ss', true);
                  return m.isValid() && m.isAfter(_formEl.querySelector('[name="init"]').value);
                },
              }
            }
          },

        },
        plugins: {
          // Bootstrap Framework Integration
          bootstrap: new FormValidation.plugins.Bootstrap({
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

  }

  return {
    // public functions
    init: function () {
      _formEl = KTUtil.getById('kt_form');
      _initValidations();
      autosize($('#kt_autosize_1'));
    }
  };
}();

jQuery(document).ready(function () {
  KTAddEdit.init();
});