<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,900" rel="stylesheet">
    <style type="text/css">
        body {
            padding: 0;
            margin: 0;
        }

        #notfound {
            position: relative;
            height: 100vh;
        }

        #notfound .notfound-bg {
            position: absolute;
            width: 100%;
            height: 100%;
            background-size: cover;
        }

        #notfound .notfound-bg:after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: #fff;
        }

        #notfound .notfound {
            position: absolute;
            left: 50%;
            top: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }

        .notfound {
            max-width: 910px;
            width: 100%;
            line-height: 1.4;
            text-align: center;
        }

        .notfound .notfound-404 {
            position: relative;
            height: 200px;
        }

        .notfound .notfound-404 h1 {
            font-family: 'Montserrat', sans-serif;
            position: absolute;
            left: 50%;
            top: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            font-size: 100px;
            font-weight: 500;
            margin: 0px;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 10px;
        }

        .notfound h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 15px;
            font-weight: 400;
            text-transform: uppercase;
            color: #6c78b3;
            margin-top: 80px;
            margin-bottom: 15px;
        }

        .notfound .home-btn,
        .notfound .contact-btn {
            font-family: 'Montserrat', sans-serif;
            display: inline-block;
            font-weight: 700;
            text-decoration: none;
            background-color: transparent;
            border: 2px solid transparent;
            text-transform: uppercase;
            padding: 13px 25px;
            font-size: 18px;
            border-radius: 40px;
            margin: 7px;
            -webkit-transition: 0.2s all;
            transition: 0.2s all;
        }

        .notfound .contact-btn:hover {
            opacity: 0.9;
        }

        .notfound .home-btn:hover {
            opacity: 0.9;
        }

        .notfound .home-btn {
            color: #6c78b3;
            background: #fff;
            border: 2px solid #6c78b3;
        }

        .notfound .contact-btn {
            color: #fff;
            background: #6c78b3;
            border: 2px solid #6c78b3;
        }

        @media only screen and (max-width: 767px) {
            .notfound .notfound-404 h1 {
                font-size: 182px;
            }
        }

        @media only screen and (max-width: 480px) {
            .notfound .notfound-404 {
                height: 146px;
            }

            .notfound .notfound-404 h1 {
                font-size: 146px;
            }

            .notfound h2 {
                font-size: 16px;
            }

            .notfound .home-btn,
            .notfound .contact-btn {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>

    <div id="notfound">
        <div class="notfound-bg"></div>
        <div class="notfound">
            <div class="notfound-404">
                <h1>@yield('image')</h1>
            </div>
            <h2 class="mt-4">@yield('message')</h2>
            <a href="{{ route('dashboard') }}" class="home-btn">Go Home</a>
            <a href="{{ route(name: 'dashboard') }}" class="contact-btn">Contact us</a>
        </div>
    </div>

</body>

</html>
