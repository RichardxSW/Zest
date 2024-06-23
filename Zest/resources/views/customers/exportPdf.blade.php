<!DOCTYPE html>
<html>
<head>
    <title>Customers List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>List of Customers</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Item</th>
                <th>Item Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customer as $cus)
                <tr>
                    <td>{{ $cus->id }}</td>
                    <td>{{ $cus->nama_customer }}</td>
                    <td>{{ $cus->item_customer }}</td>
                    <td>{{ $cus->quantity_customer }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>