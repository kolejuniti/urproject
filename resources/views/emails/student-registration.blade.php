<!DOCTYPE html>
<html>
<head>
    <title>Notifikasi Pendaftaran Pelajar Baru</title>
</head>
<body>    
    <p>Ini adalah notifikasi Borang Hubungi bagi admin Kolej UNITI</p>
    
    <table border="0" cellpadding="5">
        <tr>
            <td><strong>Name Penuh:</strong></td>
            <td>{{ $studentData['name'] }}</td>
        </tr>
        <tr>
            <td><strong>No. Kad Pengenalan:</strong></td>
            <td>{{ $studentData['ic'] }}</td>
        </tr>
        <tr>
            <td><strong>Emel:</strong></td>
            <td>{{ $studentData['email'] }}</td>
        </tr>
        <tr>
            <td><strong>No. Telefon:</strong></td>
            <td>{{ $studentData['phone'] }}</td>
        </tr>
        <tr>
            <td><strong>Program Pertama:</strong></td>
            <td>{{ $studentData['programA'] }}</td>
        </tr>
        <tr>
            <td><strong>Program Kedua:</strong></td>
            <td>{{ $studentData['programB'] }}</td>
        </tr>
    </table>
</body>
</html>