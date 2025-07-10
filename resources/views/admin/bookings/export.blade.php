<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bookings Export - {{ now()->format('Y-m-d') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #2c3e50;
            margin-bottom: 5px;
        }
        .header p {
            color: #7f8c8d;
            margin-top: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background-color: #3498db;
            color: white;
            text-align: left;
            padding: 12px;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 12px;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #ecf0f1;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        tr:hover {
            background-color: #f1f7fd;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            color: #7f8c8d;
            font-size: 12px;
        }
        .badge {
            display: inline-block;
            padding: 3px 7px;
            background-color: #e3f2fd;
            color: #1976d2;
            border-radius: 10px;
            font-weight: bold;
            font-size: 12px;
        }
        .text-muted {
            color: #95a5a6;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Bookings Export</h1>
        <p>Generated on {{ now()->format('d M Y, h:i A') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>User Name</th>
                <th>Event Title</th>
                <th>Quantity</th>
                <th>Payment Reference</th>
                <th>Booked At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $index => $booking)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $booking->user->name ?? 'N/A' }}</td>
                    <td>{{ $booking->event->title ?? 'N/A' }}</td>
                    <td><span class="badge">{{ $booking->quantity }}</span></td>
                    <td><code>{{ $booking->payment_reference }}</code></td>
                    <td>
                        {{ $booking->created_at->format('d M Y') }}<br>
                        <small class="text-muted">{{ $booking->created_at->format('h:i A') }}</small>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Total Bookings: {{ count($bookings) }} | Exported by {{ auth()->user()->name ?? 'System' }}
    </div>
</body>
</html>