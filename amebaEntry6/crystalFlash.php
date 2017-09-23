<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="content-language" content="ja">
	</head>
	<script type="text/javascript">
		var beforeSts;
		window.onload = function(){
			//0.3秒おきに、表示するクリスタルを変える
			beforeSts = 0;//0が明るくなる過程、1が暗くなる過程
			flashCrystal();
		}
		function flashCrystal(){
			if(document.getElementById("crystal1_1").style.display=="block"){
				//一番光ってないクリスタルが表示されている。二番目に光ってるクリスタルを表示させる。
				beforeSts = 0;
				console.log("1");
				document.getElementById("crystal1_1").style.display="none";
				document.getElementById("crystal1_2").style.display="block";
				document.getElementById("crystal1_3").style.display="none";
			}else if(document.getElementById("crystal1_2").style.display=="block"){
				//二番目に光ってるクリスタルが表示されている。直前の光り具合に応じて、次に切り替えるクリスタルを決める。
				console.log("2");
				if(beforeSts==0){
					document.getElementById("crystal1_1").style.display="none";
					document.getElementById("crystal1_2").style.display="none";
					document.getElementById("crystal1_3").style.display="block";
				}else{
					document.getElementById("crystal1_1").style.display="block";
					document.getElementById("crystal1_2").style.display="none";
					document.getElementById("crystal1_3").style.display="none";
				}
			}else{
				//一番光ってるクリスタルが表示されている。二番目に光ってるクリスタルを表示させる。
				console.log("3");
				beforeSts = 1;
				document.getElementById("crystal1_1").style.display="none";
				document.getElementById("crystal1_2").style.display="block";
				document.getElementById("crystal1_3").style.display="none";
			}
			//0.3秒置いて、再帰処理
			setTimeout("flashCrystal()",300);
		}
	</script>
	<body>
		<form name="MyForm" id="MyForm">
			<div style="position:relative;"><!--相対位置指定することで、画像の上に画像や文字を重ねる-->
				<input type="image" id="himekaImg" src="./img/himeka001.png" width="800" height="1066"/>
				<input type="image" id="crystal1_1" src="./img/crystal_blue_1.png" width="32" height="64" style="position:absolute;top:200px;left:100px;">
				<input type="image" id="crystal1_2" src="./img/crystal_blue_2.png" width="32" height="64" style="position:absolute;top:200px;left:100px;display:none;">
				<input type="image" id="crystal1_3" src="./img/crystal_blue_3.png" width="32" height="64" style="position:absolute;top:200px;left:100px;display:none;">
			</div>
		</form>
	</body>
</html>