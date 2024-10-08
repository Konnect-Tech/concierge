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

$where = " 1 = 1 ";
if($keyword){
	if($keyword_type){
		switch($keyword_type){
			case "hospital": $where .= " AND `hospital` LIKE '%$keyword%' "; break;
			case "procedure": $where .= " AND `procedure` LIKE '%$keyword%' "; break;
		}
	}else{
		$where .= " AND (`hospital` LIKE '%$keyword%' OR `procedure` LIKE '%$keyword%') ";
	}
}

$query = " SELECT * FROM promotion_info WHERE $where ORDER BY `idx` DESC LIMIT $StarRowNum,$EndRowNum ";
$result = mysqli_query($gconnet, $query);

$query_cnt = " SELECT idx FROM promotion_info WHERE $where ";
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

    let check = 0;
    function syncCheckboxSelectAll(){
        const idxDOC = document.getElementsByName("idx[]");
        let booleanCheck;

        check = check ? 0 : 1;
        booleanCheck = check;
        for (let i = 0; i < idxDOC.length; i ++) {
            idxDOC[i].checked = booleanCheck;
        }
    }

    function getSelectedCheckboxIds(){
        let checkIdsMap = {}
        const chk = document.getElementsByName("idx[]");
        for (let i = 0; i < chk.length; i++) {
            if(chk[i].checked){
                checkIdsMap[i] = chk[i].value
            }
        }
        return checkIdsMap;
    }

    function go_remove(){
        const links = getSelectedCheckboxIds();
        if(Object.keys(links).length === 0){
            alert("삭제할 프로모션 데이터를 선택해주세요.")
            return
        }

        if(confirm("삭제하시겠습니까?")) {

            let idx = '';
            Object.keys(links).forEach((value) => {
                idx += `${links[value]},`
            })

            remove_frm.idx.value = idx;
            remove_frm.submit()
        }
    }

    function go_write(){
        location.href = "./promotion_write.php?<?=$total_param?>"
    }

    function go_modify(idx){
        location.href = "./promotion_modify.php?<?=$total_param?>&idx=" + idx;
    }
</script>
<body>
	<form action="./promotion_remove_action.php" target="_fra_admin" name="remove_frm" method="post">
		<input type="hidden" name="total_param" value="<?=$total_param?>">
		<input type="hidden" name="idx">
	</form>

	<div id="wrap" class="skin_type01">
		<?php include $_SERVER["DOCUMENT_ROOT"]."/master/include/admin_top.php"; // 상단메뉴?>
		<div class="sub_wrap">
			<?php include $_SERVER["DOCUMENT_ROOT"]."/master/include/promotion_left.php"; // 좌측메뉴?>
			<!-- content 시작 -->
			<div class="container clearfix">
				<div class="content">
					<!-- 네비게이션 시작 -->
					<a href="javascript:location.reload();" class="btn_refresh">새로고침</a>
					<div class="navi">
						<ul class="clearfix">
							<li>HOME</li>
							<li>프로모션 관리</li>
						</ul>
					</div>
					<div class="list_tit">
						<h3>프로모션 목록</h3>
						<button class="btn_add" onclick="go_write()" style="width:15%;"><span>프로모션 등록하기</span></button>
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
											<option value="" selected>전체</option>
											<option value="hospital" <?php if($keyword_type === 'hospital'){ echo 'selected'; } ?> >병원명</option>
											<option value="procedure" <?php if($keyword_type === 'procedure'){ echo 'selected'; } ?> >시술명</option>
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
								<p class="txt">전체 (<span><?=$num?></span>)</p>
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
									<col style="width:10%;">
									<col style="width:10%;">
									<col style="width:10%;">
									<col style="width:10%;">
									<col style="width:10%;">
									<col style="width:10%;">
									<col style="width:10%;">
									<col style="width:10%;">
									<col style="width:10%;">
									<col style="width:10%;">
								</colgroup>
								<thead>
								<tr>
									<th scope="col"><input type="checkbox" id="" name="checkNum" onclick="syncCheckboxSelectAll()"></th>
									<th scope="col">NO.</th>
									<th scope="col">등록 일자</th>
									<th scope="col">프로모션코드</th>
									<th scope="col">진료과목</th>
									<th scope="col">병원명</th>
									<th scope="col">병원위치</th>
									<th scope="col">시술명</th>
									<th scope="col">재고수량</th>
									<th scope="col"></th>
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
									$listnum	= $iTotalSubCnt - (( $pageNo - 1 ) * $pageScale ) - $i;
									?>
									<tr>
										<td><input type="checkbox" name="idx[]" id="idx[]" value="<?=$row["idx"]?>" required="yes" message="메뉴"/></td>
										<td><?=$listnum?></td>
										<td><?=$row['wdate']?></td>
										<td><?=$row['code']?></td>
										<td><?=$row['hospital_type']?></td>
										<td><?=$row['hospital']?></td>
										<td><?=$row['location']?></td>
										<td><?=$row['procedure']?></td>
										<td><?=$row['amount']?></td>
										<td><a href="javascript:go_modify('<?=$row['idx']?>');" class="btn_gray">상세보기</a></td>
									</tr>
								<?php } ?>
								</tbody>
							</table>

							<ul class="list_tab" style="height:20px;"></ul>

							<div class="write_btn align_r">
								<a href="javascript:go_remove();" class="btn_red">삭제</a>
							</div>

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