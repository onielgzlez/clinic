// Class definition

var KTBootstrapDatepicker = function () {

    var arrows;
    if (KTUtil.isRTL()) {
        arrows = {
            leftArrow: '<i class="la la-angle-right"></i>',
            rightArrow: '<i class="la la-angle-left"></i>'
        }
    } else {
        arrows = {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }
    }

    // Private functions
    var datess = function () {
        // minimum setup      
        $('#kt_datepicker').datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            format: 'yyyy-mm-dd',
            orientation: "bottom left",
            language: locale,
            templates: arrows
        });

        $('#pay_date').datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            format: 'yyyy-mm-dd',
            orientation: "bottom left",
            language: locale,
            templates: arrows
        });

        // range picker
        $('#kt_datepicker_range').datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            language: locale,
            templates: arrows
        });

        const initValueDate = $('[name="init"]').val();
        $('#kt_datetimepicker_7_1').datetimepicker({
            locale: locale,
            minDate: initValueDate ? moment(initValueDate) : moment(),
            format: 'YYYY-MM-DD HH:mm:ss',
        });
        $('#kt_datetimepicker_7_2').datetimepicker({
            locale: locale,
            useCurrent: false,
            format: 'YYYY-MM-DD HH:mm:ss'
        });

        $('#kt_datetimepicker_7_1').on('change.datetimepicker', function (e) {
            $('#kt_datetimepicker_7_2').datetimepicker('minDate', e.date);
        });
        $('#kt_datetimepicker_7_2').on('change.datetimepicker', function (e) {
            $('#kt_datetimepicker_7_1').datetimepicker('maxDate', e.date);
        });
    }

    return {
        // public functions
        init: function () {
            datess();
        }
    };
}();

jQuery(document).ready(function () {
    KTBootstrapDatepicker.init();
});