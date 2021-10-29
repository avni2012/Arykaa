<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/* Get Address Essentials */
Route::get('get-states','Controller@getStatesByCountry')->name('get-states');
Route::get('get-cities','Controller@getCitiesByState')->name('get-cities');

Route::group(['namespace'=>'Backend','prefix'=>'/control-panel'], function () {

    /* Admin Authentication */
    Route::group(['namespace'=>'Auth'], function (){
        Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
        Route::post('login', 'LoginController@login')->name('admin.login');
        Route::post('logout', 'LoginController@logout')->name('admin.logout');

        // Password Reset Routes
        Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
        Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');

        Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('password/reset', 'ResetPasswordController@reset')->name('admin.password.update');
    });
    //Can access only authenticated users
   Route::group(['middleware'=>'admin'], function(){
       /* Admin Dashboard */
       Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');

       /* Manage profile */
       Route::get('profile','AdminController@profile')->name('profile');
       Route::post('profile-update','AdminController@profileUpdate')->name('profile-update');
       Route::post('change-password','AdminController@changePassword')->name('change-password');

       /* Manage Staff */
       Route::group(['namespace'=>'Staff'], function (){
           Route::resource('manage-staff', 'StaffController');
           Route::post('multiple-user-delete','StaffController@multipleUserDelete')->name('multiple-user-delete');
       });

       /* Manage PermissionRole */
       Route::group(['namespace'=>'PermissionRole'], function (){
           Route::resource('manage-role', 'PermisstionRollController');
           Route::get('manage-permisstion/{RoleId}','PermisstionRollController@managePermisstion')->name('manage-permisstion');
           Route::post('permisstion-store/{RoleId}','PermisstionRollController@permisstionStore')->name('permisstion-store');
           Route::get('check-role-has-user/{RoleId}','PermisstionRollController@checkRolehasUser')->name('check-role-has-user');
           Route::post('permisstion-additional-store/{RoleId}','PermisstionRollController@permisstionAdditionalStore')->name('permisstion-additional-store');
       });

       /* Manage Customers */
       Route::group(['namespace'=>'User'], function (){
           Route::resource('manage-users','UserController');
           Route::get('/get-users-data','UserController@getData')->name('admin.get-user-data');
           Route::get('/edit-user-address','UserController@editAddress')->name('admin.edit-user-address');
           Route::post('/update-user-address','UserController@updateAddress')->name('admin.update-user-address');
           Route::post('/delete-user-address','UserController@deleteAddress')->name('admin.delete-user-address');
           Route::post('/delete-multiple-user','UserController@multipleUserDelete')->name('admin.delete-multiple-user');
           Route::post('/change-user-password/{id}','UserController@changeUserPassword')->name('admin.change-user-password');
       });

       /* Manage CMS */
       Route::group(['namespace'=>'CMS'], function (){
           Route::resource('manage-cms','CmsController');
           Route::post('/multiple-cms-delete','CmsController@multipleCmsDelete')->name('/multiple-cms-delete');
       });

       /* Manage FAQs */
       Route::group(['namespace'=>'Faq'], function (){
           Route::resource('manage-faq','FaqController');
           Route::post('/multiple-faq-delete','FaqController@multipleFaqDelete')->name('/multiple-faq-delete');
       });

       /* Manage Category */
       Route::group(['namespace'=>'Category'], function (){
           Route::resource('manage-category','CategoryController');
           Route::post('/multiple-category-delete','CategoryController@multipleCategoryDelete')->name('/multiple-category-delete');
       });

       /* Manage Tag */
       Route::group(['namespace'=>'Tag'], function (){
           Route::resource('manage-tag','TagController');
           Route::post('/multiple-tag-delete','TagController@multipleTagDelete')->name('/multiple-tag-delete');
       });

       /* Manage Notification */
       Route::group(['namespace'=>'Notification'], function (){
           Route::resource('manage-notification','NotificationController');
       });

       /* Manage Album Gallery */
       /*Route::group(['namespace'=>'AlbumGallery'], function (){
           Route::resource('manage-album-gallery','AlbumGalleryController');
           Route::post('/multiple-album-gallery-delete','AlbumGalleryController@multipleAlbumGalleryDelete')->name('/multiple-album-gallery-delete');
           Route::post('/manage-album-gallery/delete-image/{id}','AlbumGalleryController@deleteImage')->name('/delete-image');
           Route::post('/manage-album-gallery/upload-image/{id}','AlbumGalleryController@uploadImage')->name('/upload-image');
           Route::post('/manage-album-gallery/edit-gallery-image/{id}','AlbumGalleryController@editGalleryImage')->name('/edit-gallery-image');
       });*/

       /* Manage Email Templates */
       Route::group(['namespace'=>'EmailTemplates'], function (){
           Route::resource('manage-email-templates','EmailTemplateController');
       });

       /* Manage Settings */
       Route::group(['namespace'=>'Setting'], function (){
           Route::get('manage-settings','SettingController@index')->name('manage-settings.index');
           Route::post('manage-settings/update','SettingController@update')->name('manage-settings.update');
       });

       /* Manage Homepage Sliders */
       Route::group(['namespace'=>'HomepageSlider'], function (){
           Route::resource('manage-homepage-sliders','HomepageSliderController');
       });

       /* Manage Contact Us*/
       Route::group(['namespace'=>'ContactUs'], function (){
           Route::get('manage-contact-us','ContactUsController@index')->name('manage-contact-us.index');
           Route::delete('manage-contact-us/{id}','ContactUsController@destroy')->name('manage-contact-us.delete');
           Route::post('/multiple-contact-us-delete','ContactUsController@multipleContactUsDelete')->name('/multiple-contact-us-delete');
       });

       /* Manage Coaches */
       Route::group(['namespace'=>'Coaches'], function (){
           Route::resource('manage-coach','CoachController');
           Route::post('/multiple-coach-delete','CoachController@multipleCoachDelete')->name('/multiple-coach-delete');
           Route::get('manage-coach-availability/{id}','CoachController@manageCoachAvailability')->name('manage-coach-availability');
           Route::post('save-coach-availability/{id}','CoachController@saveCoachAvailability')->name('save-coach-availability');
           Route::post('add-availability-block','CoachController@addAvailabilityBlock')->name('add-availability-block');
       });

       /* Manage Pricing */
       Route::group(['namespace'=>'Pricing'], function (){
           Route::resource('manage-pricing','PricingController');
           Route::post('/multiple-pricing-delete','PricingController@multiplePricingDelete')->name('/multiple-pricing-delete');
       });

       Route::group(['namespace'=>'Industry'], function (){
           Route::resource('manage-industry','IndustryController');
       });

       Route::group(['namespace'=>'Blog'], function (){
           Route::resource('manage-blog','BlogController');
           Route::post('/add-category','BlogController@addCategory')->name('manage-blog.add-category');
           Route::post('/add-tag','BlogController@addTag')->name('manage-blog.add-tag');
           // Route::post('/check-blog/{id}','BlogController@checkBlogs')->name('manage-blog.check-blog');
           Route::post('/multiple-blog-delete','BlogController@multipleBlogDelete')->name('/multiple-blog-delete');
       });

       Route::group(['namespace'=>'BlogCategory'], function (){
           Route::resource('manage-blog-category','BlogCategoryController');
           Route::post('/multiple-blog-category-delete','BlogCategoryController@multipleBlogCategoryDelete')->name('/multiple-blog-category-delete');
           Route::post('/manage-blog-category/delete-blogcategory-having-blogs','BlogCategoryController@deleteBlogCategoryWithBlogs')->name('manage-blog-category.delete-blogcategory-having-blogs');
       });

       Route::group(['namespace'=>'Tag'], function (){
           Route::resource('manage-tag','TagController');
           Route::post('/multiple-tag-delete','TagController@multipleTagDelete')->name('/multiple-tag-delete');
       });

       Route::group(['namespace'=>'Course'], function (){
           Route::resource('manage-course','CourseController');
           Route::post('/multiple-course-delete','CourseController@multipleCourseDelete')->name('/multiple-course-delete');
       });

       Route::group(['namespace'=>'Coupon'], function (){
           Route::resource('manage-coupon','CouponController');
           Route::post('/multiple-coupon-delete','CouponController@multipleCouponDelete')->name('/multiple-coupon-delete');
       });

       Route::group(['namespace'=>'Product'], function (){
           Route::resource('manage-product','ProductController');
           Route::post('/multiple-product-delete','ProductController@multipleProductDelete')->name('/multiple-product-delete');
       });

       Route::group(['namespace'=>'ProductSub'], function (){
           Route::resource('manage-sub-product','ProductSubController');
           Route::get('/get-product-data','ProductSubController@getData')->name('/get-product-data');
           // Route::post('/multiple-product-delete','ProductSubController@multipleProductDelete')->name('/multiple-product-delete');
       });

       Route::group(['namespace'=>'Order'], function (){
           Route::resource('manage-order','OrderController');
           Route::get('/manage-order/get-order-form/{count}','OrderController@getOrderForm')->name('/get-order-form');
           Route::post('/manage-order/search-product-name','OrderController@getProductName')->name('/search-product-name');
       });
   });
});
