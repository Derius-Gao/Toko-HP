
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>404 Not Found</title>
    <style>
        body {
            background: #f1f2f6;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            flex-direction: column;
        }
        .error-container {
            text-align: center;
        }
        .error-container img {
            max-width: 350px;
            width: 100%;
            margin-bottom: 30px;
        }
        .back-btn {
            display: inline-block;
            padding: 12px 28px;
            background: #3498db;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.2s;
        }
        .back-btn:hover {
            background: #217dbb;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <img src="<?= base_url('assets/images/error.jpg'); ?>" alt="404 Error">
        <br>
        <a href="<?= base_url('home/dashboard'); ?>" class="back-btn">Back to Home</a>
    </div>
</body>
</html>