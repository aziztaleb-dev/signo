<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactMessageRequest;
use App\Models\ContactMessage;
use App\Models\ContactPageSetting;

class ContactController extends Controller
{
    public function index()
    {
        $sections = ContactPageSetting::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->keyBy('key');

        return view('front.contact', compact('sections'));

    }
    public function store(StoreContactMessageRequest $request)
    {
        ContactMessage::create($request->validated());

        return redirect()
            ->to(route('contact') . '#contact-form')
            ->with('contact_success', 'Votre message a bien été envoyé. Nous vous répondrons dans les plus brefs délais.');
    }
}
