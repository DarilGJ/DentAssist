<?php

namespace App\Http\Controllers;

use App\Enums\GenderEnum;
use App\Enums\MaritalStatusEnum;
use App\Http\Resources\PatientResource;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::all();

        return $patients;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'surname' => 'nullable|string|max:255',
            'birth_at' => 'required|date_format:Y-m-d',
            'phone' => 'required|string|max:8',
            'gender' => [
                'required',
                'string',
                \Illuminate\Validation\Rule::in(GenderEnum::getValuesToArray()),
            ],
            'marital_status' => [
                'required',
                'string',
                \Illuminate\Validation\Rule::in(MaritalStatusEnum::getValuesToArray()),
            ],
            'email' => 'required|string|email|max:255|unique:patients',
            'allergies' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors(), 422);
        }

        $patient = Patient::create([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'birth_at' => $request->input('birth_at'),
            'phone' => $request->input('phone'),
            'gender' => $request->input('gender'),
            'marital_status' => $request->input('marital_status'),
            'email' => $request->input('email'),
            'allergies' => $request->input('allergies'),
            'address' => $request->input('address'),
        ]);

        return response()->json([
            'message' => 'Successfully created patient!',
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        return PatientResource::make($patient);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        //
    }
}
