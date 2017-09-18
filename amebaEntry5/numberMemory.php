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
			//※あとで作る
		}
		function onStatBtnClick(){
			//開始ボタン押下時のイベント処理
			cnt = 3;							//テキストに表示させる回数だが、ここの値は実際は変動させる
			showNumber();
		}
		function showNumber(){
			//１～９までの数値をランダムに表示する
			//※あとでちゃんと作る
			console.log("ok");
			//cntが正の間は１秒単位で繰り返し実行
			cnt = cnt - 1;
			if(cnt>0){
				setTimeout("showNumber()",1000);
			}
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