<?php

namespace App\Http\Controllers\Backend;

use App\AdditionalRole;
use App\Http\Controllers\Controller;
use App\Rules\MatchOldPassword;
use App\User;
use Auth;
use Exception;
use Hash;
use Illuminate\Http\Request;
use Validator;

class AdminController extends Controller {
	public function dashboard() {
		try {
			$role_id = Auth::guard()->user()->roles->first()->id;
			$permissions = null;
			if ($role_id > 1) {
				$permissions = AdditionalRole::select('rel_id', 'product_name', 'chahat_catlog_no', 'chahat_design_no', 'purchase_price', 'our_price', 'product_type', 'fabric', 'ucode', 'ncode', 'color', 'total_stock', 'available_stock', 'image1', 'image2', 'date')->where('role_id', $role_id)->first()->toArray();
			}
			return view('backend.index', compact('permissions'));
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
	public function profile() {
		try {
			return view('backend.profile');
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
	public function profileUpdate(Request $request) {
		try {
			$validator = Validator::make($request->all(), [
				'username' => 'required|string|max:255|min:2',
				//'email'     => 'required|unique:users,email,NULL,id,deleted_at,NULL',
				'mobile_no' => 'required|digits:10|min:10',
			]);

			if ($validator->fails()) {

				return redirect()->back()->withErrors($validator)->withInput();
			}
			$id = Auth::guard()->user()->id;
			$user = User::findOrFail($id);
			$user->username = $request->username;
			//$user->email    = $request->email;
			$user->mobile_no = $request->mobile_no;
			$user->save();
			return redirect()->back()
				->with(['message.content' => "Profile update succesfully!!", 'message.level' => 'success']);
		} catch (Exception $e) {
			return redirect()->back()->with(['message.content' => $e->getMessage(), 'message.level' => 'danger']);}
	}
	public function changePassword(Request $request) {
		// if validation fails it automatically redirect back
		$request->validate([
			'current_password' => ['required', new MatchOldPassword],
			'new_password' => ['required'],
			'new_confirm_password' => ['same:new_password'],
		]);

		try {
			auth()->user()->update([
				'password' => Hash::make($request->new_password),
			]);

			return redirect()->back()->with(['message.content' => 'Password change succesfully.', 'message.level' => 'success']);
		} catch (Exception $e) {
			return redirect()->back()->with(['message.content' => $e->getMessage(), 'message.level' => 'danger']);
		}
	}
}
