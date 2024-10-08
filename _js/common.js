/**
 * @desc nice-select 세팅
 */
$('.common-select').niceSelect();

/**
 * @desc modal 동작
 */
$(".btn-modal").on("click",(e)=>{
    const modalData = $(e.currentTarget).attr("data-modal");
  
    $(`.modal-layer[data-modal=${modalData}]`).addClass("on");
    $("body").addClass("fixed");
  });
  
  $(".modal-layer .btn-close").on("click",(e)=>{
    $(e.target).closest(".modal-layer").removeClass("on");
    $("body").removeClass("fixed");
  });

/**
 * @desc datepicker 세팅
 */
const date = new Date();
const curYear = date.getFullYear();
const previousYear =  curYear - 73;
const nextYear =  curYear + 50;

$(".common-date").datepicker({
  dateFormat: "yy-mm-dd",
  showMonthAfterYear: true,
  changeMonth: true,
  changeYear: true,
  yearRange: `${previousYear}:${nextYear}`,
  monthNames: [
    "01",
    "02",
    "03",
    "04",
    "05",
    "06",
    "07",
    "08",
    "09",
    "10",
    "11",
    "12",
  ],
  monthNamesShort: [
    "1월",
    "2월",
    "3월",
    "4월",
    "5월",
    "6월",
    "7월",
    "8월",
    "9월",
    "10월",
    "11월",
    "12월",
  ],
  dayNamesMin: ["일", "월", "화", "수", "목", "금", "토"],
});


// 생년월일 (현재 년도 이전)
$(".common-date-2").datepicker({
  dateFormat: "yy-mm-dd",
  showMonthAfterYear: true,
  changeMonth: true,
  changeYear: true,
  yearRange: `${previousYear}:${curYear}`,
  maxDate: "0",
  monthNames: [
    "01",
    "02",
    "03",
    "04",
    "05",
    "06",
    "07",
    "08",
    "09",
    "10",
    "11",
    "12",
  ],
  monthNamesShort: [
    "1월",
    "2월",
    "3월",
    "4월",
    "5월",
    "6월",
    "7월",
    "8월",
    "9월",
    "10월",
    "11월",
    "12월",
  ],
  dayNamesMin: ["일", "월", "화", "수", "목", "금", "토"],
});

/**
 * @desc scrollTop
 */
$(".scroll_top").click(function () {
    $("html, body").animate({ scrollTop: 0 }, 500);
  });

$(".btn_back").on("click",()=>{
  window.history.back();
});

/* === nav active === */
/**
 * @desc nav의 active 유지
 */
function navActive() {


  //현재 페이지의 nav active 유지
  const url      = window.location.pathname;
  const urlSplit = url.split("/", 3)[1];
  const urlIndex = urlSplit.indexOf(".");
  let   urlName  = urlSplit.slice(0, urlIndex);
  const gnbList  = document.querySelectorAll(".gnb__list a");


  for (var i = 0; i < gnbList.length; i++) {
    //특수문자 필터링
    let gnbHref = gnbList[i].href.replaceAll(/[@$^#!-]/g, "");
    

    if(!urlSplit.length == 0){
      if (gnbHref.includes(urlName) == 1) {
        gnbList[i].closest("li").classList.add("on");
  
      }
    }else{
      gnbList[0].closest("li").classList.add("on");
    }

  }
}

navActive();