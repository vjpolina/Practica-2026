<?php
echo "Hello, World!";
echo "<script>console.log('Potatoes!');</script>";

/*
Scrierea in consola poate fi implementata si prin urmatoarea functie:

function console_log($output, $with_script_tags = true) {
$js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
');';
if ($with_script_tags) {
$js_code = '<script>' . $js_code . '</script>';
}
echo $js_code;
}

console_log('text here');
*/