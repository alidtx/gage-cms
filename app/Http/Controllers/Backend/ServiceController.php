<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveServiceRequest;
use App\Models\Entity;
use App\Models\Service;
use App\Services\ServiceManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ServiceController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Backend/Service/Index', [
            'services' => Service::with(['entity:id,name', 'media'])->latest('id')->paginate(12)->through(fn (Service $service) => [
                ...$service->only(['id', 'title', 'description', 'link', 'entity_id']),
                'entity' => $service->entity?->only(['id', 'name']),
                'icon_url' => $service->media?->name === 'Service SVG Icon' ? route('backend.services.image', $service, false).'?v='.$service->media_id : null,
            ]),
            'entities' => Entity::orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function store(SaveServiceRequest $request, ServiceManager $manager): RedirectResponse
    {
        $manager->save(new Service, $request->validated());

        return to_route('backend.services.index');
    }

    public function update(SaveServiceRequest $request, Service $service, ServiceManager $manager): RedirectResponse
    {
        $manager->save($service, $request->validated());

        return to_route('backend.services.index');
    }

    public function destroy(Service $service, ServiceManager $manager): RedirectResponse
    {
        $manager->delete($service);

        return to_route('backend.services.index');
    }

    public function image(Service $service): StreamedResponse
    {
        $media = $service->media;
        abort_unless($media && Storage::exists($media->src), 404);

        return Storage::response($media->src, null, ['Cache-Control' => 'no-store, private', 'Content-Type' => $media->name === 'Service SVG Icon' ? 'image/svg+xml' : Storage::mimeType($media->src), 'X-Content-Type-Options' => 'nosniff', 'Content-Security-Policy' => "default-src 'none'; sandbox"]);
    }
}
