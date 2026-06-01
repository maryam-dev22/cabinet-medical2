<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $totalUsers = User::count();
        $totalServices = Service::count();
        $totalAppointments = Appointment::count();
        
        $upcomingAppointments = Appointment::with(['user', 'service'])
            ->where('appointment_date', '>=', now())
            ->where('status', '!=', 'cancelled')
            ->orderBy('appointment_date', 'asc')
            ->take(5)
            ->get();
        
        $recentAppointments = Appointment::with(['user', 'service'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalUsers',
            'totalServices',
            'totalAppointments',
            'upcomingAppointments',
            'recentAppointments'
        ));
    }
}
