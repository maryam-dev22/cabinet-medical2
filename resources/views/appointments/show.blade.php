@extends('layouts.medical')

@section('title', __('Appointment Details'))

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ __('Appointment Details') }}</h2>
        <a href="{{ route('appointments.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>{{ __('Back') }}
        </a>
    </div>

    <div class="card table-card">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th width="30%">{{ __('ID') }}</th>
                    <td>{{ $appointment->id }}</td>
                </tr>
                <tr>
                    <th>{{ __('Patient') }}</th>
                    <td>{{ $appointment->user->name }}</td>
                </tr>
                <tr>
                    <th>{{ __('Email') }}</th>
                    <td>{{ $appointment->user->email }}</td>
                </tr>
                <tr>
                    <th>{{ __('Service') }}</th>
                    <td>{{ $appointment->service->name }}</td>
                </tr>
                <tr>
                    <th>{{ __('Price') }}</th>
                    <td>${{ number_format($appointment->service->price, 2) }}</td>
                </tr>
                <tr>
                    <th>{{ __('Appointment Date') }}</th>
                    <td>{{ $appointment->appointment_date->format('M d, Y H:i') }}</td>
                </tr>
                <tr>
                    <th>{{ __('Status') }}</th>
                    <td>
                        <span class="badge bg-{{ $appointment->status === 'confirmed' ? 'success' : ($appointment->status === 'pending' ? 'warning' : 'danger') }}">
                            {{ __(ucfirst($appointment->status)) }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>{{ __('Notes') }}</th>
                    <td>{{ $appointment->notes ?? '-' }}</td>
                </tr>
                <tr>
                    <th>{{ __('Created At') }}</th>
                    <td>{{ $appointment->created_at->format('M d, Y H:i') }}</td>
                </tr>
                <tr>
                    <th>{{ __('Updated At') }}</th>
                    <td>{{ $appointment->updated_at->format('M d, Y H:i') }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
