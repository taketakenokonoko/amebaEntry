<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="content-language" content="ja">
	</head>
	<script type="text/javascript">
		//JavaScript実行部分
		//テキストに表示させる回数用の変数
		var cnt;
		//------------------------------
		//数値ボタン押下時のイベント処理
		//------------------------------
		function onNumBtnClick(btnValue){
			//hidden値に押したボタンの値を格納する
			document.getElementById("setNumPtn").value = "" + document.getElementById("setNumPtn").value + btnValue;
			//一応、テキストフィールドにも表示
			document.getElementById("txt_numShow").value = btnValue;
		}
		//------------------------------
		//開始ボタン押下時のイベント処理
		//------------------------------
		function onStatBtnClick(){
			//ユーザ設定値とサーバ設定値をクリアする
			document.getElementById("setNumPtn").value = "";
			document.getElementById("showNumPtn").value = "";
			//サーバメッセージもクリアする
			document.getElementById("serverMsg").innerHTML = "";
			//開始ボタンを非活性にする
			document.getElementById("btn_start").disabled = true;
			//数値ボタンも非活性にする
			document.getElementById("btn_No1").disabled = true;
			document.getElementById("btn_No2").disabled = true;
			document.getElementById("btn_No3").disabled = true;
			document.getElementById("btn_No4").disabled = true;
			document.getElementById("btn_No5").disabled = true;
			document.getElementById("btn_No6").disabled = true;
			document.getElementById("btn_No7").disabled = true;
			document.getElementById("btn_No8").disabled = true;
			document.getElementById("btn_No9").disabled = true;
			var loopMin = 3;
			var loopMax = 5;
			//テキストに表示させる回数
			cnt = Math.floor(Math.random() * (loopMax + 1 - loopMin)) + loopMin;
			document.getElementById("showNumPtn").value = "";
			showNumber();
		}
		//------------------------------
		//テキストフィールドに値表示する
		//------------------------------
		function showNumber(){
			if(cnt==0){
				//表示をクリアする
				document.getElementById("txt_numShow").value = "";
				//決定ボタンだけを活性化する
				document.getElementById("btn_decision").disabled = false;
				//数値ボタン活性化
				//数値ボタンも非活性にする
				document.getElementById("btn_No1").disabled = false;
				document.getElementById("btn_No2").disabled = false;
				document.getElementById("btn_No3").disabled = false;
				document.getElementById("btn_No4").disabled = false;
				document.getElementById("btn_No5").disabled = false;
				document.getElementById("btn_No6").disabled = false;
				document.getElementById("btn_No7").disabled = false;
				document.getElementById("btn_No8").disabled = false;
				document.getElementById("btn_No9").disabled = false;
			}else{
				//０～９までの数値をランダムに表示する
				var showMin = 1;
				var showMax = 9;
				var showValue = Math.floor(Math.random() * (showMax + 1 - showMin)) + showMin;
				console.log("ok");
				//テキストフィールドに表示
				document.getElementById("txt_numShow").value = showValue;
				//hidden値にサーバが表示した数値を格納
				document.getElementById("showNumPtn").value = "" + document.getElementById("showNumPtn").value + showValue;
				//cntが正の間は１秒単位で繰り返し実行
				cnt = cnt - 1;
				if(cnt>=0){
					setTimeout("showNumber()",1000);
				}
			}
			
		}
		//------------------------------
		//決定ボタン押下時の処理
		//------------------------------
		function onDecBtnClick(){
			document.getElementById("MyForm").action="numberMemory.php";//今呼んでるのと同じPHPファイル指定
			document.getElementById("MyForm").method="POST";//POST型のデータ送信
			document.getElementById("MyForm").submit();//このページを再度呼び出す
			return true;
		}
	</script>
