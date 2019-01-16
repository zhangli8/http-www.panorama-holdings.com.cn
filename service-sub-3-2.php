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
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/css.css">
</head>
<body>
	<header>
		<h3>致力于为中国企业或者个人赴美投资及生活提供全周期服务</h3>
		<a href="index.html"><img class="logo" src="images/index_02.png" /></a>
		<ul class="tel">
			<li>中国热线：(+86) 010-58116019</li>
			<li>美国热线：(+1) 828 - 4904420</li>
		</ul>
	</header>
	<nav>
		<ul>
			<li><a href="about-panorama.html">关于磐远</a></li>
			<li><a class="nav-mr" href="project.html">磐远项目</a></li>
			<li><a class="nav-ml" href="service.html">磐远服务</a></li>
			<li><a href="club.html">会员CLUB</a></li>
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
						<a href="service-sub-3.html">生活在美国</a>
					</li>
					<li>
						<a class="current" href="service-sub-3-2.php?id=1">经商在美国</a>
					</li>
				</ul>
			</section>
			<section class="service-sub3-div-right">
				<h3>经商在美国</h3>
				<img class="service-sub3-div-right-img" src="images/service-sub/service-sub-4_03.jpg" alt="">
				<div class="service-sub-3-2-3col">
					<section>
						<strong>金融</strong>
						<ul>
							<li><span>银行</span></li>
							<li><span>外汇</span></li>
							<li><span>投资</span></li>
							<li><span>保险</span></li>
							<li><span>其他</span></li>
						</ul>
					</section>
					<section>
						<strong>会计</strong>
						<ul>
							<li><span>审计</span></li>
							<li><span>税务</span></li>
							<li><span>财务</span></li>
							<li><span>管理会计业务</span></li>
						</ul>
					</section>
					<section>
						<strong>房地产</strong>
						<ul>
							<li><span>物业管理</span></li>
							<li><span>设施管理及外包</span></li>
							<li><span>租户代表及租赁代理</span></li>
							<li><span>酒店投资顾问</span></li>
							<li><span>项目开发管理及施工</span></li>
							<li><span>估值，估值修复及破产清算</span></li>
							<li><span>能源及可持续性发展</span></li>
							<li><span>房地产投资管理</span></li>
							<li><span>全球市场概况及市场比较分析</span></li>
							<li><span>风险敞口</span></li>
							<li><span>促进购买及出售</span></li>
						</ul>
					</section>

				</div>

				<img class="service-sub3-div-right-img" src="images/service-sub/service-sub-4_06.jpg" alt="">

				<div class="service-sub-3-2-3col m-b-30">
					<section>
						<strong>工程 | 建筑 | 施工</strong>
						<ul>
							<li><span>前期设计</span></li>
							<li><span>施工筹备</span></li>
							<li><span>详细设计</span></li>
							<li><span>施工</span></li>
							<li><span>建后管理</span></li>
							<li><span>开发业主代表</span></li>
						</ul>
					</section>
					<section>
						<strong>企业战略发展顾问</strong>
						<ul>
							<li><span>选址分析</span></li>
							<li><span>搬迁选址</span></li>
							<li><span>扩张</span></li>
							<li><span>企业重组及兼并</span></li>
							<li><span>并购及收购</span></li>
							<li><span>政府奖励机制分析及谈判</span></li>
						</ul>
					</section>
					<section>
						<strong>法务</strong>
						<ul>
							<li><span>EB-5美国投资移民</span></li>
							<li><span>融资</span></li>
							<li><span>担保及无担保贷款</span></li>
							<li><span>并购及收购</span></li>
							<li><span>许可获取</span></li>
							<li><span>证券</span></li>
							<li><span>风险投资</span></li>
							<li><span>互联网和新媒体技术</span></li>
							<li><span>电子商务</span></li>
							<li><span>众筹</span></li>
						</ul>
					</section>

				</div>
				
				<div class="news">
					<strong>新闻</strong>
					<div class="hr"></div>
					<?php 
					while(!!$_rows=mysql_fetch_array($_results)){
					?>
						<article class="news-article-list">
							<div class="post_date">
								<span class="day"><?php echo date("d",$_rows['date']); ?></span>
								<span class="month"><?php echo date("m",$_rows['date']); ?>月 <?php echo date("Y",$_rows['date']); ?></span>
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


				<strong>戴维洛普成功案例分享</strong>

				<p>
					客户：位于北卡罗来纳州的中国木材加工厂 <br>
					项目规模：一千万美元（$10million），创造114个就业 <br>
					选址地点：北卡罗来纳州/维吉尼亚州 <br>
					奖励政策总值：一百六十万美元（$1.6million）
				</p>
				<p>
					戴维洛普与客户在购置过程谈判奖励政策时结识。客户不了解购置后扩建业务有任何奖励政策。客户面临在短时间内需要大面积返修建筑的挑战。通过广泛的关系和业界经验，戴维洛普为客户争取到总值一百六十万美元的奖励政策，其中包括在第一年内获取五十万美元抵销建筑翻修费用。戴维洛普基于以下事实能够为客户的投资项目增值：客户缺乏奖励政策谈判经验；客户不清楚项目本身的价值，或哪些公共私营实体可以为项目提供奖励。
				</p>
				<p>详情请点击北美华商会网站：<a href="http://www.na-ccc.org">www.na-ccc.org</a></p>
			</section>

		</div>
	</div>
	<footer>
		<p>Copyright © 2015 panorama-holdings.com.cn All Rights Reserved 磐远控股有限责任公司 PANORAMA HOLDINGS. LLC</p>
	</footer>
</body>
</html>