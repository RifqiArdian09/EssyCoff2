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
                {{-- Dashboard --}}
                <a href="{{ route('admin.dashboard') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all text-gray-700 
                hover:bg-[var(--accent)] hover:text-[var(--primary)] 
                {{ request()->routeIs('admin.dashboard') ? 'bg-[var(--accent)] text-[var(--primary)] font-medium' : '' }}">
                    <span class="material-icons">dashboard</span>
                    <span class="flex-1">Dashboard</span>
                </a>

                {{-- Staff Management --}}
                <a href="{{ route('admin.users.index') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all text-gray-700 
                hover:bg-[var(--accent)] hover:text-[var(--primary)] 
                {{ request()->routeIs('admin.users.*') ? 'bg-[var(--accent)] text-[var(--primary)] font-medium' : '' }}">
                    <span class="material-icons">people_alt</span>
                    <span class="flex-1">Staff Management</span>
                </a>

                {{-- Menu Items --}}
                <a href="{{ route('admin.products.index') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all text-gray-700 
                hover:bg-[var(--accent)] hover:text-[var(--primary)] 
                {{ request()->routeIs('admin.products.*') ? 'bg-[var(--accent)] text-[var(--primary)] font-medium' : '' }}">
                    <span class="material-icons">restaurant_menu</span>
                    <span class="flex-1">Menu Items</span>
                </a>

                {{-- Categories --}}
                <a href="{{ route('admin.categories.index') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all text-gray-700 
                hover:bg-[var(--accent)] hover:text-[var(--primary)] 
                {{ request()->routeIs('admin.categories.*') ? 'bg-[var(--accent)] text-[var(--primary)] font-medium' : '' }}">
                    <span class="material-icons">category</span>
                    <span class="flex-1">Categories</span>
                </a>

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
                        <span class="material-icons text-brown-600">dashboard</span>
                        Dashboard Overview
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

        <!-- Dashboard Content -->
        <main class="p-4 sm:p-6">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow p-6 flex items-center gap-4">
                    <div class="p-3 bg-brown-100 rounded-full">
                        <span class="material-icons text-brown-600 text-2xl">people</span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total Staff</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $totalEmployees }}</h3>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6 flex items-center gap-4">
                    <div class="p-3 bg-brown-100 rounded-full">
                        <span class="material-icons text-brown-600 text-2xl">local_cafe</span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Menu Items</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $totalProducts }}</h3>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6 flex items-center gap-4">
                    <div class="p-3 bg-brown-100 rounded-full">
                        <span class="material-icons text-brown-600 text-2xl">receipt</span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Today's Orders</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $totalOrders }}</h3>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6 flex items-center gap-4">
                    <div class="p-3 bg-brown-100 rounded-full">
                        <span class="material-icons text-brown-600 text-2xl">attach_money</span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Today's Revenue</p>
                        <h3 class="text-2xl font-bold text-gray-800">Rp {{ number_format($monthlyRevenue->sum('total') ?? 0, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <!-- Revenue Chart -->
                <div class="bg-white rounded-lg shadow p-6 lg:col-span-2">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">
                            Monthly Revenue
                        </h2>
                    </div>
                    <div class="h-64">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>

                <!-- Popular Items -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">
                            Popular Items
                        </h2>
                    </div>
                    <div class="space-y-3">
                        @foreach($popularProducts as $product)
                        <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center overflow-hidden">
                                    @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    @else
                                    <span class="material-icons text-gray-400">local_cafe</span>
                                    @endif
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-800">{{ $product->name }}</h4>
                                    <p class="text-xs text-gray-500">{{ $product->category->name }}</p>
                                </div>
                            </div>
                            <div class="flex flex-col items-end">
                                <div class="bg-brown-100 text-brown-600 px-2 py-1 rounded-full text-xs font-medium">
                                    {{ $product->order_items_count }} sold
                                </div>
                                <p class="text-xs font-medium mt-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Bottom Row -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Recent Orders -->
                <div class="bg-white rounded-lg shadow p-6 lg:col-span-2">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">
                            Recent Orders
                        </h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($recentOrders as $order)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-brown-600">#EC-{{ $order->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($order->status == 'completed')
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                            Completed
                                        </span>
                                        @elseif($order->status == 'pending')
                                        <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">
                                            Pending
                                        </span>
                                        @else
                                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">
                                            Cancelled
                                        </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->created_at->diffForHumans() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">
                        Quick Actions
                    </h2>
                    <div class="grid grid-cols-2 gap-4">
                        <a href="{{ route('admin.pos.index') }}" class="p-4 bg-brown-50 hover:bg-brown-100 rounded-lg flex flex-col items-center justify-center transition-colors">
                            <span class="material-icons text-brown-600 text-2xl mb-2">point_of_sale</span>
                            <span class="text-sm font-medium">New Order</span>
                        </a>
                        <a href="{{ route('admin.products.create') }}" class="p-4 bg-brown-50 hover:bg-brown-100 rounded-lg flex flex-col items-center justify-center transition-colors">
                            <span class="material-icons text-brown-600 text-2xl mb-2">add_circle</span>
                            <span class="text-sm font-medium">Add Menu Item</span>
                        </a>
                        <a href="{{ route('admin.users.create') }}" class="p-4 bg-brown-50 hover:bg-brown-100 rounded-lg flex flex-col items-center justify-center transition-colors">
                            <span class="material-icons text-brown-600 text-2xl mb-2">person_add</span>
                            <span class="text-sm font-medium">Add Staff</span>
                        </a>
                        <a href="{{ route('admin.orders.index') }}" class="p-4 bg-brown-50 hover:bg-brown-100 rounded-lg flex flex-col items-center justify-center transition-colors">
                            <span class="material-icons text-brown-600 text-2xl mb-2">receipt_long</span>
                            <span class="text-sm font-medium">View Reports</span>
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Revenue Chart
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(revenueCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($monthlyRevenue->pluck('month')->map(function($item) {
                return \Carbon\Carbon::create()->month($item)->format('M');
            })) !!},
            datasets: [{
                label: 'Revenue',
                data: {!! json_encode($monthlyRevenue->pluck('total')) !!},
                backgroundColor: '#3B82F6',
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Rp ' + context.raw.toLocaleString();
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString();
                        }
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Mobile menu toggle
    document.getElementById('menuToggle').addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('-translate-x-full');
    });
</script>
@endpush
@endsection