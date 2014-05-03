<?php use Hexagon\Context;?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
    <title>房产集中营</title>
    <link rel="stylesheet" type="text/css" href="/estate/static/css/manager.css">
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
	<div id="welcome">
		<h1><i></i>我的房源<i></i></h1>
	</div> 
	<div id="content">
		<?php if(count($houseInfo) > 0) {?>
			<table border="1" width="900" cellspacing="0" cellpadding="0">
				<th width="15%">发布类型</th><th width="15%">小区名称</th><th width="15%">户型</th>
				<th width="12%">楼层</th><th width="12%">面积</th><th width="15%">审核</th><th width="20%">操作</th>
			<?php }else {?>
				<div class="notice_info">您尚未发布任何房源信息</div>
				<a href="/default/publish"><input type="button" value="发布信息" /></a>
			<?php }?>
			<?php for($i = 0; $i < count($houseInfo); $i++) {?>
				<tr>
					<td><?php echo $houseInfo[$i]['type']?></td>
					<td><?php echo $houseInfo[$i]['estateName']?></td>
					<td><?php echo $houseInfo[$i]['houseHold']?></td>
					<td><?php echo $houseInfo[$i]['houseFloor']?></td>
					<td><?php echo $houseInfo[$i]['houseArea']?>平米</td>
					<td><?php if(0 == $houseInfo[$i]['checkPass']) echo "未通过";else echo "通过";?></td>
					<td><a href="/manager/update?id=<?php echo $houseInfo[$i]['id']?>"><span>修改</span></a><a href="/manager/delete?id=<?php echo $houseInfo[$i]['id'];?>"><span>删除</span></a></td>
				</tr>
			<?php }?>
		</table>
		<div id="public_info">
			<a href="/default/publish"><img alt="我要发房" src="/estate/static/images/public.png"></a>
			<a href=""><img alt="意见反馈" src="/estate/static/images/advice.png"></a>
		</div>
	</div>
</body>
<script type="text/javascript" src="/estate/static/javascript/lib/jquery-2.0.3.js"></script>
</html>