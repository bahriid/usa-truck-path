<!DOCTYPE html>
<html>
<head>
    <title>New Course Purchased!</title>
</head>
<body>
    <h1>New Course Purchased!</h1>

    <p>{{ $userName }} has   purchased a course:{{ $courseTitle }}</p>

    <h3>User Details:</h3>
    <ul>
        <li><strong>Name:</strong> {{ $userName }}</li>
        <li><strong>Email:</strong> {{ $userEmail }}</li>
    </ul>

    <h3>Course Details:</h3>
    <ul>
        <li><strong>Title:</strong> {{ $courseTitle }}</li>
        <li><strong>Price:</strong> ${{ $coursePrice }}</li>
    </ul>

    <p>Thank you,</p>
    <p>{{ config('app.name') }}</p>
</body>
</html>