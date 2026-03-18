<?php
// session_start() is used to start a new session or resume an existing one. 
// It allows you to store and access session variables across multiple pages in a web application. In this code, it is used to manage user authentication and maintain the user's logged-in state.
session_start();

// checks if the form was submitted using post method and it only runs if user submit the form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //retrieves the submitted email and password
    $email = $_POST['email'];
    $password = $_POST['password'];

    // checks if a user has been registered and stord in session
    if (isset($_SESSION['user'])) {

        //compares the stored email and password with the submitted values. If they match,
        //it sets a session variable 'logged_in' to true and redirects the user to the dashboard page
        if ($email == $_SESSION['user']['email'] && $password == $_SESSION['user']['password']) {
            $_SESSION['logged_in'] = true;
            header("Location: dashboard.php");
            exit();
        } else {  //If the credentials are invalid, it sets an error message to be displayed on the login page
            $error = "Invalid credentials!";
        }
    } else { //If no user is registered yet, it also sets an error message indicating that no user exists.
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
    <!-- header section of the page consisting of the title and navigation links -->
    <header>
        <h1>Student Portal System</h1>
        <nav>
            <a href="index.html">Home</a>
            <a href="register.php">Register</a>
            <a href="login.php">Login</a>
        </nav>
    </header>

    <!-- main content of the page -->
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

    <!-- footer section with copyright information and group details -->
    <footer>
        <p>&copy; 2026 Student Portal System - Group 13</p>
    </footer>
</body>

</html>