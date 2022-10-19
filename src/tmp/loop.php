<?php
$a = 0;

while (true) {
    echo $a . PHP_EOL;
    $a += 10;
    if ($a > 50) {
        break;
    }
}

// while (true) {
//     if ($a <= 50) {
//         echo $a . PHP_EOL;
//         $a += 10;
//     } else {
//         break;
//     }
// }
