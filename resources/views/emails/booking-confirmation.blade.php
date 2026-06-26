<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo h1 {
            color: #1e3a8a;
            margin: 0;
            font-size: 28px;
        }
        .header {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            color: white;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            margin: -30px -30px 30px -30px;
        }
        .header h2 {
            margin: 0;
            font-size: 24px;
        }
        .booking-details {
            background-color: #f8fafc;
            border-left: 4px solid #1e3a8a;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .detail-row {
            display: flex;
            padding: 8px 0;
            border-bottom: 1px solid #e2e8f0;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: bold;
            color: #1e3a8a;
            width: 180px;
            flex-shrink: 0;
        }
        .detail-value {
            color: #333;
            flex-grow: 1;
        }
        .price-highlight {
            background-color: #fef3c7;
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0;
            text-align: center;
            border: 2px solid #fbbf24;
        }
        .price-highlight .amount {
            font-size: 28px;
            font-weight: bold;
            color: #92400e;
        }
        .notes-section {
            background-color: #fef9e7;
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0;
            border-left: 4px solid #fbbf24;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #e2e8f0;
            text-align: center;
            color: #64748b;
            font-size: 14px;
        }
        .contact-info {
            margin: 15px 0;
            font-size: 14px;
        }
        .contact-info a {
            color: #1e3a8a;
            text-decoration: none;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #1e3a8a;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h2>✓ Booking Confirmed!</h2>
        </div>

        <p>Dear {{ $booking->customer_name }},</p>

        <p>Thank you for booking with <strong>Diva House Beauty</strong>! We're excited to serve you.</p>

        <p>Your booking has been confirmed. Here are the details:</p>

        <div class="booking-details">
            <div class="detail-row">
                <span class="detail-label">Booking Reference:</span>
                <span class="detail-value"><strong>{{ $booking->booking_reference }}</strong></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Service:</span>
                <span class="detail-value">{{ $booking->service->name }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Date:</span>
                <span class="detail-value">{{ $booking->formatted_date }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Time:</span>
                <span class="detail-value">{{ $booking->formatted_time }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Customer Name:</span>
                <span class="detail-value">{{ $booking->customer_name }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Email:</span>
                <span class="detail-value">{{ $booking->customer_email }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Phone:</span>
                <span class="detail-value">{{ $booking->customer_phone }}</span>
            </div>
        </div>

        <div class="price-highlight">
            <div style="color: #92400e; font-size: 14px; margin-bottom: 5px;">Total Price</div>
            <div class="amount">{{ number_format($booking->total_price_rwf, 0) }} RWF</div>
        </div>

        @if($booking->notes)
        <div class="notes-section">
            <strong>Additional Notes:</strong><br>
            {{ $booking->notes }}
        </div>
        @endif

        <p style="margin-top: 30px;"><strong>What's Next?</strong></p>
        <ul>
            <li>We'll send you a reminder 24 hours before your appointment</li>
            <li>Please arrive 5-10 minutes early</li>
            <li>If you need to reschedule, please contact us at least 24 hours in advance</li>
        </ul>

        <div class="footer">
            <strong>Diva House Beauty</strong>
            <div class="contact-info">
                Email: <a href="mailto:info@divahousebeauty.com">info@divahousebeauty.com</a><br>
                Phone: Contact us for more information<br>
            </div>
            <p style="font-size: 12px; color: #94a3b8;">
                This is an automated confirmation email. Please do not reply to this email.
            </p>
        </div>
    </div>
</body>
</html>
