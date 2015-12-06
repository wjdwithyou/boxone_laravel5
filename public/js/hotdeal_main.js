$(document).ready(function() {
	var now = new Date();
	var thismonth = now.getMonth();
	var thisyear = now.getYear() + 1900;

	load_calendar(thismonth, thisyear);

	$(".product_div2").height($(".product_div").height());
	move_div();
	move_div2();
	
	$(window).resize(function() {
		$(".product_div2").height($(".product_div").height());
		move_div();
		move_div2();
	});
});

function move_div() {
	if (window.innerWidth <= 991) {
		$("#move_div").insertAfter("#move_target");
	} else {
		$("#move_div").insertAfter("#move_target2");
	}
}

function move_div2() {
	if (window.innerWidth <= 769) {
		$(".code_img:odd").each(function() {
			$(this).insertAfter($(this).siblings(".code_desc"));
		});
	} else {
		$(".code_desc:odd").each(function() {
			$(this).insertAfter($(this).siblings(".code_img"));
		});
	}
}

function load_calendar(month, year) {
	$("#calendar").calendarWidget({
		month : month,
		year : year
	});
}

function calendarWidget(el, params) {
	var monthNames = ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'];
	var dayNames = ['일', '월', '화', '수', '목', '금', '토'];
	month = i = parseInt(params.month);
	year = parseInt(params.year);
	var m = 0;
	var table = '';

	// next month
	if (month == 11) {
		$("#next_month").attr('onclick', 'load_calendar(' + 0 + ', ' + (year + 1) + ')');
	} else {
		$("#next_month").attr('onclick', 'load_calendar(' + (month + 1) + ', ' + (year) + ')');
	}

	// previous month
	if (month == 0) {
		$("#prev_month").attr('onclick', 'load_calendar(' + 11 + ', ' + (year - 1) + ')');
	} else {
		$("#prev_month").attr('onclick', 'load_calendar(' + (month - 1) + ', ' + (year) + ')');
	}

	$("#current_month").text(year + '년 ' + monthNames[month]);

	table += ('<table class="calendar-month " ' + 'id="calendar-month' + i + ' " cellspacing="0">');

	table += '<tr>';

	for ( d = 0; d < 7; d++) {
		table += '<td class="weekday">' + dayNames[d] + '</td>';
	}

	table += '</tr>';

	var days = getDaysInMonth(month, year);
	var firstDayDate = new Date(year, month, 1);
	var firstDay = firstDayDate.getDay();

	var prev_days = getDaysInMonth(month, year);
	var firstDayDate = new Date(year, month, 1);
	var firstDay = firstDayDate.getDay();

	var prev_m = month == 0 ? 11 : month - 1;
	var prev_y = prev_m == 11 ? year - 1 : year;
	var prev_days = getDaysInMonth(prev_m, prev_y);
	firstDay = (firstDay == 0 && firstDayDate) ? 7 : firstDay;

	var i = 0;
	for ( j = 0; j < 42; j++) {

		if ((j < firstDay)) {
			table += ('<td class="other-month"><span class="day">' + (prev_days - firstDay + j + 1) + '</span></td>');
		} else if ((j >= firstDay + getDaysInMonth(month, year))) {
			i = i + 1;
			table += ('<td class="other-month"><span class="day">' + i + '</span></td>');
		} else {
			table += ('<td class="current-month day' + (j - firstDay + 1) + '"><span class="day">' + (j - firstDay + 1) + '</span></td>');
		}
		if (j % 7 == 6)
			table += ('</tr>');
	}

	table += ('</table>'
	);

	el.html(table);
}

function getDaysInMonth(month, year) {
	var daysInMonth = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
	if ((month == 1) && (year % 4 == 0) && ((year % 100 != 0) || (year % 400 == 0))) {
		return 29;
	} else {
		return daysInMonth[month];
	}
}

$.fn.calendarWidget = function(params) {
	calendarWidget(this, params);
	return this;
};
