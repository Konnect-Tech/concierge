<?php

include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드
include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더
include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login.php"; // 관리자 로그인여부 확인

$pageNo = trim(sqlfilter($_REQUEST['pageNo']));
$pageScale = trim(sqlfilter($_REQUEST['pageScale']));
$keyword = trim(sqlfilter($_REQUEST['keyword']));
$keyword_type = trim(sqlfilter($_REQUEST['keyword_type']));
$idx = trim(sqlfilter($_REQUEST['idx']));
if(!$idx){
	error_back("접근 불가능한 페이지입니다.");
	exit;
}

$total_param = "bmenu=$bmenu&smenu=$smenu&pageScale=$pageScale&keyword=$keyword&keyword_type=$keyword_type";

$query = "
SELECT *
FROM member_info
WHERE `idx` = '$idx'
";
$result = mysqli_query($gconnet, $query);
$row = $result->fetch_array();

//$board_width = 800;
//$board_height = 800;

$hospitals = get_hospitals('id', 'name', static function(array $data): array{ return ["id" => $data['_doc']["_id"], "name" => $data['_doc']['name']]; });

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>

<style>
	.btn_search{
        width: 132px;
        height: 35px;
        margin-left: 2px;
        border: 0;
        color: #fff;
        background-color: #444;
        font-size: 15px;
	}

	.btn_wrap_select{
        display: inline-block;
        vertical-align: middle;
        padding: 0 15px 0 5px;
        border: 1px solid #b7b7b7;
        box-sizing: border-box;
        height: 36px;
        border-radius: 3px;
        box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.15);
	}
</style>
<script>
    function go_list(){
        location.href = "./member_list.php?<?=$total_param?>"
    }

    function go_currency_submit(frm, type){
        frm.insert_type.value = type
		frm.submit()
	}

    function fn_c_g(f){
        if(confirm("구매내역을 추가하시겠습니까?")){
            f.submit()
		}
	}
