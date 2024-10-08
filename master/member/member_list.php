<?php

include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드
include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더
include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login.php"; // 관리자 로그인여부 확인

$pageNo = trim(sqlfilter($_REQUEST['pageNo']));
$pageScale = trim(sqlfilter($_REQUEST['pageScale']));
$keyword = trim(sqlfilter($_REQUEST['keyword']));
$keyword_type = trim(sqlfilter($_REQUEST['keyword_type']));
if(!$pageNo){
	$pageNo = 1;
}

if(!$pageScale){
	$pageScale = 10;
}

$total_param = "bmenu=$bmenu&smenu=$smenu&pageScale=$pageScale&keyword=$keyword&keyword_type=$keyword_type";

$StarRowNum = (($pageNo-1) * $pageScale);
$EndRowNum = $pageScale;

$where = " member.member_type = 'GEN' ";
if($keyword){
	if($keyword_type){
		switch($keyword_type){
			case "member_name": $where .= " AND member.user_name LIKE '%$keyword%' "; break;
			case "member_code": $where .= " AND member.member_code LIKE '%$keyword%' "; break;
			case "member_phone": $where .= " AND member.phone_num LIKE '%$keyword%' "; break;
		}
	}else{
		$where .= "
            AND ( member.user_name LIKE '%$keyword%' OR member.member_code LIKE '%$keyword%' OR member.phone_num LIKE '%$keyword%' )
        ";
	}
}

$query = "
SELECT 
    member.*,
    COALESCE(SUM(CASE WHEN c.currency = 'D' THEN c.amount ELSE 0 END), 0) AS D_total,
    COALESCE(SUM(CASE WHEN c.currency = 'M' THEN c.amount ELSE 0 END), 0) AS M_total,
    COALESCE(SUM(CASE WHEN c.currency = '원' THEN c.amount ELSE 0 END), 0) AS total
FROM member_info member
LEFT JOIN currency_info AS c ON member.idx = c.member_idx
WHERE $where
GROUP BY member.idx
ORDER BY member.wdate DESC
LIMIT $StarRowNum,$EndRowNum
";
$result = mysqli_query($gconnet, $query);

$query_cnt = "
SELECT member.*
FROM member_info member
LEFT JOIN currency_info AS c ON member.idx = c.member_idx
WHERE $where
GROUP BY member.idx
";
$result_cnt = mysqli_query($gconnet, $query_cnt);
$num = $result_cnt->num_rows;

$iTotalSubCnt = $num;
$totalpage	= ($iTotalSubCnt - 1)/$pageScale  + 1;

//$board_width = 800;
//$board_height = 800;

?>
<script>
    function syncChangePageScale(value){
        const url = new URL(location.href);
        url.searchParams.set('pageScale', value)
        location.href = url.href;
    }

    function go_view(idx){
        location.href = "./member_view.php?<?=$total_param?>&idx=" + idx;
	}
