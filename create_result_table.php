<?php
$db = new SQLite3('experiments.db');
$db->exec("CREATE TABLE experiments(id INTEGER PRIMARY KEY, path TEXT)");
// Example:
$db->exec("INSERT INTO experiments(path) VALUES('TODO: TEST')");