</script>
<body>
	<div id="wrap" class="skin_type01">
		<?php include $_SERVER["DOCUMENT_ROOT"] . "/master/include/admin_top.php"; // 상단메뉴?>
		<div class="sub_wrap">
			<?php include $_SERVER["DOCUMENT_ROOT"] . "/master/include/member_left.php"; // 좌측메뉴?>
			<!-- content 시작 -->
			<div class="container clearfix">
				<div class="content">
					<div class="navi">
						<ul class="clearfix">
							<li>HOME</li>
							<li>회원 관리</li>
						</ul>
					</div>
					<div class="list_tit">
						<h3>회원 상세</h3>
					</div>

					<div class="write">
						<p class="tit">개인정보</p>
						<table>
							<colgroup>
								<col style="width:15%">
								<col style="width:35%">
								<col style="width:15%">
								<col style="width:35%">
							</colgroup>

							<tr>
								<th scope="row">이름</th>
								<td colspan="3"><?=$row['user_name']?></td>
							</tr>

							<tr>
								<th scope="row">이메일</th>
								<td colspan="3"><?=$row['user_id']?></td>
							</tr>

							<tr>
								<th scope="row">회원코드</th>
								<td colspan="3"><?=$row['member_code']?></td>
							</tr>

							<tr>
								<th scope="row">생년월일</th>
								<td colspan="3"><?=$row['birthday']?></td>
							</tr>

							<tr>
								<th scope="row">성별</th>
								<td colspan="3"><?=$row['gender'] == 0 ? "남성" : "여성"?></td>
							</tr>

							<tr>
								<th scope="row">연락처</th>
								<td colspan="3"><?=$row['phone_code']?>&nbsp;<?=$row['phone_num']?></td>
							</tr>

							<tr>
								<th scope="row">WeChat ID</th>
								<td colspan="3"><?=$row['wechat_id']?></td>
							</tr>

							<tr>
								<th scope="row">신라 면세점 ID</th>
								<td colspan="3"><?=$row['shilla_id']?></td>
							</tr>

							<tr>
								<th scope="row">개인정보 유효기간</th>
								<td colspan="3"><?=$row['data_type'] == 0 ? "회원 탈퇴시까지" : "1년"?></td>
							</tr>
						</table>

						<p class="tit">여권정보</p>
						<table>
							<colgroup>
								<col style="width:15%">
								<col style="width:35%">
								<col style="width:15%">
								<col style="width:35%">
							</colgroup>

							<tr>
								<th scope="row">여권 영문명</th>
								<td colspan="3"><?=strtoupper($row['passport_last_name'])?>&nbsp;<?=strtoupper($row['passport_first_name'])?></td>
							</tr>

							<tr>
								<th scope="row">여권번호</th>
								<td colspan="3"><?=$row['passport_num']?></td>
							</tr>

							<tr>
								<th scope="row">여권 만료일</th>
								<td colspan="3"><?=date("Y-m-d", strtotime($row['passport_expire_date']))?></td>
							</tr>
						</table>

						<?php
						$reservations = get_reservations($row['user_id']);
						if(count($reservations) > 0){
							$reserve = $reservations[0];
							?>
							<p class="tit">예약정보</p>

							<table>
								<colgroup>
									<col style="width:15%">
									<col style="width:35%">
									<col style="width:15%">
									<col style="width:35%">
								</colgroup>

								<tr>
									<th scope="row">병원명</th>
									<td colspan="3"><?=$reserve['hospital']['name']?></td>
								</tr>

								<tr>
									<th scope="row">시술명</th>
									<td colspan="3">
										<?php
										$promotion_query = " SELECT `procedure` FROM promotion_info WHERE `hospital_code` = '" . $reserve['hospital']['code'] . "' ";
										$promotion_result = mysqli_query($gconnet, $promotion_query);
										if($promotion_result->num_rows){
											echo $promotion_result->fetch_array()['procedure'];
										}else{
											echo '삭제된 프로모션';
										}
										?>
									</td>
								</tr>

								<tr>
									<th scope="row">예약일시</th>
									<td colspan="3"><?=$reserve['appointmentAt'] ?? '예약 대기중'?></td>
								</tr>

								<tr>
									<th scope="row">예약번호</th>
									<td colspan="3"><a href="https://medical.konnect-promo.com/reservations"><?=$reserve['uuid']?></a></td>
								</tr>
							</table>
						<?php } ?>

						<p class="tit">포인트정보</p>
						<?php
						$point_query = "
						SELECT
							COALESCE(SUM(CASE WHEN c.currency = 'D' THEN c.amount ELSE 0 END), 0) AS D_total,
							COALESCE(SUM(CASE WHEN c.currency = 'M' THEN c.amount ELSE 0 END), 0) AS M_total
						FROM member_info AS m
						LEFT JOIN currency_info AS c ON m.idx = c.member_idx
						WHERE m.idx = '$idx'
						GROUP BY m.idx
						";
						$point_result = mysqli_query($gconnet, $point_query);
						$point_row = $point_result->fetch_array();
						?>
						<table>
							<colgroup>
								<col style="width:15%">
								<col style="width:35%">
								<col style="width:15%">
								<col style="width:35%">
							</colgroup>

							<tr>
								<th scope="row">M포인트 잔여</th>
								<td colspan="3"><?=number_format($point_row['M_total'])?> point</td>
							</tr>

							<tr>
								<th scope="row">D포인트 잔여</th>
								<td colspan="3"><?=number_format($point_row['D_total'])?> point</td>
							</tr>

							<tr>
								<th scope="row">누적 구매 금액</th>
								<td colspan="3">
									<table style="margin-bottom: 0px !important;">
										<colgroup>
											<col style="width:15%">
											<col style="width:35%">
											<col style="width:15%">
											<col style="width:35%">
										</colgroup>

										<?php

										$history_total_query = "
										SELECT 
											COALESCE(SUM(CASE WHEN c.currency = '원' THEN c.amount ELSE 0 END), 0) AS total
										FROM member_info AS m
										LEFT JOIN currency_info AS c ON m.idx = c.member_idx
										WHERE m.idx = '$idx'
										GROUP BY m.idx
										";
										$history_total_result = mysqli_query($gconnet, $history_total_query);
										$history_total_row = $history_total_result->fetch_array();

										?>

										<tr>
											<th scope="row">전체</th>
											<td colspan="3"><?=number_format($history_total_row['total'])?>원</td>
										</tr>

										<?php

										$history_query = "
										SELECT bh.*, ci.amount
										FROM buy_history_info bh
										JOIN currency_info ci ON bh.currency_idx = ci.idx
										WHERE ci.member_idx = '$idx';
										";
										$history_result = mysqli_query($gconnet, $history_query);
										for($i = 0, $iMax = $history_result->num_rows; $i < $iMax; $i ++){
											$history_row = $history_result->fetch_array();
											?>
											<tr>
												<th scope="row"><?=$history_row['subject']?><br>(<?=$history_row['gubun']?>)</th>
												<td colspan="3"><?=number_format($history_row['amount'])?>원</td>
											</tr>
										<?php } ?>
									</table>
								</td>
							</tr>
						</table>

						<?php foreach(["M", "D"] as $currency){ ?>
							<p class="tit mt20">
								<?=$currency?> 포인트
								<a href="javascript:go_currency_submit(<?=strtolower($currency)?>_frm, '+')" class="btn_green">지급</a>
								<a href="javascript:go_currency_submit(<?=strtolower($currency)?>_frm, '-')" class="btn_blue">차감</a>
							</p>
							<form name="<?=strtolower($currency)?>_frm" method="post" action="./member_currency_write_action.php" target="_fra_admin">
								<input type="hidden" name="member_idx" value="<?=$idx?>">
								<input type="hidden" name="currency_type" value="<?=$currency?>">
								<input type="hidden" name="insert_type">
								<table>
									<colgroup>
										<col style="width:15%">
										<col style="width:35%">
										<col style="width:15%">
										<col style="width:35%">
									</colgroup>

									<tr>
										<th scope="row">적립처명 입력</th>
										<td><input type="text" name="source" style="width: 100%"></td>
										<th scope="row">포인트</th>
										<td><input type="text" name="amount" style="width: 100%" oninput="autoComma(this)"></td>
									</tr>
								</table>
							</form>
						<?php } ?>

						<form name="voucher_give_frm" action="./voucher_give_action.php" target="_fra_admin" method="post">
							<input type="hidden" name="member_idx" value="<?=$idx?>">
						</form>

						<form name="voucher_take_frm" action="./voucher_take_action.php" target="_fra_admin" method="post">
							<input type="hidden" name="member_idx" value="<?=$idx?>">
						</form>

						<p class="tit mt20">바우처 <a href="javascript:voucher_give_frm.submit();" class="btn_green">지급</a> <a href="javascript:voucher_take_frm.submit();" class="btn_blue">차감</a> </p>
						<table>
							<colgroup>
								<col style="width:15%">
								<col style="width:35%">
								<col style="width:15%">
								<col style="width:35%">
							</colgroup>

							<tr>
								<th scope="row">발급여부</th>
								<td colspan="3">
									<input type="text" style="width: 100%" disabled value="<?=$row['voucher_state'] == 1 ? date('Y-m-d 발급됨', strtotime($row['voucher_date'])) : '미발급'?>">
								</td>
							</tr>
						</table>

						<p class="tit mt20">구매내역&nbsp; <!-- <a href="javascript:;" class="btn_gray">면세점</a>&nbsp;<a href="javascript:;" class="btn_gray">메디컬</a> --></p>

						<table>
							<colgroup>
								<col style="width:15%">
								<col style="width:35%">
								<col style="width:15%">
								<col style="width:35%">
							</colgroup>

							<form name="buy_history_1_frm" method="post" action="./member_buy_history_write_action.php" target="_fra_admin">
								<input type="hidden" name="member_idx" value="<?=$idx?>">
								<input type="hidden" name="type" value="0">
								<tr>
									<th scope="row">면세점</th>
									<td>
										<input type="text" name="source" placeholder="면세점명 입력" style="width: 50%">
										<select class="btn_wrap_select" name="gubun">
											<option value="온라인">온라인</option>
											<option value="오프라인">오프라인</option>
										</select>
									</td>
									<th scope="row">금액</th>
									<td>
										<input type="text" name="amount" style="width: 50%" oninput="autoComma(this)">
										<a href="javascript:fn_c_g(buy_history_1_frm);" class="btn_green">등록</a>
									</td>
								</tr>
							</form>

							<form name="buy_history_2_frm" method="post" action="./member_buy_history_write_action.php" target="_fra_admin">
								<input type="hidden" name="member_idx" value="<?=$idx?>">
								<input type="hidden" name="type" value="1">

								<tr>
									<th scope="row">메디컬</th>
									<td>
										<input type="text" name="source" placeholder="추가시술명 입력" style="width: 30%">
										<select class="btn_wrap_select" name="gubun">
											<option value="">병원 선택</option>
											<?php foreach($hospitals as $id => $name){ ?>
												<option value="<?=$name?>"><?=$name?></option>
											<?php } ?>
										</select>
										<input type="text" class="datetimepicker" name="date" placeholder="시술 일시 입력" readonly>
									</td>
									<th scope="row">금액</th>
									<td>
										<input type="text" name="amount" style="width: 50%" oninput="autoComma(this)">
										<a href="javascript:fn_c_g(buy_history_2_frm);" class="btn_green">등록</a>
									</td>
								</tr>
							</form>
						</table>

					</div>
				</div>
			</div>

			<?php include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_bottom_admin_tail.php"; ?>

			<script>
                const autoComma = (target) => {
                    target.value = target.value
                        .replace(/[^0-9]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }
			</script>
</body>
</html>
