<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elegant User Directory</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    />
    <style>
        body {
            background-color: #eef1f6;
            font-family: 'Arial', sans-serif;
        }
        .user-container {
            max-width: 1000px;
            margin: 3rem auto;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .user-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            padding: 1.5rem;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            width: 280px;
        }
        .user-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
        .user-avatar {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background-color: #007bff;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.8rem;
            font-weight: bold;
            margin: 0 auto 1rem;
        }
        .user-name {
            font-weight: bold;
            font-size: 1.3rem;
            color: #212529;
            margin-bottom: 0.5rem;
        }
        .user-role {
            font-size: 1rem;
            color: #6c757d;
            background: #f1f3f5;
            padding: 5px 12px;
            border-radius: 20px;
            display: inline-block;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center my-4 text-primary">User Directory</h2>
    <div class="user-container">
        @foreach($users as $user)
            <div class="user-card">
                <div class="user-avatar">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <div class="user-name">{{$user->name}}</div>
                <div class="user-role">{{$user->role ?? 'Member'}}</div>
            </div>
        @endforeach
    </div>
</div>
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
></script>
</body>
</html>
