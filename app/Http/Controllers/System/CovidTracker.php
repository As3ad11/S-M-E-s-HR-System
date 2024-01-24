<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\CovidCases;
use App\Models\CovidRiskStatus;
use App\Models\User;
use App\Models\UserCovidStatus;
use App\Models\UserVaccinated;
use App\Models\VaccinatedCategory;
use Illuminate\Http\Request;

class CovidTracker extends Controller
{
    public function Index(Request $request)
    {
        if ($request->has('id')) {
            $current_user = $request->get('id');
        } else {
            $current_user = auth()->user()->id;
        }

        if ($request->has('search_employee')) {
            return redirect()->route('covidtracker', ['id' => $request->get('employee')]);
        }

        if ($request->has('submit_covid_status')) {
            UserCovidStatus::updateOrCreate([
                'user_id' => $current_user,
            ], [
                'covid_status_id' => $request->get('status'),
                'conditions' => $request->get('conditions'),
            ]);

            $report_flag = CovidRiskStatus::where('id', $request->get('status'))->first()->report_flag;

            if ($report_flag == 1) {
                CovidCases::create([
                    'date' => date('Y-m-d'),
                    'user_id' => $current_user,
                    'covid_status' => $request->get('status'),
                ]);
            } else {
                CovidCases::where('user_id', $current_user)->delete();
            }
        }

        return view('system.covid-tracker.index', [
            'current_user' => $current_user,
            'users' => User::all(),
            'covid_statuses' => CovidRiskStatus::all(),
            'covid_status' => UserCovidStatus::where('user_id', $current_user)->first(),
            'vaccine_status' => UserVaccinated::where('user_id', $current_user)->first(),
        ]);
    }

    public function Cases()
    {
        return view('system.covid-tracker.cases', [
            'cases' => CovidCases::selectRaw('date, count(*) as count')->groupBy('date')->orderByDesc('date')->get(),
        ]);
    }

    public function Vaccinated(Request $request)
    {
        if ($request->has('id')) {
            $current_user = $request->get('id');
        } else {
            $current_user = '';
        }

        if ($request->has('search')) {
            return redirect()->route('covidtracker.vaccinated', ['id' => $request->get('name')]);
        }

        if ($request->has('submit_create_vaccinated_status')) {
            UserVaccinated::updateOrCreate([
                'user_id' => $request->get('employee'),
            ], [
                'vaccination_id' => $request->get('status'),
                'vaccination_at' => now(),
            ]);
        }

        return view('system.covid-tracker.vaccinated', [
            'users' => User::all(),
            'vaccinated_categories' => VaccinatedCategory::all(),
            'vaccinated' => ($current_user and $current_user != '') ? UserVaccinated::where('user_id', $current_user)->get() : UserVaccinated::all(),
            'current_user' => $current_user,
        ]);
    }
}
