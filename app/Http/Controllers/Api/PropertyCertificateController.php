<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Property\Certificate\IndexPropertyCertificateFormRequest;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PropertyCertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function index(IndexPropertyCertificateFormRequest $request, Property $property) : JsonResponse
    {
        return response()->json($property->certificate()->paginate($request->input('limit')), Response::HTTP_OK);
    }
}
