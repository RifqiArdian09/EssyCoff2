<!-- Sidebar -->
<aside class="w-64 bg-white shadow-sm hidden md:block sticky top-0 h-screen transition-all duration-300 transform -translate-x-full md:translate-x-0" id="sidebar">
        <div class="p-6">
            <div class="flex items-center gap-3 mb-10">
                <div class="w-10 h-10 bg-brown-100 rounded-full flex items-center justify-center">
                    <span class="material-icons text-brown-600 text-xl">local_cafe</span>
                </div>
                <h2 class="text-xl font-bold text-gray-800">CafePOS</h2>
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