<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

use App\Http\Controllers\Controller;

use App\Models\Report;
use App\Models\User;
use App\Models\Word;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        return $this->renderAdminView('admin.main', array());
    }

    public function listUsers()
    {
        $users = User::query()->withTrashed()->paginate(10);

        return $this->renderAdminView('admin.listUsers', [ 'users' => $users ]);
    }

    public function listReports()
    {
        $reports = Report::query()->paginate(10);

        return $this->renderAdminView('admin.listReports', [ 'reports' => $reports ]);
    }

    public function reportCheck(Report $report)
    {
        $report->user_id = Auth::user()->id;
        $report->save();
        $report->delete();

        return redirect()->back();
    }

    public function reportDelete(Report $report)
    {
        $report->user_id = Auth::user()->id;
        $report->save();
        $report->delete();
        $report->tweet->delete();

        return redirect()->back();
    }
}
