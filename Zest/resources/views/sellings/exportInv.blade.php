{{-- <!DOCTYPE html>
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
</html> --}}
<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            color: #555;
            position: relative;
        }
        .invoice-box .title {
            font-size: 30px;
            line-height: 30px;
            color: #333;
            margin-bottom: 20px;
        }
        .invoice-box .date, .invoice-box .purchase-id {
            text-align: right;
            margin-bottom: 5px;
        }
        .invoice-box .purchase-id {
            margin-bottom: 20px;
        }
        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
            border: 1px solid #ddd;
        }
        .invoice-box table td {
            padding: 8px;
            vertical-align: top;
            border: 1px solid #ddd;
        }
        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.top table td.title {
            font-size: 30px;
            line-height: 30px;
            color: #333;
        }
        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }
        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }
        .invoice-box table tr.item.last td {
            border-bottom: none;
        }
        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }
        .invoice-box table tr.title-row td {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            color: #333;
        }
        .invoice-box table tr.details td {
            background: #f9f9f9;
        }
        .invoice-box table tr.total td {
            background: #f1f1f1;
        }
        .manager-info {
            margin-top: 20px;
            text-align: right;
            font-style: italic;
            position: relative;
        }
        .date-column {
            white-space: nowrap; /* Prevents text wrapping */
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="title">
            Invoice
        </div>
        <div class="date">
            Date: {{ \Carbon\Carbon::now()->toFormattedDateString() }}
        </div>
        <div class="purchase-id">
            Invoice No: {{ $selling->id }}
        </div>
        <table cellpadding="0" cellspacing="0">
            <tr class="heading">
                <td>Category Name</td>
                <td>Product Name</td>
                <th>Customer Name</th>
                <td>Price @</td>
                <td>Quantity</td>
                <td>Total Price</td>
                <td>In Date</td>
            </tr>
            <tr class="item">
                <td>{{ $selling->category_name }}</td>
                <td>{{ $selling->product_name }}</td>
                <td>{{ $selling->customer_name }}</td>
                <td>IDR {{ $product->harga_produk }}</td>
                <td>{{ $selling->quantity }}</td>
                <td>IDR {{ $product->harga_produk * $selling->quantity }}</td>
                <td>{{ $selling->date }}</td>
            </tr>
        </table>
        <div class="manager-info">
            <p>Marketing Staff</p>
        </div>
    </div>
</body>
</html>