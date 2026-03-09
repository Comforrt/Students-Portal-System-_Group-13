<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // Ensure uploads folder exists
    $target_dir = __DIR__ . "/uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $file_name = basename($_FILES["profile"]["name"]);
    $target_file = $target_dir . $file_name;
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $allowed_types = ["jpg", "jpeg", "png", "gif"];

    if (in_array($file_type, $allowed_types)) {
        if (move_uploaded_file($_FILES["profile"]["tmp_name"], $target_file)) {
            $_SESSION['user'] = [
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'profile' => "uploads/" . $file_name
            ];
            echo "<p style='color:white;text-align:center;'>Registration successful! <a href='login.php' style='color:yellow;'>Login here</a></p>";
        } else {
            echo "<p style='color:red;text-align:center;'>Error uploading file.</p>";
        }
    } else {
        echo "<p style='color:red;text-align:center;'>Only image files (jpg, jpeg, png, gif) are allowed.</p>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
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
                <form method="POST" enctype="multipart/form-data">
                    <h2>Student Registration</h2>
                    <label>Name:</label><input type="text" name="name" required>
                    <label>Email:</label><input type="email" name="email" required>
                    <label>Password:</label><input type="password" name="password" required>
                    <label>Upload Profile Image:</label><input type="file" name="profile" accept="image/*" required>
                    <button type="submit">Register</button>
                </form>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2026 Student Portal System - Group 13</p>
    </footer>
</body>

</html>