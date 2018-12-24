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
	<link rel="stylesheet" href="http://panorama-holdings.com.cn/css/style.css">
	<link rel="stylesheet" href="http://panorama-holdings.com.cn/css/css.css">
	<base href="http://www.na-ccc.org" />
</head>
<body>
	<header>
		<h3>致力于为中国企业或者个人赴美投资及生活提供全周期服务</h3>
		<a href="http://panorama-holdings.com.cn/index.html"><img class="logo" src="http://panorama-holdings.com.cn/images/index_02.png" /></a>
		<ul class="tel">
			<li>中国热线：(+86) 010-58116019</li>
			<li>美国热线：(+1) 828 - 4904420</li>
		</ul>
	</header>
	<nav>
		<ul>
			<li><a href="http://panorama-holdings.com.cn/about-panorama.html">关于磐远</a></li>
			<li><a class="nav-mr" href="http://panorama-holdings.com.cn/project.html">磐远项目</a></li>
			<li><a class="nav-ml" href="http://panorama-holdings.com.cn/service.html">磐远服务</a></li>
			<li><a href="http://panorama-holdings.com.cn/club.html">会员CLUB</a></li>
		</ul>
	</nav>
	<section class="service-banner">

	</section>
	<div class="div-bg">
		<div class="service-sub-title">
			<section class="service-sub-title-center">
				<h2>磐远服务</h2>
				<em>panorama service</em>
				<span>立足美国</span>
			</section>
		</div>
		<div class="service-sub3-div">
			<section class="service-sub3-div-left">
				<ul>
					<li>
						<a href="http://panorama-holdings.com.cn/service-sub-3.html">生活在美国</a>
					</li>
					<li>
						<a class="current" href="http://panorama-holdings.com.cn/service-sub-3-2.php?id=1">经商在美国</a>
					</li>
				</ul>
			</section>
			<section class="service-sub3-div-right">
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
	</div>
	<footer>
		<p>Copyright © 2015 panorama-holdings.com.cn All Rights Reserved 磐远控股有限责任公司 PANORAMA HOLDINGS. LLC</p>
	</footer>
</body>
</html>