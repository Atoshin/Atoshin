<?php

namespace Modules\Admin\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Modules\Admin\Http\Requests\gallery\GalleryStoreRequest;
use Modules\Admin\Http\Requests\gallery\GalleryUpdateRequest;
use Modules\Admin\Transformers\GalleryResource;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->integer('per_page', 15);
        $perPage = max(1, min($perPage, 500));

        $query = QueryBuilder::for(Gallery::query())
            ->allowedIncludes([
                'location',
                'medias',
                'wallet',
                'videoLinks',
                'assets',
            ])
            ->allowedSorts([
                'id',
                'name',
                'status',
                'created_at',
            ])
            ->defaultSort('-id')
            ->allowedFilters([
                AllowedFilter::callback('search', function ($q, $value) {
                    $value = trim((string) $value);
                    if ($value === '') return;

                    $q->where(function ($qq) use ($value) {
                        $qq->where('name', 'LIKE', "%{$value}%")
                            ->orWhere('website', 'LIKE', "%{$value}%")
                            ->orWhere('instagram', 'LIKE', "%{$value}%")
                            ->orWhere('twitter', 'LIKE', "%{$value}%")
                            ->orWhere('youtube', 'LIKE', "%{$value}%");
                    });
                }),
                AllowedFilter::exact('status'),
            ]);

        $paginator = $query->paginate($perPage)->appends($request->query());

        return GalleryResource::collection($paginator);
    }

    public function store(GalleryStoreRequest $request)
    {
        $data = $request->validated();

        // default
        $data['status'] = $data['status'] ?? 'unpublished';

        $gallery = Gallery::create($data);

        return new GalleryResource($gallery);
    }

    public function show(Gallery $gallery)
    {
        // optionally allow ?include=...
        // QueryBuilder doesn't run here automatically; we can load manually:
        $include = request()->query('include');
        if (is_string($include) && $include !== '') {
            $relations = array_filter(array_map('trim', explode(',', $include)));
            $allowed = ['location','medias','wallet','videoLinks','assets'];
            $gallery->load(array_values(array_intersect($relations, $allowed)));
        }

        return new GalleryResource($gallery);
    }

    public function update(GalleryUpdateRequest $request, Gallery $gallery)
    {
        $data = $request->validated();
        $gallery->update($data);

        return new GalleryResource($gallery);
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return response()->noContent();
    }
}
