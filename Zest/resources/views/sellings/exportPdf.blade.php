<!DOCTYPE html>
<html>
<head>
    <title>Selling Products List</title>
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
    <h2>List of Selling Products</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Category Name</th>
                <th>Customer Name</th>
                <th>Quantity</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sellings as $sell)
                <tr>
                    <td>{{ $sell->id }}</td>
                    <td>{{ $sell->product_name }}</td>
                    <td>{{ $sell->category_name }}</td>
                    <td>{{ $sell->customer_name }}</td>
                    <td>{{ $sell->quantity }}</td>
                    <td>{{ $sell->date }}</td>
                    <td>{{ $sell->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>