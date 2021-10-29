<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('index', function () {
    return view('/index');
});

Route::group(['namespace'=>'Frontend'], function (){
    // Route::resource('resume','ResumeController');
    Route::group(['namespace'=>'Auth'], function (){
	    Route::get('/register','RegisterController@index')->name('register.index');
	    Route::post('/register/submit','RegisterController@register')->name('register.submit');

		Route::post('login-after-purchase-plan','RegisterController@loginUserAfterSubscribe')->name('login-after-purchase-plan');
		Route::post('verify-email', 'RegisterController@verifyEmail')->name('verify-email');
		Route::post('verify-otp', 'RegisterController@verifyOTP')->name('verify-otp');
		Route::post('resend-otp', 'RegisterController@resendOTP')->name('resend-otp');
		Route::get('get-otp-form','RegisterController@getOTPForm');
		Route::post('register-user', 'RegisterController@registerUser')->name('register-user');

		Route::post('apply-coupon', 'RegisterController@applyCoupon')->name('apply-coupon');
		Route::post('remove-coupon', 'RegisterController@removeCoupon')->name('remove-coupon');
	    // Route::get('/register/{slug}','RegisterController@index')->name('register');
		// Route::get('/register/{id}/select-plan','RegisterController@planSelect')->name('register.select-plan');

	    Route::get('login', 'LoginController@showLoginForm')->name('login');
	    Route::post('login', 'LoginController@login')->name('login');
	    Route::post('logout', 'LoginController@logout')->name('logout');

	    // Password Reset Routes
        Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');

        Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');

	    Route::get('auth/google', 'GoogleLoginController@redirectToGoogle');
	    Route::get('auth/google/callback', 'GoogleLoginController@handleGoogleCallback');

	    Route::get('auth/facebook', 'FacebookLoginController@redirectToFacebook');
        Route::get('auth/facebook/callback', 'FacebookLoginController@handleFacebookCallback');

	});
	Route::group(['middleware' => 'Dashboard'], function(){
		// Dashboard Controller
		Route::get('profile-picture','DashboardCandidateController@getProfilePicture')->name('profile-picture');
		Route::get('dashboard-candidates','DashboardCandidateController@index')->name('dashboard-candidates');
		Route::get('dashboard-candidates-resume-builder','DashboardCandidateController@indexResumeBuilder')->name('dashboard-candidates-resume-builder');
		Route::get('dashboard-candidates-cover-letter','DashboardCandidateController@indexCoverLetter')->name('dashboard-candidates-cover-letter');
		Route::get('dashboard-candidates-email-templates','DashboardCandidateController@indexEmailTemplates')->name('dashboard-candidates-email-templates');
		Route::get('dashboard-candidates-my-profile','DashboardCandidateController@indexMyProfile')->name('dashboard-candidates-my-profile');
		Route::post('dashboard-profile-update','DashboardCandidateController@dashboardUpdateProfile')->name('dashboard-profile-update');
		Route::get('dashboard-candidates-pricing','DashboardCandidateController@indexPricing')->name('dashboard-candidates-pricing');
		Route::get('dashboard-candidates-change-password','DashboardCandidateController@indexChangePassword')->name('dashboard-candidates-change-password');
		Route::post('dashboard-change-password','DashboardCandidateController@changeUserPassword')->name('dashboard-change-password');
		Route::post('delete-resume-builder/{r_id}','DashboardCandidateController@deleteResumeBuilder')->name('delete-resume-builder');
		Route::get('download-resume-builder-pdf/{r_id}','DashboardCandidateController@downloadDashboardResumeBuilderPDF')->name('download-resume-builder-pdf');
		Route::post('change-resume-title','DashboardCandidateController@changeResumeTitle')->name('change-resume-title');
		Route::get('dashboard-user-sesions','DashboardCandidateController@dashboardUserSessions')->name('dashboard-user-sesions');
		Route::get('dashboard-user-sesion-coaches/{s_id}','DashboardCandidateController@dashboardUserSessionsCoachesAvailability')->name('dashboard-user-sesion-coaches');
	});
	Route::get('/','HomeController@home')->name('home');
	Route::get('/contact-us','HomeController@contactUs')->name('contact-us');
	Route::post('/contact-us/submit','HomeController@contactUsSubmit')->name('contact-us.submit');
	Route::get('/about-us','HomeController@about')->name('about-us');
	Route::get('/faqs','HomeController@faqs')->name('faqs');
	Route::get('/team','HomeController@teams')->name('team');
	Route::get('/blog','BlogController@index')->name('blog');
	Route::get('/blog-detail/{id}','BlogController@blogDetails')->name('blog-detail');
	Route::post('/blog','BlogController@searchBlogs')->name('blog');
	Route::get('/courses','CourseController@getCourses')->name('courses');
	// Route::get('/pricing','HomeController@pricing')->name('pricing');
	Route::get('/cms/{slug}','HomeController@cms')->name('cms');
	Route::get('/resume-builder','HomeController@resumeBuilder')->name('resume-builder');
	Route::get('/cover-letters','HomeController@coverLetters')->name('cover-letters');
	Route::get('/email-templates','HomeController@emailTemplates')->name('email-templates');
	Route::get('/terms-conditions','HomeController@termsConditions')->name('terms-conditions');
	Route::get('/privacy-policy','HomeController@privacyPolicy')->name('privacy-policy');

	Route::get('/pricing','PricingController@index')->name('pricing');
	Route::get('/pricing/two-days-pass','PricingController@pricingTwoDayPass')->name('two-days-pass');
	Route::post('/subscribe','PricingController@subscribePlan')->name('pricing.subscribe');

	Route::post('payment-cancel','RazorpayPaymentController@paymentCancel')->name('payment-cancel');
   	Route::post('razorpay-payment-success','RazorpayPaymentController@razorpayPaymentSuccess')->name('razorpay-payment-success');

	// Resume All Routes 
	Route::get('/choose-resume-template','ResumeController@chooseResumeTemplate')->name('choose-resume-template');
	Route::get('/choose-template/{id}','ResumeController@resumeBuildingView')->name('choose-template');


	// Select/Change resume template Routes
	Route::get('/update-resume-template/{id}','ResumeController@updateResumeTemplate')->name('update-resume-template');
	Route::get('/update-choose-template/{id}/{t_id}','ResumeController@changeResumeTemplate')->name('update-choose-template');


	Route::get('/resumes/{id}','ResumeController@resumeBuilderPage')->name('resumes');
	Route::get('check-user-resume-data','ResumeController@getUserResumeSaveData')->name('check-user-resume-data');
	Route::post('/save-user-resume','ResumeController@saveUserResume')->name('save-user-resume');

	// Store resume details and section data routes
	Route::post('/store-user-resume-data','ResumeController@storeUserResumeDetails')->name('store-user-resume-data');
	Route::post('/store-user-career-data','ResumeController@saveCareers')->name('store-user-career-data');
	Route::post('/store-user-education-data','ResumeController@saveEducation')->name('store-user-education-data');
	Route::post('/store-user-website-social-data','ResumeController@saveWebsiteSocialLinks')->name('store-user-website-social-data');
	Route::post('/store-user-skill-data','ResumeController@saveSkills')->name('store-user-skill-data');
	Route::post('/store-user-hobby','ResumeController@saveHobby')->name('store-user-hobby');
	Route::post('/store-user-custom-section-data','ResumeController@saveCustomSection')->name('store-user-custom-section-data');
	Route::post('/store-user-internship-data','ResumeController@saveInternship')->name('store-user-internship-data');
	Route::post('/store-user-course-data','ResumeController@saveCourse')->name('store-user-course-data');
	Route::post('/store-user-extra-curricular-activity-data','ResumeController@ajaxExtraCurricularActivitySave')->name('store-user-extra-curricular-activity-data');
	Route::post('/store-user-language-data','ResumeController@saveLanguage')->name('store-user-language-data');
	Route::post('/store-user-reference-data','ResumeController@saveReference')->name('store-user-reference-data');

	// Delete sections/data routes 
	Route::post('/delete-user-career-data','ResumeController@deleteCareers')->name('delete-user-career-data');
	Route::post('/delete-user-education-data','ResumeController@deleteEducation')->name('delete-user-education-data');
	Route::post('/delete-user-website-links-data','ResumeController@deleteWebsiteLinks')->name('delete-user-website-links-data');
	Route::post('/delete-user-skill-data','ResumeController@deleteSkills')->name('delete-user-skill-data');
	Route::post('/delete-user-custom-section-data','ResumeController@deleteCustomSection')->name('delete-user-custom-section-data');
	Route::post('/delete-user-course-data','ResumeController@deleteCourse')->name('delete-user-course-data');
	Route::post('/delete-user-extra-activity-data','ResumeController@deleteExtraActivity')->name('delete-user-extra-activity-data');
	Route::post('/delete-user-internship-data','ResumeController@deleteInternship')->name('delete-user-internship-data');
	Route::post('/delete-user-hobbies-data','ResumeController@deleteHobbies')->name('delete-user-hobbies-data');
	Route::post('/delete-user-language-data','ResumeController@deleteLanguage')->name('delete-user-language-data');
	Route::post('/delete-user-reference-data','ResumeController@deleteReference')->name('delete-user-reference-data');
	// Route::get('/resumes','ResumeController@resumeBuildingView')->name('resumes');
	Route::post('add-resume-details','ResumeController@addUserResumeEmailFullname')->name('add-resume-details');

	// Resume get html form (Left side)
	Route::get('/resumes/get-employer-form/{count}','ResumeController@AppendEmployment');
	Route::get('/resumes/get-education-form/{count}','ResumeController@AppendEducation');
	Route::get('/resumes/get-website-and-social-link-form/{count}','ResumeController@AppendWebsiteSocialLinks');
	Route::get('/resumes/get-skill-form/{count}','ResumeController@AppendSkills');
	Route::get('/resumes/get-custom-section-form/{count}','ResumeController@AppendCustomSection');
	Route::get('/resumes/get-course-form/{count}','ResumeController@AppendCourse');
	Route::get('/resumes/get-extra-curricular-activity-form/{count}','ResumeController@AppendExtraCurricularActivity');
	Route::get('/resumes/get-internship-form/{count}','ResumeController@AppendInternship');
	Route::get('/resumes/get-hobbies-form/{template}','ResumeController@AppendHobbies');
	Route::get('/resumes/get-language-form/{count}','ResumeController@AppendLanguage');
	Route::get('/resumes/get-reference-form/{count}','ResumeController@AppendReference');

	// Resume filled section data
	Route::get('/resumes/get-employer-data/{r_id}','ResumeController@getEmployment');
	Route::get('/resumes/get-education-data/{r_id}','ResumeController@getEducation');
	Route::get('/resumes/get-website-and-social-link-data/{r_id}','ResumeController@getWebsiteSocialLinks');
	Route::get('/resumes/get-skill-data/{r_id}','ResumeController@getSkill');
	Route::get('/resumes/get-custom-section-data/{r_id}','ResumeController@getCustomSection');
	Route::get('/resumes/get-internship-data/{r_id}','ResumeController@getInternship');
	Route::get('/resumes/get-course-data/{r_id}','ResumeController@getCourse');
	Route::get('/resumes/get-extra-curricular-data/{r_id}','ResumeController@getExtraCurricularActivity');
	Route::get('/resumes/get-language-data/{r_id}','ResumeController@getLanguage');
	Route::get('/resumes/get-reference-data/{r_id}','ResumeController@getReference');
	// 
	Route::get('/resumes/get-sample-template/{id}','ResumeController@getSampleTemplate');
	Route::get('get-autosuggest-skill','ResumeController@getAutoSuggestSkills');

	// Profile picture routes
	Route::post('/resumes/profile-picture-crop-image','ResumeController@ProfilePictureCrop')->name('profile-picture-crop-image');
	Route::post('/resumes/profile-picture-image','ResumeController@ProfilePictureUpload')->name('profile-picture-image');
	Route::post('/resumes/delete-profile-picture','ResumeController@deletePictureCrop')->name('delete-profile-picture');
	Route::get('get-profile-picture','ResumeController@GetProfilePicture');
	Route::post('/resumes/generate-resume-pdf','ResumeController@generateResumePDF')->name('generate-resume-pdf');
	Route::get('/resumes/get-section-form','ResumeController@getSectionForm');

	// Get all section ids routes
	Route::get('/resumes/get-custom-section-ids/{r_id}','ResumeController@getCustomSectionIds')->name('get-custom-section-ids');
	Route::get('/resumes/get-course-section-ids/{r_id}','ResumeController@getCourseSectionIds')->name('get-course-section-ids');
	Route::get('/resumes/get-extra-curricular-section-ids/{r_id}','ResumeController@getExtraCurricularSectionIds')->name('get-extra-curricular-section-ids');
	Route::get('/resumes/get-hobby-section-ids/{r_id}','ResumeController@getHobbySectionIds')->name('get-hobby-section-ids');
	Route::get('/resumes/get-internship-section-ids/{r_id}','ResumeController@getInternshipSectionIds')->name('get-internship-section-ids');
	Route::get('/resumes/get-language-section-ids/{r_id}','ResumeController@getLanguageSectionIds')->name('get-language-section-ids');
	Route::get('/resumes/get-reference-section-ids/{r_id}','ResumeController@getReferenceSectionIds')->name('get-reference-section-ids');

	// Change resume template color route
	Route::post('/change-resume-color','ResumeController@changeResumeColor')->name('change-resume-color');

	// Save or Reload PDF
	Route::post('/save-and-reload-pdf','ResumeController@saveAndLoadPersonalDetailsPDF')->name('save-and-reload-pdf');
	Route::get('check-pdf','ResumeController@ConvertHTMLtoPDF');
	Route::post('convert-html-to-pdf','ResumeController@HTMLtoPDF')->name('convert-html-to-pdf');
});



