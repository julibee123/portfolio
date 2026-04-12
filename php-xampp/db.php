<?php
$server = "localhost";
$userid = "root";
$password = "";
$dbname = "portfolio";
$port = 3307; // default is 3306, but my laptop has a conflict with MySQL, so I changed it to 3307

$db = mysqli_connect($server, $userid, $password, null, $port);
//Check connection
if (!$db)
    die("Connection Error: " . mysqli_connect_error());

$db->query("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
$db->select_db($dbname);

$db->query(
    "CREATE TABLE IF NOT EXISTS contact_messages (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(120) NOT NULL,
        email VARCHAR(190) NOT NULL,
        message TEXT NOT NULL,
        reply TEXT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci"
);

$reply_column_check = $db->query("SHOW COLUMNS FROM contact_messages LIKE 'reply'");

if ($reply_column_check && $reply_column_check->num_rows === 0) {
    $db->query("ALTER TABLE contact_messages ADD COLUMN reply TEXT NULL AFTER message");
}