</script>
<body>

	<div id="wrap" class="skin_type01">
		<?php include $_SERVER["DOCUMENT_ROOT"]."/master/include/admin_top.php"; // 상단메뉴?>
		<div class="sub_wrap">
			<?php include $_SERVER["DOCUMENT_ROOT"]."/master/include/member_left.php"; // 좌측메뉴?>
			<!-- content 시작 -->
			<div class="container clearfix">
				<div class="content">
					<!-- 네비게이션 시작 -->
					<a href="javascript:location.reload();" class="btn_refresh">새로고침</a>
					<div class="navi">
						<ul class="clearfix">
							<li>HOME</li>
							<li>회원 관리</li>
						</ul>
					</div>
					<div class="list_tit">
						<h3>회원 목록</h3>
					</div>
					<!-- 네비게이션 종료 -->
					<div class="list">
						<!-- 검색창 시작 -->
						<table class="search">
							<caption>검색</caption>
							<colgroup>
								<col style="width:14%;">
								<col style="width:20%;">
								<col style="width:13%;">
								<col style="width:20%;">
								<col style="width:13%;">
								<col style="width:20%;">
							</colgroup>

							<form name="search_frm" method="post" action="<?=basename($_SERVER['PHP_SELF'])?>">
								<input type="hidden" name="bmenu" value="<?=$bmenu?>">
								<input type="hidden" name="smenu" value="<?=$smenu?>">
								<input type="hidden" name="pageScale" value="<?=$pageScale?>">
								<tr>
									<th scope="row">검색어</th>
									<td colspan="2">
										<select name="keyword_type">
											<option value="" selected>전체 검색</option>
											<option value="member_name" <?php if($keyword_type === 'member_name'){ echo 'selected'; } ?> >회원명</option>
											<option value="member_code" <?php if($keyword_type === 'member_code'){ echo 'selected'; } ?> >회원코드</option>
											<option value="member_phone" <?php if($keyword_type === 'member_phone'){ echo 'selected'; } ?> >전화번호</option>
										</select>
									</td>
									<th scope="row">키워드</th>
									<td colspan="2">
										<input type="text" name="keyword" style="width:80%;" value="<?=$keyword?>">
										<a href="javascript:search_frm.submit();" class="btn_green">검색</a>
									</td>
								</tr>
							</form>
						</table>

						<ul class="list_tab" style="height:20px;"></ul>

						<div class="search_wrap">
							<div class="result">
								<p class="txt">회원 목록 (<span><?=$num?></span>건)</p>
								<div class="btn_wrap">
									<select name="pageScale" onchange="syncChangePageScale(this.value)">
										<option value="10" <?php if($pageScale == 10){ echo 'selected'; } ?>>10개씩 보기</option>
										<option value="30" <?php if($pageScale == 30){ echo 'selected'; } ?>>30개씩 보기</option>
										<option value="50" <?php if($pageScale == 50){ echo 'selected'; } ?>>50개씩 보기</option>
										<option value="100" <?php if($pageScale == 100){ echo 'selected'; } ?>>100개씩 보기</option>
									</select>
								</div>
							</div>

							<div style="height: 20px"></div>

							<table class="search_list">
								<caption>검색결과</caption>
								<colgroup>
								</colgroup>
								<thead>
								<tr>
									<th scope="col">가입 일자</th>
									<th scope="col">회원코드</th>
									<th scope="col">연락처</th>
									<th scope="col">여권번호</th>
									<th scope="col">상태</th>
									<th scope="col">이름</th>
									<th scope="col">생년월일</th>
									<th scope="col">성별</th>
									<th scope="col">잔여 D 포인트</th>
									<th scope="col">잔여 M 포인트</th>
									<th scope="col">총 누적금액</th>
									<th scope="col">바우처 상태</th>
									<th scope="col">예약 번호</th>
								</tr>
								</thead>
								<tbody>
								<?php if($num === 0){ ?>
									<tr>
										<td colspan="10" height="40">등록된 데이터가 없습니다.</strong></td>
									</tr>
								<?php } ?>

								<?php
								for($i = 0, $iMax = mysqli_num_rows($result); $i < $iMax; $i ++){
									$row = mysqli_fetch_array($result);

									$reservations = get_reservations($row['user_id']);
									?>
									<tr>
										<td onclick="go_view('<?=$row['idx']?>')" style="cursor: pointer"><?=$row['wdate']?></td>
										<td onclick="go_view('<?=$row['idx']?>')" style="cursor: pointer"><?=$row['member_code']?></td>
										<td onclick="go_view('<?=$row['idx']?>')" style="cursor: pointer">(<?=$row['phone_code']?>) <?=$row['phone_num']?></td>
										<td onclick="go_view('<?=$row['idx']?>')" style="cursor: pointer"><?=$row['passport_num']?></td>
										<td><?=$row['is_del'] == 1 ? "탈퇴" : "회원"?></td>
										<td onclick="go_view('<?=$row['idx']?>')" style="cursor: pointer"><?=$row['user_name']?></td>
										<td onclick="go_view('<?=$row['idx']?>')" style="cursor: pointer"><?=$row['birthday']?></td>
										<td onclick="go_view('<?=$row['idx']?>')" style="cursor: pointer"><?=["남", "여"][$row['gender']]?></td>
										<td onclick="go_view('<?=$row['idx']?>')" style="cursor: pointer"><?=number_format($row['D_total'])?></td>
										<td onclick="go_view('<?=$row['idx']?>')" style="cursor: pointer"><?=number_format($row['M_total'])?></td>
										<td onclick="go_view('<?=$row['idx']?>')" style="cursor: pointer"><?=number_format($row['total'])?></td>
										<td onclick="go_view('<?=$row['idx']?>')" style="cursor: pointer"><?=$row['voucher_state'] == 0 ? "미발행" : "발행"?></td>
										<td onclick="location.href = 'https://medical.konnect-promo.com/reservations/list'" style="cursor: pointer">
											<?php
											if(count($reservations) > 0){
												echo $reservations[0]['uuid'];
											}else{
												echo '예약 없음';
											}
											?>
										</td>
									</tr>
								<?php } ?>
								</tbody>
							</table>

							<div class="pagination mt0">
								<?php include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/paging.php";?>
							</div>

						</div>
					</div>
				</div>
			</div>
			<!-- content 종료 -->
		</div>
	</div>
	<?php include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_bottom_admin_tail.php"; ?>
</body>
</html>