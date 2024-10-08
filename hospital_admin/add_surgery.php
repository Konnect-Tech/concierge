<?php include("../_inc/admin_head.php"); ?>
<body>
	<div id="ad-wrap">
		<div class="ad-container">
			<header class="ad-header">
				<div class="ad-header__inner">
					<div class="logo_area">
						<div class="logo">
							<h1>Konnect Concierge</h1>
						</div>
						<nav class="ad-gnb">
							<ul>
								<li class="active"><a href="./add_surgery.php">시술내역추가</a></li>
								<li><a href="./calculate.php">병원정산내역</a></li>
							</ul>
						</nav>
					</div>
					<button type="button" class="btn_logout" onclick="location.href = './logout.php'">로그아웃</button>
				</div>
			</header>
			<main class="ad-main">
				<aside class="ad-aside">
					<div class="aside_content">
						<h3>예약자 조회</h3>
						<div class="member_code">
							<span>회원CODE</span>
							<form action="./search_member_by_code_action.php" method="post" name="search_frm" target="_fra_admin" class="form_search-member">
								<fieldset>
									<div class="input_search">
										<input type="text" name="member_code" placeholder="회원코드를 입력해주세요">
										<button type="button" class="btn_search" onclick="search_frm.submit()">검색</button>
									</div>
								</fieldset>
							</form>
						</div>
					</div>
					<div class="aside_content"></div>
				</aside>
				<div class="ad-content">
					<div class="surgery__inner">
						<form action="./surgery_write_action.php" method="post" name="frm" target="_fra_admin" class="form_register">
							<input type="hidden" name="member_idx">
							<input type="hidden" name="reservation_idx">
							<input type="hidden" name="hospital_id">
							<input type="hidden" name="hospital_code">
							<input type="hidden" name="reservation_uuid">
							<input type="hidden" name="promotion_idx">
							<input type="hidden" name="have_point">
							<fieldset>
								<div class="input_surgery">
									<span>추가시술명</span>
									<textarea placeholder="시술명을 모두 입력해주세요" name="surgery_addons"></textarea>
								</div>
								<div class="input_surgery">
									<span>사용한 포인트</span>
									<div class="input_number">
										<input type="text" name="point" placeholder="사용한 포인트를 입력해주세요" oninput="autoComma(this)">
										<span>Point</span>
									</div>
								</div>
								<div class="input_surgery">
									<span>실 결제금액</span>
									<div class="input_number">
										<input type="text" name="paid" placeholder="포인트를 제외한 실제 결제금액을 입력해주세요" oninput="autoComma(this)">
										<span>원</span>
									</div>
								</div>
								<div class="input_surgery">
									<span>메모</span>
									<input type="text" name="memo" placeholder="메모를 입력해주세요">
								</div>
								<div class="upload_btn">
									<!-- 유휴성 검사 후 disabled 제거 -->
									<button type="button" class="btn_upload" onclick="openModal('modal-upload')">업로드</button>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</main>
		</div>
		<div id="modal-upload" class="modal modal_upload">
			<div class="modal__inner">
				<div class="modal__contents">
					<p>추가 시술 내역을<br> 업로드 하시겠습니까?</p>
				</div>
				<div class="modal__btns">
					<button type="button" onclick="closeModal('modal-upload')">아니오</button>
					<button type="button" onclick="push()">네</button>
				</div>
			</div>
		</div>
	</div>

	<script>
		// 세자리 콤마
        const autoComma = (target) => {
			target.value = target.value
				.replace(/[^0-9]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        function openModal(id) {
            if(id === 'modal-upload'){
                if(frm.member_idx.value.trim().length === 0){
                    alert('회원조회를 완료해주세요')
					return
				}
			}
            $('#' + id).show()
            $('html').css('overflow-y', 'hidden')
        }

        function closeModal(id) {
            $('#' + id).hide()
            $("html").css("overflow-y", "scroll");
        }

        $(function () {

        })

		function push(){
            frm.submit()
            closeModal('modal-upload')
		}

		const reserve_box = document.querySelectorAll('.aside_content')[1];

        function not_reserved(){
            reserve_box.innerHTML = `
            	<h3>예약정보</h3>
				<div class="reserv_info">
					<p class="nodata">예약된 정보가 없습니다.</p>
				</div>
            `
			reset();
		}

        function reset(){
            frm.member_idx.value = '';
            frm.reservation_idx.value = '';
            frm.hospital_id.value = '';
            frm.hospital_code.value = '';
            frm.reservation_uuid.value = '';
            frm.promotion_idx.value = '';
		}

        function reserve_data_parsing(
            member_idx,
            reservation_idx,
            hospital_id,
            hospital_code,
            member_code,
			phone_num,
			passport_num,
			user_name,
			birthday,
			gender_format,
			have_d_point,
			hospital,
            procedure,
			reserve_date,
            reservation_uuid,
            promotion_idx
		){
            frm.member_idx.value = member_idx;
            frm.reservation_idx.value = reservation_idx;
            frm.hospital_id.value = hospital_id;
            frm.hospital_code.value = hospital_code;
            frm.reservation_uuid.value = reservation_uuid;
            frm.promotion_idx.value = promotion_idx;
            frm.have_point.value = have_d_point;

            reserve_box.innerHTML = `
            	<h3>예약정보</h3>
				<div class="reserv_info">
					<div class="reserv_box">
						<h4>개인정보</h4>
						<ul>
							<li><span>회원코드</span> <b>${member_code}</b></li>
							<li><span>연락처</span> <b>${phone_num}</b></li>
							<li><span>여권번호</span> <b>${passport_num}</b></li>
							<li><span>성/이름</span> <b>${user_name}</b></li>
							<li><span>생년월일</span> <b>${birthday}</b></li>
							<li><span>성별</span> <b>${gender_format}</b></li>
							<li><span>보유 D포인트</span> <b>${have_d_point.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")}P</b></li>
						</ul>
					</div>

					<div class="reserv_box">
						<h4>예약 정보</h4>
						<ul>
							<li><span>병원명</span> <b>${hospital}</b></li>
							<li><span>시술명</span> <b>${procedure}</b></li>
							<li><span>예약일시</span> <b>${reserve_date}</b></li>
						</ul>
					</div>
				</div>
            `
		}
	</script>
</body>
<?php include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_bottom_admin_tail.php"; ?>
</html>