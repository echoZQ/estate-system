<table class="table table-striped">
	<caption>用户信息列表</caption>
	<th>用户名</th><th>邮箱</th><th>联系电话</th><th>qq</th><th>注册时间</th><th>操作</th>
  	<?php for($i = 0; $i < count($users); $i++) {?>
  	<tr>
  		<td><?php echo $users[$i]['username'];?></td>
  		<td><?php echo $users[$i]['email'];?></td>
  		<td><?php echo $users[$i]['mobile'];?></td>
  		<td><?php echo $users[$i]['qq'];?></td>
  		<td><?php echo $users[$i]['registerTime'];?></td>
  		<td>
  			<a href="/admin/deleteUserInfo?id=<?php echo $users[$i]['id'];?>"><button type="button" class="btn btn-danger">删除</button></a>
  		</td>
  	</tr>
  	<?php }?>
</table>
<ul class="pagination">
  <li><a href="#">&laquo;</a></li>
  <?php for($i=1; $i<=$pages; $i++) {?>
  <li><a href="/admin/userInfo?page=<?php echo $i;?>"><?php echo $i;?></a></li>
  <?php }?>
  <li><a href="#">&raquo;</a></li>
</ul>