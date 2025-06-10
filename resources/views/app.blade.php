<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DentBol - Vista Principal</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .main-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border-radius: 25px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 100%;
            max-width: 800px;
            min-height: 600px;
        }

        .header {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 40px;
            text-align: center;
            position: relative;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="30" r="1.5" fill="rgba(255,255,255,0.1)"/><circle cx="60" cy="70" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="30" cy="80" r="2.5" fill="rgba(255,255,255,0.1)"/></svg>');
        }

        .header-content {
            position: relative;
            z-index: 1;
        }

        .header h1 {
            font-size: 3rem;
            margin-bottom: 15px;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            animation: fadeInDown 1s ease;
        }

        .header p {
            font-size: 1.3rem;
            opacity: 0.9;
            animation: fadeInUp 1s ease 0.3s both;
        }

        .main-content {
            padding: 60px 40px;
            text-align: center;
        }

        .welcome-text {
            color: #555;
            font-size: 1.2rem;
            margin-bottom: 40px;
            line-height: 1.6;
            animation: fadeIn 1s ease 0.6s both;
        }

        .action-button {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
            color: white;
            padding: 20px 40px;
            border: none;
            border-radius: 50px;
            font-size: 1.3rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.4s ease;
            box-shadow: 0 10px 30px rgba(255, 107, 107, 0.4);
            position: relative;
            overflow: hidden;
            animation: fadeIn 1s ease 0.9s both;
        }

        .action-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .action-button:hover::before {
            left: 100%;
        }

        .action-button:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(255, 107, 107, 0.6);
        }

        .appointments-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
            display: none;
            z-index: 1000;
            animation: fadeIn 0.3s ease;
        }

        .modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            border-radius: 20px;
            width: 90%;
            max-width: 600px;
            max-height: 80vh;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
            animation: slideInScale 0.4s ease;
        }

        .modal-header {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            font-size: 1.5rem;
        }

        .close-btn {
            background: none;
            border: none;
            color: white;
            font-size: 1.8rem;
            cursor: pointer;
            padding: 5px;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s ease;
        }

        .close-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .modal-body {
            padding: 30px;
            max-height: 400px;
            overflow-y: auto;
        }

        .appointment-item {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .appointment-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        .appointment-item h3 {
            margin-bottom: 8px;
            font-size: 1.2rem;
        }

        .appointment-item p {
            margin-bottom: 4px;
            opacity: 0.9;
        }

        .no-appointments {
            text-align: center;
            color: #888;
            font-style: italic;
            padding: 40px 0;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
            animation: fadeIn 1s ease 1.2s both;
        }

        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 25px;
            border-radius: 15px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideInScale {
            from {
                opacity: 0;
                transform: translate(-50%, -50%) scale(0.8);
            }
            to {
                opacity: 1;
                transform: translate(-50%, -50%) scale(1);
            }
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 2.2rem;
            }

            .main-content {
                padding: 40px 20px;
            }

            .modal-content {
                width: 95%;
            }
        }
    </style>
</head>
<body>
<div class="main-container">
    <div class="header">
        <div class="header-content">
            <h1>🦷 Clínica Dental Bol</h1>
            <p>Bienvenido al Sistema de Citas</p>
        </div>
    </div>

    <div class="main-content">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number" id="totalAppointments">0</div>
                <div class="stat-label">Citas Totales</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id="todayAppointments">0</div>
                <div class="stat-label">Citas Hoy</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id="weekAppointments">0</div>
                <div class="stat-label">Esta Semana</div>
            </div>
        </div>

        <p class="welcome-text">
            Gestiona todas tus citas dentales de manera eficiente.<br>
            Haz clic en el botón para ver todas las citas programadas.
        </p>

        <button class="action-button" onclick="showAppointments()">
            📅 Ver Citas
        </button>
    </div>
</div>

