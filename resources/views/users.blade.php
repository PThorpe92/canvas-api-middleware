<!DOCTYPE html>
<html>

<head>
    <title>Canvas Users</title>
</head>

<body>
    <h1>Canvas Users</h1>

    <ul>
        @foreach ($users as $user)
        <li>{{ $user['name'] }}</li>
        @endforeach
    </ul>

    @if (isset($newUser))
    <h2>New User Created:</h2>
    <p>Name: {{ $newUser['name'] }}</p>
    <p>Email: {{ $newUser['email'] }}</p>
    @endif

    <form method="POST" action="{{ route('canvas.create-user') }}">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" id="name" />
        <label for="email">Email</label>
        <input type="email" name="email" id="email" />
        <button type="submit">Create User</button>
    </form>
</body>

</html>