<?php
	//基準となる点数
	$basePoint = 1000;
	//ユーザが数値ボタン押下で設定した文字列POST取得
	$setNumPtn = '';
	if(isset($_POST['setNumPtn'])){
		$setNumPtn = $_POST['setNumPtn'];
	}
	
	//サーバが提示した数値の文字列POST取得
	$showNumPtn = '';
	if(isset($_POST['setNumPtn'])){
		$showNumPtn = $_POST['showNumPtn'];
	}
	
	//スコア算出
	$userScore = 0;
	if(isset($_POST['userScore'])){
		$userScore = intval($_POST['userScore']);
	}
	//一致フラグ
	$matchFlg;
	//メッセージ
	$serverMsg='';
	if($showNumPtn!==''){
		//前画面からの遷移の場合
		if($setNumPtn==$showNumPtn){
			//値一致
			$matchFlg = '1';
			$userScore = $userScore + strlen($setNumPtn) * $basePoint;
			$serverMsg = '正解♪現在のスコアは'.(string)$userScore.'だよ～＼(^o^)／';
		}else{
			//値不一致
			$matchFlg = '0';
			$serverMsg = 'ハズレ…正解は'.$showNumPtn.'だよ<br>トータルスコアは'.(string)$userScore.'だよ(´・ω・`)';
			$userScore = 0;
		}
	}else{
		//初回は一致フラグオンにしておく
		$matchFlg = '1';
	}
?>
	<body>
		<form name="MyForm" id="MyForm">
<!--サーバメッセージを表示-->
			<p>
				<div id="serverMsg" style="color:DeepPink;"><?=$serverMsg?></div>
			</p>
<!--対象の数値を表示-->
			<p>
				<input type="text" name="txt_numShow" id="txt_numShow" size="200" value="ここに数値が出るよ" readonly>
			</p>
<!--対象の数値を入力-->
			<p>
				<input type="button" id="btn_No1" name="btn_No1" value="1" height="90px" width="90px" style="margin:0px 5px 0px;" onClick="onNumBtnClick(1)">
				<input type="button" id="btn_No2" name="btn_No2" value="2" height="90px" width="90px" style="margin:0px 5px 0px;" onClick="onNumBtnClick(2)">
				<input type="button" id="btn_No3" name="btn_No3" value="3" height="90px" width="90px" style="margin:0px 5px 0px;" onClick="onNumBtnClick(3)">
			</p>
			<p>
				<input type="button" id="btn_No4" name="btn_No4" value="4" height="90px" width="90px" style="margin:0px 5px 0px;" onClick="onNumBtnClick(4)">
				<input type="button" id="btn_No5" name="btn_No5" value="5" height="90px" width="90px" style="margin:0px 5px 0px;" onClick="onNumBtnClick(5)">
				<input type="button" id="btn_No6" name="btn_No6" value="6" height="90px" width="90px" style="margin:0px 5px 0px;" onClick="onNumBtnClick(6)">
			</p>
			<p>
				<input type="button" id="btn_No7" name="btn_No7" value="7" height="90px" width="90px" style="margin:0px 5px 0px;" onClick="onNumBtnClick(7)">
				<input type="button" id="btn_No8" name="btn_No8" value="8" height="90px" width="90px" style="margin:0px 5px 0px;" onClick="onNumBtnClick(8)">
				<input type="button" id="btn_No9" name="btn_No9" value="9" height="90px" width="90px" style="margin:0px 5px 0px;" onClick="onNumBtnClick(9)">
			</p>
<?php
	if($matchFlg=='1'){
?>
			<p>
				<!--開始-->
				<input type="button" id="btn_start" name="btn_start" value="開始" height="90px" width="135px" style="margin:0px 5px 0px;" onClick="onStatBtnClick()">
				<!--決定ボタン-->
				<input type="button" id="btn_decision"  name="btn_decision" value="決定" height="90px" width="135px" style="margin:0px 5px 0px;" onClick="onDecBtnClick()" disabled>
			</p>
<?php
	}else{
?>
			<p>
				<!--リセット-->
				<input type="button" id="btn_reset" name="btn_reset" value="リセット" height="90px" width="135px" style="margin:0px 5px 0px;" onClick="onDecBtnClick()">
			</p>
<?php
	}
?>
<!--POSTでサーバに渡すために、以下のhiddenタイプの値に、必要な値を格納-->
			<!--ユーザが数値ボタン押下で設定した文字列を格納-->
			<input type="hidden" name="setNumPtn" id="setNumPtn">
			<!--サーバが提示した数値の文字列を格納-->
			<input type="hidden" name="showNumPtn" id="showNumPtn">
			<!--現在のスコアを格納-->
			<input type="hidden" name="userScore" id="userScore" value="<?=$userScore?>">
		</form>
	</body>
</html>