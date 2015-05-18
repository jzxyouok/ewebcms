// -----------------------获取时间-----------------------------------
function updateTime() {
		var dateTime = new Date();

		var yy = dateTime.getFullYear(); //年份
		var MM = dateTime.getMonth() + 1; //月份-因为1月这个方法返回为0，所以加1
		var dd = dateTime.getDate(); //日数

		var week = dateTime.getDay(); //周(0~6,0表示星期日)
		var days = ["日 ", "一 ", "二 ", "三 ", "四 ", "五 ", "六 ", ]

		document.getElementById("top_time").innerHTML =
			"&nbsp;&nbsp;&nbsp;&nbsp;" + yy + "年" + MM + "月" + dd + "日 " + "&nbsp;&nbsp;" + "星期" + days[week] + "&nbsp;";
	}
	// ---------------------下拉菜单---------------------------
function menuFix() {
	var sfEls = document.getElementById("top_menu").getElementsByTagName("li");
	for (var i = 0; i < sfEls.length; i++) {
		sfEls[i].onmouseover = function() {
			this.className += (this.className.length > 0 ? " " : "") + "sfhover";
		}
		sfEls[i].onMouseDown = function() {
			this.className += (this.className.length > 0 ? " " : "") + "sfhover";
		}
		sfEls[i].onMouseUp = function() {
			this.className += (this.className.length > 0 ? " " : "") + "sfhover";
		}
		sfEls[i].onmouseout = function() {
			this.className = this.className.replace(new RegExp("( ?|^)sfhover\\b"),
				"");
		}
	}

}


function newschange() {
	var oUl1 = document.getElementById("ul1"); //得到主菜单
	var aLi = oUl1.getElementsByTagName("li"); //主菜单的三个列表

	var oDiv = document.getElementById("tab-list"); //
	var aDiv = oDiv.getElementsByTagName("div");

	for (var i = 0; i < aLi.length; i++) {
		aLi[i].index = i;
		aLi[i].onmouseover = function() {
			for (var i = 0; i < aLi.length; i++) {
				aLi[i].className = "";
			}
			this.className = "active";
			for (var j = 0; j < aDiv.length; j++) {
				aDiv[j].className = "hide";
			}
			aDiv[this.index].className = "show";
		}
	}
}


window.onload = function() {
	// updateTime();
	menuFix();
	newschange();
};

