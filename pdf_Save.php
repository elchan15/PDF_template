<?php
if (!isset($_POST['pdf_title'])) {
    echo "Error: Missing PDF title!";
    exit;
}

$title = preg_replace("/[^a-zA-Z0-9_-]/", "_", $_POST['pdf_title']); // Sanitize title
$filename = "data/" . $title . ".txt";

if (!is_dir("data")) {
    mkdir("data", 0777, true);
}

// Save all form inputs as JSON
$data = json_encode($_POST) . "\n";
file_put_contents($filename, $data, FILE_APPEND);

echo "Data saved to " . $filename;
?>
