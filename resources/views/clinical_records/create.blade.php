<x-layouts.app title="Registrar Expediente Clínico">
    <div class="max-w-4xl mx-auto p-6 mt-10 bg-white rounded-xl shadow-md space-y-6">

        <h2 class="text-2xl font-bold text-gray-800">🩺 Registrar Expediente Clínico</h2>

        <form action="{{ route('expedientes.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Sección I -->
            <section>
                <h3 class="text-lg font-semibold mb-3 border-b pb-1">I. Información del paciente</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium">Nombre completo</label>
                        <input type="text" name="name" class="input" required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Fecha de nacimiento</label>
                        <input type="date" name="birthdate" class="input" required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Género</label>
                        <select name="gender" class="input" required>
                            <option value="">Seleccione</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Teléfono</label>
                        <input type="text" name="phone" class="input" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Dirección</label>
                        <input type="text" name="address" class="input" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Correo electrónico</label>
                        <input type="email" name="email" class="input" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Contacto de emergencia</label>
                        <input type="text" name="emergency_contact" class="input" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Número de registro médico</label>
                        <input type="text" name="medical_record_number" class="input" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium">DPI</label>
                        <input type="text" name="dpi" class="input" required />
                     </div>
                </div>
            </section>

            <!-- Sección II -->
            <section>
                <h3 class="text-lg font-semibold mb-3 border-b pb-1">II. Historial médico</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium">Condiciones previas</label>
                        <textarea name="conditions" rows="2" class="input"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Cirugías realizadas</label>
                        <textarea name="surgeries" rows="2" class="input"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Alergias</label>
                        <textarea name="allergies" rows="2" class="input"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Antecedentes familiares</label>
                        <textarea name="family_history" rows="2" class="input"></textarea>
                    </div>
                </div>
            </section>

            <!-- Sección III -->
            <section>
                <h3 class="text-lg font-semibold mb-3 border-b pb-1">III. Medicamentos actuales</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium">Nombre del medicamento</label>
                        <input type="text" name="medication_name" class="input" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Frecuencia / Dosis</label>
                        <input type="text" name="medication_frequency" class="input" />
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium">Observaciones</label>
                        <textarea name="medication_observations" rows="2" class="input"></textarea>
                    </div>
                </div>
            </section>

            <div class="text-right">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    💾 Guardar Expediente
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>