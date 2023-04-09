<!DOCTYPE html>
<html>
    <head>
        <title>Register Page</title>
    </head>
    <body>
        <h2>Register</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div>
                <label for="name">Name:</label>
                <input type="text" name="name" id="name">
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email">
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password">
            </div>
            <div>
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" name="password_confirmation" id="password_confirmation">
            </div>
            <div>
                <label for="bio">Bio:</label>
                <input type="bio" name="bio" id="bio">
            </div>
            <div>
                <input type="submit" value="Register">
            </div>
        </form>
    </body>
</html>
