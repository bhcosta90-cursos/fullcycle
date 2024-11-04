<?php

declare(strict_types = 1);

use App\Http\Resources\CategoryResource;
use App\Models\Category;

it('returns the correct structure for a single category', function () {
    $category = Category::factory()->create();

    $resource = new CategoryResource($category);
    $response = $resource->toArray(request());

    expect($response)->toBe([
        'id'         => $category->id,
        'name'       => $category->name,
        'is_global'  => $category->is_global,
        'created_at' => $category->created_at->format('Y-m-d H:i:s'),
        'updated_at' => $category->updated_at->format('Y-m-d H:i:s'),
    ]);
});

it('returns the correct structure for a collection of categories', function () {
    $categories = Category::factory(3)->create();

    $resourceCollection = CategoryResource::collection($categories);
    $response           = $resourceCollection->response()->getData(true);

    expect($response)->toHaveKey('data')
        ->and($response['data'])->toHaveCount(3);
});
