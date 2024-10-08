<header id="header">
	<div class="header_top">
		<div class="inner relative">
			<h1>ADMINISTRATOR</h1>
			<div class="user_name" <?php if($_SESSION[$_SESSION_ADMIN_PREFIX . 'type'] == 'AD'){ ?> style="cursor: pointer;" onclick="location.href = '/master/operator/admin_modify.php?smenu=1'" <?php } ?>>
				<span class="ico"></span>
				<p class="txt"><?=$_SESSION[$_SESSION_ADMIN_PREFIX . 'name']?>님</p>
				<span class="info">관리자</span>
			</div>
			<ul class="btn_wrap clearfix">
				<li class="homepage"><a href="/" target="_blank">HOMEPAGE</a></li>
				<li class="logout"><a href="../login/logout.php">LOG-OUT</a></li>
			</ul>
		</div>
	</div>
	<nav id="gnb">
		<ul class="clearfix">
			<li <?php if($bmenu == 1){ ?>class="on"<?php } ?>>
				<a href="../member/member_list.php?bmenu=1&smenu=1">회원 관리</a>
			</li>

			<li <?php if($bmenu == 2){ ?>class="on"<?php } ?>>
				<a href="../promotion/promotion_list.php?bmenu=2&smenu=1">프로모션 관리</a>
			</li>
		</ul>
	</nav>
</header>