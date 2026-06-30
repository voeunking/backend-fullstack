<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::orderByDesc('created_at')->paginate(10);

        return view('admin.contact-messages.index', compact('messages'));
    }

    public function show(ContactMessage $contactMessage)
    {
        return view('admin.contact-messages.show', compact('contactMessage'));
    }

    public function reply(Request $request, ContactMessage $contactMessage)
    {
        $data = $request->validate([
            'admin_reply' => ['required', 'string'],
        ]);

        $contactMessage->admin_reply = $data['admin_reply'];
        $contactMessage->replied_at = now();
        $contactMessage->status = 'replied';
        $contactMessage->save();

        return redirect()
            ->route('admin.contact-messages.show', $contactMessage)
            ->with('success', 'Reply saved successfully.');
    }
}

