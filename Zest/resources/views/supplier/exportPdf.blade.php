<!DOCTYPE html>
<html>
<head>
    <title>Supplier List</title>
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
    <h2>List of Suppliers</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Email</th>
                <th>Contact</th>
            </tr>
        </thead>
        <tbody>
            @foreach($supplier as $sup)
                <tr>
                    <td>{{ $sup->id }}</td>
                    <td>{{ $sup->name }}</td>
                    <td>{{ $sup->address }}</td>
                    <td>{{ $sup->email }}</td>
                    <td>{{ $sup->contact }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>