<table class="table table-striped" style="width: 600px;margin-left: 60px;">
	<caption>房源详情</caption>
  	<tr>
  		<td>小区名称</td>
  		<td class="estateName"><?php echo $house['estateName'];?></td>
  	</tr>
  	<tr>
  		<td>发布人</td>
  		<td><?php echo $publisher;?></td>
  	</tr>
  	<tr>
  		<td>发布时间</td>
  		<td><?php echo $house['publishTime'];?></td>
  	</tr>
  	<tr>
  		<td>户型</td>
  		<td><?php echo $house['houseHold'];?></td>
  	</tr>
  	<tr>
  		<td>楼层</td>
  		<td><?php echo $house['houseFloor'];?></td>
  	</tr>
  	<tr>
  		<td>面积</td>
  		<td><?php echo $house['houseArea'];?></td>
  	</tr>
  	<tr>	  
  		<td>期望售价</td>
  		<td><?php echo $house['sellPrice'];?></td>
  	</tr>
  	<tr>	
  		<td>朝向</td>
  		<td><?php echo $house['houseFaceTo'];?></td>
  	</tr>
  	<tr>		
  		<td>地址</td>
  		<td><?php echo $house['address'];?></td>
  	</tr>
  	<tr>	
  		<td>建造时间</td>
  		<td><?php echo $house['buildTime'];?></td>
  	</tr>
  	<tr>	
  		<td>联系人</td>
  		<td><?php echo $house['ownerName'];?></td>
  	</tr>
  	<tr>	
  		<td>联系电话</td>
  		<td><?php echo $house['ownerMobile'];?></td>
  	</tr>
  	<?php if($isCheck == "true") {?>
  	<tr>
  		<td>审核状态</td>
  		<td>
	  		<?php if(0 == $house['checkPass']) {echo "尚未审核";}
	  				else if(1 == $house['checkPass']) {echo "审核通过";}
	  				else if(2 == $house['checkPass']) {echo "审核不通过";}?>
  		</td>
  	</tr>
  	<tr>
  		<td>操作</td>
  		<td>
  			<a href="/admin/checkHouseInfo?id=<?php echo $house['id'].'&check=true';?>"><button type="button" class="btn btn-success">通过</button></a>
  			<a href="/admin/checkHouseInfo?id=<?php echo $house['id'].'&check=false';?>"><button type="button" class="btn btn-warning">不通过</button></a>
  			<a href="/admin/deleteHouseInfo?id=<?php echo $house['id'];?>"><button type="button" class="btn btn-danger">删除</button></a>
  		</td>
  	</tr>
  	<?php }?>
</table>
<div id="carousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <?php $imgs = explode(";", $house['img']);?>
  <ol class="carousel-indicators">
    <li data-target="#carousel" data-slide-to="0" class="active"></li>
    <?php for($i=0; $i<count($imgs) -1 ; $i++) {?>
    <li data-target="#carousel" data-slide-to="1"></li>
    <?php }?>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="<?php if($imgs > 0) echo $imgs[0]; else echo "/upload/default.jpg";?>" alt="...">
    </div>
    <?php for($i=1; $i<count($imgs); $i++) {?>
     <div class="item">
      <img src="<?php echo explode(";", $house['img'])[$i];?>" alt="...">
    </div>
    <?php }?>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
</div>