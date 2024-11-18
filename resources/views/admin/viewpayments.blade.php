<table>
    <thead>
        <tr>
            <th>Payment ID</th>
            <th>Appointment ID</th>
            <th>Client Name</th>
            <th>Payment Method</th>
            <th>Details</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($payments as $payment)
            <tr>
                <td>{{ $payment->id }}</td>
                <td>{{ $payment->appointment->id ?? 'N/A' }}</td>
                <td>{{ $payment->appointment->client_name ?? 'N/A' }}</td>
                <td>{{ $payment->payment_method }}</td>
                <td>{{ $payment->details }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
