<?php
$doctorNames = [
    '1' => 'MRS. MANJU (Cardiologist)',
    '2' => 'MR. SATHISH (Neurologist)',
    '3' => 'MR. SUBINRA (Oncology)'
];

$timeSlots = [
    '09:00 AM - 11:00 AM (MRS.MANJU)',
    '10:00 AM - 12:00 PM (MR.SATHISH)',
    '08:00 AM - 10:00 AM (MR.SUBINRA)',
    '01:00 PM - 02:00 PM (MRS.MANJU)',
    '03:00 PM - 04:00 PM (MR.SATHISH)',
    '04:00 PM - 05:00 PM (MR.SUBINRA)'
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Doctor Appointment</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>

    <form action="dashboard.php" method="POST">
        <h2>Doctor Appointment Form</h2>

        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" placeholder="Enter your name" required><br><br>

        <label for="age">Age:</label><br>
        <input type="number" id="age" name="age" placeholder="Enter your age" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" placeholder="Enter your email" required><br><br>

        <label for="doctor">Choose a Doctor:</label><br>
        <select id="doctor" name="doctor" required>
            <option value="">Select a Doctor</option>
            <?php foreach ($doctorNames as $key => $name): ?>
                <option value="<?= $key ?>"><?= $name ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="date">Date:</label><br>
        <input type="date" id="date" name="date" required min="<?= date('Y-m-d'); ?>"><br><br>

        <label for="time">Available Time Slots:</label><br>
        <select id="time" name="time" required>
            <option value="">Select a Time Slot</option>
            <?php foreach ($timeSlots as $slot): ?>
                <option value="<?= $slot ?>"><?= $slot ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit">Submit</button>

    </form>

</body>

</html>