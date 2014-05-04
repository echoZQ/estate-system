<?php use Hexagon\Context;?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
    <title>房产集中营</title>
    <link rel="stylesheet" type="text/css" href="/estate/static/css/register.css">
</head>
<body>
	<div id="blc_title">
		<h2>10秒快速注册</h2>
		<h6>已经是会员?<span><a href="/login/index"> 直接登录</a></span></h6>
	</div>
	<div id="register_form">
		<form id="registertForm" action="/register/doRegister" method="post">
			<div class="account_info">
				<label>账号:</label><br>
				<span><input type="text" id="account" name="account" maxlength="20" minlength="4" required="required"></span>
				<div class="err_box"></div>
			</div>
			<div class="psw_info">
				<label>密码:</label><br>
				<span><input type="password" id="password" name="password" minlength="6" required="required" /></span>
				<div class="err_box"></div>
			</div>
<!-- 			<div class="service_info"> -->
<!-- 				<input type="checkbox" id="checkRead" name="checkRead" required="required"> 我已阅读并接受《<span>服务条款</span>》 -->
<!-- 				<div class="err_box"></div> -->
<!-- 			</div> -->
			<div class="login_button">
				<input type="submit" value="注册">
			</div>
		</form>
	</div>
</body>
<script type="text/javascript" src="/estate/static/javascript/lib/jquery-2.0.3.js"></script>
<script type="text/javascript" src="/estate/static/javascript/lib/jquery.form.js"></script>
<script type="text/javascript" src="/estate/static/javascript/lib/jquery.validate.js"></script>
<script type="text/javascript" src="/estate/static/javascript/lib/validate-ex.js"></script>
<script type="text/javascript" src="/estate/static/javascript/register.js"></script>
</html>