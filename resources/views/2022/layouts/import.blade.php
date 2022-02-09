<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/2022/especial/importepersonas" method="post" enctype="multipart/form-data">
        @csrf
        <label for="xcl">importar personas</label>
        <input type="file" name="xcl" id="xcl">
        <button type="submit">boton</button>
    </form>
</body>
</html>
