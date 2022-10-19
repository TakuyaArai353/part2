<?php

// $numbers = [1, 2, 3, 4, 5];

// foreach ($numbers as $number) {
//     echo $number * 2 . PHP_EOL;
// }

$currencies = [
    'japan' => 'yen',
    'us' => 'dollar',
    'england' => 'pound',
];

foreach ($currencies as $currencie => $currency) {
    echo $currencie . ':' . $currency . PHP_EOL;
}
