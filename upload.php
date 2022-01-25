<?php
ini_set("auto_detect_line_endings", true);
if (!isset($_SESSION['id'])) {
    session_start();
}
$title = 'Bullentin board | Sin・System Engineers';
$description = 'アイコン変更';

?>
<!DOCTYPE html>
<html>
<?php
include 'inc/head.php'; // head.php の読み込み
?>
<!-- 特定のページでのみ読み込むスタイルシートなどがあればここに追加 -->
</head>

<body>
    <?php include 'inc/header.php'; ?>
    <!-- header.php の読み込み -->
    <div id="particles-js"></div>
    <nav class="crumbs">
        <ol>
            <li class="crumb"><a href="index.php">Top</a></li>
            <li class="crumb"><a href="profile.php">profile</a></li>
            <li class="crumb">Icon change</li>
        </ol>
    </nav>
    <section class="up01">
        <h1>画像アップロード</h1>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="image">
            <button><input type="submit" name="upload" value="変更"></button>
        </form>
    </section>
    <div class="border"></div>
    <?php include 'inc/footer.php'; ?>
    <!-- footer.php の読み込み -->



    <?php
    // テ゛ータベースに接続
    include('source/dbconnect.php');
    try {
        $db = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    if (isset($_POST['upload'])) { //送信ボタンが押された場合
        $id = $_SESSION['id'];
        $image = uniqid(mt_rand(), true); //ファイル名をユニーク化
        $image .= '.' . substr(strrchr($_FILES['image']['name'], '.'), 1); //アップロードされたファイルの拡張子を取得
        $file = "img/$image";
        // プリペアドステートメントを作成
        $stmt = $db->prepare("
        update shineva.pf set img = :image WHERE user_id=:id
        ");

        $stmt2 = $db->prepare("
        SELECT img FROM shineva.pf WHERE user_id=:id
        ");

        // パラメータを割り当て
        $stmt->bindValue(':image', $image, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt2->bindParam(':id', $id, PDO::PARAM_STR);


        if (!empty($_FILES['image']['name'])) { //ファイルが選択されていれば$imageにファイル名を代入
            move_uploaded_file($_FILES['image']['tmp_name'], './img/' . $image); //imagesディレクトリにファイル保存
            //クエリの実行
            $stmt2->execute();
            if (exif_imagetype($file)) { //画像ファイルかのチェック
                $message = '画像を変更しました';
                //クエリの実行
                $stmt->execute();


                //前のアイコンを削除
                $beforeimg = $stmt2->fetch(PDO::FETCH_COLUMN);
                if ($beforeimg != "profile.png") {
                    $beforefile = "img/" . $beforeimg;
                    unlink($beforefile);
                }
                //プロファイルへ
                header('Location: profile.php');
                exit();
                print_r($stmt->errorInfo());
            } else {
                unlink($file);
                $message = "<script type='text/javascript'>alert('画像ファイルではありません');</script>";
                echo $message;
            }
        }
    }
    ?>
