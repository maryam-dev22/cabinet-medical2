@extends('layouts.medical')

@section('title', __('Service Details'))

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ __('Service Details') }}</h2>
        <a href="{{ route('services.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>{{ __('Back') }}
        </a>
    </div>

    <div class="card table-card">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th width="30%">{{ __('ID') }}</th>
                    <td>{{ $service->id }}</td>
                </tr>
                <tr>
                    <th>{{ __('Name') }}</th>
                    <td>{{ $service->name }}</td>
                </tr>
                <tr>
                    <th>{{ __('Description') }}</th>
                    <td>{{ $service->description ?? '-' }}</td>
                </tr>
                <tr>
                    <th>{{ __('Price') }}</th>
                    <td>${{ number_format($service->price, 2) }}</td>
                </tr>
                <tr>
                    <th>{{ __('Created At') }}</th>
                    <td>{{ $service->created_at->format('M d, Y H:i') }}</td>
                </tr>
                <tr>
                    <th>{{ __('Updated At') }}</th>
                    <td>{{ $service->updated_at->format('M d, Y H:i') }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
