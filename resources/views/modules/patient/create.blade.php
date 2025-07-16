@extends('layouts.guest')

@section('title', 'Crear paciente')

@section('content')
    <h1>Formulario De Pacientes</h1>
    <div class="row mb-3"></div>

    <form action="{{ route('simple.patient.store') }}" method="POST">
        @csrf
        <fieldset class="row">
            <h2>Paciente</h2>

            <div class="mb-3 col-6">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 col-6">
                <label for="surname" class="form-label">Apellido</label>
                <input type="text" id="surname" name="surname" class="form-control @error('surname') is-invalid @enderror">
                @error('surname')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 col-12">
                <label for="allergies" class="form-label">Alergias</label>
                <input type="text" id="allergies" name="allergies" class="form-control @error('allergies') is-invalid @enderror">
                @error('allergies')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 col-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror">
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 col-6">
                <label for="phone" class="form-label">Telefono</label>
                <input type="number" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror">
                @error('phone')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 col-6">
                <label for="gender" class="form-label">Genero</label>
                <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror">
                    <option value="">Seleccione una opcion</option>
                    <option value="male">Hombre</option>
                    <option value="female">Mujer</option>
                    <option value="other">Otro</option>
                </select>
                @error('gender')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 col-6">
                <label for="address" class="form-label">Direccion</label>
                <input type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror">
                @error('address')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 col-6">
                <label for="birth_at" class="form-label">Fecha de Nacimiento</label>
                <input type="date" id="birth_at" name="birth_at" max="{{\Illuminate\Support\Carbon::now()->toDateString() }}" class="form-control @error('birth_at') is-invalid @enderror">
                @error('birth_at')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 col-6">
                <label for="martial_status" class="form-label">Estado Civil</label>
                <select name="marital_status" id="marital_status" class="form-control @error('marital_status') is-invalid @enderror">
                    <option value="">Seleccione una opcion</option>
                    <option value="married">Casad@</option>
                    <option value="single">Solter@</option>
                    <option value="divorced">Divorciad@</option>
                    <option value="widowed">Viud@</option>
                    <option value="separated">Separad@</option>
                </select>
                @error('marital_status')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </fieldset>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-success me-md-2" id="bSubmitPatientCreate">Crear Paciente</button>
        </div>
    </form>
@endsection
