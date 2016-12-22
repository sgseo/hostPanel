	<div class="row">
		<nav class="navbar navbar-default" role="navigation">
			<div class="navbar-header">
				<a class="navbar-brand" href="/<?php echo $page_name;?>/">Nbhao</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							国内主机
						<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="https://shop199016211.taobao.com/" target="_blank">主机代购</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							国外主机
						<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="https://item.taobao.com/item.htm?id=543485922111" target="_blank">Linode代购</a></li>
							<li><a href="https://item.taobao.com/item.htm?id=543451376093" target="_blank">DigitalOcean代购</a></li>
							<li><a href="https://item.taobao.com/item.htm?id=543477365920" target="_blank">Vultr代购</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="/<?php echo $page_name;?>/trial/">试用VPS</a>
					</li>
					<li>
						<a href="http://bbs.sijitao.net/" target="_blank">交流论坛</a>
					</li>
					<!-- <li><a target="_blank" href="/donate/"><span>赞助NB号</span></a></li> -->
					<!-- admin -->
					<?php if (isset($_SESSION['username'])) { ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							主机试用
						<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="/<?php echo $page_name; ?>/admin/?mod=manage&item=trial&order=list">试用列表</a></li>
							<li><a href="/<?php echo $page_name; ?>/admin/?mod=manage&item=trial&order=add">添加订单</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							主机代购
						<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="/<?php echo $page_name; ?>/admin/?mod=manage&item=host&order=list">主机列表</a></li>
							<li><a href="/<?php echo $page_name; ?>/admin/?mod=manage&item=host&order=add">添加主机</a></li>
						</ul>
					</li>
					<?php } ?>
					
					<!-- manager -->
					<?php if (isset($_SESSION['email'])) { ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							服务器列表
						<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="/<?php echo $page_name; ?>/manager/?mod=server&item=linode&order=list">Linode</a></li>
							<li><a href="/<?php echo $page_name; ?>/manager/?mod=server&item=vultr&order=list">Vultr</a></li>
							<li><a href="/<?php echo $page_name; ?>/manager/?mod=server&item=digitalocean&order=list">DigitalOcean</a></li>
						</ul>
					</li>
					<?php } ?>
					
				</ul>
				
				<!-- user login and logout -->
				<?php if (!isset($_SESSION['username'])){ ?>
				
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							用户管理
						<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<?php 
							if (isset($_SESSION['email'])) {
								echo "<li><a href=\"/".$page_name."/manager/?mod=logout\">Logout</a></li>" ;
							}
							else{
								echo "<li><a href=\"/".$page_name."/manager/?mod=login\">Login</a></li>" ;
							}
							?>
						</ul>
					</li>
				</ul>
				<?php } else { ?>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							用户管理
						<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="/<?php echo $page_name; ?>/admin/?mod=logout">Logout</a></li>
						</ul>
					</li>
				</ul>
				<?php } ?>
			</div>
		</nav>
	</div>