<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveEntityRequest;
use App\Models\Entity;
use App\Services\EntityService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class EntityController extends Controller
{
    public function index(Request $request): Response
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', Rule::in(Entity::CATEGORIES)],
        ]);
        $query = Entity::query();
        if (! empty($filters['search'])) {
            $query->where('name', 'like', '%'.$filters['search'].'%');
        }
        if (! empty($filters['category'])) {
            $query->where('category', $filters['category']);
        }

        return Inertia::render('Backend/Entity/Index', [
            'entities' => $query->ordered()->paginate(12)->withQueryString()->through(fn (Entity $entity) => $this->data($entity)),
            'filters' => $filters,
            'categories' => Entity::CATEGORIES,
            'stats' => [
                'total' => Entity::count(),
                'active' => Entity::active()->count(),
                'featured' => Entity::featured()->count(),
                'inactive' => Entity::where('is_active', false)->count(),
            ],
        ]);
    }

    public function edit(Entity $entity): Response
    {
        return Inertia::render('Backend/Entity/Edit', [
            'entity' => $this->data($entity),
            'categories' => Entity::CATEGORIES,
        ]);
    }

    private function data(Entity $entity): array
    {
        return [
            ...$entity->toArray(),
            'image_url' => $entity->media_id ? route('backend.entities.image', $entity, false).'?v='.$entity->media_id : null,
        ];
    }

    public function store(SaveEntityRequest $request, EntityService $service): RedirectResponse
    {
        $entity = new Entity;
        $service->save($entity, $request->entityData());

        return to_route('backend.entities.edit', $entity);
    }

    public function update(SaveEntityRequest $request, Entity $entity, EntityService $service): RedirectResponse
    {
        $service->save($entity, $request->entityData());

        return to_route('backend.entities.edit', $entity);
    }

    public function toggleActive(Entity $entity): RedirectResponse
    {
        $entity->update(['is_active' => ! $entity->is_active]);

        return back();
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
