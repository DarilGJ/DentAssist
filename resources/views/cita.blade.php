
<x-layouts.guest>
    <h1>Citas</h1>

{{--            <a href="/cita/{{$appointment->patient_id}}">--}}
{{--                {{$appointment->date_at->format('d-m-Y')}},--}}
{{--                {{$appointment->hour_in}}--}}
{{--            </a>--}}

{{--            @section('content')--}}
{{--                <div class="container">--}}
{{--                    <h1>Citas Finalizadas</h1>--}}
{{--            @if($citasFinalizadas->count() > 0)--}}
{{--                <div class="row">--}}
{{--                </div>--}}
{{--                        <div class="mt-3">--}}
{{--                            <p class="text-muted">Total de citas finalizadas: {{ $citasFinalizadas->count() }}</p>--}}
{{--                        </div>--}}
{{--                    @else--}}
{{--                        <div class="alert alert-info">--}}
{{--                            <h4>No hay citas finalizadas</h4>--}}
{{--                            <p>Actualmente no existen citas con estado "Ended".</p>--}}
{{--                        </div>--}}
{{--                @endif--}}

                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="mb-4">Citas Finalizadas</h2>
                            @dd($citasFinalizadas, collect([1,2,3,4,5]))
                            @if($citasFinalizadas->count() > 0)
                                <div class="row">
                                    @foreach($citasFinalizadas as $cita)
                                        <p>
                                            {{$loop->count}}/{{$loop->iteration}}
                                        </p>
                                        <div class="col-md-6 col-lg-4 mb-4">
                                            <div class="card h-100">
                                                <div class="card-header bg-success text-white">
                                                    <h6 class="mb-0">
                                                        <i class="fas fa-calendar-check"></i>
                                                        Cita #{{ $cita->id }}
                                                    </h6>
                                                </div>
                                                <div class="card-body">
                                                    <p class="card-text">
                                                        <strong>📅 Fecha:</strong>
                                                        {{ \Carbon\Carbon::parse($cita->date_at)->format('d/m/Y') }}<br>

                                                        <strong>🕐 Hora:</strong>
                                                        {{ $cita->hour_in }}<br>

                                                        <strong>👤 Paciente ID:</strong>
                                                        {{ $cita->patient_id }}<br>

                                                        <strong>🏥 Tipo:</strong>
                                                        <span class="badge badge-primary">{{ ucfirst($cita->type->value) }}</span><br>

                                                        <strong>✅ Estado:</strong>
                                                        <span class="badge badge-success">{{ $cita->status->getLabel() }}</span>
                                                </div>
                                                <div class="card-footer text-muted small">
                                                    Actualizada: {{ \Carbon\Carbon::parse($cita->updated_at)->diffForHumans() }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div>
                                    <h4>😔 No hay citas finalizadas</h4>
                                    <p>Aún no tienes citas con estado "Finalizado"</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>



</x-layouts.guest>
