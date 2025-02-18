<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional User Directory</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    />
    <style>
        body {
            background-color: #f5f7fa;
            font-family: 'Arial', sans-serif;
        }
        .table-container {
            max-width: 1000px;
            margin: 3rem auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            overflow: hidden;
        }
        .table-header {
            background: linear-gradient(135deg, #007bff, #00d4ff);
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            padding: 1rem;
            border-radius: 10px 10px 0 0;
        }
        .users-table {
            width: 100%;
            margin: 0;
            border-collapse: collapse;
        }
        .users-table th, .users-table td {
            text-align: left;
            padding: 15px;
            font-size: 1rem;
            border-bottom: 1px solid #e9ecef;
        }
        .users-table th {
            background-color: #f1f1f1;
            color: #333;
            text-transform: uppercase;
            font-weight: bold;
        }
        .users-table tr:hover {
            background-color: #f8f9fa;
            transition: background 0.3s ease;
        }
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #007bff;
            color: white;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            font-size: 1rem;
            font-weight: bold;
            margin-right: 10px;
        }
        .d-flex {
            display: flex;
            align-items: center;
        }
        .user-name {
            font-weight: 600;
            font-size: 1.1rem;
            color: #212529;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
        }
    </style>
</head>
<body>
<div class="container table-container">
    <div class="table-header">
        User Directory
    </div>
    <table class="users-table">
        <thead>
        <tr>
            <th>Avatar</th>
            <th>Name</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="user-avatar">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                    </div>
                </td>
                <td>
                    <div class="user-name">{{$user->name}}</div>
                </td>
                <td>{{$user->role->name ?? 'Member'}}</td>
                <td>
                    <div class="action-buttons">
                        <button class="btn btn-primary btn-sm" >Edit</button>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
></script>
</body>
</html>
