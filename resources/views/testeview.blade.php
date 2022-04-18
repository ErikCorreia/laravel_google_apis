<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
</head>
<body>
    <h1>OK</h1>

    @foreach ($data as $key => $value)
        <h1>{{ $value }}</h1>
    @endforeach

</body>
</html>