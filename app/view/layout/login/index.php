<?php use Hexagon\Context;?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
    <title>房产集中营</title>
    <link rel="stylesheet" type="text/css" href="/estate/static/css/login.css">
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
	<div id="login_form">
		<form id="loginForm" action="/login/doLogin" method="post">
			<div id="blc_title">
				<h2>账号登陆</h2>
				<h6>不是会员?<span><a href="/register/index"> 快速注册</a></span></h6>
			</div>
			<div class="account_info">
				<label>账号:</label><br>
				<span><input type="text" placeholder="  请输入账号" id="account" name="account" maxlength="20" minlength="4" required="required"></span>
				<div class="err_box"></div>
			</div>
			<div class="psw_info">
				<label>密码:</label>
				<label class="forget_psw"><a href="/login/forgetPsw">忘记密码?</a></label>
				<br>
				<span><input type="password" placeholder="  请输入密码" id="password" name="password" minlength="6" required="required" /></span>
				<div class="err_box"></div>
			</div>
<!-- 			<div class="remember_info"> -->
<!-- 				<input type="checkbox" id="remember" name="remember"> 记住密码 -->
<!-- 			</div> -->
			<div class="login_button">
				<input type="submit" value="登陆">
			</div>
		</form>
	</div>
</body>
<script type="text/javascript" src="/estate/static/javascript/lib/jquery-2.0.3.js"></script>
<script type="text/javascript" src="/estate/static/javascript/lib/jquery.form.js"></script>
<script type="text/javascript" src="/estate/static/javascript/lib/jquery.validate.js"></script>
<script type="text/javascript" src="/estate/static/javascript/lib/validate-ex.js"></script>
<script type="text/javascript" src="/estate/static/javascript/login.js"></script>
</html>