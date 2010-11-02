﻿/*
 * Chinese year format for the jQuery UI date picker plugin.
 * Written by Max Clapton
 * http://maxclapton.comoj.com
 */

(function($)
{

dpuuid = new Date().getTime();
$.extend($.datepicker, {
	_generateMonthYearHeader : function(inst, drawMonth, drawYear, minDate, maxDate,
			secondary, monthNames, monthNamesShort) {
		var changeMonth = this._get(inst, 'changeMonth');
		var changeYear = this._get(inst, 'changeYear');
		var showMonthAfterYear = this._get(inst, 'showMonthAfterYear');
		var html = '<div class="ui-datepicker-title">';
		var monthHtml = '';
		// month selection
		if (secondary || !changeMonth)
			monthHtml += '<span class="ui-datepicker-month">' + monthNames[drawMonth] + '</span>';
		else {
			var inMinYear = (minDate && minDate.getFullYear() == drawYear);
			var inMaxYear = (maxDate && maxDate.getFullYear() == drawYear);
			monthHtml += '<select class="ui-datepicker-month" ' +
				'onchange="DP_jQuery_' + dpuuid + '.datepicker._selectMonthYear(\'#' + inst.id + '\', this, \'M\');" ' +
				'onclick="DP_jQuery_' + dpuuid + '.datepicker._clickMonthYear(\'#' + inst.id + '\');"' +
				'>';
			for (var month = 0; month < 12; month++) {
				if ((!inMinYear || month >= minDate.getMonth()) &&
						(!inMaxYear || month <= maxDate.getMonth()))
					monthHtml += '<option value="' + month + '"' +
						(month == drawMonth ? ' selected="selected"' : '') +
						'>' + monthNamesShort[month] + '</option>';
			}
			monthHtml += '</select>';
		}
		if (!showMonthAfterYear)
			html += monthHtml + (secondary || !(changeMonth && changeYear) ? '&#xa0;' : '');
		// year selection

		if (secondary || !changeYear)
			html += '<span class="ui-datepicker-year">' + (drawYear-1911) + '</span>';
		else {
			// determine range of years to display
			var years = this._get(inst, 'yearRange').split(':');
			var thisYear = new Date().getFullYear();
			var determineYear = function(value) {
				var year = (value.match(/c[+-].*/) ? drawYear + parseInt(value.substring(1), 10) :
					(value.match(/[+-].*/) ? thisYear + parseInt(value, 10) :
					parseInt(value, 10)));
				return (isNaN(year) ? thisYear : year);
			};
			var year = determineYear(years[0]);
			var endYear = Math.max(year, determineYear(years[1] || ''));
			year = (minDate ? Math.max(year, minDate.getFullYear()) : year);
			endYear = (maxDate ? Math.min(endYear, maxDate.getFullYear()) : endYear);
			html += '<select class="ui-datepicker-year" ' +
				'onchange="DP_jQuery_' + dpuuid + '.datepicker._selectMonthYear(\'#' + inst.id + '\', this, \'Y\');" ' +
				'onclick="DP_jQuery_' + dpuuid + '.datepicker._clickMonthYear(\'#' + inst.id + '\');"' +
				'>';
			for (; year <= endYear; year++) {
				html += '<option value="' + year + '"' +
					(year == drawYear ? ' selected="selected"' : '') +
					'>' + (year-1911) + '</option>';
			}
			html += '</select>';
		}
		html += this._get(inst, 'yearSuffix');
		if (showMonthAfterYear)
			html += (secondary || !(changeMonth && changeYear) ? '&#xa0;' : '') + monthHtml;
		html += '</div>'; // Close datepicker_header
		return html;
	},
    _setDateFromField : function(inst)

    {

	   var dateFormat = this._get(inst, 'dateFormat');

       var dates = inst.input ? inst.input.val() : null;

       inst.endDay = inst.endMonth = inst.endYear = null;

       var date = defaultDate = this._getDefaultDate(inst);

       var settings = this._getFormatConfig(inst);

       try

       {

           var dateArr = dates.split("-");

           var year = parseInt(dateArr[0], 10) + 1911;

           var month = parseInt(dateArr[1], 10) - 1;

           var day = parseInt(dateArr[2], 10);
		   
           date = new Date(year, month, day);

       } catch (event)

       {

           this.log(event);

           date = defaultDate;

       }

       inst.selectedDay = date.getDate();

       inst.drawMonth = inst.selectedMonth = date.getMonth();

       inst.drawYear = inst.selectedYear = date.getFullYear();

       inst.currentDay = (dates ? date.getDate() : 0);

       inst.currentMonth = (dates ? date.getMonth() : 0);

       inst.currentYear = (dates ? date.getFullYear() : 0);
		
       this._adjustInstDate(inst);

    },
	
    _formatDate : function(inst, day, month, year)

    {

       if (!day)

       {

           inst.currentDay = inst.selectedDay;

           inst.currentMonth = inst.selectedMonth;

           inst.currentYear = inst.selectedYear;

       }

       var date = (day ? (typeof day == 'object' ? day :

               this._daylightSavingAdjust(new Date(year, month, day))) :

              this._daylightSavingAdjust(new Date(inst.currentYear, inst.currentMonth, inst.currentDay)));

       return (date.getFullYear() - 1911) + "-" +

              (date.getMonth() < 9 ? "0" + (date.getMonth() + 1) : (date.getMonth() + 1)) + "-" +

              (date.getDate() < 10 ? "0" + date.getDate() : date.getDate());

    }
});

$.datepicker.regional['zh-TW'] = {
	clearText: '清除', clearStatus: '清除已選日期',
	closeText: '關閉', closeStatus: '不改變目前的選擇',
	prevText: '&#x3c;上月', prevStatus: '顯示上月',
	prevBigText: '&#x3c;&#x3c;', prevBigStatus: '顯示上一年',
	nextText: '下月&#x3e;', nextStatus: '顯示下月',
	nextBigText: '&#x3e;&#x3e;', nextBigStatus: '顯示下一年',
	currentText: '今天', currentStatus: '顯示本月',
	monthNames: ['1月','2月','3月','4月','5月','6月',
	'7月','8月','9月','10月','11月','12月'],
	monthNamesShort: ['1月','2月','3月','4月','5月','6月',
	'7月','8月','9月','10月','11月','12月'],
	monthStatus: '選擇月份', yearStatus: '選擇年份',
	weekHeader: '周', weekStatus: '年內周次',
	dayNames: ['星期日','星期一','星期二','星期三','星期四','星期五','星期六'],
	dayNamesShort: ['日','一','二','三','四','五','六'],
	dayNamesMin: ['日','一','二','三','四','五','六'],
	dayStatus: '設定 DD 為一周起始', dateStatus: '選擇 m月 d日, DD',
	dateFormat: 'yy-mm-dd', firstDay: 1,
	initStatus: '請選擇日期', isRTL: false,
	showMonthAfterYear: true, yearSuffix: ''};
$.datepicker.setDefaults($.datepicker.regional['zh-TW']);

// Workaround for #4055
// Add another global to avoid noConflict issues with inline event handlers
window['DP_jQuery_' + dpuuid] = $;

})(jQuery);