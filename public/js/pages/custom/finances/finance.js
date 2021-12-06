"use strict";

// Class definition
var KTUserEdit = function () {
  // Base elements
  var _formEl;
  const saveButton = document.getElementById('saveButton');

  var _initValidations = function () {
    // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/

    // Validation Rules For Step 1
    var fv = FormValidation.formValidation(
      _formEl,
      {
        fields: {
          type: {
            validators: {
              notEmpty: {
                message: translate('validation.required', { attribute: translate('locale.fields.type') })
              }
            }
          },
          amount: {
            validators: {
              notEmpty: {
                message: translate('validation.required', { attribute: translate('locale.fields.amount') })
              }
            }
          },
          organization_id: {
            validators: {
              notEmpty: {
                message: translate('validation.required', { attribute: translate('locale.fields.organization') })
              }
            }
          },

          pay_date: {
            validators: {
              notEmpty: {
                message: translate('validation.date', { attribute: translate('locale.fields.pay_date') })
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
    }
  };
}();

function ok(el) {
  if (el.value == 'income') {
    $('.income').removeClass('d-none');
    if ($('#organization_id').val()) populateData($('#organization_id').val(), $('#patient_id').val())
  } else {
    $('.income').addClass('d-none');
  }
}

$('#organization_id').change(function () {
  if ($('#financeType').val() == 'income' && this.value) {
    populateData(this.value, $('#patient_id').val())
  }
});

function populateData(id, val = null) {
  axios.get('/api/organizations/' + id + '/patients').then(function (response) {
    var patients = response.data.patients;
    $('#patient_id').empty();
    var options = '<option value="">' + translate('locale.Select') + '...</option>';
    patients.forEach(function (e, i) {
      var selected = (val == e.id) ? 'selected' : '';
      options += '<option value="' + e.id + '" ' + selected + '>' + e.name + '</option>';
    });
    $('#patient_id').append(options);
  })
}

jQuery(document).ready(function () {
  KTUserEdit.init();
  $('#financeType').trigger('change');
  $('#organization_id').trigger('change');
});
