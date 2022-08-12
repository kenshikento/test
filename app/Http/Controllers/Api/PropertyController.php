<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Property\IndexPropertyFormRequest;
use App\Http\Requests\Api\Property\StorePropertyFormRequest;
use App\Http\Requests\Api\Property\UpdatePropertyFormRequest;
use App\Models\Property;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function index(IndexPropertyFormRequest $request) : JsonResponse
    {
        return response()->json(Property::paginate($request->input('limit')), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Http\JsonResponse
     */
    public function store(StorePropertyFormRequest $request) : JsonResponse
    {
        Property::create($request->validated());

        return response()->json(Response::HTTP_CREATED);  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Illuminate\Http\JsonResponse
     */
    public function show(Property $id) : JsonResponse
    {
        return response()->json($id, Response::HTTP_OK);   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Property  $id
     * @return Illuminate\Http\JsonResponse
     */
    public function update(UpdatePropertyFormRequest $request, Property $model) : JsonResponse
    {
        $model->update($request->validated());

        return response()->json(Response::HTTP_OK);
    }

    /**
     * Task doesnt not specify if resource should be forced deleted so going for soft delete approach
     *
     * @param  int  $id
     * @return Illuminate\Http\JsonResponse
     */
    public function delete(Property $model) : JsonResponse
    {
        $model->delete();

        return response()->json(Response::HTTP_OK);
    }
}
