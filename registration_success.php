<!DOCTYPE html>
<html>
<head>
    <title>Registration Success</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
    <h1>Registration Successful!</h1>
    <?php if (isset($_GET['username'])) : ?>
        <p>Login successful! Welcome, <?php echo $_GET['username']; ?> with ID: <?php echo $_GET['id']; ?></p>
    <?php else : ?>
        <p>Login successful! Your ID is: <?php echo $_GET['id']; ?></p>

    <?php endif; ?>
    <p>Please save your ID and login to continue</p>
    <p><a href="login.html">Proceed to Login</a></p>
    </body>
</html>