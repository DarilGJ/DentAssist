# DentAssist
DentAssist is a Python-based application designed to assist dental professionals in managing patient data, appointments, and treatment plans. It provides a user-friendly interface for dentists and their staff to streamline their workflow and improve patient care.

## Features
- **Patient Management**: Add, edit, and view patient information including medical history and treatment records.
- **Appointment Scheduling**: Schedule, reschedule, and cancel appointments with reminders.
- **Treatment Planning**: Create and manage treatment plans for patients, including tracking progress.
- **Reporting**: Generate reports on patient visits, treatments, and other metrics.
- **User Management**: Manage user accounts with different roles (admin, dentist, staff).

## Installation
1. Clone the repository:
   ```bash
   git clone
2. Navigate to the project directory:
   ```bash
   cd DentAssist
   ```
3. Install the required dependencies:
   ```bash
   compose install
   ```
4. Configure the environment variables

5. Set up the database:
   ```bash
   php artisan migrate
   ```
6. Configure user roles and permissions as needed.
   ```bash
   php artisan db:seed --class=ShieldSeeder
   ```
   ```bash
   php artisan shield:super-admin
    ```
7. Start the application

8. Access the application in your web browser at `http://localhost:8000`.
