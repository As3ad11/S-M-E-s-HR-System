<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\CovidRiskStatus;
use App\Models\CreditCategory;
use App\Models\Department;
use App\Models\Income;
use App\Models\LeaveCategory;
use App\Models\VaccinatedCategory;
use Illuminate\Http\Request;

class Setting extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('submit_create_department')) {
            Department::create([
                'name' => $request->get('name'),
            ]);
        }

        if ($request->has('submit_update_department')) {
            Department::where('id', $request->get('id'))->update([
                'name' => $request->get('name'),
            ]);
        }

        if ($request->has('submit_delete_department')) {
            Department::where('id', $request->get('id'))->delete();
        }

        if ($request->has('submit_create_leave_category')) {
            LeaveCategory::create([
                'name' => $request->get('name'),
            ]);
        }

        if ($request->has('submit_update_leave_category')) {
            LeaveCategory::where('id', $request->get('id'))->update([
                'name' => $request->get('name'),
            ]);
        }

        if ($request->has('submit_delete_leave_category')) {
            LeaveCategory::where('id', $request->get('id'))->delete();
        }

        if ($request->has('submit_create_credit_category')) {
            CreditCategory::create([
                'name' => $request->get('name'),
            ]);
        }

        if ($request->has('submit_update_credit_category')) {
            CreditCategory::where('id', $request->get('id'))->update([
                'name' => $request->get('name'),
            ]);
        }

        if ($request->has('submit_delete_credit_category')) {
            CreditCategory::where('id', $request->get('id'))->delete();
        }

        if ($request->has('submit_add_covid_status')) {
            CovidRiskStatus::create([
                'name' => $request->get('name'),
                'report_flag' => $request->get('report_flag'),
            ]);
        }

        if ($request->has('submit_update_covid_status')) {
            CovidRiskStatus::where('id', $request->get('id'))->update([
                'name' => $request->get('name'),
                'report_flag' => $request->get('report_flag'),
            ]);
        }

        if ($request->has('submit_delete_covid_status')) {
            CovidRiskStatus::where('id', $request->get('id'))->delete();
        }

        if ($request->has('submit_add_vaccinated_category')) {
            VaccinatedCategory::create([
                'name' => $request->get('name'),
            ]);
        }

        if ($request->has('submit_update_vaccinated_category')) {
            VaccinatedCategory::where('id', $request->get('id'))->update([
                'name' => $request->get('name'),
            ]);
        }

        if ($request->has('submit_delete_vaccinated_category')) {
            VaccinatedCategory::where('id', $request->get('id'))->delete();
        }

        return view('system.setting.index', [
            'departments' => Department::all(),
            'leave_categories' => LeaveCategory::all(),
            'credit_categories' => CreditCategory::all(),
            'covid_status' => CovidRiskStatus::all(),
            'vaccinated_categories' => VaccinatedCategory::all(),
        ]);
    }
}
