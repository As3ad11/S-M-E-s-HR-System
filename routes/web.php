<?php

use App\Http\Controllers\System\CovidTracker;
use App\Http\Controllers\System\Dashboard;
use App\Http\Controllers\System\FeedAnnouncement;
use App\Http\Controllers\System\Leave;
use App\Http\Controllers\System\Organization;
use App\Http\Controllers\System\Payslip;
use App\Http\Controllers\System\Profile;
use App\Http\Controllers\System\Setting;
use App\Http\Controllers\System\Task;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function() {
    Route::get('/profile', [Profile::class, 'index'])->name('profile');
    Route::post('/profile', [Profile::class, 'index'])->name('profile');
    Route::get('/profile/personal', [Profile::class, 'Personal'])->name('profile.personal');
    Route::post('/profile/personal', [Profile::class, 'Personal'])->name('profile.personal');
    Route::get('/profile/family', [Profile::class, 'Family'])->name('profile.family');
    Route::post('/profile/family', [Profile::class, 'Family'])->name('profile.family');
    Route::get('/profile/experience', [Profile::class, 'Experience'])->name('profile.experience');
    Route::post('/profile/experience', [Profile::class, 'Experience'])->name('profile.experience');
    Route::get('/profile/education', [Profile::class, 'Education'])->name('profile.education');
    Route::post('/profile/education', [Profile::class, 'Education'])->name('profile.education');
    Route::get('/profile/password-update', [Profile::class, 'Password'])->name('profile.password');
    Route::post('/profile/password-update', [Profile::class, 'Password'])->name('profile.password');

    Route::middleware(['check.profile'])->group(function() {
        Route::get('/', [Dashboard::class, 'index'])->name('dashboard');
        Route::post('/', [Dashboard::class, 'index'])->name('dashboard');
        Route::get('/setting', [Setting::class, 'index'])->name('setting');
        Route::post('/setting', [Setting::class, 'index'])->name('setting');
        Route::get('/feed-announcement', [FeedAnnouncement::class, 'Index'])->name('feedannouncement');
        Route::post('/feed-announcement', [FeedAnnouncement::class, 'Index'])->name('feedannouncement');
        Route::get('/organization', [Organization::class, 'Index'])->name('organization');
        Route::post('/organization', [Organization::class, 'Index'])->name('organization');
        Route::get('/organization/chart', [Organization::class, 'Chart'])->name('organization.chart');
        Route::post('/organization/chart', [Organization::class, 'Chart'])->name('organization.chart');
        Route::get('/payslip', [Payslip::class, 'Index'])->name('payslip');
        Route::post('/payslip', [Payslip::class, 'Index'])->name('payslip.view');
        Route::get('/payslip/view', [Payslip::class, 'viewPayslip'])->name('payslip.view');
        Route::get('/leave', [Leave::class, 'Index'])->name('leave');
        Route::post('/leave', [Leave::class, 'Index'])->name('leave');
        Route::get('/leave/history', [Leave::class, 'LeaveHistory'])->name('leave.history');
        Route::get('/leave/information', [Leave::class, 'LeaveInformation'])->name('leave.information');
        Route::post('/leave/information', [Leave::class, 'LeaveInformation'])->name('leave.information');
        Route::get('/covid-tracker', [CovidTracker::class, 'Index'])->name('covidtracker');
        Route::post('/covid-tracker', [CovidTracker::class, 'Index'])->name('covidtracker');
        Route::get('/covid-tracker/cases', [CovidTracker::class, 'Cases'])->name('covidtracker.cases');
        Route::get('/covid-tracker/vaccinated', [CovidTracker::class, 'Vaccinated'])->name('covidtracker.vaccinated');
        Route::post('/covid-tracker/vaccinated', [CovidTracker::class, 'Vaccinated'])->name('covidtracker.vaccinated');
        Route::get('/task', [Task::class, 'Index'])->name('task');
        Route::post('/task', [Task::class, 'Index'])->name('task');
    });
});
