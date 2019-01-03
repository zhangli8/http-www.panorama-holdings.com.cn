<?php
define('GUY','true');
require 'common.inc.php';
if(isset($_GET['id'])){
	$_html['id']=$_GET['id'];
	if(empty($_html['id']) || !is_numeric($_html['id']) || $_html['id']<0 || ($_html['id']>0 && $_html['id']<1)){
	echo '<script type="text/javascript">alert("非法访问!");location.href="index.php";</script>';
	exit;
	}else{
	$_html['id']=intval($_html['id']);	
	}
}else{
	echo '<script type="text/javascript">alert("非法访问!");location:index.php;</script>';
	exit;	
}
$_result=mysql_query("select title,hits from news where id='{$_html['id']}'");
$_rows=mysql_fetch_array($_result);
$_html['title']=$_rows['title'];
$_html['hits']=$_rows['hits'];

global $_system;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>磐远中国</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="../css/m.css">
	<link rel="stylesheet" href="css/mstyle.css">
	<link rel="stylesheet" href="css/mcss.css">
</head>
<body>
<div class="main">
	<a href="../index-m.html"><img src="../images/m/index-m_01.jpg" alt=""></a>
	
	<nav>
		<ul>
			<li><a href="../m/about.html">关于磐远</a></li>
			<li><a href="../m/project.html">磐远项目</a></li>
			<li><a href="../m/service.html">磐远服务</a></li>
			<li><a href="../m/club.html">会员CLUB</a></li>
		</ul>
	</nav>
	<img src="../images/m/service/service-sub-1_02.jpg" alt="">
	<div class="project-nav">
		<a href="service.html">磐远服务</a>
		<a href="service-sub-1.html">了解美国</a>
		<a href="service-sub-2.html">移民美国</a>	
		<a class="current" href="service-sub-3.html">立足美国</a>		
	</div>
	
	<div class="service-sub-3-con">
		<section class="service-sub-3-left">
			<a href="service-sub-3.html">生活在美国</a>
			<a class="current" href="service-sub-3-2.php?id=1">经商在美国</a>
		</section>
		<section class="service-sub-3-right">
			<?php 
				$_result=mysql_query("select title,birth,date,content from news where id='{$_html['id']}'");
				$_rows=mysql_fetch_array($_result);
				$_a='/onmousemove="(.*)"/';
				$_b='';
			?>

			<div class="sub-content">
				<article class="news-detail">
						<h3><?php echo $_rows['title']?></h3>
						<time><?php echo date("Y-m-d",$_rows['date']); ?></time>
						<div class="author">发布作者: <span>官方发布</span></div>
						<div class="hr"></div>
						<div class="news-detail-content"><?php echo preg_replace($_a,$_b,$_rows['content'])?></div>


					<div class="c"></div>
				</article>
			</div>

			<?php 
				mysql_close();
			?>
		</section>
	</div>
	
	<img src="../images/m/about/about_09.png" alt="">
</div>
</body>
</html>