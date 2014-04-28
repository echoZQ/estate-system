<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>房产集中营</title>
    <link rel="stylesheet" type="text/css" href="/estate/static/css/home.css">
    <link rel="stylesheet" type="text/css" href="/estate/static/css/houseinfo.css">
</head>
<body>
	<div id="head">
		<ul>
			<li><img src="/estate/static/images/person.png"></li>
			<li><a href="/login/index" >登录</a></li>
			<li><a href="/register/index" >注册</a></li>
			<li><a href="/login/loginOut" >登出</a></li>
			<li><a href="/help/index" >帮助</a></li>
		</ul>
	</div>
	<div id="header">
		房产集中营
		<?php if(isset($_SESSION['username'])) {?>
			<span>欢迎您: <?php echo $_SESSION['username']."  ";?><a href="/manager/index"><img alt="管理房源" title="管理房源" src="/estate/static/images/home.png"></a></span>
		<?php }?>
	</div>
	<div id="houseInfoList">
		<div id="houseBox">
			<?php for($i=0; $i<count($houseInfo); $i++) {?>
				<div class="house">
					<div class="houseImg">
						<img src="<?php echo explode(";", $houseInfo[$i]['img'])[0];?>">
					</div>
					<div class="houseTextInfo">
						<div class="name"><a href="/default/houseDetail?id=<?php echo $houseInfo[$i]['id'];?>"><?php echo $houseInfo[$i]['estateName'];?></a></div>
						<div class="text">房源户型:<?php echo $houseInfo[$i]['houseHold'];?></div>
						<div class="text">房源面积:<?php echo $houseInfo[$i]['houseArea'];?></div>
						<div class="text">期望售价:<?php echo $houseInfo[$i]['sellPrice'];?></div>
						<div class="text">联系电话:<?php echo $houseInfo[$i]['ownerMobile'];?></div>
					</div>
					<div class="avgPrice">均价<span><?php echo $houseInfo[$i]['sellPrice'] / $houseInfo[$i]['houseArea']; ?></span>元/平米</div>
				</div>
			<?php }?>
		</div>
	</div>
	<div id="public_info">
		<a href="/default/publish"><img alt="我要发房" src="/estate/static/images/public.png"></a>
		<a href=""><img alt="意见反馈" src="/estate/static/images/advice.png"></a>
	</div>
</body>
</html>