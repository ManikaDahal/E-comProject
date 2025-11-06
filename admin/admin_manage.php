<?php
session_start();

require_once 'connect.php';

// Fetch admins from the database
$sql = "SELECT * FROM admins";
$result = mysqli_query($conn, $sql);

$admins = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $admins[] = $row;
    }
}

// Handle password change
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['change_password'])) {
        $adminId = $_POST['admin_id'];
        $newPassword = $_POST['new_password'];
        
        // Hash the new password before updating
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        
        // Update password in the database
        $updateSql = "UPDATE admins SET password = '$hashedPassword' WHERE admin_id = $adminId";
        if (mysqli_query($conn, $updateSql)) {
            echo "Password changed successfully";
        } else {
            echo "Error updating password: " . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            display: inline-block;
        }
        /* CSS for the button */
/* CSS for the button */
button {
    background-color: #4CAF50;
    color: white;
    padding: 8px 15px; /* Adjust padding to make the button smaller */
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
    font-size: 14px; /* Reduce font size for smaller text */
}

button:hover {
    background-color: #45a049;
}


    </style>
</head>
<body>
    <?php include 'admin_nav.php'; ?><br><br>
    <div class="container">
        <h2>Admin Records</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Creation Timestamp</th>
                <th>Action</th>
            </tr>
            <?php foreach ($admins as $admin) : ?>
                <tr>
                    <td><?php echo $admin['admin_id']; ?></td>
                    <td><?php echo $admin['username']; ?></td>
                    <td><?php echo $admin['email']; ?></td>
                    <td><?php echo $admin['created_at']; ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="admin_id" value="<?php echo $admin['admin_id']; ?>">
                            <input type="password" name="new_password" placeholder="New Password" required><br>
                            <button type="submit" name="change_password">Change Password</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php include 'admin_footer.php'; ?><br><br>
</body>
</html>
