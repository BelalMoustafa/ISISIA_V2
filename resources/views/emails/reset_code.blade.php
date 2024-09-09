<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password Code</title>
    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }
        .login-box {
            width: 100%;
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .login-logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .login-logo img {
            max-width: 100px;
            max-height: 100px;
        }
        .card {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 20px;
        }
        .card-body {
            padding: 20px;
        }
        .login-box-msg {
            margin: 0;
            padding: 0;
            text-align: center;
            font-size: 16px;
            color: #333;
        }
        .login-box-msg strong {
            font-size: 24px;
            display: block;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="login-box">
        <div class="card">
            <div class="card-body">
                <p class="login-box-msg">Reset Your Password</p>
                <p class="login-box-msg">We received a request to reset your password. Use the following code to reset it:</p>
                <p class="login-box-msg"><strong>{{ $code }}</strong></p>
            </div>
        </div>
    </div>
</body>

</html>
