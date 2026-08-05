<?php defined('BASEPATH') or exit('No direct script access allowed');

$pdf->setMargins(6.5, 8, 6.5);

// Theese lines should aways at the end of the document left side. Dont indent these lines
$html = <<<EOF
<div>
$delivery
</div>
EOF;
$pdf->writeHTML($html, true, false, true, false, '');
