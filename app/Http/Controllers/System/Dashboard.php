<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\CovidCases;
use App\Models\Department;
use App\Models\Income;
use App\Models\User;
use App\Models\UserCovidStatus;
use App\Models\UserLeaves;
use App\Models\UserPayslip;
use App\Models\UserTask;
use App\Models\UserVaccinated;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function Index(Request $request)
    {
        $general_department = 'all';
        $task_cycle = 'yearly';
        $task_department = 'all';
        $covid_cycle = 'yearly';

        if ($request->has('general')) {
            $general_department = $request->get('general');
        }

        if ($request->has('task-cycle')) {
            $task_cycle = $request->get('task-cycle');
        }

        if ($request->has('task-department')) {
            $task_department = $request->get('task-department');
        }

        if ($request->has('covid-cycle')) {
            $covid_cycle = $request->get('covid-cycle');
        }

        return view('system.dashboard.index', [
            'user' => User::find(auth()->user()->id),
            'announcements' => Announcement::query()
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get(),
            'leaves' => UserLeaves::query()
                ->orderBy('id', 'desc')
                ->limit(5)
                ->get(),
            'health' => UserCovidStatus::query()
                ->orderBy('id', 'desc')
                ->limit(5)
                ->get(),
            'departments' => Department::all(),
            'general_department' => $general_department,
            'general' => $this->get_general($general_department),
            'salary' => $this->get_salary(),
            'task_cycle' => $task_cycle,
            'task_department' => $task_department,
            'task' => $this->get_task($task_cycle, $task_department),
            'ravenue' => $this->get_ravenue(),
            'covid_cycle' => $covid_cycle,
            'covid' => $this->get_covid($covid_cycle),
        ]);
    }

    private function get_covid($cycle)
    {
        if ($cycle == 'yearly') {
            $cases = CovidCases::whereYear('date', date('Y'))->count();
            $vaccinated = UserVaccinated::where('vaccination_id', 1)->whereYear('vaccination_at', date('Y'))->count();
            $fully_vaccinated = UserVaccinated::where('vaccination_id', 2)->whereYear('vaccination_at', date('Y'))->count();
        } else {
            $cases = CovidCases::whereYear('date', date('Y'))->whereMonth('date', date('m'))->count();
            $vaccinated = UserVaccinated::where('vaccination_id', 1)->whereYear('vaccination_at', date('Y'))->whereMonth('vaccination_at', date('m'))->count();
            $fully_vaccinated = UserVaccinated::where('vaccination_id', 2)->whereYear('vaccination_at', date('Y'))->whereMonth('vaccination_at', date('m'))->count();
        }

        return [
            $cases,
            $vaccinated,
            $fully_vaccinated,
        ];
    }

    private function get_ravenue()
    {
        $least_year = date('Y') - 5;

        $incomes = Income::whereYear('created_at', '>=', $least_year)->get();
        $expenses = UserPayslip::where('year', '>=', $least_year)->get();

        $years = [];
        $ravenue_income = [];
        $ravenue_expenses = [];
        for ($x = $least_year; $x <= date('Y'); $x++) {

            $years[] = $x;

            $sum = 0;
            foreach ($incomes as $income) {
                if ($x == date('Y', strtotime($income->created_at))) {
                    $sum = $sum + $income->amount;
                }
            }
            $ravenue_income[] = $sum;

            $sum = 0;
            foreach ($expenses as $expense) {
                if ($x == $expense->year) {
                    $sum = $sum + $expense->commision + $expense->epf + $expense->socso;
                }
            }
            $ravenue_expenses[] = $sum;
        }

        return [
            'years' => $years,
            'ravenue_income' => $ravenue_income,
            'ravenue_expenses' => $ravenue_expenses,
        ];
    }

    private function get_task($cycle, $department)
    {
        if ($department == 'all') {
            $user = User::select('id')->get();
        } else {
            $user = User::select('id')->whereHas('Department', function($query) use ($department) {
                $query->where('department_id', $department);
            })->get();
        }

        $users = [];
        foreach ($user as $row) {
            $users[] = $row->id;
        }

        if ($cycle == 'yearly') {
            $tasks = UserTask::whereIn('user_id', $users)->whereYear('created_at', date('Y'))->get();
        } else {
            $tasks = UserTask::whereIn('user_id', $users)->whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->get();
        }

        return [
            $tasks->where('status', 'NEW')->count(),
            $tasks->where('status', 'ON PROGRESS')->count(),
            $tasks->where('status', 'COMPLETED')->count()
        ];
    }

    private function get_salary()
    {
        $month_list = ['01','02','03','04','05','06','07','08','09','10','11','12'];
        $current_month = date('m');

        $current_year = date('Y');
        $previous_year = $current_year - 1;

        $current_year_salaries = UserPayslip::where('year', $current_year)->get();
        $previous_year_salaries = UserPayslip::where('year', $previous_year)->get();

        $months = [];
        $current_year_salary = [];
        $last_year_salary = [];
        foreach ($month_list as $m) {
            if ($m <= $current_month) {
                $months[] = date('M', strtotime(date('Y').'-'.$m.'-01'));

                $current_year_month_salaries = $current_year_salaries->where('month', ltrim($m, '0'));
                $previous_year_month_salaries = $previous_year_salaries->where('month', ltrim($m, '0'));

                $salary = 0;
                foreach ($current_year_month_salaries as $cyms) {
                    $salary = $salary + $cyms->basic + $cyms->overtime;
                }
                $current_year_salary[] = $salary;

                $salary = 0;
                foreach ($previous_year_month_salaries as $cyms) {
                    $salary = $salary + $cyms->basic + $cyms->overtime;
                }
                $last_year_salary[] = $salary;
            }
        }

        return [
            'months' => $months,
            'current_year_salary' => $current_year_salary,
            'last_year_salary' => $last_year_salary
        ];
    }

    private function get_general($department)
    {
        if ($department == 'all') {
            $employees = User::all();
        } else {
            $employees = User::whereHas('Department', function($query) use ($department) {
                $query->where('department_id', $department);
            })->get();
        }

        $basic = 0;
        $overtime = 0;
        $salary = 0;
        foreach($employees as $employee) {
            foreach ($employee->Salary as $salary) {
                $basic = $basic + $salary->basic;
                $overtime = $overtime + $salary->overtime;
            }
        }
        $salary = $basic + $overtime;

        $task = 0;
        foreach($employees as $employee) {
            $task = $task + $employee->Task->count();
        }

        return [
            'employee' => $employees->count(),
            'salary' => $salary,
            'task' => $task,
        ];
    }
}
