<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    {{-- <link rel="mask-icon" type="" href="https://static.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg"
        color="#111" /> --}}
    <title>Unsubscribe</title>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css"> --}}
    <style>
        #oopss {
            background: linear-gradient(-45deg, #ff3300, #efe400);
            position: fixed;
            left: 0px;
            top: 0;
            width: 100%;
            height: 100%;
            line-height: 1.5em;
            z-index: 9999;
        }

        #oopss #error-text {
            font-size: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            font-family: 'Shabnam', Tahoma, sans-serif;
            color: #000;
            direction: rtl;
        }

        #oopss #error-text img {
            margin: 85px auto 20px;
            height: 342px;
        }

        #oopss #error-text span {
            position: relative;
            font-size: 1.1em;
            font-weight: 900;
            margin-bottom: 50px;
        }

        #oopss #error-text p.p-a {
            font-size: 19px;
            margin: 30px 0 15px 0;
        }

        #oopss #error-text p.p-b {
            font-size: 15px;
        }

        #oopss #error-text .back {
            background: #fff;
            color: #000;
            font-size: 30px;
            text-decoration: none;
            margin: 2em auto 0;
            padding: .7em 2em;
            border-radius: 500px;
            box-shadow: 0 20px 70px 4px rgba(0, 0, 0, 0.1), inset 7px 33px 0 0px #fff300;
            font-weight: 900;
            transition: all 300ms ease;
        }

        /* #oopss #error-text .back:hover {
            -webkit-transform: translateY(-10vh);
            transform: translateY(-10vh);
            box-shadow: 0 35px 90px 4px rgba(0, 0, 0, 0.3), inset 0px 0 0 3px #000;
        } */

        @font-face {
            font-family: Shabnam;
            src: url("https://cdn.rawgit.com/ahmedhosna95/upload/ba6564f8/fonts/Shabnam/Shabnam-Bold.eot");
            src: url("https://cdn.rawgit.com/ahmedhosna95/upload/ba6564f8/fonts/Shabnam/Shabnam-Bold.eot?#iefix") format("embedded-opentype"), url("https://cdn.rawgit.com/ahmedhosna95/upload/ba6564f8/fonts/Shabnam/Shabnam-Bold.woff") format("woff"), url("https://cdn.rawgit.com/ahmedhosna95/upload/ba6564f8/fonts/Shabnam/Shabnam-Bold.woff2") format("woff2"), url("https://cdn.rawgit.com/ahmedhosna95/upload/ba6564f8/fonts/Shabnam/Shabnam-Bold.ttf") format("truetype");
            font-weight: bold;
        }

        @font-face {
            font-family: Shabnam;
            src: url("https://cdn.rawgit.com/ahmedhosna95/upload/ba6564f8/fonts/Shabnam/Shabnam.eot");
            src: url("https://cdn.rawgit.com/ahmedhosna95/upload/ba6564f8/fonts/Shabnam/Shabnam.eot?#iefix") format("embedded-opentype"), url("https://cdn.rawgit.com/ahmedhosna95/upload/ba6564f8/fonts/Shabnam/Shabnam.woff") format("woff"), url("https://cdn.rawgit.com/ahmedhosna95/upload/ba6564f8/fonts/Shabnam/Shabnam.woff2") format("woff2"), url("https://cdn.rawgit.com/ahmedhosna95/upload/ba6564f8/fonts/Shabnam/Shabnam.ttf") format("truetype");
            font-weight: normal;
        }
    </style>
</head>

<body translate="no">
    <div id='oopss'>
        <div id='error-text'>
            <img src="https://cdn.rawgit.com/ahmedhosna95/upload/1731955f/sad404.svg" alt="404"> 
            {{-- TODO CHANGE TO CLIENT
            AND NOT USER --}}
            <span>Oh no! we're sorry to see you leave {{ $user->email }} </span>
            <p class="p-a">If you have any complaint, you can email us here</p>
            {{-- <a href='#' class="back">lets go back</a> --}}

        </div>
    </div>
</body>

</html>