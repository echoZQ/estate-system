<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>房产集中营</title>
    <link rel="stylesheet" type="text/css" href="/estate/static/css/home.css">
</head>
<body>
	<div id="header">
		<ul>
			<li><img src="/estate/static/images/person.png"></li>
			<li><a href="/login/index" >登录</a></li>
			<li><a href="/register/index" >注册</a></li>
			<li><a href="/help/index" >帮助</a></li>
		</ul>
	</div>
	<div id="title">房产集中营</div>
	<div id="content">
		<div id="menu">
			<ul>
				<li class="home_page">首页</li><!-- 
			 --><li>新房</li><!--
			 --><li>二手房</li><!--
			 --><li class="rent_page">租房</li>
			</ul>
			<?php if(isset($_SESSION['username'])) {?>
			<span>欢迎您: <?php echo $_SESSION['username'];?></span>
			<?php }?>
		</div>
	</div>
	<div id="public_info">
		<a href="/default/publish"><img alt="我要发房" src="/estate/static/images/public.png"></a>
		<a href=""><img alt="意见反馈" src="/estate/static/images/advice.png"></a>
	</div>
</body>
</html>