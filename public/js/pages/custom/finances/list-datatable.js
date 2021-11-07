"use strict";
// Class definition

var KTAppsUsersListDatatable = function () {
	// Private functions

	var _users = function () {

		var datatable = $('#kt_datatable').KTDatatable({
			// datasource definition
			data: {
				type: 'remote',
				source: {
					read: {
						url: '/finances',
						method: 'GET',
						contentType: 'application/json',
					}
				},
				pageSize: 10, // display 20 records per page
				serverPaging: true,
				serverFiltering: true,
				serverSorting: true,
			},

			// layout definition
			layout: {
				scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
				footer: false, // display/hide footer
			},

			// column sorting
			sortable: true,

			pagination: true,

			search: {
				input: $('#kt_subheader_search_form'),
				delay: 400,
				key: 'generalSearch'
			},

			// columns definition
			columns: [
				{
					field: 'id',
					title: '#',
					sortable: 'asc',
					width: 40,
					type: 'number',
					selector: false,
					textAlign: 'left',
					template: function (data) {						
						return '<span class="font-weight-bolder">' + data.id + '</span>';
					}
				}, {
					field: 'type',
					title: translate('locale.fields.type'),				
					template: function (data) {						
						return '<div class="text-dark-75 font-weight-bolder font-size-lg mb-0">' + (data.type == 'income' ? translate('locale.fields.income') : translate('locale.fields.outcome')) + '</div>';					
					}
				}, {
					field: 'amount',
					title: translate('locale.fields.amount'),
					template: function (row) {
						return '<div class="font-weight-bolder font-size-lg mb-0">' + row.amount + '</div>';
					}
				}, {
					field: 'pay_date',
					title: translate('locale.fields.pay_date'),
					template: function (row) {
						return '<div class="font-weight-bolder text-primary mb-0">' + row.pay_date + '</div>';
					},
				}, {
					field: 'organization',
					title: translate('locale.fields.organization'),
					sortable: false,
					template: function (row) {
						return '<div class="font-weight-bold text-muted">' + row.organization + '</div>';
					}
				}, {
					field: 'actions',
					title: translate('locale.actions'),
					sortable: false,
					width: 130,
					overflow: 'visible',
					autoHide: false,
					template: function (row) {
						var link = '<form method="POST" action="' + row.actions.delete + '" style="display: inline;">\
						<input type="hidden" name="_token" value="'+ row.actions.crsf + '">\
						<a href="javascript:;" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon" title="Delete" onclick="event.preventDefault();_modal(this);">\
                                <span class="svg-icon svg-icon-md">\
                                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                      <rect x="0" y="0" width="24" height="24"/>\
                                      <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
                                      <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
                                    </g>\
                                  </svg>\
                                </span>\
                                          </a>\
										  <form>\
            ';

						return '\ <a href="' + row.actions.edit + '" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Edit details">\
	                            <span class="svg-icon svg-icon-md">\
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
											<rect x="0" y="0" width="24" height="24"/>\
											<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>\
											<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>\
										</g>\
									</svg>\
	                            </span>\
	                        </a>'+ (!row.self ? link : '')

					},
				}],
		});

		$('#kt_datatable_search_status').on('change', function () {
			datatable.search($(this).val().toLowerCase(), 'status');
		});

		$('#kt_datatable_search_type').on('change', function () {
			datatable.search($(this).val().toLowerCase(), 'type');
		});

		$('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
	};

	return {
		// public functions
		init: function () {
			_users();
		},
	};
}();

var _modal = function (a) {
	Swal.fire({
		title: translate("locale.Are you sure?"),
		text: translate("You will not be able to reverse this action!"),
		icon: "warning",
		showCancelButton: true,
		confirmButtonText: translate("locale.Yes, delete!"),
        cancelButtonText: translate("locale.No, cancel"),
		reverseButtons: true
	}).then(function (result) {
		if (result.value) {
			$(a).closest('form').submit();
		}
	});
};

jQuery(document).ready(function () {
	KTAppsUsersListDatatable.init();
});
