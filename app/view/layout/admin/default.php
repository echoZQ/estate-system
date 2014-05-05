<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>房产集中营</title>
    <link rel="stylesheet" type="text/css" href="/estate/static/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/estate/static/css/admin/default.css">
</head>
<body>
	<div id="link" style="display: none;"><?php echo $_SESSION['link'];?></div>
	<nav class="navbar navbar-inverse" role="navigation">
	  	<div class="navbar-header">
	    		<a class="navbar-brand">房产集中营管理员系统</a>
	  	</div>
	
	  	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	  	  	<ul class="nav navbar-nav">
	    			<li class="active" linkTo="houseInfo"><a href="/admin/houseInfo">房源信息</a></li>
	      		<li linkTo="sellRecord"><a href="/admin/sellRecord">销售记录</a></li>
	      		<li linkTo="userInfo"><a href="/admin/userInfo">用户信息</a></li>
	     		<li linkTo="adminInfo" class="dropdown">
	        			<a href="#" class="dropdown-toggle" data-toggle="dropdown">管理员信息<b class="caret"></b></a>
        				<ul class="dropdown-menu">
          				<li><a href="/admin/addAdmin">添加管理员</a></li>
         				<li><a href="/admin/adminList">修改管理员信息</a></li>
        				</ul>
	      		</li>
	   		</ul>
	    </div>
	    <div class="welcome"><?php if(isset($_SESSION['admin'])) echo "欢迎您: ".$_SESSION['admin'];?><a href="/admin/loginOut"><span style="padding-left: 20px;">登出</span></a></div>
	</nav>
	<div id="container">
		<?php echo $_screenHolder;?>
	</div>
</body>
<script type="text/javascript" src="/estate/static/javascript/lib/jquery-2.0.3.js"></script>
<script type="text/javascript" src="/estate/static/javascript/lib/bootstrap.min.js"></script>
<script type="text/javascript" src="/estate/static/javascript/lib/jquery.form.js"></script>
<script type="text/javascript" src="/estate/static/javascript/lib/jquery.validate.js"></script>
<script type="text/javascript" src="/estate/static/javascript/lib/validate-ex.js"></script>
<script type="text/javascript" src="/estate/static/javascript/addAdmin.js"></script>
<script type="text/javascript" src="/estate/static/javascript/updateAdmin.js"></script>
<script type="text/javascript">
	$(function() {
		var linkTo = $('#link').text();
		$('li').each(function() {
			$(this).removeClass("active");

			if($(this).attr("linkTo") == linkTo) {
				$(this).addClass("active");
			}
		});
	})
</script>
</html>