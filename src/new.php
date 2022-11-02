<?php
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="wedth=device-width,initial-scale=1">

    <title>読書ログ登録</title>
</head>
<body>
    <h1>読書ログ</h1>
    <h2>読書ログの登録</h2>

    <form action="" method="POST">
        <div>
            <label for="title">書籍名</label>
            <input type="text" id="title" name="title">
        </div>
        <div>
            <label for="author">著者名</label>
            <input type="author" id="author" name="author">
        </div>
        <!-- <div>
            <label for="situation">読書状況</label>
            <input type="radio" id="situation" name="situation" value="未読">未読
            <input type="radio" id="situation" name="situation" value="読中">読中
            <input type="radio" id="situation" name="situation" value="読了">読了
        </div> -->
        <div>
            <label>読書状況</label>
            <div>
                <div>
                    <input type="radio" name="status" id="status1" value="未読">
                    <label for="status1">未読</label>
                </div>
                <div>
                    <input type="radio" name="status" id="status2" value="読んでる">
                    <label for="status2">読んでる</label>
                </div>
                <div>
                    <input class="form-check-input" type="radio" name="status" id="status3" value="読了">
                    <label for="status3">読了</label>
                </div>
            </div>
        </div>
        <div>
            <label for="score">評価（５点満点の整数）</label>
            <input type="text" id="score" name="score" pattern="^[+-]?([1-5][0-5]*|0)$">
        </div>
        <div>
            <label for="impression">感想</label>
            <textarea type="text" id="impression" name="impression" row="10"></textarea>
        </div>
        <button type="submit">登録する</button>
    </form>
</body>
</html>
