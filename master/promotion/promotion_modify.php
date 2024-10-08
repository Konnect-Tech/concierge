<?php

include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드
include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더
include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login.php"; // 관리자 로그인여부 확인

$bmenu = trim(sqlfilter($_REQUEST['bmenu']));
$smenu = trim(sqlfilter($_REQUEST['smenu']));
$pageNo = trim(sqlfilter($_REQUEST['pageNo']));
$pageScale = trim(sqlfilter($_REQUEST['pageScale']));
$idx = trim(sqlfilter($_REQUEST['idx']));
if(!$idx){
	error_back("접근 불가능한 페이지입니다.");
	exit;
}

$total_param = "bmenu=$bmenu&smenu=$smenu&pageScale=$pageScale&pageNo=$pageNo";

$query = " SELECT * FROM promotion_info WHERE `idx` = '$idx' ";
$result = mysqli_query($gconnet, $query);
$row = $result->fetch_array();

$board_width = 800;
$board_height = 800;

$hospitals = get_hospitals('id', 'name', static function(array $data): array{ return ["id" => $data['_doc']["_id"], "name" => $data['_doc']['name']]; });

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>

<script>
    function go_list(){
        location.href = "./promotion_list.php?<?=$total_param?>"
    }
</script>
<body>
	<div id="wrap" class="skin_type01">
		<?php include $_SERVER["DOCUMENT_ROOT"]."/master/include/admin_top.php"; // 상단메뉴?>
		<div class="sub_wrap">
			<?php include $_SERVER["DOCUMENT_ROOT"]."/master/include/promotion_left.php"; // 좌측메뉴?>
			<!-- content 시작 -->
			<div class="container clearfix">
				<div class="content">
					<div class="navi">
						<ul class="clearfix">
							<li>HOME</li>
							<li>프로모션 관리</li>
						</ul>
					</div>
					<div class="list_tit">
						<h3>프로모션 수정</h3>
					</div>
					<form action="./promotion_modify_action.php" method="post" enctype="multipart/form-data" name="frm" target="_fra_admin" id="frm">
						<input type="hidden" name="total_param" value="<?=$total_param?>">
						<input type="hidden" name="idx" value="<?=$idx?>">
						<div class="write">
							<table>
								<colgroup>
									<col style="width:15%">
									<col style="width:35%">
									<col style="width:15%">
									<col style="width:35%">
								</colgroup>

								<tr>
									<th scope="row">병원명</th>
									<td colspan="3">
										<select name="hospital" style="width: 30%">
											<option value="">선택</option>
											<?php foreach($hospitals as $id => $name){ ?>
												<option value="<?=$id?>" <?php if($name === $row['hospital']){ echo 'selected'; } ?>><?=$name?></option>
											<?php } ?>
										</select>
									</td>
								</tr>

								<tr>
									<th scope="row">병원 위치</th>
									<td><input type="text" name="location" style="width: 100%" required="yes" message="병원 위치" value="<?=$row['location']?>"></td>
									<th scope="row">시술명</th>
									<td>
										<textarea name="procedure" id="" rows="1"  style="width: 100%; height:32px; resize:none; padding:5px 10px;" required="yes" message="시술명"><?=$row['procedure']?></textarea>
									</td>
								</tr>

								<tr>
									<th scope="row">프로모션 여부</th>
									<td>
										<input type="radio" name="is_promotion" value="Y" <?php if($row['is_promotion'] == 1){ echo 'checked'; } ?>> 예&nbsp;&nbsp;&nbsp;
										<input type="radio" name="is_promotion" value="N" <?php if($row['is_promotion'] == 0){ echo 'checked'; } ?>> 아니오
									</td>
									<th scope="row">재고 수량</th>
									<td><input type="text" name="amount" style="width: 100%" required="yes" message="재고 수량" value="<?=$row['amount']?>"></td>
								</tr>

								<tr>
									<th scope="row">병원 정보</th>
									<td colspan="3">
										<textarea name="hospital_info"><?=$row['hospital_info']?></textarea>
									</td>
								</tr>

								<tr>
									<th scope="row">주요 시술</th>
									<td colspan="3">
										<textarea name="major_procedures"><?=$row['major_procedures']?></textarea>
									</td>
								</tr>

								<tr>
									<th scope="row">운영 시간</th>
									<td colspan="3">
										<textarea name="operating_time"><?=$row['operating_time']?></textarea>
									</td>
								</tr>

								<tr>
									<th scope="row">병원 주소</th>
									<td colspan="3">
										<textarea name="hospital_pos"><?=$row['hospital_pos']?></textarea>
									</td>
								</tr>

								<tr>
									<th scope="row">병원 이미지</th>
									<td colspan="3">
										<table style="margin-bottom: 0px !important;">
											<colgroup>
												<col style="width:15%">
												<col style="width:35%">
												<col style="width:15%">
												<col style="width:35%">
											</colgroup>

											<tr>
												<th scope="row">병원 배너</th>
												<td colspan="3">
													<input type="file" name="banner_file" required="true" message="병원 배너 이미지" accept="image/*">
													<br><font color="red">⁕ 파일 첨부시 파일이 교체됩니다.</font>
												</td>
											</tr>

											<tr>
												<th scope="row">병원 내부</th>
												<td colspan="3">
													<input type="file" name="hospital_in_file" required="true" message="병원 내부 이미지" accept="image/*">
													<br><font color="red">⁕ 파일 첨부시 파일이 교체됩니다.</font>
												</td>
											</tr>

											<tr>
												<th scope="row">병원 전경</th>
												<td colspan="3">
													<input type="file" name="hospital_view_file" required="true" message="병원 전경 이미지" accept="image/*">
													<br><font color="red">⁕ 파일 첨부시 파일이 교체됩니다.</font>
												</td>
											</tr>

											<tr>
												<th scope="row">로고 이미지</th>
												<td colspan="3">
													<input type="file" name="logo_file" required="true" message="로고 이미지" accept="image/*">
													<br><font color="red">⁕ 파일 첨부시 파일이 교체됩니다.</font>
												</td>
											</tr>

										</table>
									</td>
								</tr>

							</table>

							<h2>시술 상세 이미지</h2>
							<font color="red">※ 등록하실 파일을 선택해주세요.</font><br>
							<input multiple type="file" name="procedure[]" accept="image/*" id="procedure-file" style="display: none">
							<table>
								<colgroup>
									<col style="width:20%">
									<col style="width:30%">
									<col style="width:25%">
									<col style="width:25%">
								</colgroup>

								<thead>
								<tr>
									<th scope="col"><label for="procedure-file"><a class="btn_green">파일 추가</a></label></th>
									<th scope="col">파일</th>
									<th scope="col">용량</th>
									<th scope="col">삭제</th>
								</tr>
								</thead>

								<tbody id="file_sec">
								</tbody>
							</table>

							<h2>병원 후기 이미지</h2>
							<font color="red">※ 등록하실 파일을 선택해주세요.</font><br>
							<input multiple type="file" name="review[]" accept="image/*" id="review-file" style="display: none">
							<table>
								<colgroup>
									<col style="width:20%">
									<col style="width:30%">
									<col style="width:25%">
									<col style="width:25%">
								</colgroup>

								<thead>
								<tr>
									<th scope="col"><label for="review-file"><a class="btn_green">파일 추가</a></label></th>
									<th scope="col">파일</th>
									<th scope="col">용량</th>
									<th scope="col">삭제</th>
								</tr>
								</thead>

								<tbody id="review_file_sec">
								</tbody>
							</table>

							<ul class="list_tab" style="height:20px;"></ul>

							<div class="write_btn align_r">
								<a href="javascript:go_submit();" class="btn_blue">등록</a>
								<a href="javascript:go_list();" class="btn_gray">취소</a>
							</div>

						</div>
					</form>
					<!-- content 종료 -->
				</div>
			</div>

			<script type="text/javascript">
                function go_submit() {
                    const check = chkFrm('frm');
                    if (check) {
                        // oEditors.getById["editor"].exec("UPDATE_CONTENTS_FIELD", []);
                        frm.submit();
                    } else {
                        false;
                    }
                }

                $(document).ready(function (){
                    window.addEventListener('change', function (){
                        let fileInput = document.getElementById('procedure-file')
                        if(fileInput !== null){
                            reallocateFileSection(fileInput)
                        }

                        let _fileInput = document.getElementById('review-file')
                        if(_fileInput !== null){
                            reallocateReviewFileSection(_fileInput)
                        }
                    })
                })

                function humanFileSize(size) {
                    const i = size === 0 ? 0 : Math.floor(Math.log(size) / Math.log(1024));
                    return (size / Math.pow(1024, i)).toFixed(2) * 1 + ' ' + ['B', 'KB', 'MB', 'GB', 'TB'][i];
                }

                function reallocateFileSection(fileInput){
                    const target = document.getElementById('file_sec')
                    target.innerHTML = ''; //reset

                    for (let i = 0; i < fileInput.files.length; i ++) {
                        let file = fileInput.files[i]

                        const tr = document.createElement('tr');
                        tr.style.textAlign = 'center';

                        let numeric = document.createElement('td');
                        numeric.innerText = `${i+1}`
                        tr.append(numeric)

                        let filename = document.createElement('td');
                        filename.innerText = file.name;
                        tr.append(filename)

                        let filesize = document.createElement('td');
                        filesize.innerText = `${humanFileSize(file.size)}`;
                        tr.append(filesize)

                        let fileremove = document.createElement('td');
                        fileremove.innerHTML = `<a class='btn_red' onclick="remove_file('${file.lastModified}')" style="cursor:pointer;">삭제</a>`
                        tr.append(fileremove)

                        target.append(tr)
                    }
                }

                function remove_file(lastModified){
                    let fileInput = document.getElementById('procedure-file');
                    const dataTransfer = new DataTransfer();

                    Array.from(fileInput.files)
                        .filter(file => file.lastModified != lastModified)
                        .forEach(file => {
                            dataTransfer.items.add(file);
                        })

                    fileInput.files = dataTransfer.files;
                    reallocateFileSection(fileInput)
                }

                function reallocateReviewFileSection(videoInput){
                    const target = document.getElementById('review_file_sec')
                    target.innerHTML = ''; //reset

                    for (let i = 0; i < videoInput.files.length; i ++) {
                        let file = videoInput.files[i]

                        const tr = document.createElement('tr');
                        tr.style.textAlign = 'center';

                        let numeric = document.createElement('td');
                        numeric.innerText = `${i+1}`
                        tr.append(numeric)

                        let filename = document.createElement('td');
                        filename.innerText = file.name;
                        tr.append(filename)

                        let filesize = document.createElement('td');
                        filesize.innerText = `${humanFileSize(file.size)}`;
                        tr.append(filesize)

                        let fileremove = document.createElement('td');
                        fileremove.innerHTML = `<a class='btn_red' onclick="remove_review_file('${file.lastModified}')" style="cursor:pointer;">삭제</a>`
                        tr.append(fileremove)

                        target.append(tr)
                    }
                }

                function remove_review_file(lastModified){
                    let fileInput = document.getElementById('review-file');
                    const dataTransfer = new DataTransfer();

                    Array.from(fileInput.files)
                        .filter(file => file.lastModified != lastModified)
                        .forEach(file => {
                            dataTransfer.items.add(file);
                        })

                    fileInput.files = dataTransfer.files;
                    reallocateReviewFileSection(fileInput)
                }
			</script>
			<?php include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_bottom_admin_tail.php"; ?>
</body>
</html>
