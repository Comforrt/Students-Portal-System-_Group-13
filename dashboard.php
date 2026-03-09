<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Portal Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <header>
        <h1>Student Portal Dashboard</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <main>
        <section>
            <div class="card dashboard-info">
                <h2>Welcome, <?php echo $user['name']; ?>!</h2>
                <p><strong>Email:</strong> <?php echo $user['email']; ?></p>

                <h3>Your Profile Image:</h3>
                <!-- Profile image directly beneath heading -->
                <img src="<?php echo $user['profile']; ?>" alt="Profile Picture" width="180">

                <h3>📚 Student Information</h3>
                <p><strong>Program:</strong> BSc Computer Science</p>
                <p><strong>Year:</strong> Level 200</p>
                <p><strong>Status:</strong> Active</p>

                <h3>🔔 Notifications</h3>
                <ul>
                    <li>Mid-Semester Exams start next week.</li>
                    <li>Project submission deadline: March 20, 2026.</li>
                    <li>Library access extended till 10 PM.</li>
                </ul>

                <h3>📅 Upcoming Events</h3>
                <p>Hackathon 2026 – April 5</p>
                <p>Guest Lecture: AI in Education – April 12</p>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2026 Student Portal System - Group 13</p>
    </footer>
</body>

</html>