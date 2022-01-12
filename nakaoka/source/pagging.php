<?php



if (mysqli_connect_errno()){
      echo "データベース接続失敗: " . mysqli_connect_error();
      die();
}
$total_pages_sql = "SELECT COUNT(*) FROM $tablename";
$result = mysqli_query($conn,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);

//SQL実行
$res_data = mysqli_query($conn,$sql);


?>