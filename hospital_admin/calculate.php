<?php include("../_inc/admin_head.php"); ?>

<?php

if(!isset($_SESSION[$_SESSION_HOSPITAL_PREFIX . "code"])){
	no_error_go("./login.php");
	exit;
}


$pageNo = trim(sqlfilter($_REQUEST['pageNo']));
$pageScale = trim(sqlfilter($_REQUEST['pageScale']));
if(!$pageNo){
	$pageNo = 1;
}

if(!$pageScale){
	$pageScale = 10;
}

$total_param = "pageScale=$pageScale";

$StarRowNum = (($pageNo-1) * $pageScale);
$EndRowNum = $pageScale;

$hospital_code = $_SESSION[$_SESSION_HOSPITAL_PREFIX . "code"];

$query = "
SELECT 
    rs.wdate, mi.phone_num, mi.member_code, mi.passport_num, mi.user_name,
    pi.procedure, rs.surgery_addons, rs.point, rs.paid, rs.memo, rs.reserve_id
FROM reservation_info rs
INNER JOIN member_info mi ON rs.member_idx = mi.idx
INNER JOIN promotion_info pi ON rs.promotion_idx = pi.idx
WHERE rs.hospital_code = '$hospital_code'
ORDER BY rs.idx DESC
LIMIT $StarRowNum,$EndRowNum
";
$result = mysqli_query($gconnet, $query);

$query_cnt = "
SELECT rs.idx
FROM reservation_info rs
INNER JOIN member_info mi ON rs.member_idx = mi.idx
INNER JOIN promotion_info pi ON rs.promotion_idx = pi.idx
WHERE rs.hospital_code = '$hospital_code'
";
$result_cnt = mysqli_query($gconnet, $query_cnt);
$num = $result_cnt->num_rows;

$iTotalSubCnt = $num;
$totalpage	= ($iTotalSubCnt - 1)/$pageScale  + 1;

?>

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
								<li><a href="./add_surgery.php">시술내역추가</a></li>
								<li class="active"><a href="./calculate.php">병원정산내역</a></li>
							</ul>
						</nav>
					</div>
					<button type="button" class="btn_logout" onclick="location.href = './logout.php'">로그아웃</button>
				</div>
			</header>
			<main class="ad-main">
				<div class="calculate__inner">
					<div class="table_wrap">
						<table class="primary_table">
							<colgroup>
								<col style="width: 100px">
								<col style="width: 150px">
								<col style="width: 150px">
								<col style="width: 150px">
								<col style="width: 150px">
								<col style="width: 150px">
								<col style="width: 150px">
								<col style="width: 210px">
								<col style="width: 390px">
								<col style="width: 150px">
								<col style="width: 150px">
								<col style="width: 150px">
								<col style="width: 150px">
							</colgroup>
							<thead>
							<tr>
								<th>NO</th>
								<th>데이터 입력일시</th>
								<th>시술 일자</th>
								<th>회원코드</th>
								<th>연락처</th>
								<th>여권번호</th>
								<th>이름</th>
								<th>프로모션명</th>
								<th>추가시술명</th>
								<th>시술금액</th>
								<th>실 결제 금액</th>
								<th>사용한 D포인트</th>
								<th>메모</th>
							</tr>
							</thead>
							<tbody>
							<?php if($num == 0){ ?>
								<tr>
									<td colspan="12" height="40">데이터가 없습니다.</strong></td>
								</tr>
							<?php } ?>

							<?php
							for($i = 0, $iMax = $result->num_rows; $i < $iMax; $i ++){
								$row = $result->fetch_array();
								$listnum	= $iTotalSubCnt - (( $pageNo - 1 ) * $pageScale ) - $i;
								$reserve = get_reservation($row['reserve_id']);
								?>
								<tr>
									<td><?=$listnum?></td>
									<td><?=date('Y.m.d', strtotime($row['wdate']))?></td>
									<td><?=$reserve['appointmentAt'] ? substr($reserve['appointmentAt'], 0, 10) : "확인 대기중"?></td>
									<td><?=$row['member_code']?></td>
									<td><?=$row['phone_num']?></td>
									<td><?=$row['passport_num']?></td>
									<td><?=$row['user_name']?></td>
									<td><?=$row['procedure']?></td>
									<td><?=$row['surgery_addons']?></td>
									<td><?=number_format($row['point'] + $row['paid'])?></td>
									<td><?=number_format($row['paid'])?></td>
									<td><?=number_format($row['point'])?></td>
									<td><?=$row['memo']?></td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
						<div class="pagination">
							<?php include $_SERVER["DOCUMENT_ROOT"] . '/hospital_admin/inc/paging.php'; ?>
						</div>
					</div>
				</div>
			</main>
		</div>
	</div>
	<script>
        $(function () {
            $('html').css('overflow', 'hidden')
            $('html').css('overflow-y', 'auto')
        })
	</script>
</body>
</html>