@extends('layouts.app')

@section('title', 'Staff Details')

@section('content')
<div class="min-h-screen flex bg-gray-50">
    @include('admin.partials.sidebar')

    <div class="flex-1 overflow-x-hidden">
        @include('admin.partials.header', ['title' => 'Staff Details'])

        <main class="p-4 sm:p-6">
            <div class="max-w-3xl mx-auto">
                <div class="card">
                    <div class="p-6">
                        <div class="flex flex-col md:flex-row gap-6 mb-8">
                            <div class="flex-shrink-0">
                                <div class="w-32 h-32 rounded-full bg-[var(--accent)] flex items-center justify-center overflow-hidden mx-auto">
                                    @if($user->photo)
                                        <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}" 
                                             class="w-full h-full object-cover">
                                    @else
                                        <span class="material-icons text-[var(--primary)] text-5xl">person</span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex-1">
                                <h2 class="text-2xl font-bold text-[var(--primary)] mb-2">{{ $user->name }}</h2>
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="px-2 py-1 text-xs rounded-full 
                                          {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                    <span class="px-2 py-1 text-xs rounded-full 
                                          {{ $user->status === 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($user->status) }}
                                    </span>
                                </div>
                                <div class="space-y-2">
                                    <div class="flex items-center gap-2">
                                        <span class="material-icons text-gray-500">email</span>
                                        <span>{{ $user->email }}</span>
                                    </div>
                                    @if($user->phone)
                                    <div class="flex items-center gap-2">
                                        <span class="material-icons text-gray-500">phone</span>
                                        <span>{{ $user->phone }}</span>
                                    </div>
                                    @endif
                                    <div class="flex items-center gap-2">
                                        <span class="material-icons text-gray-500">calendar_today</span>
                                        <span>Joined {{ $user->created_at->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end gap-3">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-primary">
                                Edit Profile
                            </a>
                            <a href="{{ route('admin.users.index') }}" class="btn-secondary">
                                Back to List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection