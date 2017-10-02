<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="content-language" content="ja">
	</head>
	<script type="text/javascript">
		window.onload = function(){
			//0.3秒おきに、表示するクリスタルを変える
			console.log("test");
			flashCrystal();
		}
		function flashCrystal(){
			if(document.getElementById("crystal1_1").style.display=="block"){
				//一番光ってないクリスタルが表示されている。光ってるクリスタルを表示させる。
				console.log("1");
				document.getElementById("crystal1_1").style.display="none";
				document.getElementById("crystal1_2").style.display="block";
			}else if(document.getElementById("crystal1_2").style.display=="block"){
				//光ってるクリスタルが表示されている。光っていないクリスタルを表示させる。
				console.log("2");
				document.getElementById("crystal1_1").style.display="block";
				document.getElementById("crystal1_2").style.display="none";
			}
			//0.3秒置いて、再帰処理
			setTimeout("flashCrystal()",300);
		}
	</script>
	<body>
		<form name="MyForm" id="MyForm">
			<div style="position:relative;"><!--相対位置指定することで、画像の上に画像や文字を重ねる-->
				<input type="image" id="karin01" src="./img/karin01.png" width="536" height="573"/>
				<div id="resultString" style="position:absolute;top:150px;left:30px;color:fuchsia;font-size:1em;font-weight:bold; ">
					<p>光るクリスタルを</p>
					<p>ちゃんと覚えてね～</p>
				</div>
				<input type="image" id="crystal1_1" src="./img/crystal_blue_1.png" width="32" height="64" style="position:absolute;top:450px;left:100px;display:block;">
				<input type="image" id="crystal1_2" src="./img/crystal_blue_2.png" width="32" height="64" style="position:absolute;top:450px;left:100px;display:none;">
				<input type="image" id="crystal2_1" src="./img/crystal_red_1.png" width="32" height="64" style="position:absolute;top:450px;left:170px;display:block;">
				<input type="image" id="crystal2_2" src="./img/crystal_red_2.png" width="32" height="64" style="position:absolute;top:450px;left:170px;display:none;">
				<input type="image" id="crystal3_1" src="./img/crystal_pink_1.png" width="32" height="64" style="position:absolute;top:450px;left:240px;display:block;">
				<input type="image" id="crystal3_2" src="./img/crystal_pink_2.png" width="32" height="64" style="position:absolute;top:450px;left:240px;display:none;">
				<input type="image" id="crystal4_1" src="./img/crystal_yellow_1.png" width="32" height="64" style="position:absolute;top:450px;left:310px;display:block;">
				<input type="image" id="crystal4_2" src="./img/crystal_yellow_2.png" width="32" height="64" style="position:absolute;top:450px;left:310px;display:none;">
				<input type="image" id="crystal5_1" src="./img/crystal_green_1.png" width="32" height="64" style="position:absolute;top:450px;left:380px;display:block;">
				<input type="image" id="crystal5_2" src="./img/crystal_green_2.png" width="32" height="64" style="position:absolute;top:450px;left:380px;display:none;">
				<input type="image" id="btn_start" src="./img/startBtn.png" width="77" height="31" style="position:absolute;top:530px;left:50px;display:block;">
				<input type="image" id="btn_decision" src="./img/decBtn.png" width="77" height="32" style="position:absolute;top:530px;left:150px;display:block;">
			</div>
		</form>
	</body>
</html>