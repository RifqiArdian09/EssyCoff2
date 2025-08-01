<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EssyCoff - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/@material-tailwind/html@latest/styles/material-tailwind.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        :root {
            --primary: #5C4B37;
            --secondary: #D4A76A;
            --accent: #E6D5B8;
        }
        body {
            font-family: 'Inter', sans-serif;
            @apply bg-gray-50 text-gray-800;
        }
        .btn-primary {
            @apply bg-[var(--primary)] hover:bg-[#4A3A2A] text-white px-4 py-2 rounded-lg transition-all duration-300 transform hover:scale-[1.02];
        }
        .card {
            @apply bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg;
        }
        .input-field {
            @apply w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--primary)] focus:border-transparent transition-all;
        }
        .nav-link {
            @apply flex items-center gap-3 px-4 py-3 rounded-lg transition-all hover:bg-[var(--accent)] hover:text-[var(--primary)];
        }
        .nav-link.active {
            @apply bg-[var(--accent)] text-[var(--primary)] font-medium;
        }
        .animate-bounce-in {
            animation: bounceIn 0.5s;
        }

        
    </style>
</head>
<body class="min-h-screen">
    @yield('content')
    
    @stack('scripts')
    <script>
        // Simple fade-in animation for all pages
        document.addEventListener('DOMContentLoaded', () => {
            document.body.classList.add('animate-fade-in');
        });
    </script>
</body>
</html>