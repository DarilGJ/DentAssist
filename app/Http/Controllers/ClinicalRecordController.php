<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClinicalRecordController extends Controller
{
    public function create()
    {
        return view('clinical_records.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // Sección I: Información del paciente
            'name' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'gender' => 'required|in:Masculino,Femenino',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'emergency_contact' => 'nullable|string|max:255',
            'medical_record_number' => 'nullable|string|max:100',
            'dpi' => 'required|string|max:20|unique:clinical_records,dpi',
    
            // Sección II: Historial médico
            'conditions' => 'nullable|string',
            'surgeries' => 'nullable|string',
            'allergies' => 'nullable|string',
            'family_history' => 'nullable|string',
    
            // Sección III: Medicamentos actuales
            'medication_name' => 'nullable|string|max:255',
            'medication_frequency' => 'nullable|string|max:255',
            'medication_observations' => 'nullable|string|max:255',
        ]);
    
        // Aquí se guardará la información cuando tengamos el modelo
        // Por ahora, solo simulamos con redirección
        return redirect()->route('dashboard')->with('success', 'Expediente creado correctamente.');
    }
    
}
