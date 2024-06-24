<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Invoice</h2>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Category Name</th>
                    <th>Customer Name</th>
                    <th>Quantity</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $selling->id }}</td>
                    <td>{{ $selling->product_name }}</td>
                    <td>{{ $selling->category_name }}</td>
                    <td>{{ $selling->customer_name }}</td>
                    <td>{{ $selling->quantity }}</td>
                    <td>{{ $selling->date }}</td>
                </tr>
            </tbody>
        </table>
        <div class="footer">
            <p>Thank you for your purchase!</p>
        </div>
    </div>
</body>
</html>