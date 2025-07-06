<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1024, initial-scale=1.0, user-scalable=yes">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        #section1, #section2, #section3, #section3Bg{
            height: 100vh;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        #section1 {
            background-image: url('{{ asset("images/head-bg.png") }}');
        }
        #section2 {
            background-image: url('{{ asset("images/sec2-bg.png") }}');
        }
        #section3Bg {
            background-color: #121212;
        }
        #section3 {
            background-image: url('{{ asset("images/sec3-bg.png") }}');
        }
    </style>
</head>
<body>
    <div id="section1">
        <section1></section1>
    </div>
    <div id="section2">
        <section2></section2>
    </div>
    <div id="section3Bg">
        <section3Bg></section3Bg>
    </div>
    <div id="section3">
        <section3></section3>
    </div>
</body>
</html>