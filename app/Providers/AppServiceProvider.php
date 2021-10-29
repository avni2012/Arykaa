<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
		//
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		/*$settings = GeneralSetting::first();
			        if($settings) {
			            Config::set('services.facebook.client_id', $settings->facebook_key);
			            Config::set('services.facebook.client_secret', $settings->facebook_secret);
			            Config::set('services.facebook.redirect', $settings->facebook_callback_url);
			            Config::set('services.google.client_id', $settings->google_key);
			            Config::set('services.google.client_secret', $settings->google_secret);
			            Config::set('services.google.redirect', $settings->google_callback_url);
			            Config::set('services.facebook_link', $settings->facebook_link);
			            Config::set('services.twitter_link', $settings->twitter_link);
			            Config::set('services.linked_in_link', $settings->linked_in_link);
			            Config::set('services.web_address', $settings->web_address);
			            Config::set('services.mob_no', $settings->mob_no);
			            Config::set('services.web_email', $settings->web_email);
			            Config::set('services.logo', $settings->logo);
			            Config::set('services.sign_ups_per_day_starts_with', $settings->sign_ups_per_day_starts_with);
			            Config::set('services.resume_built_starts_with', $settings->resume_built_starts_with);
			            Config::set('services.google_map_link', $settings->google_map_link);
			            Config::set('services.cover_letters_starts_with', $settings->cover_letters_starts_with);
			            Config::set('services.email_templates_starts_with', $settings->email_templates_starts_with);
		*/
		/*$get_image = User::select('profile_picture')->where('id',Auth::guard('users')->user()->id)->first();
			        view()->composer('layouts.frontend.dashboard-master', function($view) use ($get_image){
			            $view->with('profile',$get_image);
		*/
	}
}
