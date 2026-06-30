@extends('admin.layout')

@section('title', 'Contact Message')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-950">Message #{{ $contactMessage->id }}</h1>
        <p class="mt-1 text-sm text-slate-600">Reply to the user and track status in admin inbox.</p>
    </div>

    <div class="grid gap-6 lg:grid-cols-[1fr_360px]">
        <div class="rounded-3xl border border-white bg-white/95 shadow-xl shadow-slate-200/70 overflow-hidden">
            <div class="border-b border-slate-100 px-6 py-4">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-cyan-600">Sender</p>
                        <div class="mt-2 text-lg font-bold text-slate-950">{{ $contactMessage->name }}</div>
                        <div class="text-sm text-slate-500">{{ $contactMessage->email }}</div>
                    </div>
                    <div>
                        <span
                            class="inline-flex items-center rounded-full px-3 py-1 text-xs font-bold {{ $contactMessage->status === 'unread' ? 'bg-cyan-50 text-cyan-700' : ($contactMessage->status === 'replied' ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-200 text-slate-700') }}">
                            {{ $contactMessage->status }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="px-6 py-5">
                <div class="mb-4">
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400">Subject</p>
                    <div class="mt-2 text-base font-bold text-slate-950">{{ $contactMessage->subject }}</div>
                </div>

                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400">Message</p>
                    <div
                        class="mt-2 whitespace-pre-wrap rounded-2xl border border-slate-100 bg-slate-50 p-4 text-sm text-slate-700">
                        {{ $contactMessage->message }}
                    </div>
                </div>

                <div class="mt-6">
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400">Admin reply</p>
                    @if (!empty($contactMessage->admin_reply))
                        <div
                            class="mt-2 whitespace-pre-wrap rounded-2xl border border-emerald-100 bg-emerald-50 p-4 text-sm text-emerald-800">
                            {{ $contactMessage->admin_reply }}
                        </div>
                        <div class="mt-2 text-xs text-slate-500">
                            Replied at: {{ optional($contactMessage->replied_at)->format('Y-m-d H:i') }}
                        </div>
                    @else
                        <div class="mt-2 text-sm text-slate-500">No reply yet.</div>
                    @endif
                </div>
            </div>
        </div>

        <div class="rounded-3xl border border-white bg-white/95 shadow-xl shadow-slate-200/70 p-6">
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-cyan-600">Reply</p>
            <h2 class="mt-2 text-xl font-black text-slate-950">Send response</h2>

            <form method="POST" action="{{ route('admin.contact-messages.reply', $contactMessage) }}"
                class="mt-4 space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Admin reply</label>
                    <textarea name="admin_reply" required rows="8"
                        class="w-full rounded-2xl border border-slate-200 bg-white p-3 text-sm outline-none focus:border-cyan-300 focus:ring-2 focus:ring-cyan-100">{{ old('admin_reply') ?? $contactMessage->admin_reply }}</textarea>
                </div>

                <button type="submit"
                    class="w-full rounded-2xl bg-cyan-500 px-4 py-3 text-sm font-bold text-slate-950 hover:bg-cyan-400 transition">
                    Save Reply
                </button>

                <a href="{{ route('admin.contact-messages.index') }}"
                    class="block w-full text-center rounded-2xl border border-slate-200 px-4 py-3 text-sm font-bold text-slate-700 hover:border-cyan-300 hover:text-cyan-700 transition">
                    Back to Inbox
                </a>
            </form>
        </div>
    </div>
@endsection
