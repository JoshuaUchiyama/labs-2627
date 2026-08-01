<?php

$file = fopen("registrations.csv", "r");

?>

<html>
<head>
    <meta charset="utf-8">
    <title>Registrants</title>

    <link rel="stylesheet"
    href="https://assets.ubuntu.com/v1/vanilla-framework-version-4.15.0.min.css">

</head>

<body>

<section class="p-section--hero">

<div class="row">

<div class="col">

<h1>Registered Students</h1>

<table>

<thead>

<tr>

<th>Complete Name</th>
<th>Birthday</th>
<th>Age</th>
<th>Contact Number</th>
<th>Sex</th>
<th>Program</th>
<th>Complete Address</th>
<th>Email Address</th>

</tr>

</thead>

<tbody>

<?php

while (($row = fgetcsv($file)) !== false) {

    echo "<tr>";

    foreach ($row as $column) {

        echo "<td>" . htmlspecialchars($column) . "</td>";

    }

    echo "</tr>";

}

fclose($file);

?>

</tbody>

</table>

</div>

</div>

</section>

</body>
</html>