<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\Business;
use App\Models\Category; // Ajoutez cette ligne pour importer le modèle Category


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function overview() {
        return view('dashboard.overview');
    }

    public function reviews() {
        return view('dashboard.reviews');
    }

    public function users() {
        return view('dashboard.users');
    }

    public function reports() {
        return view('dashboard.reports');
    }

    public function settings() {
        return view('dashboard.settings');
    }

    public function notifications()
    {
        $notifications = Auth::user()->unreadNotifications;
        return view('dashboard.notifications', compact('notifications'));
    }
}
