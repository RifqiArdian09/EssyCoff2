@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="min-h-screen flex bg-gray-50">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-sm hidden md:block sticky top-0 h-screen transition-all duration-300 transform -translate-x-full md:translate-x-0" id="sidebar">
        <div class="p-6">
            <div class="flex items-center gap-3 mb-10">
                <div class="w-10 h-10 bg-brown-100 rounded-full flex items-center justify-center">
                    <span class="material-icons text-brown-600 text-xl">local_cafe</span>
                </div>
                <h2 class="text-xl font-bold text-gray-800">EssyCoff</h2>
            </div>
            
            <nav class="space-y-2">

                {{-- Transactions --}}
                <a href="{{ route('admin.orders.index') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all text-gray-700 
                hover:bg-[var(--accent)] hover:text-[var(--primary)] 
                {{ request()->routeIs('admin.orders.*') ? 'bg-[var(--accent)] text-[var(--primary)] font-medium' : '' }}">
                    <span class="material-icons">receipt_long</span>
                    <span class="flex-1">Transactions</span>
                </a>

                {{-- POS System --}}
                <a href="{{ route('admin.pos.index') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all text-gray-700 
                hover:bg-[var(--accent)] hover:text-[var(--primary)] 
                {{ request()->routeIs('admin.pos.*') ? 'bg-[var(--accent)] text-[var(--primary)] font-medium' : '' }}">
                    <span class="material-icons">point_of_sale</span>
                    <span class="flex-1">POS System</span>
                </a>
            </nav>

            
            <div class="absolute bottom-6 left-0 right-0 px-6">
                <div class="p-3 bg-gray-50 rounded-lg flex items-center gap-3">
                    <div class="w-10 h-10 bg-brown-100 rounded-full flex items-center justify-center">
                        <span class="material-icons text-brown-600">person</span>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ auth()->user()->role === 'admin' ? 'Administrator' : 'Cashier' }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-brown-600 transition-colors">
                            <span class="material-icons">logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 overflow-x-hidden">
        <!-- Top Navigation -->
        <header class="bg-white shadow-sm sticky top-0 z-10">
            <div class="max-w-7xl mx-auto px-4 py-3 sm:px-6 flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <button class="md:hidden text-gray-600" id="menuToggle">
                        <span class="material-icons text-2xl">menu</span>
                    </button>
                    <h1 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <span class="material-icons text-brown-600"></span>
                        Kasir
                    </h1>
                </div>
                
                <div class="flex items-center gap-4">
                    <button class="p-2 text-gray-500 hover:text-brown-600 rounded-full hover:bg-gray-100 transition-colors">
                        <span class="material-icons">notifications</span>
                    </button>
                    <div class="hidden md:flex items-center gap-2">
                        <div class="w-8 h-8 bg-brown-100 rounded-full flex items-center justify-center">
                            <span class="material-icons text-brown-600 text-lg">person</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>
</div>
@endsection