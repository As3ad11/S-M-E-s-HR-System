<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\PersonalProfile;
use App\Models\Role;
use App\Models\User;
use App\Models\UserChart;
use App\Models\UserDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Organization extends Controller
{
    public function Index(Request $request)
    {
        $search_name = '';

        if ($request->has('create')) {
            $user = User::create([
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            PersonalProfile::create([
                'user_id' => $user->id,
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'initial' => strtoupper($request->get('first_name')[0] . $request->get('last_name')[0]),
                'address' => $request->get('address'),
                'phone' => $request->get('phone'),
                'join_date' => $request->get('join_date'),
                'position' => $request->get('position'),
            ]);

            UserDepartment::updateOrCreate([
                'user_id' => $user->id,
                'department_id' => $request->get('department'),
            ]);
        }

        if ($request->has('update')) {
            if (auth()->user()->isHigherUp()) {
                User::where('id', $request->get('id'))->update([
                    'role' => $request->get('role'),
                ]);
            }

            PersonalProfile::updateOrCreate([
                'user_id' => $request->get('id'),
            ], [
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'initial' => strtoupper($request->get('first_name')[0] . $request->get('last_name')[0]),
                'address' => $request->get('address'),
                'phone' => $request->get('phone'),
                'join_date' => $request->get('join_date'),
                'position' => $request->get('position'),
            ]);

            UserDepartment::updateOrCreate([
                'user_id' => $request->get('id'),
            ], [
                'department_id' => $request->get('department'),
            ]);
        }

        if ($request->has('submit_search_employee')) {
            $search_name = $request->get('name');
        }

        return view('system.organization.index', [
            'employee' => ($search_name != "") ? User::whereHas('Profile', function($query) use ($search_name) {
                $query->where('first_name', 'like', '%'.$search_name.'%')
                    ->orWhere('last_name', 'like', '%'.$search_name.'%');
            })->get() : User::all(),
            'departments' => Department::all(),
            'roles' => Role::all(),
        ]);
    }

    public function Chart(Request $request)
    {
        if ($request->has('submit_add_chart')) {
            UserChart::create([
                'user_id' => $request->get('employee'),
                'level' => $request->get('level'),
            ]);
        }

        if ($request->has('submit_remove')) {
            UserChart::where('id', $request->get('id'))->delete();
        }

        return view('system.organization.chart', [
            'employee' => User::all(),
            'level_1_users' => UserChart::where('level', 1)->get(),
            'level_2_users' => UserChart::where('level', 2)->get(),
            'level_3_users' => UserChart::where('level', 3)->get(),
        ]);
    }
}
