<?php header('Content-Type: text/html; charset=UTF-8'); ?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	</head>
	<script type="text/javascript">
        <!--
        Calendar = function (obj) {
            this.avail = true;//(document.getElementById) ? true : false;
            if (!this.avail) return;

            this._setDateSeperator = "-";   // 날짜 구분자
//	this._setDateSeperator = "";   // 날짜 구분자 --없앴음. 2007-01-04

            this._setPrevColor = "#999999"; // 이전달 날짜 색
            this._setPrevBackground = "";   // 이전달 날짜 배경색
            this._setNextColor = "#999999"; // 다음달 날짜 색
            this._setNextBackground = "";   // 다음달 날짜 배경색
            this._setNowBold = true;        // 선택 날짜 Bold여부
            this._setNowColor = "blue";     // 선택 날짜 색
            this._setNowBackground = "";    // 선택 날짜 배경색
            this._setTodayBold = true;      // 오늘 날짜 Bold여부
            this._setTodayColor = "red";    // 오늘 날짜 색
            this._setTodayBackground = "";  // 오늘 날짜 배경색

            var classObj = this;
            this.layerObj = parent.document.getElementById("CalendarLayer");
            this.layerObj.style.position = 'absolute';

            this.calForm = document.forms["CalendarForm"];
            this.calForm.cal_year.onchange = function () {
                classObj.year = parseInt(this[this.selectedIndex].value, 10);
                classObj.setCalendar();
            }
            this.calForm.cal_month.onchange = function () {
                classObj.month = parseInt(this[this.selectedIndex].value, 10);
                classObj.setCalendar();
            }

            if (document.all) {
                document.getElementById("CalendarPrevMonth").style.cursor = "pointer";
                document.getElementById("CalendarNextMonth").style.cursor = "pointer";
                document.getElementById("CalendarToday").style.cursor = "pointer";
                document.getElementById("CalendarClose").style.cursor = "pointer";
            } else {
                document.getElementById("CalendarPrevMonth").style.cursor = "pointer";
                document.getElementById("CalendarNextMonth").style.cursor = "pointer";
                document.getElementById("CalendarToday").style.cursor = "pointer";
                document.getElementById("CalendarClose").style.cursor = "pointer";
            }
            document.getElementById("CalendarPrevMonth").onclick = function () {
                classObj.shiftMonth(-1);
            }
            document.getElementById("CalendarNextMonth").onclick = function () {
                classObj.shiftMonth(+1);
            }
            var d = new Date();
            document.getElementById("CalendarToday").innerHTML = "(" + this.getDateFormat(d.getFullYear(), d.getMonth(), d.getDate()) + ")";
            document.getElementById("CalendarToday").onclick = function () {
                var d = new Date();
                classObj.setDate(d.getFullYear(), d.getMonth(), d.getDate());
                classObj.destroy();
            }
            document.getElementById("CalendarClose").onclick = function () {
                classObj.destroy();
            }
            this.show(obj);
        }

        Calendar.prototype.getDateFormat = function (year, month, day) {
            month++;
            if (month.toString().length == 1) month = "0" + month;
            if (day.toString().length == 1) day = "0" + day;
            return year + this._setDateSeperator + month + this._setDateSeperator + day;
        }

        Calendar.prototype.shiftMonth = function (val) {
            this.month += val;
            d = new Date(this.year, this.month, this.day);
            this.year = d.getFullYear();
            this.month = d.getMonth();
            this.day = d.getDate();
            this.setCalendar();
        }

        Calendar.prototype.setDate = function (year, month, day) {
            this.obj.value = this.getDateFormat(year, month, day);
        }

        Calendar.prototype.setCalendar = function () {
            if (this.yearOld != this.year) this.setYear(this.calForm.cal_year);
            this.setMonth(this.calForm.cal_month);

            if (this.yearOld != this.year || this.monthOld != this.month) {
                this.drawCalendar(this.year, this.month, this.day);
            }

            this.yearOld = this.year;
            this.monthOld = this.month;
        }

        Calendar.prototype.drawCalendar = function (year, month, day) {
            var calDate = new Date(year, month, 1);
            var calWeekday = calDate.getDay();
            var calDays = this.getMonthDays(year, month + 1);
            var calPrevDays = this.getMonthDays(year, month);
            var calDay = 1;
            var calNextDay = 1;

            for (var i = 0; i < 6; i++) {  // loop for month-weeks
                for (var j = 0; j < 7; j++) {  // loop for week-days
                    var dayLayer = eval("document.getElementById('CalendarDay_" + (i + 1) + "_" + (j + 1) + "')");
                    if (i == 0 && j < calWeekday) {
                        this.linkDay(dayLayer, year, month - 1, calPrevDays - (calWeekday - j) + 1, 'prev');
                    } else if (calDay > calDays) {
                        this.linkDay(dayLayer, year, month + 1, calNextDay, 'next');
                        calNextDay++;
                    } else {
                        this.linkDay(dayLayer, year, month, calDay);
                        calDay++;
                    }
                }
            }
        }

        Calendar.prototype.linkDay = function (layer, year, month, day, monthTab) {
            var classObj = this;
            var d = new Date();
            layer.innerHTML = day;
            if (this.yearSet == year && this.monthSet == month && this.daySet == day) { // 선택날짜 효과
                layer.style.fontWeight = (this._setNowBold == true) ? "bold" : "";
                layer.style.color = (this._setNowColor) ? this._setNowColor : "";
                layer.style.background = (this._setNowBackground) ? this._setNowBackground : "";
            } else if (d.getFullYear() == year && d.getMonth() == month && d.getDate() == day) { // 오늘날짜 효과
                layer.style.fontWeight = (this._setTodayBold == true) ? "bold" : "";
                layer.style.color = (this._setTodayColor) ? this._setTodayColor : "";
                layer.style.background = (this._setTodayBackground) ? this._setTodayBackground : "";
            } else if (monthTab == 'prev') {   // 이전달 효과
                layer.style.fontWeight = "";
                layer.style.color = (this._setPrevColor) ? this._setPrevColor : "";
                ;
                layer.style.background = (this._setPrevBackground) ? this._setPrevBackground : "";
            } else if (monthTab == 'next') { // 다음달 효과
                layer.style.fontWeight = "";
                layer.style.color = (this._setNextColor) ? this._setNextColor : "";
                layer.style.background = (this._setNextBackground) ? this._setNextBackground : "";
            } else {
                layer.style.fontWeight = "";
                layer.style.color = "";
                layer.style.background = "";
            }
            layer.style.cursor = (document.all) ? "pointer" : "pointer";
            layer.onclick = function () {
                var d = new Date(year, month, day);
                classObj.setDate(d.getFullYear(), d.getMonth(), d.getDate());
                classObj.destroy();
            }
        }

        Calendar.prototype.setYear = function (yearObj) {
            yearObj.options.length = 0;
            for (var i = this.year - 80, j = 0; i <= this.year + 5; i++, j++) {
                yearObj.options[j] = new Option(i + "년", i, false);
                if (i == this.year) yearObj.options[j].selected = true;
            }
        }

        Calendar.prototype.setMonth = function (monthObj) {
            monthObj.selectedIndex = this.month;
        }

        Calendar.prototype.show = function (obj) {
            if (!this.avail || this.obj == obj) return;

            this.obj = obj;

            var classObj = this;
            var objTmp = this.obj;
            var layerX = 0;
            var layerY = 0;
            while (objTmp) {
                layerX += objTmp.offsetLeft;
                layerY += objTmp.offsetTop;
                objTmp = objTmp.offsetParent;
            }
            layerY2 = layerY + 20;
            this.layerObj.style.left = "" + layerX + "px";
            this.layerObj.style.top = "" + layerY2 + "px";
            this.layerObj.style.display = "block";

            var datePattern = /^([0-9]{4})[\-\.]?([01][0-9])[\-\.]?([0-3][0-9])$/;
            if (datePattern.test(this.obj.value)) {
                datePattern.exec(this.obj.value);
                var d = new Date(parseInt(RegExp.$1, 10), parseInt(RegExp.$2, 10) - 1, parseInt(RegExp.$3, 10));
            } else {
                var d = new Date();
            }
            this.year = d.getFullYear();
            this.month = d.getMonth();
            this.day = d.getDate();
            this.yearSet = this.year;
            this.monthSet = this.month;
            this.daySet = this.day;
            this.setCalendar();
        }

        Calendar.prototype.getMonthDays = function (year, month) {
            var d = new Date(year, month, 0);
            return d.getDate();
        }

        Calendar.prototype.destroy = function () {
            this.layerObj.style.display = "none";
            this.obj = null;
            this.yearOld = null;
            this.monthOld = null;
        }
        //-->
	</script>
	<style>
        table, td {
            font-size: 8pt;
            font-family: 굴림
        }

        div, form {
            margin: 0;
            padding: 0
        }

        select {
            font-size: 8pt;
            font-family: 굴림;
            background-color: #e5e5e5
        }

        a:hover {
            text-decoration: underline;
            color: #9999ff
        }

        a:link {
            text-decoration: none;
        }

        a:visited {
            text-decoration: none;
        }

        a:active {
            text-decoration: none;
        }
	</style>
	<body topmargin="0" leftmargin="0" marginwidth="0" marginheight="0">
		<div id="CalendarLayer">
			<form name="CalendarForm">
				<table border="0" cellspacing="1" cellpadding="0" width="172" bgcolor="666666">
					<tr>
						<td bgcolor="#FBFBFB" align="center">
							<table border="0" cellpadding="0" width="170" bgcolor="#0A246A">
								<tr height="25">
									<td align="right" width="15">
										<div id="CalendarPrevMonth"><font color="white">◁</font></div>
									</td>
									<td align="center" width="140"><select name="cal_year">
										</select>
										<select name="cal_month">
											<option value="0">1월</option>
											<option value="1">2월</option>
											<option value="2">3월</option>
											<option value="3">4월</option>
											<option value="4">5월</option>
											<option value="5">6월</option>
											<option value="6">7월</option>
											<option value="7">8월</option>
											<option value="8">9월</option>
											<option value="9">10월</option>
											<option value="10">11월</option>
											<option value="11">12월</option>
										</select>
									</td>
									<td align="left" width="15">
										<div id="CalendarNextMonth"><font color="white">▷</font></div>
									</td>
								</tr>
							</table>
							<table border="0" cellpadding="0" width="140">
								<tr align="center" height="20">
									<th width="20">S</th>
									<th width="20">M</th>
									<th width="20">T</th>
									<th width="20">W</th>
									<th width="20">T</th>
									<th width="20">F</th>
									<th width="20">S</th>
								</tr>
								<tr>
									<td height="1" colspan="7" bgcolor="black"></td>
								</tr>
							</table>
							<table border="0" cellpadding="1" width="140">
								<tr align="center" height="18">
									<td width="20">
										<div id="CalendarDay_1_1"></div>
									</td>
									<td width="20">
										<div id="CalendarDay_1_2"></div>
									</td>
									<td width="20">
										<div id="CalendarDay_1_3"></div>
									</td>
									<td width="20">
										<div id="CalendarDay_1_4"></div>
									</td>
									<td width="20">
										<div id="CalendarDay_1_5"></div>
									</td>
									<td width="20">
										<div id="CalendarDay_1_6"></div>
									</td>
									<td width="20">
										<div id="CalendarDay_1_7"></div>
									</td>
								</tr>
								<tr align="center" height="18">
									<td width="20">
										<div id="CalendarDay_2_1"></div>
									</td>
									<td width="20">
										<div id="CalendarDay_2_2"></div>
									</td>
									<td width="20">
										<div id="CalendarDay_2_3"></div>
									</td>
									<td width="20">
										<div id="CalendarDay_2_4"></div>
									</td>
									<td width="20">
										<div id="CalendarDay_2_5"></div>
									</td>
									<td width="20">
										<div id="CalendarDay_2_6"></div>
									</td>
									<td width="20">
										<div id="CalendarDay_2_7"></div>
									</td>
								</tr>
								<tr align="center" height="18">
									<td width="20">
										<div id="CalendarDay_3_1"></div>
									</td>
									<td width="20">
										<div id="CalendarDay_3_2"></div>
									</td>
									<td width="20">
										<div id="CalendarDay_3_3"></div>
									</td>
									<td width="20">
										<div id="CalendarDay_3_4"></div>
									</td>
									<td width="20">
										<div id="CalendarDay_3_5"></div>
									</td>
									<td width="20">
										<div id="CalendarDay_3_6"></div>
									</td>
									<td width="20">
										<div id="CalendarDay_3_7"></div>
									</td>
								</tr>
								<tr align="center" height="18">
									<td width="20">
										<div id="CalendarDay_4_1"></div>
									</td>
									<td width="20">
										<div id="CalendarDay_4_2"></div>
									</td>
									<td width="20">
										<div id="CalendarDay_4_3"></div>
									</td>
									<td width="20">
										<div id="CalendarDay_4_4"></div>
									</td>
									<td width="20">
										<div id="CalendarDay_4_5"></div>
									</td>
									<td width="20">
										<div id="CalendarDay_4_6"></div>
									</td>
									<td width="20">
										<div id="CalendarDay_4_7"></div>
									</td>
								</tr>
								<tr align="center" height="18">
									<td width="20">
										<div id="CalendarDay_5_1"></div>
									</td>
									<td width="20">
										<div id="CalendarDay_5_2"></div>
									</td>
									<td width="20">
										<div id="CalendarDay_5_3"></div>
									</td>
									<td width="20">
										<div id="CalendarDay_5_4"></div>
									</td>
									<td width="20">
										<div id="CalendarDay_5_5"></div>
									</td>
									<td width="20">
										<div id="CalendarDay_5_6"></div>
									</td>
									<td width="20">
										<div id="CalendarDay_5_7"></div>
									</td>
								</tr>
								<tr align="center" height="18">
									<td width="20">
										<div id="CalendarDay_6_1"></div>
									</td>
									<td width="20">
										<div id="CalendarDay_6_2"></div>
									</td>
									<td width="20">
										<div id="CalendarDay_6_3"></div>
									</td>
									<td width="20">
										<div id="CalendarDay_6_4"></div>
									</td>
									<td width="20">
										<div id="CalendarDay_6_5"></div>
									</td>
									<td width="20">
										<div id="CalendarDay_6_6"></div>
									</td>
									<td width="20">
										<div id="CalendarDay_6_7"></div>
									</td>
								</tr>
							</table>
							<table border="0" cellpadding="0" width="140">
								<tr>
									<td height="1" colspan="7" bgcolor="black"></td>
								</tr>
							</table>
							<table border="0" cellspacing="1" cellpadding="2" width="160">
								<tr>
									<td colspan="7" align="center"> 오늘
										<div id="CalendarToday" style="display:inline"></div>
										&nbsp;|
										<div id="CalendarClose" style="display:inline">닫기</div>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</body>
</html>