<!-- Modal de Citas -->
<div class="appointments-modal" id="appointmentsModal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>📋 Citas Programadas</h2>
            <button class="close-btn" onclick="closeModal()">&times;</button>
        </div>
        <div class="modal-body" id="appointmentsContainer">
            <!-- Las citas se cargarán aquí -->
        </div>
    </div>
</div>

<script>
    // Datos de ejemplo para demostrar la funcionalidad
    const sampleAppointments = [
        {
            id: 1,
            patientName: "María González",
            patientPhone: "555-0123",
            appointmentDate: "2025-06-04",
            appointmentTime: "09:00",
            treatmentType: "Limpieza Dental",
            notes: "Primera visita",
            createdAt: new Date().toLocaleString('es-ES')
        },
        {
            id: 2,
            patientName: "Juan Pérez",
            patientPhone: "555-0124",
            appointmentDate: "2025-06-05",
            appointmentTime: "14:30",
            treatmentType: "Revisión General",
            notes: "Control rutinario",
            createdAt: new Date().toLocaleString('es-ES')
        },
        {
            id: 3,
            patientName: "Ana López",
            patientPhone: "555-0125",
            appointmentDate: "2025-06-03",
            appointmentTime: "11:00",
            treatmentType: "Ortodoncia",
            notes: "Ajuste de brackets",
            createdAt: new Date().toLocaleString('es-ES')
        }
    ];

    let appointments = sampleAppointments;

    function updateStats() {
        const today = new Date().toISOString().split('T')[0];
        const currentWeek = getWeekDates();

        const todayCount = appointments.filter(apt => apt.appointmentDate === today).length;
        const weekCount = appointments.filter(apt => {
            return apt.appointmentDate >= currentWeek.start && apt.appointmentDate <= currentWeek.end;
        }).length;

        document.getElementById('totalAppointments').textContent = appointments.length;
        document.getElementById('todayAppointments').textContent = todayCount;
        document.getElementById('weekAppointments').textContent = weekCount;
    }

    function getWeekDates() {
        const today = new Date();
        const firstDay = new Date(today.setDate(today.getDate() - today.getDay()));
        const lastDay = new Date(today.setDate(today.getDate() - today.getDay() + 6));

        return {
            start: firstDay.toISOString().split('T')[0],
            end: lastDay.toISOString().split('T')[0]
        };
    }

    function showAppointments() {
        const modal = document.getElementById('appointmentsModal');
        const container = document.getElementById('appointmentsContainer');

        if (appointments.length === 0) {
            container.innerHTML = '<div class="no-appointments">No hay citas programadas</div>';
        } else {
            container.innerHTML = appointments.map(appointment => {
                const date = new Date(appointment.appointmentDate).toLocaleDateString('es-ES', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });

                return `
                        <div class="appointment-item" onclick="showAppointmentDetail(${appointment.id})">
                            <h3>${appointment.patientName}</h3>
                            <p><strong>📅 ${date}</strong></p>
                            <p><strong>🕐 ${appointment.appointmentTime}</strong></p>
                            <p>🦷 ${appointment.treatmentType}</p>
                            <p>📞 ${appointment.patientPhone}</p>
                        </div>
                    `;
            }).join('');
        }

        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        const modal = document.getElementById('appointmentsModal');
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    function showAppointmentDetail(appointmentId) {
        const appointment = appointments.find(apt => apt.id === appointmentId);
        if (appointment) {
            const date = new Date(appointment.appointmentDate).toLocaleDateString('es-ES', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            alert(`Detalles de la Cita:

Paciente: ${appointment.patientName}
Teléfono: ${appointment.patientPhone}
Fecha: ${date}
Hora: ${appointment.appointmentTime}
Tratamiento: ${appointment.treatmentType}
Notas: ${appointment.notes}
Creada: ${appointment.createdAt}`);
        }
    }

    // Cerrar modal al hacer clic fuera de él
    document.getElementById('appointmentsModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Cerrar modal con la tecla Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });

    // Inicializar estadísticas al cargar la página
    updateStats();
</script>
</body>
</html>
