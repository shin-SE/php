# 進捗について

# 変更点
スレッド機能を説明

# テスト始まる前に
0.<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;~~template.php~~<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;thread_create.php 87 75 urlform<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;~~commenting.php/thread_create.php  pdo--->sqli~~<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;~~pdo ;いるかどうか~~  <------**要らない**<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;~~'Location:'.FILE__正しいかどうか~~<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;~~$stmt->bindParam(':name', $_SESSION['name'], PDO::PARAM_STR);~~ <----- **illegal**<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;~~commenting str-->int~~ <-----**legal**<br>
<br><br><br><br><br>
1.~~date default 2000-02-01 or 2000-2-1~~　○   ---->井上<br>
<br>
2.スレッドの詳細作ったっけ？  ---->中岡<br>
    <br>

3.データベース仕様変更してください。　　　 ---->井上<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.1auto_incrementを設定<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SQL文：alter [table] [sysuser_account] auto_increment=1000; <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;user_idは1000から<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;thread_idは1000000(７桁)から<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.2delete table cmt <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.3delete Trd (comment_count,access_count)<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.4<span color="#FF0000" style="bold">contributor_id(int) --->user_name(VARCH)</span><br>
<br><br><br>
    4.各自データベースに自分のアカウント作ってください。 ----->**全員**<br>
　　　＊自分の本当のアドレスを<br>
   4.1INSERT INTO user_kihon VALUES ( e_mail,(datetime:Y-m-d H:i:s) ,user_name,passwprd);<br>
                             -------->　datetimeの指定する方法調べてない、誰か調べて<br>
   
   4.2INSERT INTO pf (gender,job,intro) VALUES (gender,job,intro);<br>
<br><br><br>
5.1~~学校のサーバーにgithub~~       ------>石井<br>
5.2 メール拡張　' https://github.com/PHPMailer/PHPMailer/'<br>
<br><br><br>
6.パナソニックのサーバーに mailer,mailserver     インストール<br>
# お願い
<br>
`header('Location: URL')`の後ろに`exit;`**忘れた可能性あります!!!!見つかったら加えてください!!!!**<br>
SQL文`$stmt->bindParam(':name', $_SESSION['name'], PDO::PARAM_STR);` みたいに最後に`;`を入れました、**';'を削除してください**<br>
SQL文`$stmt->bindParam(':name', $_SESSION['name'], PDO::PARAM_STR);` 直接に`$_SESSION['name']`や`$_POST['name']`書きました、<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;**間違いです！！！見つかったら私に教えてください**<br>

# 今週の目標<br>
11/25　ログイン<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;スレッド閲覧　　　----->井上<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;スレッドたてる     ----->劉<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;コメントする      ----->劉<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;プロファイル     ----->石井<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ログイン（ログインしたら絶対ログアウトしない）    ----->(&nbsp;&nbsp;&nbsp;&nbsp;)<br>

&nbsp;&nbsp;&nbsp;&nbsp;*今、phpファイル開けないのが多い<br>
&nbsp;&nbsp;&nbsp;&nbsp;*CSS組に早く仕事始めるように、バッグを修正し、phpを開けるようにしてから、CSS組に伝えてください。<br>
　　　　プレゼン制作　-------------->　中田<br>
11/26　....　<br><br>
<br><br>
    
# 今後の目標<br>

バッグ直しは二週間続くと思います<br>
11月第四週　＝　テスト<br>
12月第一週　＝　テスト<br>
12月第二週　＝　「いいね！」機能、<br>
・・・・・・・・・フォロー機能、<br>
・・・・・・・・・サイト内検索機能、<br>
・・・・・・・・・アクセスログ機能、<br>
・・・・・・・・・匿名コメント　　　　　　　　　の開発<br>
<br>
<br>
冬休み(12/18~1/5)　 ( 続きの開発 及び テスト　　--->劉　)<br>
<br><br>
第三学期以降　=　サーバー &　CSS修正<br>
2月 = 卒研発表<br>
