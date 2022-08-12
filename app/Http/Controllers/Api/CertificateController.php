<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Certificate\CreateCertificateFormRequest;
use App\Http\Requests\Api\Certificate\IndexCertificateFormRequest;
use App\Models\Certificate;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function index(IndexCertificateFormRequest $request) : JsonResponse 
    {
        return response()->json(Certificate::paginate($request->input('limit')), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Http\JsonResponse
     */
    public function store(CreateCertificateFormRequest $request) : JsonResponse
    {
        Certificate::create($request->validated());

        return response()->json(Response::HTTP_CREATED);  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Illuminate\Http\JsonResponse
     */
    public function show(Certificate $id) : JsonResponse
    {
        return response()->json($id, Response::HTTP_OK);   
    }
}
