@extends('layouts.medical')

@section('title', __('Dashboard'))

@section('content')
<div class="container-fluid py-4">
    <h2 class="mb-4">{{ __('Dashboard') }}</h2>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-primary text-white me-3">
                            <i class="bi bi-people"></i>
                        </div>
                        <div>
                            <h6 class="card-subtitle mb-1 text-muted">{{ __('Total Users') }}</h6>
                            <h3 class="card-title mb-0">{{ $totalUsers }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-success text-white me-3">
                            <i class="bi bi-list-check"></i>
                        </div>
                        <div>
                            <h6 class="card-subtitle mb-1 text-muted">{{ __('Total Services') }}</h6>
                            <h3 class="card-title mb-0">{{ $totalServices }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-info text-white me-3">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <div>
                            <h6 class="card-subtitle mb-1 text-muted">{{ __('Total Appointments') }}</h6>
                            <h3 class="card-title mb-0">{{ $totalAppointments }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-warning text-white me-3">
                            <i class="bi bi-clock"></i>
                        </div>
                        <div>
                            <h6 class="card-subtitle mb-1 text-muted">{{ __('Upcoming') }}</h6>
                            <h3 class="card-title mb-0">{{ $upcomingAppointments->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Upcoming Appointments -->
    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="card table-card">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-calendar-event me-2"></i>{{ __('Upcoming Appointments') }}
                    </h5>
                </div>
                <div class="card-body p-0">
                    @if($upcomingAppointments->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>{{ __('Patient') }}</th>
                                    <th>{{ __('Service') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($upcomingAppointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->user->name }}</td>
                                    <td>{{ $appointment->service->name }}</td>
                                    <td>{{ $appointment->appointment_date->format('M d, Y H:i') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $appointment->status === 'confirmed' ? 'success' : ($appointment->status === 'pending' ? 'warning' : 'danger') }}">
                                            {{ __(ucfirst($appointment->status)) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="p-4 text-center text-muted">
                        <i class="bi bi-calendar-x display-4"></i>
                        <p class="mt-2">{{ __('No upcoming appointments') }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Appointments -->
        <div class="col-lg-6">
            <div class="card table-card">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-clock-history me-2"></i>{{ __('Recent Appointments') }}
                    </h5>
                </div>
                <div class="card-body p-0">
                    @if($recentAppointments->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>{{ __('Patient') }}</th>
                                    <th>{{ __('Service') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentAppointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->user->name }}</td>
                                    <td>{{ $appointment->service->name }}</td>
                                    <td>{{ $appointment->appointment_date->format('M d, Y H:i') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $appointment->status === 'confirmed' ? 'success' : ($appointment->status === 'pending' ? 'warning' : 'danger') }}">
                                            {{ __(ucfirst($appointment->status)) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="p-4 text-center text-muted">
                        <i class="bi bi-inbox display-4"></i>
                        <p class="mt-2">{{ __('No recent appointments') }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
