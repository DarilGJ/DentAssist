<?php

namespace App\Http\Controllers;

use App\Enums\GenderEnum;
use App\Enums\MaritalStatusEnum;
use App\Models\Patient;
use Illuminate\Http\Request;

class CreatePatientController extends Controller
{
    public function create()
    {
        return view('modules.patient.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'nullable|string|max:255',
            'birth_at' => 'required|date_format:Y-m-d',
            'phone' => 'required|string|max:8',
            'gender' => [
                'required',
                \Illuminate\Validation\Rule::in(GenderEnum::getValuesToArray()),
            ],
            'marital_status' => [
                \Illuminate\Validation\Rule::in(MaritalStatusEnum::getValuesToArray()),
            ],
            'email' => 'required|email|max:255|unique:patients',
            'allergies' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        $patient = Patient::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'birth_at' => $request->birth_at,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'marital_status' => $request->marital_status,
            'email' => $request->email,
            'allergies' => $request->allergies,
            'address' => $request->address,
        ]);

        return redirect()->route('simple.appointment.create', $patient);
    }
}
