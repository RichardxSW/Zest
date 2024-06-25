<!DOCTYPE html>
<html>
<head>
    <title>Purchase List</title>
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
    <h2>List of Purchases</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Product Name</th>
                <th>Supplier Name</th>
                <th>Quantity</th>
                <th>In Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchase as $pur)
                <tr>
                    <td>{{ $pur->id }}</td>
                    <td>{{ $pur->category }}</td>
                    <td>{{ $pur->product_name }}</td>
                    <td>{{ $pur->supplier_name }}</td>
                    <td>{{ $pur->quantity }}</td>
                    <td>{{ $pur->in_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>