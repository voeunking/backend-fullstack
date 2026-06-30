<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background:
                radial-gradient(circle at top left, rgba(14, 165, 233, 0.18), transparent 32rem),
                linear-gradient(135deg, #f8fafc 0%, #eef2f7 52%, #f7f8fb 100%);
        }
    </style>
    @stack('styles')
</head>

<body class="text-slate-800 antialiased">
    <div class="min-h-screen lg:flex">
        <aside
            class="lg:fixed lg:inset-y-0 lg:left-0 lg:w-72 bg-slate-950 text-white flex flex-col shadow-2xl shadow-slate-950/20">
            <div class="p-6 border-b border-white/10">
                <div class="flex items-center gap-3">
                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-2xl bg-cyan-400 text-slate-950 font-black shadow-lg shadow-cyan-400/20">
                        S
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-[0.24em] text-cyan-200">ShopHub</p>
                        <h2 class="text-xl font-bold">Admin Panel</h2>
                    </div>
                </div>
            </div>
            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-4 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.dashboard') ? 'bg-white text-slate-950 shadow-lg shadow-cyan-500/10' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.products.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.products.*') ? 'bg-white text-slate-950 shadow-lg shadow-cyan-500/10' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    Products
                </a>
                <a href="{{ route('admin.orders.live') }}"
                    class="flex items-center px-4 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.orders.live') ? 'bg-white text-slate-950 shadow-lg shadow-cyan-500/10' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3M4 11h16M5 19h14a1 1 0 001-1v-7H4v7a1 1 0 001 1z"></path>
                    </svg>
                    Live Orders
                </a>
                <a href="{{ route('admin.orders.history') }}"
                    class="flex items-center px-4 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.orders.history') ? 'bg-white text-slate-950 shadow-lg shadow-cyan-500/10' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Order History
                </a>
                <a href="{{ route('admin.categories.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.categories.*') ? 'bg-white text-slate-950 shadow-lg shadow-cyan-500/10' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                        </path>
                    </svg>
                    Categories
                </a>
                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.users.*') ? 'bg-white text-slate-950 shadow-lg shadow-cyan-500/10' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                        </path>
                    </svg>
                    Users
                </a>

                <a href="{{ route('admin.contact-messages.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.contact-messages.*') ? 'bg-white text-slate-950 shadow-lg shadow-cyan-500/10' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 15a4 4 0 01-4 4H8l-5 3V7a4 4 0 014-4h10a4 4 0 014 4v8z"></path>
                    </svg>
                    Contact Inbox
                </a>

            </nav>
            <div class="m-4 rounded-2xl border border-white/10 bg-white/5 p-4">
                <p class="text-xs text-slate-400">Signed in as</p>
                <p class="mt-1 truncate text-sm font-semibold">{{ auth()->user()->name ?? 'Admin' }}</p>
            </div>
            <div class="p-4 border-t border-white/10">
                <form action="" method="POST" class="w-full">
                    @csrf
                    <button type="submit"
                        class="flex items-center w-full px-4 py-3 rounded-xl hover:bg-red-500/10 text-sm text-left text-slate-300 hover:text-red-200 transition">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 p-5 sm:p-8 lg:ml-72">
            @if (session('success'))
                <div
                    class="mb-5 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-700 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div
                    class="mb-5 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm font-medium text-red-700 shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    @yield('scripts')
    @stack('scripts')
</body>

</html>
