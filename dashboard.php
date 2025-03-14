<?php

$file = 'Datas.csv';
if (!file_exists($file)) {
    touch($file); 
}
$doctorNames = [
    '1' => 'MRS. MANJU (Cardiologist)',
    '2' => 'MR. SATHISH (Neurologist)',
    '3' => 'MR. SUBINRA (Oncology)'
];

$errorMessage = "";
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name'] ?? '');
    $age = intval($_POST['age'] ?? 0);
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $doctor = $_POST['doctor'] ?? '';
    $date = $_POST['date'] ?? '';
    $time = $_POST['time'] ?? '';

    if (empty($name) || $age <= 0 || empty($email) || empty($doctor) || empty($date) || empty($time)) {
        $errorMessage = "Error: All fields are required.";
    } elseif (!isset($doctorNames[$doctor])) {
        $errorMessage = "Error: Invalid doctor selection.";
    } else {
        $newEntry = [$name, $age, $email, $doctorNames[$doctor], $date, $time];

        if (($fileHandle = fopen($file, 'a')) !== false) {
            fputcsv($fileHandle, $newEntry);
            fclose($fileHandle);
            $successMessage = "";
        } else {
            $errorMessage = "";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Appointment Confirmation</title>
    <link rel="stylesheet" href="dashboard.css">
</head>

<body>
    <h2 style="text-align: center;">Appointment Confirmation</h2>

    <?php if ($errorMessage): ?>
        <p class="message"><?php echo $errorMessage; ?></p>
    <?php endif; ?>

    <?php if ($successMessage): ?>
        <p class="message success"><?php echo $successMessage; ?></p>
    <?php endif; ?>

    <table>
        <tr>
            <th>Name</th>
            <th>Age</th>
            <th>Email</th>
            <th>Doctor</th>
            <th>Date</th>
            <th>Time Slot</th>
        </tr>

        <?php
        if (file_exists($file) && ($fileHandle = fopen($file, 'r')) !== false) {
            while (($row = fgetcsv($fileHandle)) !== false) {
                echo "<tr>";
                foreach ($row as $cell) {
                    echo "<td>" . htmlspecialchars($cell) . "</td>";
                }
                echo "</tr>";
            }
            fclose($fileHandle);
        }
        ?>
    </table>

    <br>
    <form action="login.php" method="POST">
        <button type="submit">Back to Login</button>
    </form>

</body>

</html>
