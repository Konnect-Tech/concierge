<?php

include("../_inc/head.php");

$member_idx = $_SESSION[$_SESSION_DEFAULT_PREFIX . "idx"];
if(!$member_idx){
	error_frame_go("로그인 후 접근 가능한 페이지입니다.", "/login/login.php");
	exit;
}

//$board_width = 800;
//$board_height = 800;

?>

<body>
	<div id="wrap">
		<header id="header">
			<div class="header__title">구매인증</div>
		</header>
		<main class="main">
			<div id="container">
				<form name="frm" method="post" action="./certification_write_action.php" enctype="multipart/form-data" target="_fra_admin">
					<input type="hidden" name="member_idx" value="<?=$member_idx?>">
					<div class="certification__inner">
						<h3 class="tit">구매영수증을 업데이트하고<br>포인트 챙겨가세요 !</h3>
						<p>영수증 업로드</p>

						<div id="receipt"></div>

						<div class="add_btn">
							<button type="button" class="btn_add-upload" onclick="add_receipt()">추가 업로드 하기(<span class="receipt-cnt">1</span>/5)</button>
						</div>
						<div class="submit_btn">
							<button type="submit" class="btn-lg btn-w100p btn-submit_receipt btn-modal">영수증 제출하기</button>
						</div>
					</div>
				</form>
			</div>
		</main>
		<?php include("../_inc/menu.php"); ?>
	</div>

	<!-- 영수증 업로드 성공 모달 시작 -->
	<div class="modal-layer certification_modal">
		<div class="modal-layer__window">
			<div class="modal-body">
				<div class="certification_body">
					<h3><span class="receipt-cnt">1</span>개의 영수증이<br>성공적으로 업로드 되었습니다.</h3>
					<p>추후 구매 인증이 완료되면<br>포인트가 제공될 예정입니다.</p>
				</div>
			</div>
			<div class="button__wrap">
				<button type="button" class="btn btn-radius btn-close" onclick="location.reload()">닫기</button>
			</div>
		</div>
	</div>
	<!-- 영수증 업로드 성공 모달 끝 -->

	<script>
		// 2023-10-16 퍼블 로딩이미지 추가



        function modalLayerOpen(cnt){
            document.querySelector('.modal-layer').classList.add('on')
            document.querySelectorAll('.receipt-cnt')[1].innerHTML = cnt;
        }

		const receipt_section_model = `
			<div class="upload_receipt">
				<div class="select_purchase">
					<span>구매처 영수증 종류</span>
					<div class="selects">
						<div class="custom-chk">
							<label for="chk1-{%id%}">
								<input type="radio" id="chk1-{%id%}" name="receipt_source_{%id%}" value="면세점 구매" checked onclick="syncRadioChecked('{%id%}', '1')"><em>면세점 구매</em>
							</label>
						</div>
						<div class="custom-chk">
							<label for="chk2-{%id%}">
								<input type="radio" id="chk2-{%id%}" name="receipt_source_{%id%}" value="메디컬 구매" onclick="syncRadioChecked('{%id%}', '2')"><em>메디컬 구매</em>
							</label>
						</div>
					</div>
				</div>
				<div class="send_receipt">
					<span>영수증 제출</span>
					<div class="upload-file">
						<div class="upload_area">
							<input class="upload-name" id="upload-name-{%id%}" value="파일첨부" placeholder="파일첨부" readonly>
							<label for="file-{%id%}"></label>
							<button type="button" class="btn-file-del" id="del-{%id%}" onclick="delFile(event);"><img src="../_img/common/btn_file_del.svg"></button>
						</div>
						<input type="file" id="file-{%id%}" name="upload-name-{%id%}" class="file_element" accept="image/*">
					</div>
				</div>
			</div>
		`
		const receipt_content = document.querySelector('#receipt');

		let current_receipt_id = 1;

		function add_receipt(){
            if(current_receipt_id === 6){
                alert("구매영수증은 최대 5개 까지만 업로드 할 수 있습니다.")
				return
			}

            let receipt_id = current_receipt_id++;

            receipt_content.insertAdjacentHTML('beforeend', receipt_section_model.replace(/{%id%}/g, receipt_id));

            document.querySelector(`#file-${receipt_id}`).addEventListener('change', function (e){
                document.querySelector(`#upload-name-${receipt_id}`).value = e.target.files[0].name;

				//2023-10-11 퍼블 추가
				// 파일 업로드 비노출
				document.querySelector(`#upload-name-${receipt_id}+label`).style.display="none";
				// 파일 삭제버튼 노출
				document.querySelector(`#del-${receipt_id}`).style.display="inline-block";
			})

			refresh_receipt_cnt()
		}

		//2023-10-11 퍼블 추가
		// 업로드 파일 삭제
		function delFile(event){
			const uploadArea = event.target.closest(".upload_area");

			uploadArea.querySelector(".upload-name").value = "";
			event.currentTarget.style.display="none";
			uploadArea.querySelector("label").style.display="inline-block";
		}

        function refresh_receipt_cnt(){
            document.querySelectorAll('.receipt-cnt').forEach((e) => {
                e.innerText = current_receipt_id - 1;
			})
		}

        function syncRadioChecked(current_id, immutable_id){
            if(parseInt(immutable_id) === 1){
                document.querySelector(`#chk1-${current_id}`).setAttribute('checked', '')
                document.querySelector(`#chk2-${current_id}`).removeAttribute('checked')
			}else{
                document.querySelector(`#chk1-${current_id}`).removeAttribute('checked')
                document.querySelector(`#chk2-${current_id}`).setAttribute('checked', '')
			}
		}

        add_receipt()


		// 2023-10-16 퍼블 로딩이미지 추가
		const $btnSubmit = document.querySelector(".btn-submit_receipt")
		
		$btnSubmit.addEventListener("click",function(){
			$btnSubmit.classList.add("btn-load");
			$btnSubmit.innerText = "";
		});
	</script>
</body>
<?php include $_SERVER["DOCUMENT_ROOT"] . "/pro_inc/include_bottom_admin_tail.php"; ?>
</html>