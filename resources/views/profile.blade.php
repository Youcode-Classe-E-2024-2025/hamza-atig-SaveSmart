<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profiles</title>
</head>
<body>
    @if (session('LoggedUser'))
        <p>You are logged in as {{ session('LoggedUser') }}</p>
    @else
        <p>You are not logged in</p>
    @endif
</body>
</html>

