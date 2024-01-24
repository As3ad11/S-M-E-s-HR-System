<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\CreditCategory;
use App\Models\LeaveCategory;
use App\Models\User;
use App\Models\UserCredit;
use App\Models\UserLeaveBalance;
use App\Models\UserLeaves;
use Illuminate\Http\Request;

class Leave extends Controller
{
    public function Index(Request $request)
    {
        $message = "";

        if ($request->has('submit_apply_leave')) {
            $user_leave_balance = UserLeaveBalance::where('user_id', $request->get('user_id'))->where('leave_id', $request->get('leave_category'))->first();

            if ($user_leave_balance and $user_leave_balance->balance >= $request->get('count')) {
                UserLeaves::create([
                    'user_id' => $request->get('user_id'),
                    'leave_category_id' => $request->get('leave_category'),
                    'start_date' => $request->get('start_date'),
                    'end_date' => $request->get('end_date'),
                    'count' => $request->get('count'),
                ]);
            } else {
                $message = "Unsufficient leave balance";
            }
        }

        if ($request->has('submit_leave_approve')) {
            UserLeaves::where('id', $request->get('leave_apply_id'))->update([
                'status' => 1,
            ]);

            $user_leave_balance = UserLeaveBalance::where('leave_id', $request->get('leave_category_id'))
                ->where('user_id', $request->get('leave_apply_user_id'))
                ->first();
            $user_leave_balance->balance = $user_leave_balance->balance - $request->get('leave_count');
            $user_leave_balance->save();
        }

        if ($request->has('submit_leave_reject')) {
            UserLeaves::where('id', $request->get('leave_apply_id'))->update([
                'status' => 2,
            ]);
        }

        return view('system.leave.index', [
            'leaves' => (auth()->user()->isAdmin()) ? UserLeaves::whereNull('status')->get() : UserLeaves::where('user_id', auth()->user()->id)->whereNull('status')->get(),
            'leave_categories' => LeaveCategory::all(),
            'users' => User::all(),
            'message' => $message,
        ]);
    }

    public function LeaveHistory()
    {
        return view('system.leave.history', [
            'leaves' => (auth()->user()->isAdmin()) ? UserLeaves::whereNotNull('status')->get() : UserLeaves::where('user_id', auth()->user()->id)->whereNotNull('status')->get(),
        ]);
    }

    public function LeaveInformation(Request $request)
    {
        if ($request->has('id')) {
            $current_user = $request->get('id');
        } else {
            $current_user = auth()->user()->id;
        }

        if ($request->has('search_employee')) {
            return redirect()->route('leave.information', ['id' => $request->get('employee')]);
        }

        if ($request->has('submit_add_leave_balance')) {
            UserLeaveBalance::create([
                'user_id' => $current_user,
                'leave_id' => $request->get('leave_type'),
                'balance' => $request->get('balance'),
            ]);
        }

        if ($request->has('submit_add_credit')) {
            UserCredit::create([
                'user_id' => $current_user,
                'credit_id' => $request->get('credit_category'),
                'amount' => $request->get('credit'),
            ]);
        }

        if ($request->has('submit_credit_approve')) {
            UserCredit::where('id', $request->get('credit_apply_id'))->update([
                'approved' => 1,
            ]);
        }

        if ($request->has('submit_credit_reject')) {
            UserCredit::where('id', $request->get('credit_apply_id'))->update([
                'approved' => 2,
            ]);
        }

        return view('system.leave.information', [
            'current_user' => $current_user,
            'users' => User::all(),
            'leave_categories' => LeaveCategory::all(),
            'leave_balances' => UserLeaveBalance::where('user_id', $current_user)->get(),
            'credit_categories' => CreditCategory::all(),
            'credit_amount' => UserCredit::where('user_id', $current_user)->where('approved', 1)->get(),
            'credit_amount_pending' => UserCredit::where('approved', 0)->get(),
        ]);
    }
}
