@extends('admin.layout')

@section('title', 'Users Management')

@section('content')

    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <p class="text-sm text-slate-500">
                    Manage user accounts, permissions and roles
                </p>

                <h1 class="text-4xl font-black bg-gradient-to-r from-black to-blue-400 bg-clip-text text-transparent">
                    Users Management
                </h1>
            </div>
            <a href="{{ route('admin.users.create') }}"
                class="group flex items-center gap-2 px-5 py-3 rounded-2xl
                bg-gradient-to-r from-blue-600 to-indigo-400
                text-white font-bold shadow-lg
                hover:shadow-blue-300 hover:-translate-y-1 transition">

                <svg class="w-5 h-5 group-hover:rotate-90 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />

                </svg>
                Add User
            </a>

        </div>
        <!-- Card -->

        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl border border-slate-200 overflow-hidden">
            <!-- top -->
            <div class="px-6 py-5 bg-gradient-to-r from-slate-50 to-blue-50 flex justify-between">

                <h2 class="font-bold text-xl text-slate-800">
                    All Users
                </h2>
                <span class="px-4 py-2 rounded-full bg-blue-100 text-blue-700 font-bold text-sm">
                    {{ $users->total() }} Users
                </span>

            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-slate-100 text-slate-600 text-sm">
                            <th class="px-6 py-4 text-left">ID</th>

                            <th class="px-6 py-4 text-left">User</th>

                            <th class="px-6 py-4 text-left">Email</th>

                            <th class="px-6 py-4 text-left">Role</th>

                            <th class="px-6 py-4 text-left">Joined</th>

                            <th class="px-6 py-4 text-right">
                                Action
                            </th>
                        </tr>

                    </thead>
                    <tbody class="divide-y divide-slate-100">


                        @forelse($users as $user)
                            <tr
                                class="
                                hover:bg-blue-50/60
                                transition duration-300
                                group
                                ">
                                <td class="px-6 py-5 font-bold text-slate-500">

                                    #{{ $user->id }}

                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="
                                                w-12 h-12 rounded-2xl
                                                bg-gradient-to-br from-blue-500 to-purple-600
                                                text-white flex items-center justify-center
                                                font-black text-lg shadow
                                                ">

                                            {{ strtoupper(substr($user->name, 0, 1)) }}

                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800">
                                                {{ $user->name }}
                                            </p>
                                            <p class="text-xs text-slate-400">
                                                User Account
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-slate-600">

                                    {{ $user->email }}

                                </td>
                                <td class="px-6 py-5">
                                    @if ($user->role === 'admin')
                                        <span
                                            class="
                                                px-4 py-2 rounded-full
                                                bg-purple-100 text-purple-700
                                                font-bold text-xs
                                                ">
                                            👑 Admin
                                        </span>
                                    @else
                                        <span
                                            class="
                                                px-4 py-2 rounded-full
                                                bg-green-100 text-green-700
                                                font-bold text-xs
                                                ">
                                            User
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-5 text-slate-500">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                            <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ $user->created_at->format('M d, Y') }}
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('admin.users.edit', $user) }}"
                                            class="
                                                            px-4 py-2 rounded-xl
                                                            bg-blue-100 text-blue-700
                                                            font-bold text-sm
                                                            hover:bg-blue-600 hover:text-white
                                                            transition">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                            onsubmit="return confirm('Delete this user?')">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="
                                                    px-4 py-2 rounded-xl
                                                    bg-red-100 text-red-700
                                                    font-bold text-sm
                                                    hover:bg-red-600 hover:text-white
                                                    transition">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-12 text-slate-400">
                                    <div class="text-5xl mb-3">
                                        👤
                                    </div>
                                    No users found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($users->hasPages())
                <div class="px-6 py-5 border-t bg-slate-50">

                    {{ $users->links() }}

                </div>
            @endif
        </div>
    </div>

@endsection
