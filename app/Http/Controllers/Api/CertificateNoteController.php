<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Certificate\Note\IndexCertificateNoteFormRequest;
use App\Http\Requests\Api\Certificate\Note\StoreCertificateNoteFormRequest;
use App\Models\Certificate;
use App\Models\Note;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CertificateNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Illuminate\Http\JsonResponse;
     */
    public function index(IndexCertificateNoteFormRequest $request, Certificate $id) : JsonResponse
    {
        return response()->json(Certificate::paginate($request->input('input')), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Http\JsonResponse
     */
    public function store(StoreCertificateNoteFormRequest $request, Certificate $certificate) : JsonResponse
    {
        Note::create([
            'model_type' => Certificate::CERTIFICATE,
            'model_id'   => $certificate->id,
            'note'       => $request->input('note')
        ]);

        return response()->json(Response::HTTP_CREATED);  
    }
}
