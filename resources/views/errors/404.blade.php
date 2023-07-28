<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        .error-container {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .error-heading {
            font-size: 8rem;
            font-weight: bold;
            color: #343a40;
        }

        .error-message {
            font-size: 1.5rem;
            color: #6c757d;
        }

        .error-link {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="error-container">
    <span class="error-heading">404</span>
    <p class="error-message">Oops! The page you are looking for cannot be found.</p>
    <a href="/" class="btn btn-danger error-link">Go to Home</a>
</div>
</body>
</html>
