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
		<a href="/default/index">房产集中营</a>
		<?php if(isset($_SESSION['username'])) {?>
			<span>欢迎您: <?php echo $_SESSION['username']."  ";?><a href="/manager/index"><img alt="管理房源" title="管理房源" src="/estate/static/images/home.png"></a></span>
		<?php }?>
	</div>
	<div id="houseInfoList">
		<div id="houseBox">
			<?php for($i=0; $i<count($houseInfo); $i++) {?>
				<div class="house">
					<div class="houseImg">
						<img src="<?php if("" == explode(";", $houseInfo[$i]['img'])[0]) {echo "/upload/default.jpg"; }else {echo explode(";", $houseInfo[$i]['img'])[0];}?>">
					</div>
					<div class="houseTextInfo">
						<div class="name"><a href="/default/houseDetail?id=<?php echo $houseInfo[$i]['id'];?>"><?php echo $houseInfo[$i]['estateName'];?></a></div>
						<div class="text">房源户型:<?php echo $houseInfo[$i]['houseHold'];?></div>
						<div class="text">房源面积:<?php echo $houseInfo[$i]['houseArea'];?></div>
						<div class="text">期望售价:<?php echo $houseInfo[$i]['sellPrice'];?></div>
						<div class="text">联系电话:<?php echo $houseInfo[$i]['ownerMobile'];?></div>
					</div>
					<div class="avgPrice">均价<span><?php echo round($houseInfo[$i]['sellPrice'] * 10000 / $houseInfo[$i]['houseArea']); ?></span>元/平米</div>
				</div>
			<?php }?>
		</div>
		<div class="pagination">
			<ul class="pager">
				<li><?php echo $prevPage;?></li>
				<li><?php echo $nextPage;?></li>
				<li>当前第<?php echo $currentPage;?>页</li>
			</ul>
		</div>
		<div class="pagination">
			<ul class="pager">
				<li>共<?php echo $pagesNum;?>页</li>
				<li>跳转到第<input type="text" id="page" name="page">页</li>
				<li><input type="button" class="linkTo" value="跳转"></li>
			</ul>
		</div>
	</div>
	<div id="public_info">
		<a href="/default/publish"><img alt="我要发房" src="/estate/static/images/public.png"></a>
		<a href=""><img alt="意见反馈" src="/estate/static/images/advice.png"></a>
	</div>
</body>
<script type="text/javascript" src="/estate/static/javascript/lib/jquery-2.0.3.js"></script>
<script type="text/javascript">
$(function() {
	$('.linkTo').click(function() {
		window.location = "/default/index?page="+$('#page').val();
	})
})
</script>
</html>