<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unauthorized Access</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Optional: Your CSS file -->
    <style>
        body {
            background-color: #f8f9fa;
            color: #343a40;
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            padding: 2rem;
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            background-color: #fff;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        p {
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
        }
        a {
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            transition: background-color 0.2s ease-in-out;
        }
        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Access Denied</h1>
        <p>You do not have the necessary permissions to access this page.</p>
        <a href="{{ url()->previous() }}">Go Back</a>
    </div>
</body>
</html>
