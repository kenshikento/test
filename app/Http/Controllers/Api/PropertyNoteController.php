<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Property\Note\IndexPropertyNoteFormRequest;
use App\Http\Requests\Api\Property\Note\StorePropertyNoteFormRequest;
use App\Models\Note;
use App\Models\Property;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PropertyNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function index(IndexPropertyNoteFormRequest $request, Property $property) : JsonResponse
    {
        return response()->json($property->notes()->paginate($request->input('limit')), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Http\JsonResponse
     */
    public function store(StorePropertyNoteFormRequest $request, Property $property) : JsonResponse
    {
        Note::create([
            'model_type' => Property::PROPERTY,
            'model_id'   => $property->id,
            'note'       => $request->input('note')
        ]);

        return response()->json(Response::HTTP_CREATED);  
    }
}
