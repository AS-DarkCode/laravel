<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Report - {{ $user->name }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 9pt; 
            line-height: 1.2;
            color: #333;
        }
        h1 {
            color: #0056b3;
            font-size: 16pt; 
        }
        h2 {
            color: #0056b3;
            font-size: 12pt; 
        }
        h3, h4 {
            color: #0056b3;
            font-size: 10pt; 
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15pt; 
        }
        th, td {
            border: 1px solid #ddd;
            padding: 5pt; 
            text-align: left;
        }
        th {
            background-color: #f5f7fa;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .header {
            text-align: center;
            margin-bottom: 15pt; 
        }
        .section {
            margin-bottom: 20pt; 
        }
        .summary-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 15pt; 
        }
        .summary-grid div {
            flex: 1;
            min-width: 150pt; 
        }
        p {
            margin: 3pt 0; 
        }
        strong {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>User Report for {{ $user->name }}</h1>
        <p>Generated on: {{ date('d-M-Y H:i:s') }}</p>
        <p>Period: {{ $formattedStartDate }} to {{ $formattedEndDate }}</p>
    </div>

    <!-- User Details -->
    <div class="section">
        <h2>User Details</h2>
        <div class="row">
            <div style="width: 50%;">
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Contact:</strong> {{ $user->contact }}</p>
            </div>
            <div style="width: 50%;">
                <p><strong>Address:</strong> {{ $user->address }}</p>
                <p><strong>Joining Date:</strong> {{ $user->formatted_joining_date }}</p>
                <p><strong>Set Amount (Daily Rate):</strong> ₹{{ number_format($user->amount, 2) }}</p>
            </div>
        </div>
    </div>

    <!-- Date-wise Records -->
    <div class="section">
        <h2>Date-wise Records ({{ $formattedStartDate }} to {{ $formattedEndDate }})</h2>

        <!-- Attendance -->
        <h3>Attendance</h3>
        @if ($attendanceRecords->isEmpty())
            <p>No attendance records found for this period.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Site Visited</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attendanceRecords as $record)
                        <tr>
                            <td>{{ date('d-M-Y', strtotime($record->attendance_date)) }}</td>
                            <td>{{ $record->status === 'A' ? 'Absent' : ($record->status == 1 ? 'Full Day' : 'Half Day') }}</td>
                            <td>
                                @foreach ($siteVisits as $visit)
                                    @if ($visit['date'] === $record->attendance_date)
                                        {{ $visit['site_name'] }}
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <!-- Payments -->
        <h3>Payments</h3>
        @if ($paymentRecords->isEmpty())
            <p>No payment records found for this period.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Action</th>
                        <th>Sender</th>
                        <th>Recipient</th>
                        <th>Type</th>
                        <th>Details</th>
                        <th>Method</th>
                        <th style="text-align: right;">Amount (₹)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($paymentRecords as $record)
                        <tr>
                            <td>{{ date('d-M-Y', strtotime($record->transaction_date)) }}</td>
                            <td>{{ ucfirst($record->action) }}</td>
                            <td>{{ $record->sender_name }} ({{ $record->sender_type }})</td>
                            <td>{{ $record->recipient_name }} ({{ $record->recipient_type }})</td>
                            <td>{{ ucfirst($record->payment_type) }}</td>
                            <td>{{ $record->details }}</td>
                            <td>{{ ucfirst($record->method) }}</td>
                            <td style="text-align: right;">₹{{ number_format($record->amount, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <!-- Expenses -->
        <h3>Expenses</h3>
        @if ($expenseRecords->isEmpty())
            <p>No expense records found for this period.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Details</th>
                        <th style="text-align: right;">Amount (₹)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expenseRecords as $record)
                        <tr>
                            <td>{{ date('d-M-Y', strtotime($record->created_at)) }}</td>
                            <td>{{ $record->details }}</td>
                            <td style="text-align: right;">₹{{ number_format($record->amount, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Summary -->
    <div class="section">
        <h2>Summary</h2>
        <div class="summary-grid">
            <div>
                <p><strong>Total Attendance (Days):</strong> {{ number_format($summary['total_attendance'], 2) }}</p>
                <p><strong>Total Earnings:</strong> ₹{{ number_format($summary['total_earnings'], 2) }}</p>
            </div>
            <div>
                <p><strong>Total Payments Sent:</strong> ₹{{ number_format($summary['total_payments_sent'], 2) }}</p>
                <p><strong>Total Payments Received:</strong> ₹{{ number_format($summary['total_payments_received'], 2) }}</p>
            </div>
            <div>
                <p><strong>Total Expenses:</strong> ₹{{ number_format($summary['total_expenses'], 2) }}</p>
                <p><strong>Total Profit:</strong> ₹{{ number_format($summary['total_profit'], 2) }}</p>
                <p><strong>Total Remaining:</strong> ₹{{ number_format($summary['total_remaining'], 2) }}</p>
            </div>
        </div>
    </div>
</body>
</html>