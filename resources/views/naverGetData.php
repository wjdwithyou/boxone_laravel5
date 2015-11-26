<!DOCTYPE html>
<html lang="ko">
  	<head>
  	</head>	  	
  	<body>
  		<input type="hidden" id="result" value="<?=$result?>"/>
  		<?php if ($result === "success"):?>
  			<input type="hidden" id="type" value="<?=$type?>"/>
		  	<input type="hidden" id="id" value="<?=$id?>"/>
		  	<input type="hidden" id="nickname" value="<?=$nickname?>"/>
		  	<input type="hidden" id="email" value="<?=$email?>"/>
		  	<input type="hidden" id="img" value="<?=$img?>"/>  			
  		<?php endif;?>
  		<script>
  			var result = document.getElementById("result").value;
  			if (result == "success")
  			{
		  		var type = document.getElementById("type").value;
		  		var id = document.getElementById("id").value;
		  		var nickname = document.getElementById("nickname").value;
		  		var email = document.getElementById("email").value;
		  		var img = document.getElementById("img").value;
		  		window.opener.socialLogin(type, id, email, nickname, img);
  			}
  			else
  	  			alert (result);
	  		window.close(); 
  		</script>
  	</body>
</html>
