<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (isset($_SESSION['user'])) {
        if ($email == $_SESSION['user']['email'] && $password == $_SESSION['user']['password']) {
            $_SESSION['logged_in'] = true;
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid credentials!";
        }
    } else {
        $error = "No user registered yet!";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <header>
        <h1>Student Portal System</h1>
        <nav>
            <a href="index.html">Home</a>
            <a href="register.php">Register</a>
            <a href="login.php">Login</a>
        </nav>
    </header>

    <main>
        <section>
            <div class="card">
                <form method="POST">
                    <h2>Student Login</h2>
                    <?php if (!empty($error)) echo "<p style='color:red;text-align:center;'>$error</p>"; ?>
                    <label>Email:</label><input type="email" name="email" required>
                    <label>Password:</label><input type="password" name="password" required>
                    <button type="submit">Login</button>
                </form>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2026 Student Portal System - Group 13</p>
    </footer>
</body>

</html>