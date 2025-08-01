@extends('layouts.app')

@section('title', 'Edit Staff Member')

@section('content')
<div class="min-h-screen flex bg-gray-50">
    @include('admin.partials.sidebar')

    <div class="flex-1 overflow-x-hidden">
        @include('admin.partials.header', ['title' => 'Edit Staff Member'])

        <main class="p-4 sm:p-6">
            <div class="max-w-3xl mx-auto">
                <div class="card">
                    <div class="p-6">
                        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                    <input type="text" id="name" name="name" required
                                           class="input-field @error('name') border-red-500 @enderror"
                                           value="{{ old('name', $user->name) }}">
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" id="email" name="email" required
                                           class="input-field @error('email') border-red-500 @enderror"
                                           value="{{ old('email', $user->email) }}">
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password (leave blank to keep current)</label>
                                    <input type="password" id="password" name="password"
                                           class="input-field @error('password') border-red-500 @enderror">
                                    @error('password')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                    <input type="text" id="phone" name="phone"
                                           class="input-field @error('phone') border-red-500 @enderror"
                                           value="{{ old('phone', $user->phone) }}">
                                    @error('phone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                                    <select id="role" name="role" required
                                            class="input-field @error('role') border-red-500 @enderror">
                                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="kasir" {{ old('role', $user->role) == 'kasir' ? 'selected' : '' }}>Cashier</option>
                                    </select>
                                    @error('role')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                    <select id="status" name="status" required
                                            class="input-field @error('status') border-red-500 @enderror">
                                        <option value="aktif" {{ old('status', $user->status) == 'aktif' ? 'selected' : '' }}>Active</option>
                                        <option value="nonaktif" {{ old('status', $user->status) == 'nonaktif' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">Profile Photo</label>
                                    @if($user->photo)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $user->photo) }}" alt="Current Photo" 
                                                 class="h-16 w-16 rounded-full object-cover">
                                        </div>
                                    @endif
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
                                    Update Staff Member
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