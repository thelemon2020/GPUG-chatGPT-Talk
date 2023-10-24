<!doctype html>
<html lang="en">
<head>
    @viteReactRefresh
    @vite('resources/ts/app.tsx')
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>ChatGPT Demo</title>
</head>
<body>
<div id="home-root">

</div>
</body>
</html>
