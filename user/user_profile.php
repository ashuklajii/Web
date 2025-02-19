<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$query = "SELECT username, mobile, address FROM users WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo "<p>User details not found.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        :root {
            --accent-color: #C5A992;
            --dark-color: #2f2f2f;
            --light-color: #F3F2EC;
            --text-color: #757575;

            --body-font: "Raleway", sans-serif;
            --heading-font: "Prata", Georgia, serif;
        }

        body {
            background-color: var(--light-color);
            color: var(--text-color);
            font-family: var(--body-font);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }

        .profile-card {
            background-color: #fff;
            border: 1px solid var(--accent-color);
            border-radius: 8px;
            padding: 2rem;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            font-family: var(--heading-font);
            color: var(--dark-color);
            margin-bottom: 1rem;
        }

        .profile-info {
            margin: 1rem 0;
            font-size: 1rem;
        }

        .profile-info strong {
            color: var(--dark-color);
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            .profile-card {
                padding: 1.5rem;
            }

            h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="profile-card">0
        <h2>Your Profile</h2>
        <div class="profile-info">
            <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
            <p><strong>Mobile:</strong> <?php echo htmlspecialchars($user['mobile']); ?></p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($user['address']); ?></p>
        </div>
        <p><a href="user_signup.php" style="color: var(--accent-color); text-decoration: none;">New Account</a></p>
        
    </div>
</body>
</html>
