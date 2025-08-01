@extends('layouts.app')

@section('title', 'Login')
@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50">
    <div class="w-full max-w-md mx-4 bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-8">
            <!-- Logo/Header -->
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="material-icons text-blue-600 text-3xl">local_cafe</span>
                </div>
                <h1 class="text-2xl font-bold text-gray-800">CafePOS System</h1>
                <p class="text-gray-500 mt-2">Sign in to your account</p>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                
                @if($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-lg">
                        @foreach ($errors->all() as $error)
                            <p class="text-red-600 text-sm">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                        Email Address
                    </label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="material-icons text-gray-400">email</span>
                        </div>
                        <input id="email" name="email" type="email" required 
                               class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md" 
                               placeholder="your@email.com">
                    </div>
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        Password
                    </label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="material-icons text-gray-400">lock</span>
                        </div>
                        <input id="password" name="password" type="password" required 
                               class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md" 
                               placeholder="••••••••">
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" 
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 text-sm text-gray-600">
                            Remember me
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" 
                            class="w-full flex justify-center items-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        <span class="material-icons mr-2">login</span>
                        Sign In
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection