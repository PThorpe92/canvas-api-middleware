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
    @endif

    <form method="POST" action="{{ route('canvas.create-user') }}">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" id="name" />
        <label for="email">Email</label>
        <input type="email" name="email" id="email" />
        <div>
            <label for="terms_of_use">Accept terms of use agreement</label>

            <input type="checkbox" name="terms_of_use" id="terms_of_use" />
            @if ('terms_of_use' == false)
            <p>You must accept the terms of use to create a user.</p>
            @endif
        </div>
        <button type="submit">Create User</button>
    </form>
</body>

</html>
