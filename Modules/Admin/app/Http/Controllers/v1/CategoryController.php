<?php

namespace Modules\Admin\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Modules\Admin\Http\Requests\CategoryStoreRequest;
use Modules\Admin\Transformers\CategoryResource;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int)$request->input('page.size', 15);
        $perPage = max(1, min($perPage, 100)); // سقف منطقی

        $categories = QueryBuilder::for(Category::class)
            ->allowedIncludes(['parent', 'children']) // include=parent,children
            ->allowedSorts(['id', 'title', 'slug', 'status', 'type', 'created_at']) // sort=title یا sort=-id
            ->allowedFilters([
                AllowedFilter::partial('title'),
                AllowedFilter::partial('slug'),
                AllowedFilter::exact('status'),
                AllowedFilter::exact('type'),
                AllowedFilter::exact('parent_id'),

                AllowedFilter::callback('search', function ($query, $value) {
                    $query->where(function ($q) use ($value) {
                        $q->where('title', 'like', "%{$value}%")
                            ->orWhere('slug', 'like', "%{$value}%");
                    });
                }),
            ])
            ->defaultSort('-id')
            ->paginate($perPage)
            ->appends($request->query());

        return CategoryResource::collection($categories);
    }

    public function store(CategoryStoreRequest $request)
    {
        $data = $request->validated();
        $category = Category::create($data);
        $category->load('parent');
        return (new CategoryResource($category))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Category $category, Request $request)
    {
        $category = QueryBuilder::for(Category::whereKey($category->id))
            ->allowedIncludes(['parent', 'children'])
            ->firstOrFail();

        return new CategoryResource($category);
    }

    public function update(CategoryStoreRequest $request, Category $category)
    {
        $data = $request->validated();
        if (isset($data['parent_id']) && (int)$data['parent_id'] === (int)$category->id) {
            return response()->json([
                'message' => 'invalid parent id'
            ], 422);
        }
        if (isset($data['parent_id']) && $data['parent_id']) {
            $descendantIds = $category->getAllDescendantIds();
            if (in_array((int)$data['parent_id'], array_map('intval', $descendantIds), true)) {
                return response()->json([
                    'message' => 'invalid parent id'
                ], 422);
            }
        }
        $category->update($data);
        $category->refresh()->load('parent');

        return new CategoryResource($category);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'message' => 'Category deleted successfully.'
        ]);
    }
}
