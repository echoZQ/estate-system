<?php use Hexagon\Context;?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
    <title>房产集中营</title>
	<link type="text/css" rel="stylesheet" href="/estate/static/javascript/js/jquery.ui.plupload/css/jquery-ui.min.css" media="screen">
	<link type="text/css" rel="stylesheet" href="/estate/static/javascript/js/jquery.ui.plupload/css/jquery.ui.plupload.css" media="screen">
    <link rel="stylesheet" type="text/css" href="/estate/static/css/update.css">
</head>
<body>
	<div id="welcome">
		<h1><i></i>我的房源<i></i></h1>
	</div> 
	<div id="content">
		<form id="updateForm" action="/manager/doUpdate" method="post">
			<div class="update_box">
				<input type="hidden" value="<?php echo $houseInfo['id'];?>" name="id" id="houseID">
				<div class="box">
					<label class="label">发布类型</label>
					<input type="text" value="<?php echo $houseInfo['type'];?>" readonly="readonly" />
				</div>
				<div class="box">
					<label class="label">小区名称</label>
					<input type="text" value="<?php echo $houseInfo['estateName'];?>"  readonly="readonly" />
				</div>
				<div class="box">
					<label class="label">期望售价</label>
					<input type="text" value="<?php echo $houseInfo['sellPrice'];?>" id="houseprice" name="houseprice"  required="required"/>
					<div class="err_box"></div>
				</div>
				<div class="box box_hold">
					<label class="label">&nbsp;&nbsp;&nbsp;&nbsp;户型</label>
					<input type="text" value="<?php echo $houseInfo['houseHold'];?>" readonly="readonly" />
				</div>
				<div class="box">
					<label class="label">&nbsp;&nbsp;&nbsp;&nbsp;面积</label>
					<input type="text" value="<?php echo $houseInfo['houseArea'];?>" readonly="readonly" />
				</div>
				<div class="box">
					<label class="label">&nbsp;&nbsp;&nbsp;&nbsp;楼层</label>
					<input type="text" value="<?php echo $houseInfo['houseFloor'];?>" readonly="readonly" />
					<div class="err_box"></div>
				</div>
				<div class="box">
					<label class="label">&nbsp;&nbsp;&nbsp;&nbsp;朝向</label>
					<input type="text" value="<?php echo $houseInfo['houseFaceTo'];?>" readonly="readonly" />
					<div class="err_box"></div>
				</div>
				<div class="box">
					<label class="label">详细地址</label>
					<input type="text" value="<?php echo $houseInfo['address'];?>" readonly="readonly" />
				</div>
				<div class="box">
					<label class="label">建造时间</label>
					<input type="text" value="<?php echo $houseInfo['buildTime'];?>" readonly="readonly" />
				</div>
				<div class="box">
					<label class="label">&nbsp;&nbsp;联系人</label>
					<input type="text" value="<?php echo $houseInfo['ownerName'];?>" id="ownername" name="ownername" required="required" />
					<div class="err_box"></div>
				</div>
				<div class="box">
					<label class="label">联系电话</label>
					<input type="text" value="<?php echo $houseInfo['ownerMobile'];?>" id="ownermobile" name="ownermobile" required="required" />
					<div class="err_box"></div>
				</div>
				<div class="box">
					<label class="label">是否售出</label>
					<input type="text" value="<?php if(1 == $houseInfo['isSelled']) echo "已售出"; else echo "未售出"?>" readonly="readonly"  />
				</div>
				<div class="box_btn">
					<input type="submit" value="提交更新" />
				</div>
			</div>
		</form>
		<div id="uploader">
		    <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
		</div>
	</div>
</body>
<script type="text/javascript" src="/estate/static/javascript/lib/jquery-2.0.3.js"></script>
<script type="text/javascript" src="/estate/static/javascript/lib/jquery.form.js"></script>
<script type="text/javascript" src="/estate/static/javascript/lib/jquery.validate.js"></script>
<script type="text/javascript" src="/estate/static/javascript/lib/validate-ex.js"></script>
<script type="text/javascript" src="/estate/static/javascript/js/plupload.full.min.js"></script>
<script type="text/javascript" src="/estate/static/javascript/update.js"></script>
<script type="text/javascript" src="/estate/static/javascript/lib/jquery-ui-1.10.4.min.js"></script>
<script type="text/javascript" src="/estate/static/javascript/js/jquery.ui.plupload/jquery.ui.plupload.min.js"></script>
<script type="text/javascript" src="/estate/static/javascript/js/i18n/zh_CN.js"></script>
<script type="text/javascript">
// Initialize the widget when the DOM is ready
$(function() {
    $("#uploader").plupload({
        // General settings
        runtimes : 'html5,flash,silverlight,html4',
        url : "/manager/uploadFile?id="+$('#houseID').val(),
 
        // Maximum file size
        max_file_size : '2mb',
 
        chunk_size: '1mb',
        
        unique_names: true, 
 
        // Resize images on clientside if we can
        resize : {
            width : 200,
            height : 200,
            quality : 90,
            crop: true // crop to exact dimensions
        },
 
        // Specify what files to browse for
        filters : [
            {title : "Image files", extensions : "jpg,gif,png"}
        ],
 
        // Rename files by clicking on their titles
        rename: true,
         
        // Sort files
        sortable: true,
 
        // Enable ability to drag'n'drop files onto the widget (currently only HTML5 supports that)
        dragdrop: true,
 
        // Views to activate
        views: {
            list: true,
            thumbs: true, // Show thumbs
            active: 'thumbs'
        },
 
        // Flash settings
        flash_swf_url : '/estate/static/javascript/js/Moxie.swf',
     
        // Silverlight settings
        silverlight_xap_url : '/estate/static/javascript/js/Moxie.xap'
    });
});
</script>
</html>