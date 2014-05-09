<?php if(0 < count($houses)) {?>
<table class="table table-striped">
	<caption><?php echo $publisher;?>的房源信息列表</caption>
	<th>小区名称</th><th>发布人</th><th>发布时间</th><th>户型</th><th>楼层</th><th>面积</th><th>是否已售</th><th>审核状态</th>
  	<?php for($i = 0; $i < count($houses); $i++) {?>
  	<tr>
  		<td class="estateName"><a href="/admin/houseDetail?id=<?php echo $houses[$i]['id'].'&publisher='.$publisher.'&isCheck=false';?>"><?php echo $houses[$i]['estateName'];?></a></td>
  		<td><?php echo $publisher;?></td>
  		<td><?php echo $houses[$i]['publishTime'];?></td>
  		<td><?php echo $houses[$i]['houseHold'];?></td>
  		<td><?php echo $houses[$i]['houseFloor'];?></td>
  		<td><?php echo $houses[$i]['houseArea'];?></td>
  		<td><?php if(0 == $houses[$i]['isSelled']) echo "未售出"; else echo "已售出";?></td>
  		<td>
	  		<?php if(0 == $houses[$i]['checkPass']) {echo "尚未审核";}
	  				else if(1 == $houses[$i]['checkPass']) {echo "审核通过";}
	  				else if(2 == $houses[$i]['checkPass']) {echo "审核不通过";}?>
  		</td>
  	</tr>
  	<?php }?>
</table>
<ul class="pagination">
  <li><a href="#">&laquo;</a></li>
  <?php for($i=1; $i<=$pages; $i++) {?>
  <li><a href="/admin/published?id=<?php echo $publisherId.'&publisher='.$publisher.'&page='.$i;?>"><?php echo $i;?></a></li>
  <?php }?>
  <li><a href="#">&raquo;</a></li>
</ul>
<?php }else echo $publisher."暂时没有发布任何房源信息!"?>