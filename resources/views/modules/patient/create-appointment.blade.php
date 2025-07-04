@extends('layouts.guest')

@section('title', 'Crear cita')

@section('content')
        <h1>Crear Citas</h1>

        <fieldset class="row">
            <h2>Paciente</h2>
            <div class="mb-3 col-6">
                <label for="name" class="form-label">Nombres</label>
                <input type="text" id="name" name="name" class="form-control" value="{{$patient->name}}" disabled/>

            </div>

            <div class="mb-3 col-6">
                <label for="surname" class="form-label">Apellidos</label>
                <input type="text" id="surname" name="surname" class="form-control" value="{{$patient->surname}}"
                       disabled/>
            </div>

            <div class="mb-3 col-12">
                <label for="allergies" class="form-label">Alergias</label>
                <input type="text" id="allergies" name="allergies" size="72" class="form-control"
                       value="{{$patient->allergies}}" disabled/>
            </div>

            <div class="mb-3 col-12 col-sm-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{$patient->email}}" disabled/>
            </div>

            <div class="mb-3 col-12 col-sm-4">
                <label for="phone" class="form-label">Telefono</label>
                <input type="tel" id="phone" name="phone" class="form-control" value="{{$patient->phone}}" disabled/>
            </div>

            <div class="mb-3 col-12 col-sm-4">
                <label for="gender" class="form-label">Genero</label>
                <input type="text" id="gender" name="gender" class="form-control" value="{{$patient->gender}}"
                       disabled/>
            </div>

            <div class="mb-3 col-12 col-sm-4">
                <label for="address" class="form-label">Direccion</label>
                <input type="text" id="address" name="address" class="form-control" value="{{$patient->address}}"
                       disabled/>
            </div>

            <div class="mb-3 col-12 col-sm-4">
                <label for="birth_at" class="form-label">Fecha de Nacimiento</label>
                <input type="date" id="birth_at" name="birth_at" class="form-control"
                       value="{{$patient->birth_at->format('Y-m-d')}}" disabled/>

            </div>

            <div class="mb-3 col-12 col-sm-4">
                <label for="marital_status" class="form-label">Estado Civil</label>
                <input type="text" id="marital_status" name="marital_status" class="form-control"
                       value="{{$patient->marital_status}}" disabled/>
            </div>
        </fieldset>
        <br>


        <form action="{{ route('simple.appointment.store', $patient) }}" method="POST">
            @csrf
            <fieldset class="row">
                <h2>Cita</h2>

                <div class="mb-3 col-6">
                    <label for="date" class="form-label">Fecha</label>
                    <input type="date" id="date" name="date" min="{{ \Illuminate\Support\Carbon::now()->toDateString() }}" class="form-control @error('date') is-invalid @enderror">
                    @error('date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 col-6">
                    <label for="hour" class="form-label">Hora</label>
                    <input type="time" id="hour" name="hour" min="08:00" max="18:00" class="form-control @error('hour') is-invalid @enderror">
                    @error('hour')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </fieldset>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-success me-md-2" id="bSubmitAppointmentCreate">Crear Cita</button>
            </div>
        </form>
@endsection
