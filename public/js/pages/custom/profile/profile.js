"use strict";

// Class definition
var KTProfile = function () {
	// Elements
	var avatar;
	var offcanvas;

	// Private functions
	var _initAside = function () {
		// Mobile offcanvas for mobile mode
		offcanvas = new KTOffcanvas('kt_profile_aside', {
            overlay: true,
            baseClass: 'offcanvas-mobile',
            //closeBy: 'kt_user_profile_aside_close',
            toggleBy: 'kt_subheader_mobile_toggle'
        });
	}

	var _activeLink = function () {		
		$($('.links a.navi-link')).each(function(i,e){
			if ($(e).attr('href') == window.location.href) {
				if(!$(e).hasClass('active')) $(e).addClass('active');
			} else if($(e).hasClass('active')) $(e).removeClass('active');
		})
	}

	var _initForm = function() {
		avatar = new KTImageInput('kt_profile_avatar');
	}

	return {
		// public functions
		init: function() {
			_initAside();
			_activeLink();
			_initForm();
		}
	};
}();

jQuery(document).ready(function() {
	KTProfile.init();
});
