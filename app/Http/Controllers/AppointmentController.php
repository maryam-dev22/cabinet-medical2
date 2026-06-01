<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Mail\AppointmentConfirmationMail;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointment::with(['user', 'service'])->latest()->paginate(10);
        $users = User::all();
        $services = Service::all();
        return view('appointments.index', compact('appointments', 'users', 'services'));
    }

    /**
     * Search appointments.
     */
    public function search(Request $request)
    {
        $query = Appointment::with(['user', 'service']);

        if ($request->has('patient_name') && $request->patient_name) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->patient_name . '%');
            });
        }

        if ($request->has('service_name') && $request->service_name) {
            $query->whereHas('service', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->service_name . '%');
            });
        }

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        if ($request->has('appointment_date') && $request->appointment_date) {
            $query->whereDate('appointment_date', $request->appointment_date);
        }

        $appointments = $query->latest()->paginate(10);
        $users = User::all();
        $services = Service::all();

        return view('appointments.index', compact('appointments', 'users', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAppointmentRequest $request)
    {
        $appointment = Appointment::create($request->validated());

        // Send confirmation email
        Mail::to($appointment->user->email)->send(new AppointmentConfirmationMail($appointment));

        return redirect()->route('appointments.index')
            ->with('success', __('Appointment created successfully and confirmation email sent.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        $appointment->load(['user', 'service']);
        return view('appointments.show', compact('appointment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $appointment->update($request->validated());

        return redirect()->route('appointments.index')
            ->with('success', __('Appointment updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('appointments.index')
            ->with('success', __('Appointment deleted successfully.'));
    }
}
