<?php
$db = new SQLite3('experiments.db');
$db->exec("CREATE TABLE experiments(id INTEGER PRIMARY KEY, path TEXT, date TEXT)");
// Example:
// $db->exec("INSERT INTO experiments(path) VALUES('TODO: TEST TEST TEST', '2025-01-13 12:00:00.000)");
