@extends('layouts.guest')
@section('title', 'Success')
@section('content')
<h1>Success</h1>
<body>
<div class="container mt-5">
    <div class="alert alert-success text-center">
        <h2>¡Cita creada con éxito! 🎉</h2>
        <p class="lead">Gracias por usar el sistema DentAssist.</p>
    </div>

    <div class="card">
        <div class="card-header">
            Detalles de la cita
        </div>
        <div class="card-body">
            <p><strong>Fecha:</strong> {{ $appointment->date_at->format('d/m/Y') }}</p>
            <p><strong>Hora:</strong> {{ \Carbon\Carbon::parse($appointment->hour_in)->format('H:i') }}</p>
            <p><strong>Tipo:</strong> {{ $appointment->type->getLabel() }}</p>
            <p><strong>Estado:</strong> {{ $appointment->status->getLabel() }}</p>
        </div>
    </div>

</div>
</body>
@endsection
