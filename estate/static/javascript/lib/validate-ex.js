/*
 * jQuery validation 验证类型扩展
 *
 * 扩展的验证类型：用户名，邮政编码，大陆身份证号码，大陆手机号码,电话号码
 * 
 * 2010-06-17 by 刘仁飞
 */

// 用户名字验证    
jQuery.validator.addMethod("userName", function(value, element) {  
  return this.optional(element) || /^[A-Za-z0-9]{4,20}$/.test(value);   
}, "4-20个英文字符或数字");   

//小区名字验证    
jQuery.validator.addMethod("estateName", function(value, element) {  
  return this.optional(element) || /^[\u4e00-\u9fa5|A-Za-z]{4,20}$/.test(value);   
}, "4-20个中英文字符");  

//期望售价验证    
jQuery.validator.addMethod("isNum", function(value, element) {  
  return this.optional(element) || /^([0-9]*[1-9][0-9]*)$/.test(value);   
}, "必须是数字");   


// 联系电话(手机/电话皆可)验证   
jQuery.validator.addMethod("isTel", function(value,element) {   
    var length = value.length;   
    var mobile = /^(((13[0-9]{1})|(15[0-9]{1}))+\d{8})$/;   
    var tel = /^\d{3,4}-?\d{7,9}$/;   
    return this.optional(element) || (tel.test(value) || mobile.test(value));   
}, "请正确填写您的联系电话");  

//身份证号码的验证规则
function isIdCardNo(num){ 
　//　 if (isNaN(num)) {alert("输入的不是数字！"); return false;} 
　　 var len = num.length, re; 
　　 if (len == 15) 
　　 re = new RegExp(/^(\d{6})()?(\d{2})(\d{2})(\d{2})(\d{2})(\w)$/); 
　　 else if (len == 18) 
　　 re = new RegExp(/^(\d{6})()?(\d{4})(\d{2})(\d{2})(\d{3})(\w)$/); 
　　 else {alert("输入的数字位数不对"); return false;} 
　　 var a = num.match(re); 
　　 if (a != null) 
　　 { 
　　 if (len==15) 
　　 { 
　　 var D = new Date("19"+a[3]+"/"+a[4]+"/"+a[5]); 
　　 var B = D.getYear()==a[3]&&(D.getMonth()+1)==a[4]&&D.getDate()==a[5]; 
　　 } 
　　 else 
　　 { 
　　 var D = new Date(a[3]+"/"+a[4]+"/"+a[5]); 
　　 var B = D.getFullYear()==a[3]&&(D.getMonth()+1)==a[4]&&D.getDate()==a[5]; 
　　 } 
　　 if (!B) {alert("输入的身份证号 "+ a[0] +" 里出生日期不对"); return false;} 
　　 } 
　　  if(!re.test(num)){alert("身份证最后一位只能是数字和字母");return false;}
　　  
　　 return true; 
} 


