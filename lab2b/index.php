<?php

$start = microtime(true);

define('CUSTOMERS_FILE_PATH', 'customers-10000.csv');

function get_customers_data()
{
    $opened_file_handler = fopen(CUSTOMERS_FILE_PATH, 'r');

    $data = [];
    $headers = [];
    $row_count = 0;

    while (!feof($opened_file_handler)) {

        $row = fgetcsv($opened_file_handler, 1024);

        if (!empty($row)) {

            if ($row_count == 0) {
                $headers = $row;
            } else {
                $data[] = $row;
            }

            $row_count++;
        }
    }

    fclose($opened_file_handler);

    return [
        'headers' => $headers,
        'data' => $data
    ];
}

$customers = get_customers_data();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #2</title>

    <link rel="icon" href="https://phpsandbox.io/assets/img/brand/phpsandbox.png">

    <link rel="stylesheet"
        href="https://assets.ubuntu.com/v1/vanilla-framework-version-4.15.0.min.css" />
</head>

<body>

<h1>Customers</h1>

<h4>
<?php foreach (range('A', 'Z') as $letter): ?>
    <a href="filtered.php?letter=<?php echo $letter; ?>">
        <?php echo $letter; ?>
    </a>
<?php endforeach; ?>
</h4>

<small>
The dataset is retrieved from this URL
<a href="https://www.datablist.com/learn/csv/download-sample-csv-files">
https://www.datablist.com/learn/csv/download-sample-csv-files
</a>
</small>

<table aria-label="Customers Dataset">

<thead>

<tr>
    <th>Customer ID</th>
    <th>Complete Name</th>
    <th>Company</th>
    <th>Address</th>
    <th>Email Address</th>
</tr>

</thead>

<tbody>

<?php foreach ($customers['data'] as $record): ?>

<tr>

    <td><?php echo $record[1]; ?></td>

    <td>
        <strong><?php echo $record[3]; ?></strong>,
        <?php echo $record[2]; ?>
    </td>

    <td><?php echo $record[4]; ?></td>

    <td><?php echo $record[7]; ?></td>

    <td><?php echo $record[9]; ?></td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

<?php

$end = microtime(true);
$execution_time = $end - $start;

?>

<hr>

<p>
Execution Time:
<strong><?php echo number_format($execution_time, 6); ?></strong>
seconds
</p>

</body>

</html>