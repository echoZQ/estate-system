<form id="updateAdminForm" role="form" action="doUpdateAdmin?id=<?php echo $admin['id'];?>" method="post">
<table class="table table-striped" style="width: 600px;margin-left: 60px;">
	<caption>管理员详情</caption>
	<?php $powers=explode(";", $admin['power']);?>
  	<tr>
  		<td>用户名</td>
  		<td class="estateName"><input value="<?php echo $admin['username'];?>" readonly="readonly"></td>
  	</tr>
  	<tr>
  		<td>邮箱</td>
  		<td><input value="<?php echo $admin['email'];?>" id="email" name="email" required="required"><div class="err_box"></div></td>
  	</tr>
  	<tr>
  		<td>手机号</td>
  		<td><input value="<?php echo $admin['mobile'];?>" id="mobile" name="mobile" required="required"><div class="err_box"></div></td>
  	</tr>
  	<tr>
  		<td>权限</td>
  		<td>
  			<input type="checkbox" name="power[]" <?php foreach ($powers as $power) {if("房源管理权限" == $power) echo "checked";}?> value="房源管理权限"> 房源管理权限
  		</td>
  	</tr>
  	<tr>
  		<td>权限</td>
  		<td>
  			<input type="checkbox" name="power[]" <?php foreach ($powers as $power) {if("用户管理权限" == $power) echo "checked";}?> value="用户管理权限"> 用户管理权限
  		</td>
  	</tr>
	<tr>
		<td>权限</td>
  		<td>
  			<input type="checkbox" name="power[]" <?php foreach ($powers as $power) {if("管理员管理权限" == $power) echo "checked";}?> value="管理员管理权限"> 管理员管理权限
  		</td>
  	</tr>
  	<tr>
  		<td>操作</td>
  		<td>
  			<button type="submit" class="btn btn-success">确认修改</button>
  		</td>
  	</tr>
</table>
</form>