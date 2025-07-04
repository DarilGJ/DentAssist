<?php

namespace App\Http\Controllers;

use App\Models\Appointment;

class PostController extends Controller
{
    //    public function show(Appointment $appointment)
    //    {
    //            return view('cita', ['appointment' => $appointment]);
    //    }

    public function citasFinalizadas($status)
    {
        //

        // Obtener solo las citas con status 'Ended'
        $citasFinalizadas = Appointment::query()
            ->where('status', $status)
            ->orderBy('date_at', 'desc')
            ->get();

        return view('cita', compact('citasFinalizadas'));
    }
}
