<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminPasswordResetRequest;
use App\Models\Admin;
use App\Models\AdminPasswordReset;
use App\Notifications\AdminPassResetNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;

class AdminPasswordResetController extends Controller
{
    public function showForm()
    {
        return view('admin_auth.forgot-password');
    }
    public function submitForm(Request $request)
    {
        $token = Str::random(64);
        $admin = Admin::where('email', $request->email)->firstOrFail();
        $delete_reset_info = AdminPasswordReset::where('admin_id', $admin->id)->delete();
        $reset_info = AdminPasswordReset::create([
            'admin_id' => $admin->id,
            'reset_token' => $token,
            'created_at' => Carbon::now(),
        ]);
       Notification::send($admin, new AdminPassResetNotification($reset_info));
        return back()->with('sent_rest_email', 'We have emailed your password reset link! ');
    }

    public function create($reset_token){
        return view('admin_auth.reset-password', compact('reset_token'));
    }
    function store(AdminPasswordResetRequest $request) {
        $find_reset_token = AdminPasswordReset::where('reset_token', $request->reset_token)->firstOrFail();
        $find_admin = Admin::where('id', $find_reset_token->admin_id);
        $find_admin_email = Admin::where('id', $find_reset_token->admin_id)->first()->email;
        $find_admin->update([
            'password' => bcrypt($request->password),
        ]);

        if(Auth::guard('admin')->attempt(['email' => $find_admin_email, 'password' => $request->password])) {
            AdminPasswordReset::where('reset_token', $request->reset_token)->delete();
            return redirect('/admin/dashboard');
        }

    }
}
