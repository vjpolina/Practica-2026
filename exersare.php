<?php
echo "Hello, World!" . "<br>" . "<br>";
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
 $Numere = [13, 135, 31, 49, 51, 99, 74, 86, 97, 2, 89];

 echo "Numerele din array sunt: ";
 foreach ($Numere as $numar) {
     echo $numar . " ";
 }
 echo "<br>";

$nr_par=0;
$nr_impare=0;
$i=0;

for($i=0; $i<10; $i++){
    if($Numere[$i]%2==0) $nr_par++;
    else $nr_impare++;
}

echo "În array sunt " . $nr_par . " numere pare, și " . $nr_impare . " numere impare.";


