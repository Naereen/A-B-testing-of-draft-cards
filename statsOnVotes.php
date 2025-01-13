<?php
$date = date("Y-m-d_H:i");
$filename = "statsOnVotes_{$date}.csv";

// Set the content type to CSV
header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=$filename");

// Open the output stream
$output = fopen('php://output', 'w');

// Connect to the SQLite database
$db = new SQLite3('experiments.db');

// Check for connection errors
if (!$db) {
    die("Connection to database failed: " . $db->lastErrorMsg());
}

// Query the database
$result = $db->query("SELECT COUNT(*) as nombresVotes, path FROM experiments GROUP BY path ORDER BY nombresVotes DESC");

// Fetch the column names and write them to the CSV
$columns = [];
for ($i = 0; $i < $result->numColumns(); $i++) {
    $columns[] = $result->columnName($i);
}
fputcsv($output, $columns);

// Fetch each row and write it to the CSV
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    fputcsv($output, $row);
}

// Close the database connection
$db->close();

// Close the output stream
fclose($output);
exit();
?>
