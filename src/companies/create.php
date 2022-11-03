<?php

require_once __DIR__ . '/lib/mysqli.php';

function createCompany($link, $company)
{
    $sql = <<<EOT
    INSERT INTO companies (
        name,
        establishment_date,
        founder
    ) VALUES (
        "{$company['name']}",
        "{$company['establishment_date']}",
        "{$company['founder']}"
    )
    EOT;
    $result = mysqli_query($link, $sql);

    if ($result) {
        echo '登録が完了しました' . PHP_EOL;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $company = [
        'name' => $_POST['name'],
        'establishment_date' => $_POST['establishment_date'],
        'founder' => $_POST['founder']
    ];

    // バリデーションする
    $link = dbConnect();

    createCompany($link, $company);

    mysqli_close($link);
}

header("Location: index.php");

?>
