<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information Form</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        form {
            max-width: 500px;
            margin: 20px auto;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
        }
        button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">Student Information Form</h2>

<form method="POST" action="">
    <label for="first_name">First Name:</label>
    <input type="text" id="first_name" name="first_name" required>
    
    <label for="last_name">Last Name:</label>
    <input type="text" id="last_name" name="last_name" required>

    <label for="dob">Date of Birth:</label>
    <input type="date" id="dob" name="dob" required>

    <label for="address">Address:</label>
    <textarea id="address" name="address" required></textarea>

    <label for="mobile">Mobile Number:</label>
    <input type="text" id="mobile" name="mobile" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <button type="submit">Submit</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input data

    $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
    $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
    $dob = filter_input(INPUT_POST, 'dob', FILTER_SANITIZE_STRING);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
    $mobile = filter_input(INPUT_POST, 'mobile', FILTER_SANITIZE_NUMBER_INT);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    // Validate inputs
    $errors = [];

    if (!preg_match("/^[a-zA-Z ]*$/", $first_name)) {
        $errors[] = "First name should only contain letters and spaces.";
    }
    if (!preg_match("/^[a-zA-Z ]*$/", $last_name)) {
        $errors[] = "Last name should only contain letters and spaces.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (!preg_match("/^[0-9]{10}$/", $mobile)) {
        $errors[] = "Mobile number should be 10 digits.";
    }

    if (empty($errors)) {
        // Display submitted data in a table
        echo "<h3>Submitted Data:</h3>";
        echo "<table>";
        echo "<tr><th>First Name</th><td>" . htmlspecialchars($first_name) . "</td></tr>";
        echo "<tr><th>Last Name</th><td>" . htmlspecialchars($last_name) . "</td></tr>";
        echo "<tr><th>Date of Birth</th><td>" . htmlspecialchars($dob) . "</td></tr>";
        echo "<tr><th>Address</th><td>" . nl2br(htmlspecialchars($address)) . "</td></tr>";
        echo "<tr><th>Mobile Number</th><td>" . htmlspecialchars($mobile) . "</td></tr>";
        echo "<tr><th>Email</th><td>" . htmlspecialchars($email) . "</td></tr>";
        echo "</table>";
    } else {
        // Display error messages
        echo "<div style='color: red;'><ul>";
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul></div>";
    }
}
?>

</body>
</html>
