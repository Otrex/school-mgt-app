<!-- resources/views/receipt.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        /* Add your styling for the receipt here */
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .total {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div>
        <a href="{{ $url }}" style="display: inline-block;">
            <img src="https://blip.school/img/logo.png" class="logo" alt="Blip School">
        </a>
    </div>
    <h2>Receipt</h2>
    <p><strong>Patron Name:</strong> {{ $data['patron_name'] }}</p>
    <p><strong>Created At:</strong> {{ $data['created_at'] }}</p>
    <p><strong>Total slots:</strong> {{ $data['no_of_slots'] }}</p>
    @if (isset($data['beneficiary']))
        <p><strong>Beneficiary:</strong> {{ $data['beneficiary'] }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data['items'] as $item)
                <tr>
                    <td>{{ $item['description'] }}</td>
                    <td>{{ $formatNumber($item['price']) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="total"><strong>Total:</strong> {{ $formatNumber($data['total']) }}</p>
</body>
</html>
