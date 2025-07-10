<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ticket - {{ $booking->event->title }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            color: #333;
        }
        
        .ticket-container {
            width: 100%;
            max-width: 700px;
            margin: 0 auto;
            position: relative;
            overflow: hidden;
            box-sizing: border-box;
            page-break-after: avoid;
        }
        
        .ticket-header {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            padding: 25px 30px;
            text-align: center;
            color: white;
            position: relative;
        }
        
        .header-logo img {
            height: 60px;
            margin-bottom: 10px;
        }
        
        .ticket-title {
            font-size: 22px;
            font-weight: 700;
            margin: 10px 0 5px;
            letter-spacing: 0.5px;
        }
        
        .ticket-subtitle {
            font-size: 14px;
            opacity: 0.9;
            font-weight: 400;
        }
        
        .ticket-body {
            padding: 30px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: 120px 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .info-label {
            font-weight: 600;
            color: #555;
            font-size: 14px;
        }
        
        .info-value {
            font-weight: 500;
            color: #222;
            font-size: 14px;
        }
        
        .qr-section {
            text-align: center;
            margin: 25px 0 15px;
            padding: 20px;
            background: #f9fafc;
            border-radius: 8px;
            border: 1px solid #e0e6ed;
        }
        
        .qr-code {
            width: 150px;
            height: 150px;
            margin: 0 auto 10px;
            padding: 10px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }
        
        .reference-number {
            font-family: 'Courier New', monospace;
            font-size: 14px;
            font-weight: 600;
            color: #2c3e50;
            letter-spacing: 1px;
        }
        
        .ticket-footer {
            padding: 15px;
            text-align: center;
            font-size: 11px;
            color: #777;
            border-top: 1px solid #eee;
            background: #f9fafc;
        }
        
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            opacity: 0.05;
            z-index: 0;
            font-size: 100px;
            font-weight: bold;
            color: #224abe;
            white-space: nowrap;
            pointer-events: none;
        }
        
        .security-strip {
            height: 6px;
            background: repeating-linear-gradient(
                45deg,
                #4e73df,
                #4e73df 10px,
                #224abe 10px,
                #224abe 20px
            );
        }
        
        .terms {
            font-size: 12px;
            color: #666;
            margin-top: 15px;
            padding-top: 10px;
            border-top: 1px dashed #ddd;
            line-height: 1.5;
        }
        
        @page {
            size: A4;
            margin: 0;
        }
        
        @media print {
            body {
                padding: 0;
                background: white;
            }
            .ticket-container {
                box-shadow: none;
                margin: 0;
                width: 100%;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="ticket-container">
        <div class="security-strip"></div>
        <div class="watermark">ADMISSION</div>
        
        <div class="ticket-header">
            <div class="header-logo">
                <img src="{{ public_path('images/logo.png') }}" alt="EventHub Logo" />
            </div>
            <h1 class="ticket-title">Event Admission Ticket</h1>
            <p class="ticket-subtitle">Valid for entry to the event</p>
        </div>
        
        <div class="ticket-body">
            <div class="info-grid">
                <div class="info-label">Event Name:</div>
                <div class="info-value">{{ $booking->event->title }}</div>
                
                <div class="info-label">Date & Time:</div>
                <div class="info-value">{{ \Carbon\Carbon::parse($booking->event->date_time)->format('F j, Y g:i A') }}</div>
                
                <div class="info-label">Venue:</div>
                <div class="info-value">{{ $booking->event->venue }}</div>
                
                <div class="info-label">Ticket Type:</div>
                <div class="info-value">{{ ucfirst($booking->ticket_type) }}</div>
                
                <div class="info-label">Quantity:</div>
                <div class="info-value">{{ $booking->quantity }}</div>
                
                <div class="info-label">Total Paid:</div>
                <div class="info-value">₦{{ number_format($booking->total_price) }}</div>
            </div>
            
            <div class="qr-section">
                <div class="qr-code">
                    <img src="data:image/svg+xml;base64,{{ $qrCodeSvg }}" alt="QR Code" width="150" height="150">
                </div>
                <p style="margin: 8px 0 4px; font-size: 13px;">Scan this QR code at the entrance</p>
                <p class="reference-number">{{ $booking->payment_reference }}</p>
            </div>
            
            <div class="terms">
                <p><strong>Terms & Conditions:</strong> This ticket is non-transferable. The organizer reserves the right to refuse admission. Please arrive at least 30 minutes before the event.</p>
            </div>
        </div>
        
        <div class="ticket-footer">
            <p>© {{ date('Y') }} EventHub | For assistance contact support@abujaeventhub.com</p>
        </div>
    </div>
</body>
</html>