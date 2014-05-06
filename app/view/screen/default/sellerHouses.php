<?php use Hexagon\Context;?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
    <title>房产集中营</title>
    <link rel="stylesheet" type="text/css" href="/estate/static/css/manager.css">
</head>
<body>
	<div id="welcome">
		<h1><i></i><?php echo $seller;?>的房源<i></i></h1>
	</div> 
	<div id="content">
		<?php if(count($houseInfo) > 0) {?>
			<table border="1" width="900" cellspacing="0" cellpadding="0">
				<th width="15%">发布类型</th><th width="15%">小区名称</th><th width="15%">户型</th>
				<th width="12%">楼层</th><th width="12%">面积</th><th width="20%">操作</th>
			<?php }else {?>
				<div class="notice_info"><?php echo $seller;?>暂无审核通过的房源</div>
			<?php }?>
			<?php for($i = 0; $i < count($houseInfo); $i++) {?>
				<tr>
					<td><?php echo $houseInfo[$i]['type']?></td>
					<td><?php echo $houseInfo[$i]['estateName']?></td>
					<td><?php echo $houseInfo[$i]['houseHold']?></td>
					<td><?php echo $houseInfo[$i]['houseFloor']?></td>
					<td><?php echo $houseInfo[$i]['houseArea']?></td>
					<td><a href="/default/houseDetail?id=<?php echo $houseInfo[$i]['id']?>"><span>查看详情</span></a></td>
				</tr>
			<?php }?>
		</table>
		<div id="public_info">
			<a href="/default/publish"><img alt="我要发房" src="/estate/static/images/public.png"></a>
		</div>
	</div>
</body>
<script type="text/javascript" src="/estate/static/javascript/lib/jquery-2.0.3.js"></script>
</html>