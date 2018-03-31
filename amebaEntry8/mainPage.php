<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="content-language" content="ja">
	</head>
	<script type="text/javascript">
		//ファイルダウンロードボタン押したら、URLパラメータ渡してリクエスト実行
		function fileDown(blobID){
			//GETで送信
			console.log("ボタン押下");
			var params = "blobID="+blobID;
			var url = "./fileDown.php?" + params;
			console.log(url);
			location.href=url;
			return false;
		}
		//ファイルを選択したら、ファイルアップロード可能にする
		function fileChange(){
			document.getElementById("upButton").disabled = "";
		}
	</script>
	<body>
<?php
	
	$mysqli = new mysqli('localhost', 'root', 'rm610202!?', 'amebadb01');
	if ($mysqli->connect_errno) {
    	printf("Connect failed: %s\n", $mysqli->connect_error);
    	exit();
	}
	
	//アップロードファイルがあるケース
	if (!empty($_FILES['userfile'])) {
		
		//ファイルと拡張子を取得
		$ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
		//データベース登録用ディレクトリのパスと登録用ファイル名
		$uploaddir = '/ProgramData/MySQL/MySQL Server 5.7/Uploads/';
		$uploadfilebase = basename($_FILES['userfile']['name']);
		$uploadfile = $uploaddir . $uploadfilebase;
		//拡張子除いたファイル名とか
		$uploadfileparts = pathinfo($uploadfilebase);
		//今回取り込んだファイルと同じ名前のファイルがデータベース登録用ディレクトリにあれば削除
		foreach(glob(basename($_FILES['userfile']['name'])) as $file){
			//globで取得したファイルをunlinkで１つずつ削除
			unlink($file);
		}
		//データベース登録用ディレクトリにファイル移動
		if (!move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
		    echo "Possible file upload attack!\n";
		}
		//データベースに保存
		$query = "INSERT INTO amebadb01.amebablobtest(dataType,dataName,blobData) values('" . $ext . "','" . $uploadfileparts['filename'] . "',load_file('" . $uploadfile . "'))";
		$row = $mysqli->query($query);
		if (!$row) {
			echo "FILE UPLOAD ERROR!";
		}
	}
	
	
?>

<?php	
	
	$query = 'SELECT blobID, dataType, dataName FROM amebablobtest';
?>
		<form name="UploadForm" id="UploadForm" action="mainPage.php" enctype="multipart/form-data" method="POST">
			<fieldset>
			<legend>ファイルアップロード</legend>
				<!--1ファイルにつき16メガバイトまで-->
				<input type="hidden" name="MAX_FILE_SIZE" value="16000000"/>
				<p><input type="file" name="userfile" onchange="fileChange()"></p>
				<p><input type="submit" name="upButton" id="upButton" value="UPLOAD" disabled></p>
			</fieldset>
		</form>

		<form name="DownForm" id="DownForm">
			<fieldset>
			<legend>ファイルダウンロード</legend>
<?php 	
		if($result = $mysqli->query($query)){ 
?>
			<table border="1">
				<thead>
					<tr>
						<th>ID</th>
						<th>ファイル名</th>
						<th>参照</th>
					</tr>
				</thead>
				<tbody>
<?php		
			while($row = $result->fetch_assoc()){ 
?>
					<tr>
						<td><?= $row['blobID'] ?></td>
						<td><?= $row['dataName'] . '.' . $row['dataType'] ?></td>
						<td><input type="button" id="<?= 'btn_' . $row['blobID'] ?>" value="DOWN" onClick="fileDown(<?= $row['blobID'] ?>)"></td>
					</tr>

<?php 		
			}
			$result->free(); 
?>
				</tbody>
			</table>
<?php 	
		}
		$mysqli->close();
?>
			</fieldset>
			
		</form>
	</body>
</html>