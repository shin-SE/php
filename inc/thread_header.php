<header>
	<h1>Sin・System Engineers｜<?php echo $description; ?></h1>
	<nav class="gnav">
		<ul class="menu">
			<li> 
				<?php
					if (isset($_SESSION['name'])){ 
						//登録の場合
						
				?><a href="../source/logout.php">ログアウト</a> &nbsp; &nbsp; &nbsp;| &nbsp;&nbsp; &nbsp;<a href="../profile.php">プロファイル</a>
				<?php
					}else if($is_snyc==false){
						//DBに接続してない場合
				?><a href="../login.php">ログイン </a>|<a href="../sign_up.php">会員登録</a>
				<?php
					};  //DBに接続した場合は何も表示しません
				?>
				</li>
		</ul>
	</nav>
</header>
