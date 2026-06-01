@extends('layouts.medical')

@section('title', 'Profile')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <h2 class="fw-bold mb-4">
                <i class="bi bi-person-circle me-2"></i>{{ __('Profile') }}
            </h2>
        </div>
    </div>

    <div class="row g-4">
        <!-- Profile Information -->
        <div class="col-lg-8">
            <div class="card table-card mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-semibold">
                        <i class="bi bi-person me-2 text-primary"></i>{{ __('Profile Information') }}
                    </h5>
                    <p class="text-muted mb-0 small">
                        {{ __("Update your account's profile information and email address.") }}
                    </p>
                </div>
                <div class="card-body">
                    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                        @csrf
                    </form>

                    <form method="post" action="{{ route('profile.update') }}">
                        @csrf
                        @method('patch')

                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold">
                                <i class="bi bi-person me-2"></i>{{ __('Name') }}
                            </label>
                            <input id="name" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   name="name" 
                                   type="text" 
                                   value="{{ old('name', $user->name) }}" 
                                   required 
                                   autofocus 
                                   autocomplete="name"
                                   placeholder="Enter your full name">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">
                                <i class="bi bi-envelope me-2"></i>{{ __('Email') }}
                            </label>
                            <input id="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   name="email" 
                                   type="email" 
                                   value="{{ old('email', $user->email) }}" 
                                   required 
                                   autocomplete="username"
                                   placeholder="Enter your email address">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                <div class="alert alert-warning mt-3">
                                    <i class="bi bi-exclamation-triangle me-2"></i>
                                    {{ __('Your email address is unverified.') }}
                                    <button form="send-verification" class="btn btn-sm btn-link text-decoration-none p-0 ms-2">
                                        {{ __('Click here to re-send the verification email.') }}
                                    </button>
                                </div>

                                @if (session('status') === 'verification-link-sent')
                                    <div class="alert alert-success mt-2">
                                        <i class="bi bi-check-circle me-2"></i>
                                        {{ __('A new verification link has been sent to your email address.') }}
                                    </div>
                                @endif
                            @endif
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>{{ __('Save') }}
                            </button>

                            @if (session('status') === 'profile-updated')
                                <div class="alert alert-success mb-0 py-2 px-3">
                                    <i class="bi bi-check-circle me-2"></i>{{ __('Saved.') }}
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Update Password -->
        <div class="col-lg-8">
            <div class="card table-card mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-semibold">
                        <i class="bi bi-shield-lock me-2 text-primary"></i>{{ __('Update Password') }}
                    </h5>
                    <p class="text-muted mb-0 small">
                        {{ __('Ensure your account is using a long, random password to stay secure.') }}
                    </p>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')

                        <div class="mb-3">
                            <label for="update_password_current_password" class="form-label fw-semibold">
                                <i class="bi bi-lock me-2"></i>{{ __('Current Password') }}
                            </label>
                            <input id="update_password_current_password" 
                                   class="form-control @error('updatePassword.current_password') is-invalid @enderror" 
                                   name="current_password" 
                                   type="password" 
                                   autocomplete="current-password"
                                   placeholder="Enter your current password">
                            @error('updatePassword.current_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="update_password_password" class="form-label fw-semibold">
                                <i class="bi bi-key me-2"></i>{{ __('New Password') }}
                            </label>
                            <input id="update_password_password" 
                                   class="form-control @error('updatePassword.password') is-invalid @enderror" 
                                   name="password" 
                                   type="password" 
                                   autocomplete="new-password"
                                   placeholder="Enter your new password">
                            @error('updatePassword.password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="update_password_password_confirmation" class="form-label fw-semibold">
                                <i class="bi bi-lock-fill me-2"></i>{{ __('Confirm Password') }}
                            </label>
                            <input id="update_password_password_confirmation" 
                                   class="form-control @error('updatePassword.password_confirmation') is-invalid @enderror" 
                                   name="password_confirmation" 
                                   type="password" 
                                   autocomplete="new-password"
                                   placeholder="Confirm your new password">
                            @error('updatePassword.password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>{{ __('Save') }}
                            </button>

                            @if (session('status') === 'password-updated')
                                <div class="alert alert-success mb-0 py-2 px-3">
                                    <i class="bi bi-check-circle me-2"></i>{{ __('Saved.') }}
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete Account -->
        <div class="col-lg-8">
            <div class="card table-card mb-4 border-danger">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-semibold text-danger">
                        <i class="bi bi-trash me-2"></i>{{ __('Delete Account') }}
                    </h5>
                    <p class="text-muted mb-0 small">
                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                    </p>
                </div>
                <div class="card-body">
                    <button type="button" 
                            class="btn btn-danger" 
                            data-bs-toggle="modal" 
                            data-bs-target="#confirmUserDeletionModal">
                        <i class="bi bi-trash me-2"></i>{{ __('Delete Account') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-semibold" id="confirmUserDeletionModalLabel">
                    <i class="bi bi-exclamation-triangle text-danger me-2"></i>{{ __('Delete Account') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-3">
                    {{ __('Are you sure you want to delete your account?') }}
                </p>
                <p class="text-muted small">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>
                <div class="mt-4">
                    <label for="password" class="form-label fw-semibold">
                        {{ __('Password') }}
                    </label>
                    <input id="password" 
                           class="form-control @error('userDeletion.password') is-invalid @enderror" 
                           name="password" 
                           type="password" 
                           placeholder="{{ __('Password') }}">
                    @error('userDeletion.password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    {{ __('Cancel') }}
                </button>
                <form method="post" action="{{ route('profile.destroy') }}" class="d-inline">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-2"></i>{{ __('Delete Account') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
