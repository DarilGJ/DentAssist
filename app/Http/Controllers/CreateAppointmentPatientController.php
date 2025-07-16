<?php

namespace App\Http\Controllers;

use App\Enums\AppointmentStatusEnum;
use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Http\Request;

class CreateAppointmentPatientController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function create(Patient $patient)
    {
        return view('modules.patient.create-appointment', ['patient' => $patient]);
    }

    public function store(Request $request, Patient $patient)
    {
        $request->validate([
            'date' => 'required|date|date_format:Y-m-d',
            'hour' => 'required|date_format:H:i',
        ]);
        $appointment = $patient->appointments()->create([
            'user_id' => 1,
            'date_at' => $request->input('date'),
            'hour_in' => $request->input('hour'),
            'type' => $request->input('type', 'consult'),
            'status' => $request->input('status', 'scheduled'),
            'reason' => $request->input('reason'),
        ]);

        // return back()->with('success', 'Appointment created!');
        return redirect()->route('simple.confirm-appointment.edit', $appointment);

    }

    public function edit(Appointment $confirmAppointment)
    {
        return view('modules.patient.confirmacion-cita', ['appointment' => $confirmAppointment]);
    }

    public function update(Request $request, Appointment $confirmAppointment)
    {
        $request->validate([
            'type' => 'required',
            'reason' => 'string',
        ]);

        $appointment = $confirmAppointment->update([
            'type' => $request->get('type'),
            'status' => AppointmentStatusEnum::Confirmed,
            'reason' => $request->get('reason'),
        ]);

        return view('modules.patient.success', ['appointment' => $confirmAppointment]);
    }

    public function destroy(Appointment $confirmAppointment)
    {
        $confirmAppointment->delete();

        return redirect()->route('simple.appointment.create', $confirmAppointment);
    }
}
