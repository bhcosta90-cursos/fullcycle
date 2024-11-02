<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Package\Core\UseCase\Category\ListCategoryUseCase;

class CategoryController extends Controller
{
    public function index(Request $request, ListCategoryUseCase $listCategoryUseCase): AnonymousResourceCollection
    {
        $response = $listCategoryUseCase->handle($request->all(), $request->get('direction', 'asc'));

        return CategoryResource::collection(collect($response->items))
            ->additional([
                'meta' => [
                    'total'        => $response->total,
                    'per_page'     => $response->per_page,
                    'current_page' => $response->current_page,
                    'last_page'    => $response->last_page,
                    'from'         => $response->from,
                    'to'           => $response->to,
                    'first_page'   => $response->first_page,
                ],
            ]);
    }
}
