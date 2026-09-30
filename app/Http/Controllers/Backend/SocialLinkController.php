<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UpdateSocialLinkRequest;
use App\Models\SocialLink;
use Inertia\Inertia;

class SocialLinkController extends Controller
{
    /**
     * Show the social links settings page.
     */
    public function index()
    {
        $socialLink = SocialLink::first();

        if (! $socialLink) {
            $socialLink = new SocialLink([
                'facebook'  => '',
                'linkedin'  => '',
                'youtube'   => '',
                'instagram' => '',
                'whatsapp'  => '',
            ]);
            $socialLink->id = null;
        }

        return Inertia::render('Backend/SocialLink/Index', [
            'socialLink' => $socialLink,
        ]);
    }

    /**
     * Update the social links (singleton).
     */
    public function update(UpdateSocialLinkRequest $request, ?SocialLink $socialLink = null)
    {
        $validated = $request->validated();

        if ($socialLink && $socialLink->exists) {
            $socialLink->update($validated);
        } else {
            $socialLink = SocialLink::create($validated);
        }

        return redirect()
            ->route('backend.social-link.index')
            ->with('success', 'Social links updated successfully.');
    }
}