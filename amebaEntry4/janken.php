<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="content-language" content="ja">
	</head>
	<script type="text/javascript">
		//じゃんけんのボタン押したときに走る処理 引数myValueはじゃんけんの手
		function getResultJanken(myValue){
			document.getElementById("resultAct").value = myValue; //じゃんけんの手の値格納
			document.getElementById("MyForm").action="janken.php";//今呼んでるのと同じPHPファイル指定
			document.getElementById("MyForm").method="POST";//POST型のデータ送信
			document.getElementById("MyForm").submit();//このページを再度呼び出す
			return true;
		}
	</script>
	<body>
		<form name="MyForm" id="MyForm">
			<div style="position:relative;"><!--相対位置指定することで、画像の上に画像や文字を重ねる-->
<?php
	$imgName;
	$imgWidth;
	$imgHeight;
	$msgTop;
	$msgLeft;
	$myHandTop;
	$myHandLeft;
	$serverAct;
	$serverActStr='';
	
	
	if(isset($_POST['resultAct'])){
		$serverAct = mt_rand(0,2);		//mt_rand関数使って、0～2までのランダムな値を取得
		//そのランダムな値に応じて、ぴぃすちゃんの出す手を決める
		//その手に応じて、画像切り替えと、吹き出し文字位置調整
		if($serverAct==0){
			$serverActStr = 'グー';
			$imgName = 'peace_stone.png';
			$imgWidth = '481';
			$imgHeight = '641';
			$msgTop = '380px';
			$msgLeft = '70px';
			$myHandTop = '600px';
			$myHandLeft = '50px';
		}elseif($serverAct==1){
			$serverActStr = 'チョキ';
			$imgName = 'peace_scissors.png';
			$imgWidth = '490';
			$imgHeight = '655';
			$msgTop = '360px';
			$msgLeft = '250px';
			$myHandTop = '600px';
			$myHandLeft = '50px';
		}else{
			$serverActStr = 'パー';
			$imgName = 'peace_paper.png';
			$imgWidth = '485';
			$imgHeight = '727';
			$msgTop = '480px';
			$msgLeft = '70px';
			$myHandTop = '650px';
			$myHandLeft = '50px';
		}
	}else{
		$imgName = 'peace_edit001.png';
		$imgWidth = '608';
		$imgHeight = '725';
		$msgTop = '50px';
		$msgLeft = '340px';
		$myHandTop = '650px';
		$myHandLeft = '70px';
	}
?>
				<div id="peaceImg">
					<img src="./img/<?=$imgName?>" width="<?=$imgWidth?>" height="<?=$imgHeight?>"/>
				</div>
				<div id="resultString" style="position:absolute;top:<?=$msgTop?>;left:<?=$msgLeft?>;color:DeepPink;font-size:1em">
<?php
	$myAct;
	$myActStr='';
	$winResult;
	$sameStr;
	$lastMsg='';
	if(isset($_POST['resultAct'])){
		//POST型データ送信で、resultActポスト変数に値入っていれば、再呼び出しと判断
		$winCount = intval($_POST['winCount']);	//今まで勝った数が入ったポスト変数
		$loseCount = intval($_POST['loseCount']);	//今まで負けた数が入ったポスト変数
		$drawCount = intval($_POST['drawCount']);	//今まで引き分けた数が入ったポスト変数
		$myAct = $_POST['resultAct'];				//じゃんけんで自分が選んだ手が入ったポスト変数
		
		
		//自分のじゃんけんの手を文字列として変数に格納
		if($myAct==0){
			$myActStr = 'グー';
		}elseif($myAct==1){
			$myActStr = 'チョキ';
		}else{
			$myActStr = 'パー';
		}
		//サーバの手と自分の手を見て、じゃんけんの勝敗結果を決める
		if($serverAct==0 and $myAct==2 or $serverAct==1 and $myAct==0 or $serverAct==2 and $myAct==1){
			$winResult = 'あなたの勝ち…(´；ω；｀)';
			$sameStr = 'は';
			$winCount++;
		}elseif($serverAct==$myAct){
			$winResult = '引き分け！';
			$sameStr = 'も';
			$drawCount++;
		}else{
			$winResult = '私の勝ち♪(*^^*)';
			$sameStr = 'は';
			$loseCount++;
		}
		//じゃんけんの回数に応じて、ぴぃすちゃんの最後のセリフを変える
		if($winCount+$loseCount+$drawCount < 15){
			$lastMsg='もう一回やるにゃん♪';
		}elseif($winCount+$loseCount+$drawCount < 25){
			$lastMsg='まだやるにゃん？';
		}else{
			$lastMsg='もう止めたいにゃん…';
		}
		
		//じゃんけんの結果と集計をecho使って画面に出力する
		echo '<p>私の出した手は'.$serverActStr.'だよ～</p>'."\r\n";
		echo '<p>あなたの出した手'.$sameStr.$myActStr.'だね</p>'."\r\n";
		echo '<p>'.$winResult.'</p>'."\r\n";
		echo '<p>'.(string)$winCount.'勝'.(string)$loseCount.'負'.$drawCount.'引き分けだよ！</p>'."\r\n";
		echo '<p>'.$lastMsg.'</p>'."\r\n";
	}else{
		//一番最初に画面開いたときの表示処理
		$winCount=0;
		$loseCount=0;
		$drawCount=0;
		echo '<p>じゃんけんやるにゃん♪</p>'."\r\n";
		echo '<p>せーの♪さいしょはぐー(*^^*)</p>'."\r\n";
		echo '<p>じゃんけん…♪</p>'."\r\n";
	}
?>
				</div>
				<div id="jankenButton" style="position:absolute;top:<?=$myHandTop?>;left:<?=$myHandLeft?>;">
					<p>
<!--じゃんけんで出す手を選ぶためのコマンドボタン配置-->
						<input type="image" id="goo" src="./img/stoneA.png" alt="グー" height="90" width="90" style="margin:0px 20px 0px;" onClick="getResultJanken(0)">
						<input type="image" id="goo" src="./img/scissorsA.png" alt="チョキ" height="90" width="90" style="margin:0px 20px 0px;" onClick="getResultJanken(1)">
						<input type="image" id="goo" src="./img/paperA.png" alt="パー" height="90" width="90" style="margin:0px 20px 0px;" onClick="getResultJanken(2)">
					</p>
				</div>
			</div>
<!--POSTでサーバに渡すために、以下のhiddenタイプの値に、今回のじゃんけんの手と今までの勝敗集計を格納-->
			<input type="hidden" name="resultAct" id="resultAct">
			<input type="hidden" name="winCount" id="winCount" value="<?=$winCount?>">
			<input type="hidden" name="loseCount" id="loseCount" value="<?=$loseCount?>">
			<input type="hidden" name="drawCount" id="drawCount" value="<?=$drawCount?>">
		</form>
	</body>
</html>