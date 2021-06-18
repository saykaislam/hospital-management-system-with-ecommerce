/*
Author       : Dreamguys
Template Name: Doccure - Bootstrap Template
Version      : 1.0
*/

(function($) {
    "use strict";

	// Pricing Options Show

	$('#pricing_select input[name="rating_option"]').on('click', function() {
		if ($(this).val() == 'price_free') {
			$('#custom_price_cont').hide();
		}
		if ($(this).val() == 'custom_price') {
			$('#custom_price_cont').show();
		}
		else {
		}
	});

	// Education Add More

    $(".education-info").on('click','.trash', function () {
		$(this).closest('.education-cont').remove();
		return false;
    });

    $(".add-education").on('click', function () {

		var educationcontent = '<div class="row form-row education-cont">' +
			'<div class="col-12 col-md-10 col-lg-11">' +
				'<div class="row form-row">' +
					'<div class="col-12 col-md-6 col-lg-4">' +
						'<div class="form-group">' +
							'<label>Degree</label>' +
							'<input type="hidden" name="doctor_education_id[]" class="form-control">' +
							'<input type="text" name="degree[]" class="form-control">' +
						'</div>' +
					'</div>' +
					'<div class="col-12 col-md-6 col-lg-4">' +
						'<div class="form-group">' +
							'<label>College/Institute</label>' +
							'<input type="text" name="institute[]" class="form-control">' +
						'</div>' +
					'</div>' +
					'<div class="col-12 col-md-6 col-lg-4">' +
						'<div class="form-group">' +
							'<label>Year of Completion</label>' +
							'<input type="text" name="year_of_completion[]" class="form-control">' +
						'</div>' +
					'</div>' +
				'</div>' +
			'</div>' +
			'<div class="col-12 col-md-2 col-lg-1"><label class="d-md-block d-sm-none d-none">&nbsp;</label><a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a></div>' +
		'</div>';

        $(".education-info").append(educationcontent);
        return false;
    });

    // Clinic Add More

    $(".clinic-info").on('click','.trash', function () {
        $(this).closest('.clinic-cont').remove();
        return false;
    });

    $(".add-clinic").on('click', function () {

        var cliniclist = $('.cliniclist-select-area').html();

        var cliniccontent = '<div class="row form-row clinic-cont">' +
            '<div class="col-12 col-md-10 col-lg-11">' +
            '<div class="row form-row">' +
            '<div class="col-12 col-md-6 col-lg-4">' +
            '<div class="form-group">' +
            '<label>Clinic</label>' +
            '<input type="hidden" name="clinic_doctor_id[]" class="form-control">' +
            '<select class="select form-control cliniclist-select-area" name="clinic_id[]">' +
            cliniclist +
            '</select>' +
            '</div>' +
            '</div>' +
            '<div class="col-12 col-md-6 col-lg-4">' +
            '<div class="form-group">' +
            '<label>Visit Cost</label>' +
            '<input type="text" name="visit_cost[]" class="form-control">' +
            '</div>' +
            '</div>' +
            '<div class="col-12 col-md-6 col-lg-4">' +
            '<div class="form-group">' +
            '<label>Main Clinic Status1</label>' +
            '<select class="select form-control main_clinic_status" name="main_clinic_status[]">' +
            '<option value="">Select</option>' +
            '<option value="1">Main</option>' +
            '<option value="0">Other</option>' +
            '</select>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<div class="col-12 col-md-2 col-lg-1"><label class="d-md-block d-sm-none d-none">&nbsp;</label><a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a></div>' +
            '</div>';

        $(".clinic-info").append(cliniccontent);
        return false;
    });

	// Experience Add More

    $(".experience-info").on('click','.trash', function () {
		$(this).closest('.experience-cont').remove();
		return false;
    });

    $(".add-experience").on('click', function () {

		var experiencecontent = '<div class="row form-row experience-cont">' +
			'<div class="col-12 col-md-10 col-lg-11">' +
				'<div class="row form-row">' +
					'<div class="col-12 col-md-6 col-lg-3">' +
						'<div class="form-group">' +
							'<label>Hospital Name</label>' +
							'<input type="hidden" name="doctor_experience_id[]" class="form-control">' +
							'<input type="text" name="hospital_name[]" class="form-control">' +
						'</div>' +
					'</div>' +
					'<div class="col-12 col-md-6 col-lg-3">' +
						'<div class="form-group">' +
							'<label>From</label>' +
							'<input type="text" name="from[]" class="form-control">' +
						'</div>' +
					'</div>' +
					'<div class="col-12 col-md-6 col-lg-3">' +
						'<div class="form-group">' +
							'<label>To</label>' +
							'<input type="text" name="to[]" class="form-control">' +
						'</div>' +
					'</div>' +
					'<div class="col-12 col-md-6 col-lg-3">' +
						'<div class="form-group">' +
							'<label>Designation</label>' +
							'<input type="text" name="designation[]" class="form-control">' +
						'</div>' +
					'</div>' +
				'</div>' +
			'</div>' +
			'<div class="col-12 col-md-2 col-lg-1"><label class="d-md-block d-sm-none d-none">&nbsp;</label><a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a></div>' +
		'</div>';

        $(".experience-info").append(experiencecontent);
        return false;
    });

	// Awards Add More

    $(".awards-info").on('click','.trash', function () {
		$(this).closest('.awards-cont').remove();
		return false;
    });

    $(".add-award").on('click', function () {

        var regcontent = '<div class="row form-row awards-cont">' +
			'<div class="col-12 col-md-5">' +
				'<div class="form-group">' +
					'<label>Awards</label>' +
					'<input type="hidden" name="doctor_award_id[]" class="form-control">' +
					'<input type="text" name="award[]" class="form-control">' +
				'</div>' +
			'</div>' +
			'<div class="col-12 col-md-5">' +
				'<div class="form-group">' +
					'<label>Year</label>' +
					'<input type="text" name="year[]" class="form-control">' +
				'</div>' +
			'</div>' +
			'<div class="col-12 col-md-2">' +
				'<label class="d-md-block d-sm-none d-none">&nbsp;</label>' +
				'<a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a>' +
			'</div>' +
		'</div>';

        $(".awards-info").append(regcontent);
        return false;
    });


    $(".specialist-info").on('click','.trash', function () {
        $(this).closest('.specialists-cont').remove();
        return false;
    });

    $(".add-specialist").on('click', function () {
        var specialist = $('.specialist-select-area').html();
        var regcontent = '<div class="row form-row specialists-cont">' +
            '<div class="col-12 col-md-5">' +
            '<div class="form-group">' +
            '<label>Specialist</label>' +
            '<input type="hidden" name="doctor_speciality_doctor_id[]" class="form-control">' +
            '<select class="select form-control specialist-select-area" name="doctor_speciality_id[]">' +
            specialist +
            '</select>' +
            '</div>' +
            '</div>' +
            '<div class="col-12 col-md-5">' +
            '<div class="form-group">' +
            '<label>Main Specialist Status</label>' +
            '<select class="select form-control" name="main_specialist_status[]">' +
            '<option value="">Select</option>' +
            '<option value="1">Main</option>' +
            '<option value="0">Other</option>' +
            '</select>' +
            '</div>' +
            '</div>' +
            '<div class="col-12 col-md-2">' +
            '<label class="d-md-block d-sm-none d-none">&nbsp;</label>' +
            '<a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a>' +
            '</div>' +
            '</div>';

        $(".specialist-info").append(regcontent);
        return false;
    });

	// Membership Add More

    $(".membership-info").on('click','.trash', function () {
		$(this).closest('.membership-cont').remove();
		return false;
    });

    $(".add-membership").on('click', function () {

        var membershipcontent = '<div class="row form-row membership-cont">' +
			'<div class="col-12 col-md-10 col-lg-5">' +
				'<div class="form-group">' +
					'<label>Memberships</label>' +
					'<input type="text" class="form-control">' +
				'</div>' +
			'</div>' +
			'<div class="col-12 col-md-2 col-lg-2">' +
				'<label class="d-md-block d-sm-none d-none">&nbsp;</label>' +
				'<a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a>' +
			'</div>' +
		'</div>';

        $(".membership-info").append(membershipcontent);
        return false;
    });

	// Registration Add More

    $(".registrations-info").on('click','.trash', function () {
		$(this).closest('.reg-cont').remove();
		return false;
    });

    $(".add-reg").on('click', function () {

        var regcontent = '<div class="row form-row reg-cont">' +
			'<div class="col-12 col-md-5">' +
				'<div class="form-group">' +
					'<label>Registrations</label>' +
					'<input type="text" class="form-control">' +
				'</div>' +
			'</div>' +
			'<div class="col-12 col-md-5">' +
				'<div class="form-group">' +
					'<label>Year</label>' +
					'<input type="text" class="form-control">' +
				'</div>' +
			'</div>' +
			'<div class="col-12 col-md-2">' +
				'<label class="d-md-block d-sm-none d-none">&nbsp;</label>' +
				'<a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a>' +
			'</div>' +
		'</div>';

        $(".registrations-info").append(regcontent);
        return false;
    });


    //Service Provider Education Add More
    $(".service-provider-education-info").on('click','.trash', function () {
        $(this).closest('.service-provider-education-cont').remove();
        return false;
    });

    $(".add-service-provider-education").on('click', function () {


        var educationcontent = '<div class="row form-row service-provider-education-cont">' +
            '<div class="col-12 col-md-10 col-lg-11">' +
            '<div class="row form-row">' +
            '<div class="col-12 col-md-6 col-lg-4">' +
            '<div class="form-group">' +
            '<label>Degree</label>' +
            '<input type="hidden" name="service_provider_education_id[]" class="form-control" >' +
            '<input type="text" name="degree[]" class="form-control">' +
            '</div>' +
            '</div>' +
            '<div class="col-12 col-md-6 col-lg-4">' +
            '<div class="form-group">' +
            '<label>College/Institute</label>' +
            '<input type="text" name="institute[]"  class="form-control">' +
            '</div>' +
            '</div>' +
            '<div class="col-12 col-md-6 col-lg-4">' +
            '<div class="form-group">' +
            '<label>Year of Completion</label>' +
            '<input type="text" name="year_of_completion[]" class="form-control">' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<div class="col-12 col-md-2 col-lg-1"><label class="d-md-block d-sm-none d-none">&nbsp;</label><a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a></div>' +
            '</div>';

        $(".service-provider-education-info").append(educationcontent);
        return false;
    });
//Service Provider Experience Add More

    $(".service-provider-experience-info").on('click','.trash', function () {
        $(this).closest('.service-provider-experience-cont').remove();
        return false;
    });

    $(".add-service-provider-experience").on('click', function () {

        var experiencecontent = '<div class="row form-row service-provider-experience-cont">' +
            '<div class="col-12 col-md-10 col-lg-11">' +
            '<div class="row form-row">' +
            '<div class="col-12 col-md-6 col-lg-3">' +
            '<div class="form-group">' +
            '<label>Company Name</label>' +
            '<input type="hidden" name="service_provider_experience_id[]" class="form-control">' +
            '<input type="text" name="company_name[]" class="form-control">' +
            '</div>' +
            '</div>' +
            '<div class="col-12 col-md-6 col-lg-3">' +
            '<div class="form-group">' +
            '<label>From</label>' +
            '<input type="text" name="from[]" class="form-control">' +
            '</div>' +
            '</div>' +
            '<div class="col-12 col-md-6 col-lg-3">' +
            '<div class="form-group">' +
            '<label>To</label>' +
            '<input type="text" name="to[]" class="form-control">' +
            '</div>' +
            '</div>' +
            '<div class="col-12 col-md-6 col-lg-3">' +
            '<div class="form-group">' +
            '<label>Designation</label>' +
            '<input type="text" name="designation[]" class="form-control">' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<div class="col-12 col-md-2 col-lg-1"><label class="d-md-block d-sm-none d-none">&nbsp;</label><a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a></div>' +
            '</div>';

        $(".service-provider-experience-info").append(experiencecontent);
        return false;
    });
})(jQuery);
