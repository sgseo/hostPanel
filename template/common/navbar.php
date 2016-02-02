	
	<div class="row">
		<nav class="navbar navbar-default" role="navigation">
			<div class="navbar-header">
				<a class="navbar-brand" href="/">Nbhao</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							国内主机
						<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="https://zhangnq.taobao.com/category-1130370426.htm" target="_blank">主机代购</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							国外主机
						<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="https://item.taobao.com/item.htm?id=522194007039" target="_blank">Linux代购</a></li>
							<li><a href="https://item.taobao.com/item.htm?id=523205318200" target="_blank">DigitalOcean代购</a></li>
							<li><a href="https://item.taobao.com/item.htm?id=525393879787" target="_blank">Vultr代购</a></li>
						</ul>
					</li>
					<li><a target="_blank" href="/donate/"><span>赞助NB号</span></a></li>
					<?php if (isset($_SESSION['username'])) { if (isset($_GET['mod'])) { ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							SSH代理
						<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="./?mod=manage&item=ssh&order=list">账号列表</a></li>
							<li><a href="./?mod=manage&item=ssh&order=add">添加账号</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							主机代购
						<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="./?mod=manage&item=host&order=list">主机列表</a></li>
							<li><a href="./?mod=manage&item=host&order=add">添加主机</a></li>
						</ul>
					</li>
					<?php } else { ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							SSH代理
						<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="./admin/?mod=manage&item=ssh&order=list">账号列表</a></li>
							<li><a href="./admin/?mod=manage&item=ssh&order=add">添加账号</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							主机代购
						<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="./admin/?mod=manage&item=host&order=list">主机列表</a></li>
							<li><a href="./admin/?mod=manage&item=host&order=add">添加主机</a></li>
						</ul>
					</li>
					<?php } } ?>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							用户管理
						<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<?php 
							if (isset($_SESSION['username'])) {
								if (isset($_GET['mod'])){
									echo "<li><a href=\"./?mod=logout\">Logout</a></li>" ;
								}
								else{
									echo "<li><a href=\"./admin/?mod=logout\">Logout</a></li>" ;
								}
							}
							else{
								if (isset($_GET['mod'])){
									echo "<li><a href=\"./?mod=login\">Login</a></li>" ;
								}
								else{
									echo "<li><a href=\"./admin/?mod=login\">Login</a></li>" ;
								}
							}
							?>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
	</div>