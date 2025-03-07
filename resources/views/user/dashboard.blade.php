<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 80%; margin: 20px auto; }
        .logout-btn { background-color: #ff0000; color: white; padding: 10px 20px; border: none; cursor: pointer; }
        .logout-btn:hover { background-color: #cc0000; }
        .user-details { margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>User Dashboard</h2>
        <p>Welcome, {{ Session::get('user_data.name') }}!</p>
        <p>Role: {{ Session::get('user_data.role') }}</p>

        <div class="user-details">
            <h3>Your Details:</h3>
            <p>ID: {{ Session::get('user_data.id') }}</p>
            <p>Email: {{ Session::get('user_data.email') }}</p>
            <p>Contact: {{ Session::get('user_data.contact') }}</p>
            <p>Address: {{ Session::get('user_data.address') }}</p>
            <p>Joining Date: {{ Session::get('user_data.joiningdate') }}</p>
            <p>Set Amount: {{ Session::get('user_data.setamount') }}</p>
            <p>Profile Pic: {{ Session::get('user_data.profile_pic') ?: 'No profile pic' }}</p>
            <p>Created At: {{ Session::get('user_data.created_at') }}</p>
            <p>Updated At: {{ Session::get('user_data.updated_at') }}</p>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
</body>
</html>