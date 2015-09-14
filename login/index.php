<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="livequery,jquery,php" />
<title>PHP+jQuery+Ajax实现用户登录与退出</title>
<style type="text/css">
#login{width:420px; height:200px; margin:60px auto; border:1px solid #aac6eb}
#login h3{height:32px; line-height:32px; padding-left:8px; background:#e8f5fe}
#login_form{margin:20px 10px}
#login p{height:30px; line-height:30px; margin:10px 0}
#login p label{float:left; width:120px; text-align:right}
.input{width:180px; height:24px; line-height:24px; padding:2px; border:1px solid #d3d3d3}
.sub{height:42px; line-height:42px; position:absolute}
.btn{width:86px; height:33px; background:url(images/login_btn.jpg) no-repeat; border:none; text-indent:-999em; display:block; cursor:pointer; margin-left:120px}
.cur_select{border:1px solid #aac6eb}
#msg,#errmsg{position:absolute; width:200px; height:32px; line-height:32px; left:220px; top:0; color:#f30; font-weight:bold}
.loading{background:url(images/loading.gif) no-repeat 0 6px; padding-left:18px; color:#999}
#result{margin:20px; text-align:center}
#result p{line-height:22px; margin:2px 0}
#result p span{color:#f30; margin:4px; font-weight:bold}
</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="global.js"></script>
</head>

<body>

<div id="main">
  <p style="margin:20px">提示：用户名和密码都是demo。</p>
  <div id="login">
      <h3>用户登录</h3>
      <?php
	  if(isset($_SESSION['user'])){
	  ?>
      <div id="result">
        <p><strong><?php echo $_SESSION['user'];?></strong>，恭喜您登录成功！</p>
        <p>您这是第<span><?php echo $_SESSION['login_counts'];?></span>次登录本站。</p>
        <p>上次登陆本站的时间是：<span><?php echo date('Y-m-d H:i:s',$_SESSION['login_time']);?></span></p><p><a href='#' id='logout'>【退出】</a></p>
      </div>
      <?php }else{?>
      <div id="login_form">
          <p><label>用户名：</label> <input type="text" class="input" name="user" id="user" /></p>
          <p><label>密 码：</label> <input type="password" class="input" name="pass" id="pass" /></p>
          <div class="sub">
              <input type="submit" class="btn" value="登 录" />
          </div>
      </div>
      <?php }?>
  </div> 
  <br />
<br />
<br />

</div>
<p id="stat"><script type="text/javascript" src="http://js.tongji.linezing.com/1870888/tongji.js"></script></p>
</body>
</html>
