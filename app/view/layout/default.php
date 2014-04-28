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