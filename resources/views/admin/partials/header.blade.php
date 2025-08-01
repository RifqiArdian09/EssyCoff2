<header class="bg-white shadow-sm sticky top-0 z-10">
    <div class="max-w-7xl mx-auto px-4 py-3 sm:px-6 flex justify-between items-center">
        <div class="flex items-center gap-4">
            <button class="md:hidden text-gray-600" id="menuToggle">
                <span class="material-icons text-2xl">menu</span>
            </button>
            <h1 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                <span class="material-icons text-brown-600">dashboard</span>
                {{ $title ?? 'Dashboard' }}
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
                <div class="text-sm">
                    <div class="text-gray-800 font-medium">{{ auth()->user()->name }}</div>
                    <div class="text-gray-500 text-xs">{{ ucfirst(auth()->user()->role) }}</div>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    // Mobile menu toggle
    document.addEventListener('DOMContentLoaded', () => {
        const toggleBtn = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        if (toggleBtn && sidebar) {
            toggleBtn.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
            });
        }
    });
</script>
