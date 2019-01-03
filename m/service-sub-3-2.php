<?php
define('GUY','true');
require 'common.inc.php';
global $_system;

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
$_result=mysql_query("select class from class where id='{$_html['id']}'");
$_rows=mysql_fetch_array($_result);
$_html['class']=$_rows['class'];


if(isset($_GET['page'])){
	$_page=$_GET['page'];
	if(empty($_page)|| !is_numeric($_page)||$_page<0|| ($_page>0 && $_page<1)){
		$_page=1;
	}else{
		$_page=intval($_page);
	}	
}else{
	$_page=1;
}
$_pagenums=$_system['pagenums'];
$_pageopen=($_page-1)*$_pagenums;
$_result=mysql_query("select id from news where uid='{$_html['id']}' or uid in (select id from class where uptypeid='{$_html['id']}') ");
$_nums=mysql_num_rows($_result);
$_pages=ceil($_nums/$_pagenums);
$_results=mysql_query("select id,title,date,simg,link,brief from news where uid='{$_html['id']} ORDER BY date DESC' or uid in (select id from class where uptypeid='{$_html['id']}') ORDER BY date DESC limit $_pageopen,$_pagenums");

function tre($_id,$_num){
	$_results=mysql_query("select id,class from class where uptypeid='{$_id}'");
	while(!!$_row=mysql_fetch_array($_results,MYSQL_ASSOC)){
		echo "<li><a href=sqlgunclass.php?id=".$_row['id'].">".str_repeat('　',$_num)."|-".$_row['class']."</a></li>";
		tre($_row['id'],$_num+1);
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>磐远中国</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="../css/m.css">
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
			<img src="../images/m/service/service-sub-3-2_03.png" alt="">
			<img src="../images/m/service/service-sub-3-2_04.jpg" alt="">
			<img src="../images/m/service/service-sub-3-2_05.png" alt="">
			<img src="../images/m/service/service-sub-3-2_06.jpg" alt="">
			<img src="../images/m/service/service-sub-3-2_07.png" alt="">
			<img src="../images/m/service/service-sub-3-2_08.jpg" alt="">
			<img src="../images/m/service/service-sub-3-2_09.png" alt="">
			
			<div class="news">
				<strong>新闻</strong>
				<div class="hr"></div>
				<?php 
				while(!!$_rows=mysql_fetch_array($_results)){
				?>
					<article class="news-article-list">
						<div class="post_date">
							<span class="day"><?php echo date("Y-m-d",$_rows['date']); ?></span>
							<!-- <span class="month"><?php echo date("m",$_rows['date']); ?>月 <?php echo date("Y",$_rows['date']); ?></span> -->
						</div>
						<?php if($_rows['simg']){ ?>
							<img class="news-img" src="<?php echo "http://www.na-ccc.org/upload/news/".$_rows['simg'] ?>" />
						<?php } else{ ?>
							<img class="news-img" src="http://www.na-ccc.org/images/default.jpg" />
						<?php }; ?>
						<div class="news-txt">
							<h3>
							<?php if($_rows['link']){ ?>
								<a href="<?php echo $_rows['link'] ?>">
							<?php }else{ ?>
								<a href="service-sub-detail.php?id=<?php echo $_rows['id'] ?>">
							<?php }; ?>
								<?php echo $_rows['title'] ?>
							</a>
							</h3>
							<div class="author">发布作者: <span>官方发布</span></div>
							<p><?php echo $_rows['brief'] ?></p>
							<?php if($_rows['link']){ ?>
								<a class="read_more" href="<?php echo $_rows['link'] ?>">查看全文</a>
							<?php }else{ ?>
								<a class="read_more" href="service-sub-detail.php?id=<?php echo $_rows['id'] ?>">查看全文</a>
							<?php }; ?>
						</div>
						<div class="c"></div>
					</article>
				<?php }?>
					

					<?php if($_pages==1){ ?>
					<style>
						.page{
							display:none;
						}
					</style>
					<?php } ?>
					<ul class="page">
						<li><?php echo $_page?>/<?php echo $_pages?>页</li>
						<li>共<?php echo $_nums?>条新闻</li>
						<?php 
						if($_page==1){?>
						<li>首页</li>
						<li>上一页</li>	
						<?php }else{?>
						<li><a href="?id=<?php echo $_html['id']?>&page=1">首页</a></li>
						<li><a href="?id=<?php echo $_html['id']?>&page=<?php echo $_page-1?>">上一页</a></li>		
						<?php }
						?>

						<?php 
						if($_page==$_pages|| $_nums==0){?>
						<li>下一页</li>
						<li>尾页</li>	
						<?php }else{?>
						<li><a href="?id=<?php echo $_html['id']?>&page=<?php echo $_page+1?>">下一页</a></li>
						<li><a href="?id=<?php echo $_html['id']?>&page=<?php echo $_pages?>">尾页</a></li>		
						<?php }
						?>
					</ul>
			</div>


			<a href="http://www.na-ccc.org">
				<img src="../images/m/service/service-sub-3-2_11.png" alt="">
			</a>
		</section>
	</div>
	
	<img src="../images/m/about/about_09.png" alt="">
</div>
</body>
</html>