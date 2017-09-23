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
		function onNumBtnClick(btnValue){
			//数値ボタン押下時のイベント処理
			//hidden値に押したボタンの値を格納する
			document.getElementById("setNumPtn").value = "" + document.getElementById("setNumPtn").value + btnValue;
			//一応、テキストフィールドにも表示
			document.getElementById("txt_numShow").value = btnValue;
		}
		function onStatBtnClick(){
			//ユーザ設定値とサーバ設定値をクリアする
			document.getElementById("setNumPtn").value = "";
			document.getElementById("showNumPtn").value = "";
			//開始ボタンを非活性にする
			document.getElementById("btn_start").disabled = true;
			//開始ボタン押下時のイベント処理
			var loopMin = 3;
			var loopMax = 5;
			cnt = Math.floor(Math.random() * (loopMax + 1 - loopMin)) + loopMin;
			//cnt = 3;							//テキストに表示させる回数だが、ここの値は実際は変動させる
			document.getElementById("showNumPtn").value = "";
			showNumber();
		}
		function showNumber(){
			
			if(cnt==0){
				//表示をクリアする
				document.getElementById("txt_numShow").value = "";
				//決定ボタンだけを活性化する
				document.getElementById("btn_decision").disabled = false;
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
		function onDecBtnClick(){
			//決定ボタン押下時の処理
			var showValue = document.getElementById("showNumPtn").value;
			var setValue = document.getElementById("setNumPtn").value;
			if(showValue==setValue){
				alert("一致してます");
			}else{
				alert("間違い！正解は"+showValue+"\r\nあなたが入れたのは"+setValue);
			}
			//決定ボタン非活性
			document.getElementById("btn_decision").disabled = true;
			//開始ボタン活性化
			document.getElementById("btn_start").disabled = false;
		}
	</script>
	<body>
		<form name="MyForm" id="MyForm">

				
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
			<p>
				<!--開始-->
				<input type="button" id="btn_start" name="btn_start" value="開始" height="90px" width="135px" style="margin:0px 5px 0px;" onClick="onStatBtnClick()">
				<!--決定ボタン-->
				<input type="button" id="btn_decision"  name="btn_decision" value="決定" height="90px" width="135px" style="margin:0px 5px 0px;" onClick="onDecBtnClick()" disabled>
			</p>
<!--POSTでサーバに渡すために、以下のhiddenタイプの値に、必要な値を格納-->
			<!--ユーザが数値ボタン押下で設定した文字列を格納-->
			<input type="hidden" name="setNumPtn" id="setNumPtn">
			<!--サーバが提示した数値の文字列を格納-->
			<input type="hidden" name="showNumPtn" id="showNumPtn">
		</form>
	</body>
</html>