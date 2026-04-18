<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Agribiz Earth - Maintenance</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #f5f9f6;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2c3e50;
        }

        .container {
            max-width: 700px;
            text-align: center;
            padding: 40px;
        }

        .logo {
            margin-bottom: 30px;
        }

        .logo img {
            height: 60px;
        }

        h1 {
            font-size: 42px;
            color: #4682B4;
            margin-bottom: 20px;
        }

        .subtitle {
            font-size: 18px;
            color: #555;
            margin-bottom: 30px;
        }

        .box {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .loader {
            width: 50px;
            height: 50px;
            border: 5px solid #e5e5e5;
            border-top: 5px solid #4682B4;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 25px auto;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .contact {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .contact h3 {
            color: #4682B4;
            margin-bottom: 10px;
        }

        .contact p {
            font-size: 15px;
            margin: 5px 0;
            color: #555;
        }

        .contact a {
            color: #4682B4;
            text-decoration: none;
            font-weight: 500;
        }

        .footer {
            margin-top: 30px;
            font-size: 13px;
            color: #888;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="logo">
            <!-- Ganti dengan logo agribiz -->
            <img src="/template/Passion/assets/img/Agribiz_Color.png" alt="Agribiz Earth">
        </div>

        <div class="box">

            <h1>Website Under Maintenance</h1>

            <p class="subtitle">
                Kami sedang melakukan peningkatan sistem untuk memberikan layanan yang lebih baik.
                Silakan kunjungi kembali nanti.
            </p>

            <div class="loader"></div>

            <div class="contact">

                <h3>Contact Information</h3>

                <p>Email :
                    <a href="mailto:beni@inovasidigital.asia">beni@inovasidigital.asia</a>
                </p>

            </div>

        </div>

        <div class="footer">
            © {{ date('Y') }} Agribiz Earth. All rights reserved.
        </div>

    </div>

</body>

</html>