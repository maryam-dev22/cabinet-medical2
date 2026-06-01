@extends('layouts.medical')

@section('title', __('Appointments'))

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ __('Appointments') }}</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
            <i class="bi bi-plus-circle me-2"></i>{{ __('Create Appointment') }}
        </button>
    </div>

    <!-- Search Form -->
    <div class="card table-card mb-4">
        <div class="card-body">
            <form action="{{ route('appointments.search') }}" method="GET" class="row g-3" id="searchForm">
                <div class="col-md-3">
                    <input type="text" class="form-control" name="patient_name" placeholder="{{ __('Patient Name') }}" value="{{ request('patient_name') }}">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="service_name" placeholder="{{ __('Service Name') }}" value="{{ request('service_name') }}">
                </div>
                <div class="col-md-2">
                    <select class="form-select" name="status">
                        <option value="">{{ __('All Status') }}</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>{{ __('Pending') }}</option>
                        <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>{{ __('Confirmed') }}</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>{{ __('Cancelled') }}</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="date" class="form-control" name="appointment_date" value="{{ request('appointment_date') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-secondary w-100">
                        <i class="bi bi-search me-2"></i>{{ __('Search') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Appointments Table -->
    <div class="card table-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('ID') }}</th>
                            <th>{{ __('Patient') }}</th>
                            <th>{{ __('Service') }}</th>
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Notes') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->id }}</td>
                            <td>{{ $appointment->user->name }}</td>
                            <td>{{ $appointment->service->name }}</td>
                            <td>{{ $appointment->appointment_date->format('M d, Y H:i') }}</td>
                            <td>
                                <span class="badge bg-{{ $appointment->status === 'confirmed' ? 'success' : ($appointment->status === 'pending' ? 'warning' : 'danger') }}">
                                    {{ __(ucfirst($appointment->status)) }}
                                </span>
                            </td>
                            <td>{{ Str::limit($appointment->notes, 30) }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#showModal{{ $appointment->id }}">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $appointment->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $appointment->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($appointments->hasPages())
            <div class="d-flex justify-content-center mt-3">
                {{ $appointments->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Create Appointment') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('appointments.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">{{ __('Patient') }}</label>
                            <select class="form-select" name="user_id" required>
                                <option value="">{{ __('Select Patient') }}</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ __('Service') }}</label>
                            <select class="form-select" name="service_id" required>
                                <option value="">{{ __('Select Service') }}</option>
                                @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }} - ${{ number_format($service->price, 2) }}</option>
                                @endforeach
                            </select>
                            @error('service_id')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ __('Appointment Date') }}</label>
                            <input type="datetime-local" class="form-control" name="appointment_date" required>
                            @error('appointment_date')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ __('Status') }}</label>
                            <select class="form-select" name="status" required>
                                <option value="pending">{{ __('Pending') }}</option>
                                <option value="confirmed">{{ __('Confirmed') }}</option>
                                <option value="cancelled">{{ __('Cancelled') }}</option>
                            </select>
                            @error('status')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">{{ __('Notes') }}</label>
                            <textarea class="form-control" name="notes" rows="3"></textarea>
                            @error('notes')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Show Modals -->
@foreach($appointments as $appointment)
<div class="modal fade" id="showModal{{ $appointment->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Appointment Details') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
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
                        <th>{{ __('Date') }}</th>
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
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Edit Modals -->
@foreach($appointments as $appointment)
<div class="modal fade" id="editModal{{ $appointment->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Edit Appointment') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">{{ __('Patient') }}</label>
                            <select class="form-select" name="user_id" required>
                                <option value="">{{ __('Select Patient') }}</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $appointment->user_id === $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ __('Service') }}</label>
                            <select class="form-select" name="service_id" required>
                                <option value="">{{ __('Select Service') }}</option>
                                @foreach($services as $service)
                                <option value="{{ $service->id }}" {{ $appointment->service_id === $service->id ? 'selected' : '' }}>{{ $service->name }} - ${{ number_format($service->price, 2) }}</option>
                                @endforeach
                            </select>
                            @error('service_id')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ __('Appointment Date') }}</label>
                            <input type="datetime-local" class="form-control" name="appointment_date" value="{{ $appointment->appointment_date->format('Y-m-d\TH:i') }}" required>
                            @error('appointment_date')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ __('Status') }}</label>
                            <select class="form-select" name="status" required>
                                <option value="pending" {{ $appointment->status === 'pending' ? 'selected' : '' }}>{{ __('Pending') }}</option>
                                <option value="confirmed" {{ $appointment->status === 'confirmed' ? 'selected' : '' }}>{{ __('Confirmed') }}</option>
                                <option value="cancelled" {{ $appointment->status === 'cancelled' ? 'selected' : '' }}>{{ __('Cancelled') }}</option>
                            </select>
                            @error('status')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">{{ __('Notes') }}</label>
                            <textarea class="form-control" name="notes" rows="3">{{ $appointment->notes }}</textarea>
                            @error('notes')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Delete Modals -->
@foreach($appointments as $appointment)
<div class="modal fade" id="deleteModal{{ $appointment->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Delete Appointment') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>{{ __('Are you sure you want to delete this appointment?') }}</p>
                <p><strong>{{ $appointment->user->name }} - {{ $appointment->service->name }}</strong></p>
                <p>{{ $appointment->appointment_date->format('M d, Y H:i') }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@push('scripts')
<script>
    // Real-time search with debounce - ONLY for search form
    let searchTimeout;
    const searchForm = document.getElementById('searchForm');
    
    if (searchForm) {
        const searchInputs = searchForm.querySelectorAll('input[name="patient_name"], input[name="service_name"], select[name="status"], input[name="appointment_date"]');
        
        searchInputs.forEach(input => {
            input.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    searchForm.submit();
                }, 500);
            });
        });
    }
</script>
@endpush
@endsection
