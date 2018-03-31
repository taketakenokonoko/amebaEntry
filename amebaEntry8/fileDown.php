<?php 
	// クエリの取得
	// →今回は固定値指定なので、コメントアウト
	if (preg_match('/^[0-9]+$/', $_GET['blobID'])) {
    	$blobID = $_GET['blobID'];
	} else {
    	throw new Exception('エラー');
	}
	
	//$blobID = 1;
	
	//コネクション情報
	$mysqli = new mysqli('localhost', 'root', 'rm610202!?', 'amebadb01');
	if ($mysqli->connect_errno) {
    	printf("Connect failed: %s\n", $mysqli->connect_error);
    	exit();
	}
	//プリペアドステートメント作成
	$query = "SELECT blobID, dataType, dataName, blobData FROM amebablobtest WHERE blobID = ?";
	$stmt = $mysqli->stmt_init();
	if(!$stmt->prepare($query)){
		print "Failed to prepare statement\n";
	}else{
		//プリペアドステートメントへのパラメータの紐付け
		$stmt->bind_param("i",$blobID);
		//プリペアドステートメント実行
		$stmt->execute();
		//結果を$resultに格納
		$result = $stmt->get_result();
		//結果のうち１行取得
		$row = $result->fetch_assoc();
		
		
		//ヘッダ部の返却（保存処理が走る）
		header('Content-Disposition: attachment; filename="'. $row["dataName"] . '.' . $row["dataType"] .'"');
		header('Content-Type: application/octet-stream');
		header('Content-Transfer-Encoding: binary');
		header('Content-Length: '.strlen($row["blobData"]));
		//データ部の返却
		echo $row["blobData"];
		
		//結果格納によって占領されていたメモリ空間を開放
		$result->free();
	}
	
?>