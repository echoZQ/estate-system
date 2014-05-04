<table class="table table-striped">
	<caption>房源信息列表</caption>
	<th>小区名称</th><th>发布人</th><th>发布时间</th><th>户型</th><th>楼层</th><th>面积</th><th>审核状态</th><th>操作</th>
  	<?php for($i = 0; $i < count($houses); $i++) {?>
  	<tr>
  		<td class="estateName"><a href="/admin/houseDetail?id=<?php echo $houses[$i]['id'].'&publisher='.$publishers[$i].'&isCheck=true';?>"><?php echo $houses[$i]['estateName'];?></a></td>
  		<td><?php echo $publishers[$i];?></td>
  		<td><?php echo $houses[$i]['publishTime'];?></td>
  		<td><?php echo $houses[$i]['houseHold'];?></td>
  		<td><?php echo $houses[$i]['houseFloor'];?></td>
  		<td><?php echo $houses[$i]['houseArea'];?></td>
  		<td>
	  		<?php if(0 == $houses[$i]['checkPass']) {echo "尚未审核";}
	  				else if(1 == $houses[$i]['checkPass']) {echo "审核通过";}
	  				else if(2 == $houses[$i]['checkPass']) {echo "审核不通过";}?>
  		</td>
  		<td>
  			<a href="/admin/checkHouseInfo?id=<?php echo $houses[$i]['id'].'&check=true';?>"><button type="button" class="btn btn-success">通过</button></a>
  			<a href="/admin/checkHouseInfo?id=<?php echo $houses[$i]['id'].'&check=false';?>"><button type="button" class="btn btn-warning">不通过</button></a>
  			<a href="/admin/deleteHouseInfo?id=<?php echo $houses[$i]['id'];?>"><button type="button" class="btn btn-danger">删除</button></a>
  		</td>
  	</tr>
  	<?php }?>
</table>
<ul class="pagination">
  <li><a href="#">&laquo;</a></li>
  <?php for($i=1; $i<=$pages; $i++) {?>
  <li><a href="/admin/houseInfo?page=<?php echo $i;?>"><?php echo $i;?></a></li>
  <?php }?>
  <li><a href="#">&raquo;</a></li>
</ul>