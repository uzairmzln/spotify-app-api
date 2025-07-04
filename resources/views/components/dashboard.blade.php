<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        #section1, #section2 {
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
    </style>
</head>
<body>
    <div id="section1">
        <section1></section1>
    </div>
    <div id="section2">
        <section2></section2>
    </div>
</body>
</html>