<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unauthorized Access</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="center-vh-100">
    <div class="unauthorized-container">
        <h1>Access Denied</h1>
        <p>You do not have the necessary permissions to access this page.</p>
        <a href="{{ url()->previous() }}">Go Back</a>
    </div>
</body>
</html>
