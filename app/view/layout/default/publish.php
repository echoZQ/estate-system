<?php use Hexagon\Context;?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
    <title>房产集中营</title>
    <link rel="stylesheet" type="text/css" href="/estate/static/css/publish.css">
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
		<h1><i></i>发布房源<i></i></h1>
	</div> 
	<div id="content">
		<div id="estate_form">
			<form id="publishForm" action="/default/doPublish" method="post">
				<div class="publish_firststep">
					<div class="box">
						<label class="label">发布类型</label>
						<div class="type isChosed">出售</div>
						<input type="hidden" value="出售" id="housetype" name="housetype" />
					</div>
					<div class="box">
						<label class="label">小区名称</label>
						<input type="text" id="housename" name="housename" required="required" />
						<div class="err_box"></div>
					</div>
					<div class="box">
						<label class="label">期望售价</label>
						<input type="text" id="houseprice" name="houseprice" required="required"/>万
						<div class="err_box"></div>
					</div>
					<div class="box box_hold">
						<label class="label">&nbsp;&nbsp;&nbsp;&nbsp;户型</label>
						<input type="text" id="shi" name="shi" required="required" /> 室<input type="text" id="ting" name="ting" required="required" /> 厅<input type="text" id="wei" name="wei" required="required" />卫
						<div class="err_box"></div>
					</div>
					<div class="box">
						<label class="label">&nbsp;&nbsp;&nbsp;&nbsp;面积</label>
						<input type="text" id="housearea" name="housearea" required="required" />平
						<div class="err_box"></div>
					</div>
					<div class="btn">
						<input type="button" id="stepone_btn" value="下一步" />
					</div>
				</div>
				
				<div class="publish_secondstep">
					<div class="box box_floor">
						<label class="label">&nbsp;&nbsp;&nbsp;&nbsp;楼层</label>
						<input type="text" id="housefloor" name="housefloor" required="required" /><span> /</span><input type="text" id="housefloor1" name="housefloor1" required="required" />
						<div class="err_box"></div>
					</div>
					<div class="box">
						<label class="label">&nbsp;&nbsp;&nbsp;&nbsp;朝向</label>
						<div class="face isChosed">朝南</div>
						<div class="face">朝北</div>
						<input type="hidden" value="朝南" id="houseface" name="houseface" required="required" />
						<div class="err_box"></div>
					</div>
					<div class="box">
						<label class="label">详细地址</label>
						<input type="text" id="houseaddress" name="houseaddress" />
					</div>
					<div class="box">
						<label class="label">建造时间</label>
						<input type="text" id="buildtime" name="buildtime" />
					</div>
					<div class="box">
						<label class="label">&nbsp;&nbsp;联系人</label>
						<input type="text" id="ownername" name="ownername" required="required" />
						<div class="err_box"></div>
					</div>
					<div class="box">
						<label class="label">联系电话</label>
						<input type="text" id="ownermobile" name="ownermobile" required="required" />
						<div class="err_box"></div>
					</div>
					<div class="btn">
						<input type="submit" id="steptwo_btn" value="发布" />
						<input type="button" id="back_btn" value="上一步" />
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
<script type="text/javascript" src="/estate/static/javascript/lib/jquery-2.0.3.js"></script>
<script type="text/javascript" src="/estate/static/javascript/lib/jquery.form.js"></script>
<script type="text/javascript" src="/estate/static/javascript/lib/jquery.validate.js"></script>
<script type="text/javascript" src="/estate/static/javascript/lib/validate-ex.js"></script>
<script type="text/javascript" src="/estate/static/javascript/publish.js"></script>
</html>