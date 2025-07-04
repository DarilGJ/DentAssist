@extends('layouts.guest')
@section('title', 'Confirmacion de Cia')
@section('content')
    <h1>Confirmacion de Cita</h1>
    <div class="container mt-5">
        <div class="alert alert-info text-center">
            <h2>¡Ya Casi!, por favor complete el formulario</h2>
        </div>

        <div class="card">
            <div class="card-header">
                Detalles de la cita
            </div>
            <div class="card-body">
                <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($appointment->date_at)->format('d/m/Y') }}</p>
                <p><strong>Hora:</strong> {{ \Carbon\Carbon::parse($appointment->hour_in)->format('H:i') }}</p>
                <p><strong>Estado:</strong> {{ $appointment->status->getLabel() }}</p>
            </div>
        </div>
    </div>
        @if(session('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif

        <form action="{{ route('simple.confirm-appointment.update', $appointment) }}" method="POST">
            @csrf
            @method('PUT')
            <fieldset class="row">
                <h2>Cita</h2>

                <div class="mb-3 col-2">
                    <label for="type" class="form-label">Tipo de Cita</label>
                    <select name="type" id="type" class="form-control @error('type') is-invalid @enderror">
                        <option selected disabled value="">Selecione una opcion</option>
                        <option value="consult">Consulta</option>
                        <option value="treatment">Tratamiento</option>
                        <option value="control">Control</option>
                        <option value="urgent">Urgente</option>
                    </select>
                    @error('type')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 col-10">
                    <label for="reason" class="form-label">Descripcion</label>
                    <input type="text" id="reason" name="reason" class="form-control @error('reason') is-invalid @enderror">
                    @error('reason')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </fieldset>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-success me-md-2" id="bSubmitAppointmentConfirm">Confirmar Cita</button>
            </div>
        </form>
@endsection
