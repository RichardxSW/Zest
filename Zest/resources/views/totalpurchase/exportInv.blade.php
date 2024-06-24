<!DOCTYPE html>
<html>
<head>
    <title>Purchase Invoice</title>
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
        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }
        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
            text-align: left;
        }
        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
            text-align: left;
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
        .invoice-box table tr.heading {
            background: #f7f7f7;
        }
        .invoice-box table tr.total td {
            background: #f1f1f1;
        }
        .manager-info {
            margin-top: 30px;
            text-align: right;
            font-style: italic;
            position: absolute;
            bottom: 20px;
            right: 30px;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="4">
                    <table>
                        <tr>
                            <td class="title">
                                Purchase Invoice
                            </td>
                            <td style="text-align: right;">
                                Date: {{ \Carbon\Carbon::now()->toFormattedDateString() }}<br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>Product Name</td>
                <td>Supplier Name</td>
                <td>Quantity</td>
                <td>In Date</td>
            </tr>
            <tr class="item">
                <td>{{ $purchase->product_name }}</td>
                <td>{{ $purchase->supplier_name }}</td>
                <td>{{ $purchase->quantity }}</td>
                <td>{{ $purchase->in_date }}</td>
            </tr>
        </table>
        <div class="manager-info">
            <p>Purchasing Staff</p>
        </div>
    </div>
</body>
</html>