<?php
//starts or resumes a session so that users can store their data in $_SESSION
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") { // ensures that code runs when submitteted via POST mthod
    //then it will rerieve the form inputs that's name, email, password and profile image
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    //Htmlspecialchars prevents XSS attacks by escaping special HTML characters like (<, >, &, ", ')


    $target_dir = __DIR__ . "/uploads/"; //defines the folder where profile images will be stored 
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); //incase folder doesn't exist it creates a new one with full permissions that's read, write and execute
    }

    $file_name = basename($_FILES["profile"]["name"]); //get the uploaded file name
    $target_file = $target_dir . $file_name; //builds the full path where file will be stored on the server
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); //get the file extension

    $allowed_types = ["jpg", "jpeg", "png", "gif"];
    //defines which file types are allowed and in this case it's only images

    if (in_array($file_type, $allowed_types)) { //checks if the uploaded file type is allowed

        //and if it is, it moves the file from temporary location to the directory(uploads)
        if (move_uploaded_file($_FILES["profile"]["tmp_name"], $target_file)) {
            $_SESSION['user'] = [ //stores the user's information in the session variable $_SESSION['user'] as an associative array with keys name, email, password and profile image
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
    <!-- header section of the page -->
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
            <div class="card" style="margin-top: 15px; margin-bottom: 15px">
                <form method="POST" enctype="multipart/form-data"> <!--multipart/form-data is used to upload files along with text inputs -->
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

    <!-- footer section of the page -->
    <footer>
        <p>&copy; 2026 Student Portal System - Group 13</p>
    </footer>
</body>

</html>