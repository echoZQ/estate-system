<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>房产集中营</title>
    <link rel="stylesheet" type="text/css" href="/estate/static/css/home.css">
    <link rel="stylesheet" type="text/css" href="/estate/static/css/houseDetail.css">
    <link rel="stylesheet" type="text/css" href="/estate/static/elastislide/css/demo.css" />
	<link rel="stylesheet" type="text/css" href="/estate/static/elastislide/css/elastislide.css" />
	<link rel="stylesheet" type="text/css" href="/estate/static/elastislide/css/custom.css" />
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
	<div id="detailBox">
		<h1>概况</h1>
		<div class="demo-4">
			<div class="gallery">
				<ul id="carousel" class="elastislide-list">
				<?php 
					$imgs = explode(";",$houseInfo['img']);
					for($i = 0; $i < count($imgs); $i++) {?>
						<li data-preview="<?php echo $imgs[$i];?>"><a href="#"><img src="<?php echo $imgs[$i];?>" /></a></li>
					<?php }?>
				</ul>
				<div class="image-preview">
					<img id="preview" src="<?php echo $imgs[0];?>" />
				</div>
			</div>
		</div>
		<div class="notice"><?php if("" == $houseInfo['img']) { echo "用户尚未发布任何照片!";}?></div>
		<table cellspacing="5" cellpadding="0" width="900">
			<tr>
				<td class="even">户型</td>
				<td><?php echo $houseInfo['houseHold'];?></td>
				<td class="even">面积</td>
				<td><?php echo $houseInfo['houseArea'];?></td>
				<td class="even">楼层</td>
				<td><?php echo $houseInfo['houseFloor'];?></td>
				
			</tr>
			<tr>
				<td class="even">朝向</td>
				<td><?php echo $houseInfo['houseFaceTo'];?></td>
				<td class="even">发布类型</td>
				<td><?php echo $houseInfo['type'];?></td>
				<td class="even">小区名称</td>
				<td><?php echo $houseInfo['estateName'];?></td>
			</tr>
			<tr>
				<td class="even">期望售价</td>
				<td><?php echo $houseInfo['sellPrice'];?></td>
				<td class="even">建造时间</td>
				<td><?php echo $houseInfo['buildTime'];?></td>
			</tr>
		</table>
		<table id="detailText">
			<tr><td class="even">联系人</td><td><?php echo $houseInfo['ownerName'];?></td></tr>
			<tr><td class="even">联系电话</td><td><?php echo $houseInfo['ownerMobile'];?></td></tr>
			<tr><td class="even">详细地址</td><td><?php echo $houseInfo['address'];?></td></tr>
		</table>	
		</div>
	</div>
	<div id="public_info">
		<a href="/default/publish"><img alt="我要发房" src="/estate/static/images/public.png"></a>
		<a href=""><img alt="意见反馈" src="/estate/static/images/advice.png"></a>
	</div>
</body>
<script type="text/javascript" src="/estate/static/javascript/lib/jquery-2.0.3.js"></script>
<script type="text/javascript" src="/estate/static/elastislide/js/modernizr.custom.17475.js"></script>
<script type="text/javascript" src="/estate/static/elastislide/js/jquerypp.custom.js"></script>
<script type="text/javascript" src="/estate/static/elastislide/js/jquery.elastislide.js"></script>
<script type="text/javascript">

	var current = 0,
		$preview = $( '#preview' ),
		$carouselEl = $( '#carousel' ),
		$carouselItems = $carouselEl.children(),
		carousel = $carouselEl.elastislide( {
			current : current,
			minItems : 4,
			onClick : function( el, pos, evt ) {

				changeImage( el, pos );
				evt.preventDefault();

			},
			onReady : function() {

				changeImage( $carouselItems.eq( current ), current );
				
			}
		} );

	function changeImage( el, pos ) {

		$preview.attr( 'src', el.data( 'preview' ) );
		$carouselItems.removeClass( 'current-img' );
		el.addClass( 'current-img' );
		carousel.setCurrent( pos );

	}

</script>
</html>