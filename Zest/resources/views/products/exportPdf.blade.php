<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
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
    <h2>List of Products</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Category</th>
            </tr>
        </thead>
        <tbody>
            @foreach($product as $pro)
                <tr>
                <td>{{ $loop->iteration }}</td>
                    <td>{{ $pro-> nama_produk }}</td>
                    <td>{{ $pro-> harga_produk }} </td>
                    <td>{{ $pro-> jumlah_produk }} </td>
                    <td>{{ $pro-> kategori_produk }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>