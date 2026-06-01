<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
        }
        .content {
            padding: 30px;
        }
        .content h2 {
            color: #667eea;
            margin-top: 0;
        }
        .appointment-details {
            background-color: #f9f9f9;
            border-left: 4px solid #667eea;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .appointment-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .appointment-details td {
            padding: 10px 0;
            border-bottom: 1px solid #e0e0e0;
        }
        .appointment-details td:last-child {
            border-bottom: none;
        }
        .appointment-details strong {
            color: #667eea;
        }
        .footer {
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #666;
        }
        .btn {
            display: inline-block;
            background-color: #667eea;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .btn:hover {
            background-color: #5568d3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🏥 Medical Cabinet</h1>
            <p>Appointment Confirmation</p>
        </div>
        <div class="content">
            <h2>Hello, {{ $appointment->user->name }}!</h2>
            <p>Your appointment has been successfully scheduled. Here are the details:</p>
            
            <div class="appointment-details">
                <table>
                    <tr>
                        <td><strong>Patient Name:</strong></td>
                        <td>{{ $appointment->user->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Service:</strong></td>
                        <td>{{ $appointment->service->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Price:</strong></td>
                        <td>${{ number_format($appointment->service->price, 2) }}</td>
                    </tr>
                    <tr>
                        <td><strong>Date & Time:</strong></td>
                        <td>{{ $appointment->appointment_date->format('F d, Y \a\t g:i A') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td>
                            <span style="background-color: {{ $appointment->status === 'confirmed' ? '#28a745' : ($appointment->status === 'pending' ? '#ffc107' : '#dc3545') }}; color: white; padding: 5px 10px; border-radius: 3px;">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </td>
                    </tr>
                    @if($appointment->notes)
                    <tr>
                        <td><strong>Notes:</strong></td>
                        <td>{{ $appointment->notes }}</td>
                    </tr>
                    @endif
                </table>
            </div>
            
            <p>Please arrive 15 minutes before your scheduled appointment time. If you need to reschedule or cancel, please contact us as soon as possible.</p>
            
            <p>Thank you for choosing Medical Cabinet. We look forward to seeing you!</p>
            
            <a href="#" class="btn">View Appointment Details</a>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Medical Cabinet. All rights reserved.</p>
            <p>This is an automated email. Please do not reply to this message.</p>
        </div>
    </div>
</body>
</html>
