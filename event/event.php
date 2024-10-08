<?php include("../_inc/head.php"); ?>
<body>
	<div id="wrap">
		<header id="header">
			<div class="header__inner">
				<button type="button" class="btn_back"></button>
			</div>
			<div class="header__title">이벤트</div>
		</header>
		<main class="main">
			<div id="container" class="event_container">
				<div class="event__inner">
					<div class="event_first">
						<div class="event_first__inner">
							<!-- <div class="title">
							  <p>*오직 온라인 신라면세 고객만*</p>
							  <h1>커넥트 가입하고<br> <b>최대 50만원</b> 받기!</h1>
							</div> -->
							<div class="join_btn">
								<?php if(isset($_SESSION[$_SESSION_DEFAULT_PREFIX . "id"])){ ?>
									<a href="../promotion/list.php" class="btn_join">커넥트 컨시어지 가입하고 혜택받기</a>
								<?php }else{ ?>
									<a href="../join/join_1.php" class="btn_join">커넥트 컨시어지 가입하고 혜택받기</a>
								<?php } ?>
							</div>
						</div>
					</div>
					<div class="event_etc">
						<div class="join_benefits">
							<h3>- 가입혜택 -</h3>
							<div class="benefits_list">
								<div class="benefit">
									<div class="right_img">
										<img src="../_img/event_item01.png" alt="이벤트 이미지">
									</div>
								</div>
								<div class="benefit">
									<div class="right_img">
										<img src="../_img/event_item03.png" alt="이벤트 이미지">
									</div>
								</div>
							</div>
						</div>
						<div class="join_btn">
							<?php if(isset($_SESSION[$_SESSION_DEFAULT_PREFIX . "id"])){ ?>
								<a href="../promotion/list.php" class="btn_join">커넥트 컨시어지 가입하고 혜택받기</a>
							<?php }else{ ?>
								<a href="../join/join_1.php" class="btn_join">커넥트 컨시어지 가입하고 혜택받기</a>
							<?php } ?>
						</div>
						<div class="event_info">
							<div class="event_info-item">
								<h3>- 당첨확인 -</h3>
								<ul>
									<li>레모나 선스틱의 경우, <b>위챗으로 개별 연락</b> 예정입니다.</li>
									<li>메디컬 바우처의 경우, 당첨자에 한해 본 사이트 내 <b>‘마이페이지> 메디컬 서비스 예약 내역’</b> 에서 확인 가능합니다.</li>
									<li><b>출국확인 된 분에 한해 전달</b>되오니 가입 시, 여권정보를 정확히 입력해주세요.</li>
								</ul>
							</div>
							<div class="event_info-item">
								<h3>- 유의사항 -</h3>
								<ul>
									<li>해당 이벤트는 신라면세점 제휴 이벤트 입니다.</li>
									<li>이 이벤트는 이벤트 시작일로부터 커넥트 컨시어지에 가입된 고객에 한해 제공됩니다.</li>
									<li>레모나 썬스틱 증정은 신라면세점 내 커넥트 컨시어지 리셉션에서 제공합니다.</li>
									<li>메디컬 바우처는 1회 제공되며, 제휴된 병원 프로모션 시술을 예약할 수 있습니다.</li>
									<li>사용자의 귀책(회원 탈퇴 등)으로 혜택을 받지 못할 경우 재발급이 불가능 합니다.</li>
									<li>명의도용, 중복 가입 등으로 이벤트 참여한 것이 확인되면 혜택은 지급되지 않습니다.</li>
									<li>이 이벤트는 자사의 사정에 따라 사전 고지 없이 내용 변경 및 조기 종료될 수 있습니다.</li>
									<li>기타 문의 사항은 konnect-cs@konnect.finance로 문의해주세요.</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
		<?php include("../_inc/menu.php"); ?>
	</div>
</body>
</html>