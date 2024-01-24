<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Models\User;
use App\Models\UserPayslip;
use Illuminate\Http\Request;
use PDF;

class Payslip extends Controller
{
    public function Index(Request $request)
    {
        $months = [
            '1' => 'January',
            '2' => 'February',
            '3' => 'March',
            '4' => 'April',
            '5' => 'May',
            '6' => 'June',
            '7' => 'July',
            '8' => 'August',
            '9' => 'September',
            '10' => 'October',
            '11' => 'November',
            '12' => 'December',
        ];

        if ($request->has('year') or $request->has('month')) {
            $year = $request->get('year');
            $month = $request->get('month');
        } else {
            $year = date('Y');
            $month = date('n');
        }

        if ($request->has('submit_assign_payslip')) {
            UserPayslip::create([
                'user_id' => $request->get('employee'),
                'year' => $request->get('year'),
                'month' => $request->get('month'),
                'basic' => $request->get('basic'),
                'overtime' => $request->get('overtime'),
                'commision' => $request->get('commision'),
                'epf' => $request->get('epf'),
                'socso' => $request->get('socso'),
            ]);
        }

        if ($request->has('submit_delete')) {
            UserPayslip::where('id', $request->get('id'))->delete();
        }

        if (auth()->user()->isHigherUp()) {
            if ($request->has('submit_add_income')) {
                Income::create([
                    'amount' => $request->get('amount'),
                    'created_at' => $request->get('date'),
                ]);
            }

            if ($request->has('submit_update_income')) {
                Income::where('id', $request->get('id'))->update([
                    'amount' => $request->get('amount'),
                ]);
            }

            if ($request->has('submit_delete_income')) {
                Income::where('id', $request->get('id'))->delete();
            }
        }

        return view('system.payslip.index', [
            'months' => $months,
            'users' => User::all(),
            'payslip' => (auth()->user()->isAdmin()) ? UserPayslip::where('year', $year)->where('month', $month)->get() : UserPayslip::where('year', $year)->where('month', $month)->where('user_id', auth()->user()->id)->get(),
            'month' => $month,
            'year' => $year,
            'incomes' => Income::all(),
        ]);
    }

    public function viewPayslip(Request $request)
    {
        $pdf = PDF::loadView('system.payslip.view', [
            'payslip' => UserPayslip::find($request->get('id'))
        ]);
        return $pdf->download('itsolutionstuff.pdf');
    }
}
