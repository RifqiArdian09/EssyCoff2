@extends('layouts.app')

@section('title', 'Add New Staff')

@section('content')
<div class="min-h-screen flex bg-gray-50">
    @include('admin.partials.sidebar')

    <div class="flex-1 overflow-x-hidden">
        @include('admin.partials.header', ['title' => 'Add New Staff'])

        <main class="p-4 sm:p-6">
            <div class="max-w-3xl mx-auto">
                <div class="card">
                    <div class="p-6">
                        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                    <input type="text" id="name" name="name" required
                                           class="input-field @error('name') border-red-500 @enderror"
                                           value="{{ old('name') }}">
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" id="email" name="email" required
                                           class="input-field @error('email') border-red-500 @enderror"
                                           value="{{ old('email') }}">
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                    <input type="password" id="password" name="password" required
                                           class="input-field @error('password') border-red-500 @enderror">
                                    @error('password')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" required
                                           class="input-field">
                                </div>

                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                    <input type="text" id="phone" name="phone"
                                           class="input-field @error('phone') border-red-500 @enderror"
                                           value="{{ old('phone') }}">
                                    @error('phone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                                    <select id="role" name="role" required
                                            class="input-field @error('role') border-red-500 @enderror">
                                        <option value="">Select Role</option>
                                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="kasir" {{ old('role') == 'kasir' ? 'selected' : '' }}>Cashier</option>
                                    </select>
                                    @error('role')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                    <select id="status" name="status" required
                                            class="input-field @error('status') border-red-500 @enderror">
                                        <option value="">Select Status</option>
                                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Active</option>
                                        <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">Profile Photo</label>
                                    <input type="file" id="photo" name="photo"
                                           class="block w-full text-sm text-gray-500
                                                  file:mr-4 file:py-2 file:px-4
                                                  file:rounded-md file:border-0
                                                  file:text-sm file:font-semibold
                                                  file:bg-[var(--accent)] file:text-[var(--primary)]
                                                  hover:file:bg-[#d8c5a3]">
                                    @error('photo')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex justify-end gap-3">
                                <a href="{{ route('admin.users.index') }}" class="btn-secondary">
                                    Cancel
                                </a>
                                <button type="submit" class="btn-primary">
                                    Save Staff Member
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection