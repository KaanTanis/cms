<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnkaRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

    public function edit(AnkaRequest $request)
    {
        $fields = $request->fields($request->segment(2));
        $page = $request->page($request->segment(2));

        $data = User::where('id', auth()->id())->select('email', 'id')->first();

        return view('admin.edit-profile', compact('page', 'fields', 'data'));
    }

    public function update(AnkaRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'email',
            'password' => 'min:8|nullable'
        ], [
            'email.email' => __('notEmail'),
            'password.min' => __('passwordMin', ['min' => 8]),
        ]);

        if ($validator->fails())
            return back()->withInfo($validator->errors()->all());

        $user = User::find(Auth::id());

        if ($request->password != null) {
                $user->update([
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                ]);
        } else {
            $user->update([
                'email' => $request->email,
            ]);
        }

        return back()->withInfo(__('profileUpdated'));
    }
}
