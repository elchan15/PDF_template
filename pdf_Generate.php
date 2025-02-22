<?php
require('fpdf/fpdf.php');

if (!isset($_GET['pdf_title'])) {
    die("Error: Missing PDF title!");
}

$title = preg_replace("/[^a-zA-Z0-9_-]/", "_", $_GET['pdf_title']); // Sanitize title
$filename = "data/" . $title . ".txt";

if (!file_exists($filename)) {
    die("Error: No data found for " . htmlspecialchars($_GET['pdf_title']));
}

class PDF extends FPDF {
    function addTextToPDF($x, $y, $text, $width = 0, $height = 10, $border = 0, $align = 'L', $multi = false, $font = 'Arial', $style = '', $size = 12, $textColor = [0, 0, 0], $bgColor = null) {
        $this->SetFont($font, $style, $size);
        $this->SetTextColor($textColor[0], $textColor[1], $textColor[2]);
        $this->SetXY($x, $y);

        if ($bgColor) {
            $this->SetFillColor($bgColor[0], $bgColor[1], $bgColor[2]);
            $fill = true;
        } else {
            $fill = false;
        }

        if ($multi) {
            $this->MultiCell($width, $height, $text, $border, $align, $fill);
        } else {
            $this->Cell($width, $height, $text, $border, 1, $align, $fill);
        }
    }
}

// Convert Hex to RGB
function hexToRGB($hex) {
    $hex = str_replace("#", "", $hex);
    return [hexdec(substr($hex, 0, 2)), hexdec(substr($hex, 2, 2)), hexdec(substr($hex, 4, 2))];
}

// Create PDF
$pdf = new PDF();
$pdf->AddPage();

// Read data from the TXT file
$lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

foreach ($lines as $line) {
    $data = json_decode($line, true);

    $x = $data['x'] ?? 10;
    $y = $data['y'] ?? 10;
    $text = $data['text'] ?? "";
    $width = $data['width'] ?? 0;
    $height = $data['height'] ?? 10;
    $border = $data['border'] ?? 0;
    $align = $data['align'] ?? 'L';
    $multi = isset($data['multi']) ? ($data['multi'] == '1') : false;
    $font = $data['font'] ?? 'Arial';
    $size = $data['size'] ?? 12;
    $style = '';

    if (!empty($data['bold'])) $style .= 'B';
    if (!empty($data['italic'])) $style .= 'I';
    if (!empty($data['underline'])) $style .= 'U';

    $textColor = isset($data['text_color']) ? hexToRGB($data['text_color']) : [0, 0, 0];
    $bgColor = (!empty($data['bg_color']) && $data['bg_color'] !== "#ffffff") ? hexToRGB($data['bg_color']) : null;

    $pdf->addTextToPDF($x, $y, $text, $width, $height, $border, $align, $multi, $font, $style, $size, $textColor, $bgColor);
}

// Output the PDF
$pdf->Output();
?>
