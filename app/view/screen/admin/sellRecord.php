<table class="table table-striped">
	<caption>已售出房源列表</caption>
	<th>小区名称</th><th>发布人</th><th>发布时间</th><th>户型</th><th>楼层</th><th>面积</th>
  	<?php for($i = 0; $i < count($houses); $i++) {?>
  	<tr>
  		<td class="estateName"><a href="/admin/houseDetail?id=<?php echo $houses[$i]['id'].'&publisher='.$publishers[$i].'&isCheck=false';?>"><?php echo $houses[$i]['estateName'];?></a></td>
  		<td><?php echo $publishers[$i];?></td>
  		<td><?php echo $houses[$i]['publishTime'];?></td>
  		<td><?php echo $houses[$i]['houseHold'];?></td>
  		<td><?php echo $houses[$i]['houseFloor'];?></td>
  		<td><?php echo $houses[$i]['houseArea'];?></td>
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