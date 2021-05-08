<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title></title>
	<style type="text/css">
		*{
			padding: 0;
			margin: 0;
		}
	</style>
</head>
<body>
	<video id="video"  autoplay></video>
	<p>画布：</p>
	<canvas  id="canvas" width="480" height="640" name='img'></canvas>
	
	<form action="index.php" id="upload" method="post">
	<input type="hidden" name="img" id="result" value="" />
	<input type="submit" name="" id="" value="提交" />
	</form>
</body>
</html>
<script type="text/javascript">
	window.addEventListener('DOMContentLoaded',function(){
		let video = document.getElementById('video');
		let canvas = document.getElementById('canvas');
		let context = canvas.getContext('2d');
		
		
		// var mediaDevices = navigator.mediaDevices
		// console.log(mediaDevices)
		// console.log(navigator.mediaDevices.getUserMedia)
		
		if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia){
			let promise = navigator.mediaDevices.getUserMedia({
				// audio:true,//音频
				video:true//摄像头媒体
			}).then(function(stream){//成功后的形参
				video.srcObject = stream
				video.play()
				
				setTimeout(function(){context.drawImage(video, 0, 0, 480, 640);},1000);
				setTimeout(function(){
				    var imgUrl = canvas.toDataURL('image/png');  
				    document.getElementById('result').value = imgUrl;
				    // document.getElementById('upload').submit();
				    },1300);
			},function(reason){//失败后的形参reason
				reason = '找不到请求的设备'
				console.error(reason)
			})
		}
	})
</script>
<?php
	if(is_array($_POST)&&count($_POST)>0)
		{
		$img      = $_POST['img'];
		        $img      = str_replace('data:image/png;base64,', '', $img);
		        $img      = str_replace(' ', '+', $img);
		        $data     = base64_decode($img);
		        
		        $save_file = ''. uniqid().'.png';
		        $result = file_put_contents($save_file, $data);
		}
		
?>
<!-- <script src="https://cdn.bootcss.com/vConsole/3.2.0/vconsole.min.js"></script>
	<script>
	//初始化一下就可以了，
	let vConsole = new VConsole();
	//你打印的数据 比如
	console.log('test');
	//就可像小程序一样的看了和调试了。
	</script> -->
