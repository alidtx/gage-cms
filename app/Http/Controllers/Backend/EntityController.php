<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveEntityRequest;
use App\Models\Entity;
use App\Services\EntityService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class EntityController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Backend/Entity/Index', [
            'entities' => Entity::latest('id')->paginate(10)->through(fn (Entity $entity) => [
                ...$entity->toArray(),
                'image_url' => $entity->media_id ? route('backend.entities.image', $entity, false).'?v='.$entity->media_id : null,
            ]),
        ]);
    }

    public function store(SaveEntityRequest $request, EntityService $service): RedirectResponse
    {
        $service->save(new Entity, $request->validated());

        return to_route('backend.entities.index');
    }

    public function update(SaveEntityRequest $request, Entity $entity, EntityService $service): RedirectResponse
    {
        $service->save($entity, $request->validated());

        return to_route('backend.entities.index');
    }

    public function destroy(Entity $entity, EntityService $service): RedirectResponse
    {
        $service->delete($entity);

        return to_route('backend.entities.index');
    }

    public function image(Entity $entity): StreamedResponse
    {
        $media = $entity->media;
        abort_unless($media && Storage::exists($media->src), 404);

        return Storage::response($media->src, null, ['Cache-Control' => 'no-store, private']);
    }
}
