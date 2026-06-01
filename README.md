# Medical Cabinet

A complete Laravel 12 web application for managing appointments in a medical clinic. This application provides a comprehensive solution for scheduling, tracking, and managing medical appointments with support for multiple languages, email notifications, and REST API integration.

## Features

- **Authentication**: Complete user authentication using Laravel Breeze (Login, Register, Logout)
- **Dashboard**: Admin dashboard with statistics and real-time data
- **Appointments Management**: Full CRUD operations with Bootstrap modals
- **Services Management**: Full CRUD operations for medical services
- **Real-time Search**: Search appointments by patient name, service name, status, and date using Axios
- **Internationalization**: Support for English and French languages with language switcher
- **Email Notifications**: Automatic confirmation emails when appointments are created
- **REST API**: Complete RESTful API for appointments management
- **Responsive Design**: Beautiful Bootstrap 5 responsive layout
- **Database**: Relational database with proper foreign key constraints

## Technology Stack

- **Framework**: Laravel 12
- **Language**: PHP 8.3+
- **Database**: MySQL
- **Frontend**: Bootstrap 5, Blade Templates
- **ORM**: Eloquent ORM
- **Authentication**: Laravel Breeze
- **HTTP Client**: Axios
- **Email**: Laravel Mail

## Database Design

### Tables

1. **users**
   - id
   - name
   - email
   - password
   - role (patient or doctor)
   - timestamps

2. **services**
   - id
   - name
   - description
   - price
   - timestamps

3. **appointments**
   - id
   - user_id (foreign key referencing users)
   - service_id (foreign key referencing services)
   - appointment_date
   - status (pending, confirmed, cancelled)
   - notes
   - timestamps

### Relationships

- User hasMany Appointments
- Service hasMany Appointments
- Appointment belongsTo User
- Appointment belongsTo Service

## Installation Instructions

### Prerequisites

- PHP 8.3 or higher
- Composer
- MySQL
- Node.js and NPM

### Step 1: Clone the Repository

```bash
git clone <repository-url>
cd cabinet-medical2
```

### Step 2: Install Dependencies

```bash
composer install
npm install
```

### Step 3: Environment Configuration

```bash
cp .env.example .env
php artisan key:generate
```

Update the `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=medical_cabinet
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Step 4: Database Migration and Seeding

```bash
php artisan migrate:fresh --seed
```

### Step 5: Build Assets

```bash
npm run build
```

### Step 6: Start the Development Server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## Default Login Credentials

After running the seeder, you can use the following credentials:

- **Email**: admin@medical.com
- **Password**: password
- **Role**: doctor

Additional users are created by the seeder with random credentials.

## API Documentation

### Base URL

```
http://localhost:8000/api
```

### Endpoints

#### Get All Appointments

```http
GET /api/appointments
```

**Response**: 200 OK
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "user_id": 1,
      "service_id": 1,
      "appointment_date": "2026-06-15 10:00:00",
      "status": "confirmed",
      "notes": null,
      "created_at": "2026-06-01T00:00:00.000000Z",
      "updated_at": "2026-06-01T00:00:00.000000Z",
      "user": {...},
      "service": {...}
    }
  ]
}
```

#### Get Single Appointment

```http
GET /api/appointments/{id}
```

**Response**: 200 OK
```json
{
  "success": true,
  "data": {
    "id": 1,
    "user_id": 1,
    "service_id": 1,
    "appointment_date": "2026-06-15 10:00:00",
    "status": "confirmed",
    "notes": null,
    "user": {...},
    "service": {...}
  }
}
```

#### Create Appointment

```http
POST /api/appointments
Content-Type: application/json

{
  "user_id": 1,
  "service_id": 1,
  "appointment_date": "2026-06-20 14:00:00",
  "status": "pending",
  "notes": "Patient requested afternoon slot"
}
```

**Response**: 201 Created
```json
{
  "success": true,
  "message": "Appointment created successfully",
  "data": {...}
}
```

#### Update Appointment

```http
PUT /api/appointments/{id}
Content-Type: application/json

{
  "status": "confirmed",
  "notes": "Appointment confirmed"
}
```

**Response**: 200 OK
```json
{
  "success": true,
  "message": "Appointment updated successfully",
  "data": {...}
}
```

#### Delete Appointment

```http
DELETE /api/appointments/{id}
```

**Response**: 200 OK
```json
{
  "success": true,
  "message": "Appointment deleted successfully"
}
```

## Screenshots

### Dashboard
The dashboard provides an overview of the clinic with statistics for total users, services, appointments, and upcoming appointments.

### Appointments Management
Full CRUD operations for appointments with search functionality and Bootstrap modals for create, edit, and delete operations.

### Services Management
Complete services management with predefined medical services and pricing.

### Language Switcher
Switch between English and French languages from the navigation bar.

## Project Structure

```
cabinet-medical2/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Api/
│   │   │   │   └── AppointmentController.php
│   │   │   ├── AppointmentController.php
│   │   │   ├── ServiceController.php
│   │   │   ├── DashboardController.php
│   │   │   └── LanguageController.php
│   │   └── Requests/
│   │       ├── StoreAppointmentRequest.php
│   │       ├── UpdateAppointmentRequest.php
│   │       ├── StoreServiceRequest.php
│   │       └── UpdateServiceRequest.php
│   ├── Mail/
│   │   └── AppointmentConfirmationMail.php
│   └── Models/
│       ├── User.php
│       ├── Service.php
│       └── Appointment.php
├── database/
│   ├── factories/
│   │   ├── UserFactory.php
│   │   ├── ServiceFactory.php
│   │   └── AppointmentFactory.php
│   ├── migrations/
│   ├── seeders/
│   │   ├── UserSeeder.php
│   │   ├── ServiceSeeder.php
│   │   ├── AppointmentSeeder.php
│   │   └── DatabaseSeeder.php
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── medical.blade.php
│   │   ├── appointments/
│   │   ├── services/
│   │   ├── emails/
│   │   └── dashboard.blade.php
│   └── lang/
│       ├── en/
│       └── fr/
└── routes/
    ├── web.php
    └── api.php
```

## Available Services

The application comes with 12 predefined medical services:

1. General Consultation - $75.00
2. Dental Checkup - $120.00
3. Eye Examination - $95.00
4. Blood Test - $85.00
5. X-Ray - $150.00
6. Physical Therapy - $110.00
7. Vaccination - $65.00
8. Cardiology Checkup - $200.00
9. Dermatology Consultation - $130.00
10. Pediatric Checkup - $90.00
11. Orthopedic Consultation - $175.00
12. Neurology Examination - $250.00

## Testing

To run the application tests:

```bash
php artisan test
```

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is open-sourced software licensed under the MIT license.

## Support

For support, please open an issue in the GitHub repository.
