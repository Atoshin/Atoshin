<?php

namespace Modules\Admin\Http\Controllers\v1;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\newsletter\NewsletterStoreRequest;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class NewsletterController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int)$request->query('per_page', 15);
        $perPage = max(1, min($perPage, 500));

        $query = QueryBuilder::for(Newsletter::query())
            ->allowedSorts(['id', 'email', 'created_at'])
            ->defaultSort('-id')
            ->allowedFilters([
                AllowedFilter::partial('email'),
            ]);

        $paginated = $query
            ->paginate($perPage)
            ->appends($request->query());

        return response()->json($paginated);
    }

    public function store(NewsletterStoreRequest $request)
    {
        $newsletter = Newsletter::create([
            'email' => $request->validated()['email'],
        ]);

        return response()->json([
            'message' => 'Email subscribed successfully.',
            'data' => $newsletter,
        ], 201);
    }

    public function destroy(Newsletter $newsletter)
    {
        $newsletter->delete();

        return response()->json([
            'message' => 'Email removed from newsletter.',
        ]);
    }
}
