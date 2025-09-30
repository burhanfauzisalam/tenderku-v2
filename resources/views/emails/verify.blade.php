<!DOCTYPE html>
<html>

<head>
    <title>Verifikasi Email</title>
</head>

<body>
    <h2>Halo, terima kasih sudah mendaftar!</h2>
    <p>Silakan klik link di bawah ini untuk verifikasi email Anda:</p>
    <a href="{{ url('/verify/' . $token) }}">Verifikasi Email</a>
</body>

</html>