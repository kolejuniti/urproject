<!DOCTYPE html>
<html>
<head>
    <title>New Student Registration</title>
</head>
<body>
    <h1>New Student Registration</h1>
    
    <p>A new student has registered:</p>
    
    <table border="0" cellpadding="5">
        <tr>
            <td><strong>Name:</strong></td>
            <td>{{ $studentData['name'] }}</td>
        </tr>
        <tr>
            <td><strong>IC:</strong></td>
            <td>{{ $studentData['ic'] }}</td>
        </tr>
        <tr>
            <td><strong>Email:</strong></td>
            <td>{{ $studentData['email'] }}</td>
        </tr>
        <tr>
            <td><strong>Phone:</strong></td>
            <td>{{ $studentData['phone'] }}</td>
        </tr>
        <tr>
            <td><strong>Program First Choice:</strong></td>
            <td>{{ $studentData['programA'] }}</td>
        </tr>
        <tr>
            <td><strong>Program Second Choice:</strong></td>
            <td>{{ $studentData['programB'] }}</td>
        </tr>
        <tr>
            <td><strong>Registration Source:</strong></td>
            <td>{{ $studentData['source'] }}</td>
        </tr>
    </table>
</body>
</html>