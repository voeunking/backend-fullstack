@extends('admin.layout')

@section('title', 'Contact Messages')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-950">Contact Messages</h1>
        <p class="mt-1 text-sm text-slate-600">User messages sent from the contact page.</p>
    </div>

    <div class="rounded-3xl border border-white bg-white/95 shadow-xl shadow-slate-200/70 overflow-hidden">
        <div class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-100 px-6 py-4">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-cyan-600">Inbox</p>
                <h2 class="mt-1 text-xl font-black text-slate-950">All messages</h2>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">From</th>
                        <th class="px-6 py-4">Subject</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Received</th>
                        <th class="px-6 py-4">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($messages as $msg)
                        <tr class="transition hover:bg-cyan-50/40">
                            <td class="px-6 py-4 font-bold text-slate-400">#{{ $msg->id }}</td>
                            <td class="px-6 py-4">
                                <div class="font-semibold text-slate-900">{{ $msg->name }}</div>
                                <div class="text-xs text-slate-500">{{ $msg->email }}</div>
                            </td>
                            <td class="px-6 py-4 font-semibold text-slate-900">{{ $msg->subject }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $badge = 'bg-slate-100 text-slate-700';
                                    if ($msg->status === 'unread') {
                                        $badge = 'bg-cyan-50 text-cyan-700';
                                    }
                                    if ($msg->status === 'replied') {
                                        $badge = 'bg-emerald-50 text-emerald-700';
                                    }
                                    if ($msg->status === 'closed') {
                                        $badge = 'bg-slate-200 text-slate-700';
                                    }
                                @endphp
                                <span
                                    class="inline-flex items-center rounded-full px-3 py-1 text-xs font-bold {{ $badge }}">{{ $msg->status }}</span>
                            </td>
                            <td class="px-6 py-4 text-slate-500">{{ $msg->created_at->format('Y-m-d H:i') }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.contact-messages.show', $msg) }}"
                                    class="rounded-2xl border border-slate-200 px-4 py-2 text-xs font-bold text-slate-700 transition hover:border-cyan-300 hover:text-cyan-700">
                                    View / Reply
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500">No contact messages yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4">
            {{ $messages->links() }}
        </div>
    </div>
@endsection
