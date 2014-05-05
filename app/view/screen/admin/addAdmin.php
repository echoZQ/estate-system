<form id="adminRegister" role="form" action="doAddAdmin" method="post">
  <div class="form-group">
    <label for="username">用户名</label>
    <input type="text" class="form-control" id="username" name="username" maxlength="20" minlength="4" required="required" />
    <div class="err_box"></div>
  </div>
  <div class="form-group">
    <label for="password">密码</label>
    <input type="password" class="form-control" id="password" name="password" minlength="6" required="required" />
    <div class="err_box"></div>
  </div>
  <div class="form-group">
    <label for="email">邮箱</label>
    <input type="text" class="form-control" id="email" name="email" required="required" />
    <div class="err_box"></div>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" name="power[]" value="房源管理权限"> 房源管理权限 </label>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" name="power[]"  value="用户管理权限"> 用户管理权限 </label>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" name="power[]"  value="管理员管理权限"> 管理员管理权限 </label>
  </div>
  <button type="submit" class="btn btn-success">添加</button>
</form>
