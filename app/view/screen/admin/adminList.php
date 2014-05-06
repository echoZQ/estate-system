<table class="table table-striped">
	<caption>管理员信息列表</caption>
	<th>用户名</th><th>邮箱</th><th>权限</th><th>操作</th>
  	<?php for($i = 0; $i < count($admins); $i++) {?>
  	<tr>
  		<td><?php echo $admins[$i]['username'];?></td>
  		<td><?php echo $admins[$i]['email'];?></td>
  		<td><?php echo $admins[$i]['power'];?></td>
  		<td>
  			<a href="/admin/updateAdmin?id=<?php echo $admins[$i]['id'];?>"><button type="button" class="btn btn-success">修改</button></a>
  			<a href="/admin/deleteAdminInfo?id=<?php echo $admins[$i]['id'];?>"><button type="button" class="btn btn-danger">删除</button></a>
  		</td>
  	</tr>
  	<?php }?>
</table>
<ul class="pagination">
  <li><a href="#">&laquo;</a></li>
  <?php for($i=1; $i<=$pages; $i++) {?>
  <li><a href="/admin/adminList?page=<?php echo $i;?>"><?php echo $i;?></a></li>
  <?php }?>
  <li><a href="#">&raquo;</a></li>
</ul>