<?php

require "helpers/helper-functions.php";

session_start();

// Validate Step 3
if (
    empty($_POST['email']) ||
    empty($_POST['password']) ||
    !isset($_POST['agree'])
) {
    header("Location: step-3.php");
    exit();
}

// Save Step 3 data
$_SESSION['email'] = $_POST['email'];
$_SESSION['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
$_SESSION['agree'] = "Yes";

// Copy session data
$form_data = $_SESSION;

// Format birthday
$form_data['birthdate'] = date("F d, Y", strtotime($_SESSION['birthdate']));

// Compute age
$birth = new DateTime($_SESSION['birthdate']);
$today = new DateTime();
$form_data['age'] = $today->diff($birth)->y;

// Save to CSV
$file = fopen("registrations.csv", "a");

fputcsv($file, [
    $form_data['fullname'],
    $form_data['birthdate'],
    $form_data['age'],
    $form_data['contact_number'],
    $form_data['sex'],
    $form_data['program'],
    $form_data['address'],
    $form_data['email']
]);

fclose($file);

dump_session();

session_destroy();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Thank You</title>
    <link rel="stylesheet" href="https://assets.ubuntu.com/v1/vanilla-framework-version-4.15.0.min.css">
</head>
<body>

<section class="p-section--hero">

<div class="row">

<div class="col">

<h1>Thank You Page</h1>

<table>

<thead>
<tr>
<th>Field</th>
<th>Value</th>
</tr>
</thead>

<tbody>

<?php foreach ($form_data as $key => $value): ?>

<tr>
<td><?php echo ucfirst(str_replace("_"," ",$key)); ?></td>
<td><?php echo htmlspecialchars($value); ?></td>
</tr>

<?php endforeach; ?>

<tr>
<td>Age</td>
<td><?php echo $form_data['age']; ?></td>
</tr>

</tbody>

</table>

</div>

</div>

</section>

</body>
</html>