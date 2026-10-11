<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactMessageRequest;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    public function store(StoreContactMessageRequest $request)
    {
        ContactMessage::create($request->validated());

        return redirect()
            ->to(route('contact') . '#contact-form')
            ->with('contact_success', 'Votre message a bien été envoyé. Nous vous répondrons dans les plus brefs délais.');
    }
}
