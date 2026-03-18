<?php
session_start();
// session destroy removes all session data stored on the server like $_SESSION['username'], $_SESSION['username']
session_destroy();
// it is then redirected to the index page, which is the homepage of the student portal system. This effectively logs the user out and prevents access to any protected pages until they log in again.
header("Location: index.html");
exit(); // ensures that nothing runs after the redirection
