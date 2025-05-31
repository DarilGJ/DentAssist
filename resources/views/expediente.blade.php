?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expediente Médico - {{ $medicalRecord->patient->name }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #059669;
        }

        .header h1 {
            color: #065f46;
            font-size: 26px;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .header .clinic-info {
            color: #6b7280;
            font-size: 11px;
            margin-bottom: 5px;
        }

        .patient-header {
            background: #ecfdf5;
            border: 2px solid #059669;
            border-radius: 8px;
            padding: 18px;
            margin-bottom: 25px;
        }

        .patient-name {
            font-size: 22px;
            font-weight: bold;
            color: #065f46;
            margin-bottom: 8px;
        }

        .appointment-info {
            display: table;
            width: 100%;
        }

        .appointment-detail {
            display: table-cell;
            width: 50%;
            padding-right: 15px;
        }

        .section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }

        .section-title {
            background: #065f46;
            color: white;
            padding: 10px 15px;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 12px;
            border-radius: 5px;
        }

        .info-grid {
            display: table;
            width: 100%;
            border-collapse: collapse;
        }

        .info-row {
            display: table-row;
        }

        .info-label {
            display: table-cell;
            padding: 12px 15px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            font-weight: bold;
            width: 25%;
            vertical-align: top;
        }

        .info-value {
            display: table-cell;
            padding: 12px 15px;
            background: white;
            border: 1px solid #e2e8f0;
            vertical-align: top;
        }

        .diagnosis-treatment {
            background: #fef7ff;
            border: 2px solid #a855f7;
            border-radius: 8px;
            padding: 15px;
            margin: 15px 0;
        }

        .diagnosis-title {
            color: #7c2d12;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .diagnosis-content {
            color: #374151;
            line-height: 1.6;
            min-height: 50px;
            white-space: pre-wrap;
        }

        .treatment-section {
            background: #f0f9ff;
            border: 2px solid #0ea5e9;
            border-radius: 8px;
            padding: 15px;
            margin: 15px 0;
        }

        .treatment-title {
            color: #0c4a6e;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .treatment-content {
            color: #374151;
            line-height: 1.6;
            min-height: 50px;
            white-space: pre-wrap;
        }

        .additional-info {
            display: table;
            width: 100%;
            margin-top: 20px;
        }

        .additional-col {
            display: table-cell;
            width: 50%;
            padding: 10px;
            vertical-align: top;
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            text-align: center;
            display: inline-block;
        }

        .status-yes {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .status-no {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .signature-section {
            margin-top: 50px;
            display: table;
            width: 100%;
            page-break-inside: avoid;
        }

        .signature-box {
            display: table-cell;
            width: 45%;
            text-align: center;
            padding: 20px;
            vertical-align: bottom;
        }

        .signature-line {
            border-bottom: 2px solid #333;
            margin-bottom: 8px;
            height: 50px;
        }

        .footer {
            position: fixed;
            bottom: 15px;
            left: 20px;
            right: 20px;
            text-align: center;
            font-size: 9px;
            color: #9ca3af;
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
        }
    </style>
</head>
<body>
<div class="header">
    <h1>EXPEDIENTE MÉDICO</h1>
    <div class="clinic-info">
        <strong>Centro Médico Dental</strong><br>
        Dirección de la clínica | Teléfono: (000) 000-0000<br>
        Email: info@clinica.com
    </div>
    <div class="clinic-info" style="margin-top: 12px;">
        <strong>Fecha de impresión:</strong> {{ now()->format('d/m/Y H:i:s') }}
    </div>
</div>

<div class="patient-header">
    <div class="patient-name">{{ $medicalRecord->patient->name }}</div>
    <div class="appointment-info">
        <div class="appointment-detail">
            <strong>No. de Cita:</strong> {{ $medicalRecord->appointment->id }}<br>
            <strong>Fecha de Cita:</strong> {{ $medicalRecord->appointment->date ?? 'No especificada' }}
        </div>
        <div class="appointment-detail">
            <strong>Expediente generado:</strong> {{ now()->format('d/m/Y H:i:s') }}<br>
            <strong>Registro creado:</strong> {{ $medicalRecord->created_at->format('d/m/Y H:i:s') }}
        </div>
    </div>
</div>

{{-- Información del Paciente si está disponible --}}
@if($medicalRecord->patient)
    <div class="section">
        <div class="section-title">INFORMACIÓN DEL PACIENTE</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Nombre Completo</div>
                <div class="info-value">{{ $medicalRecord->patient->name }}</div>
            </div>
            @if(isset($medicalRecord->patient->email))
                <div class="info-row">
                    <div class="info-label">Email</div>
                    <div class="info-value">{{ $medicalRecord->patient->email }}</div>
                </div>
            @endif
            @if(isset($medicalRecord->patient->phone))
                <div class="info-row">
                    <div class="info-label">Teléfono</div>
                    <div class="info-value">{{ $medicalRecord->patient->phone }}</div>
                </div>
            @endif
            @if(isset($medicalRecord->patient->date_of_birth))
                <div class="info-row">
                    <div class="info-label">Fecha de Nacimiento</div>
                    <div class="info-value">
                        {{ $medicalRecord->patient->date_of_birth->format('d/m/Y') }}
                        ({{ $medicalRecord->patient->date_of_birth->age }} años)
                    </div>
                </div>
            @endif
        </div>
    </div>
@endif

{{-- Diagnóstico --}}
<div class="section">
    <div class="section-title">DIAGNÓSTICO MÉDICO</div>
    <div class="diagnosis-treatment">
        <div class="diagnosis-title">DIAGNÓSTICO:</div>
        <div class="diagnosis-content">{{ $medicalRecord->diagnosis ?: 'No se ha registrado diagnóstico' }}</div>
    </div>
</div>

{{-- Tratamiento --}}
<div class="section">
    <div class="section-title">TRATAMIENTO PRESCRITO</div>
    <div class="treatment-section">
        <div class="treatment-title">TRATAMIENTO:</div>
        <div class="treatment-content">{{ $medicalRecord->treatment ?: 'No se ha registrado tratamiento' }}</div>
    </div>
</div>

{{-- Información Adicional --}}
<div class="section">
    <div class="section-title">ESTUDIOS Y DOCUMENTACIÓN</div>
    <div class="additional-info">
        <div class="additional-col">
            <strong>Rayos X:</strong><br>
            <span class="status-badge {{ $medicalRecord->xray == 'Si' ? 'status-yes' : 'status-no' }}">
                    {{ $medicalRecord->xray ?: 'No' }}
                </span>
            @if($medicalRecord->xray == 'Si')
                <div style="margin-top: 8px; font-size: 10px; color: #666;">
                    Se requiere adjuntar las imágenes radiográficas correspondientes.
                </div>
            @endif
        </div>
        <div class="additional-col">
            <strong>Fotografías Clínicas:</strong><br>
            <span class="status-badge {{ $medicalRecord->photo == 'Si' ? 'status-yes' : 'status-no' }}">
                    {{ $medicalRecord->photo ?: 'No' }}
                </span>
            @if($medicalRecord->photo == 'Si')
                <div style="margin-top: 8px; font-size: 10px; color: #666;">
                    Se requiere adjuntar las fotografías clínicas correspondientes.
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Información de la Cita --}}
@if($medicalRecord->appointment)
    <div class="section">
        <div class="section-title">INFORMACIÓN DE LA CITA</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Número de Cita</div>
                <div class="info-value">{{ $medicalRecord->appointment->id }}</div>
            </div>
            @if(isset($medicalRecord->appointment->date))
                <div class="info-row">
                    <div class="info-label">Fecha de la Cita</div>
                    <div class="info-value">{{ $medicalRecord->appointment->date }}</div>
                </div>
            @endif
            @if(isset($medicalRecord->appointment->time))
                <div class="info-row">
                    <div class="info-label">Hora de la Cita</div>
                    <div class="info-value">{{ $medicalRecord->appointment->time }}</div>
                </div>
            @endif
            @if(isset($medicalRecord->appointment->status))
                <div class="info-row">
                    <div class="info-label">Estado de la Cita</div>
                    <div class="info-value">{{ $medicalRecord->appointment->status }}</div>
                </div>
            @endif
        </div>
    </div>
@endif

{{-- Firmas --}}
<div class="signature-section">
    <div class="signature-box">
        <div class="signature-line"></div>
        <strong>Firma del Médico</strong><br>
        Dr./Dra. _____________________<br>
        Registro Médico: ______________<br>
        Fecha: {{ now()->format('d/m/Y') }}
    </div>

    <div style="display: table-cell; width: 10%;"></div>

    <div class="signature-box">
        <div class="signature-line"></div>
        <strong>Firma del Paciente</strong><br>
        {{ $medicalRecord->patient->name }}<br>
        Fecha: {{ now()->format('d/m/Y') }}
    </div>
</div>

<div class="footer">
    <p><strong>CONFIDENCIAL:</strong> Este documento contiene información médica confidencial protegida por las leyes de privacidad médica.</p>
    <p>Expediente médico generado automáticamente - {{ now()->format('d/m/Y H:i:s') }}</p>
</div>
</body>
</html>
