<?php
include 'db-connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $formClass = isset($_POST['formClass']) ? strtolower(trim($_POST['formClass'])) : '';
    $sNum = isset($_POST['sNum']) ? $_POST['sNum'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Validate form class
    if ($formClass === 'admin' || $formClass === 'staff') {
        $sql = "SELECT * FROM users WHERE sNum = ? AND level = ?";
        $stmt = $conn->prepare($sql);

        if ($formClass === 'admin') {
            $level = 1;
            $redirectPage = 'staff/index.php';
        } elseif ($formClass === 'staff') {
            $level = 2;
            $redirectPage = 'student/student.php';
        }

        $stmt->bind_param("si", $sNum, $level);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                // Successful login
                session_start();
                $_SESSION['level'] = $level;
                $_SESSION['user_details'] = $user;
				$_SESSION['sNum'] = $sNum;

                echo "<script>alert('Login successful');</script>";
                echo "<script>window.location.href = '$redirectPage';</script>";
                exit;
            } else {
                // Invalid password
                echo "<script>alert('Invalid password.');</script>";
                echo "<script>window.location.href = 'index.php';</script>";
            }
        } else {
            // User not found
            echo "<script>alert('User not found.');</script>";
            echo "<script>window.location.href = 'index.php';</script>";
        }

        $stmt->close();
    } else {
        // Invalid form class
        echo "<script>alert('Invalid form class.');</script>";
        echo "<script>window.location.href = 'index.php';</script>";
    }

    $conn->close();
} else {
    // Form not submitted
    echo "<script>alert('Form not submitted.');</script>";
    echo "<script>window.location.href = 'index.php';</script>";
}
?>
