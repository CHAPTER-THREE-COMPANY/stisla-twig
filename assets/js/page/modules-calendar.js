"use strict";

var data_url = ""+kyoten+"/data";
var date_start;
var date_end;

$("#myCalender").fullCalendar({
    height: 'auto',
    //plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'moment' ],
    locale: 'ja',

    defaultView: 'listWeek',
    header: {
        left: 'title',
        center: 'month,listWeek',
        //center: 'month,agendaWeek,agendaDay,listWeek',
        right: 'today prev,next'
        //right: 'month,basicWeek,basicDay,agendaWeek,agendaDay,listWeek'
    },
    views: {
        month: {
            eventLimit: 5, // adjust to 6 only for month
            // LimitText
            eventLimitText: "その他",
            timeFormat: " "
        }
    },
    // 月名称
    monthNames: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
    timeFormat: "H:mm",
    titleRangeSeparator: ' 〜 ',
    // 月曜日(1)始まり
    firstDay: 1,
    // スクロール開始時間
    firstHour: 9,
    // 最小時間
    minTime: "09:00:00",
    // 最大時間
    maxTime: "21:00:00",
    // スクロールの中心位置
    //scrollTime: "12:00:00",
    // 過去の日付表示の有無
    //showNonCurrentDates: false,
    // ドラッグ移動 Mode
    //editable: true,
    //
    eventOverlap: false,
    //events: data_url,
    event2Sources: [{
        url: data_url,
        type: 'GET',
        cache: false
    }],

    even2ts: function(start, end, timezone, callback) {

      $.ajax({
          url: data_url,
          type: 'get',
          dataType: 'text',
          cache: false,
          data: {
              start: start.format('YYYY-MM-DD'),
              end: end.format('YYYY-MM-DD')
          },
          success: function(data) {
              // JSONパース
              var obj = jQuery.parseJSON(data);
              var events = [];

              $.each(obj, function(index, value) {
                  events.push({
                      // イベント情報をセット
                      id: value['id'],
                      title: value['title'],
                      //description: value['description'],
                      start: value['start'],
                      end: value['end'],
                      //color: value['color'],
                      textColor: value['textColor']
                  });
              });

              // コールバック設定
              callback(events);
          }
      })
    },

    loading: function(bool) {
        if (bool) $('#loading').show();
        else $('#loading').hide();
    },
    view3Display: function (view) {//Dynamic data found, according to the monthly dynamic query
        var viewStart = $.fullCalendar.formatDate(view.start, "yyyy-MM-dd HH:mm:ss");
        var viewEnd = $.fullCalendar.formatDate(view.end, "yyyy-MM-dd HH:mm:ss");
        $("#myCalender").fullCalendar('removeEvents');
        alert('The new title2 of the view is ' + view.title);
        $.post(data_url, { start: viewStart, end: viewEnd }, function (data) {

            var resultCollection = jQuery.parseJSON(data);
            $.each(resultCollection, function (index, term) {
                $("#myCalender").fullCalendar('renderEvent', term, true);
            });
        });

    },
    eventRender: function(eventObj, $element) {
        var titleStr = $element.find('.fc-list-item-title').text(), // htmlタグを含むtitleの文字列を取得
            $eventElem = $element.find('.fc-list-item-title');

        //$element.html(titleStr);
        $eventElem.html(titleStr); // htmlとして出力
    },
    viewRender: (function () {
        var lastViewName;
        /*$('#myCalender').fullCalendar('option', 'validRange', {
            // Don't worry if user didn't provide *any* inputs.
            start: '2019-08-26',
            end: '2019-09-01'
        });*/
        $('#myCalender').fullCalendar('option', 'validRange', {
            start: '2019-08-26',
            end: '2019-09-01'
        });
        return function (view) {
            //var view = $("#myCalender").fullCalendar('getView');
            //view.unrenderDates();
            //view.renderDates();
            console.log(view.start.format('YYYY-MM-DD')+":"+view.end.format('YYYY-MM-DD'));
            date_start = view.start.format('YYYY-MM-DD');
            date_end = view.end.format('YYYY-MM-DD');
            //alert('The new title of the view is ' + view.start.format('YYYY-MM-DD')+" - "+view.end.format('YYYY-MM-DD'));
            $("#myCalender").fullCalendar( 'removeEventSources' );
            $("#myCalender").fullCalendar( 'removeEvents' );
            $("#myCalender").fullCalendar( 'addEventSource',
                function(start, end, timezone, callback) {
                    // ***** ここでカレンダーデータ取得JSを呼ぶ *****
                    console.log(start.format('YYYY-MM-DD')+" : "+end.format('YYYY-MM-DD'));
                    var view = $("#myCalender").fullCalendar('getView');
                    console.log(view+" + ");
                    //alert(view.start.format('YYYY-MM-DD') + " : " + view.end.format('YYYY-MM-DD'));
                    setCalendarList(start, end, callback);
                }
            );
            //$("#myCalender").fullCalendar({eventOverlap:false});
            //$("#myCalender").fullCalendar('rerenderEvents');
            //view.start='2019-08-26';
            //view.end='2019-09-01';
            //$('#myCalender').events.start = new Date('2019-08-26');
            //$('#myCalender').events.end = new Date('2019-09-01');
            //$('#myCalender').fullCalendar('refetchEventSources', data_url+"?start="+view.start.format('YYYY-MM-DD')+"&end="+view.end.format('YYYY-MM-DD'))
        }
    })(),

});

/**
 * 対象日付スケジュールデータセット処理
 * @param {type} startDate
 * @param {type} endDate
 * @param {type} callback
 * @returns {undefined}
 */
function setCalendarList(startDate, endDate, callback) {

    $.ajax({
        type: 'get',
        dataType : "text",
        async: true,
        cache: false,
        url : data_url+"?start="+date_start+"&end="+date_end,
        //url : data_url+"?start="+startDate+"&end="+endDate
        success: function(data) {
            // JSONパース
            var obj = jQuery.parseJSON(data);
            var events = [];

            $.each(obj, function(index, value) {
                events.push({
                    // イベント情報をセット
                    id: value['id'],
                    title: value['title'],
                    //description: value['description'],
                    start: value['start'],
                    end: value['end'],
                    //color: value['color'],
                    textColor: value['textColor'],
                    textEscape: false
                });
            });

            // コールバック設定
            callback(events);
        }
    });

    return;
}


$("#myEvent3").fullCalendar({
    locale: 'ja',
    resourceAreaWidth: 230,
    now: '2019-08-07',
    editable: true,
    aspectRatio: 1.5,
    scrollTime: '00:00',
    header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,basicDay,agendaDay,listWeek'
    },
    defaultView: 'month',
});


$("#myEvent4").fullCalendar({
      // ヘッダーのタイトルとボタン
      header: {
        // title, prev, next, prevYear, nextYear, today
        left: 'prev,next today',
        center: 'title',
        right: 'month agendaWeek agendaDay'
      },
      // jQuery UI theme
      theme: false,
      // 最初の曜日
      firstDay: 1, // 1:月曜日
      // 土曜、日曜を表示
      weekends: true,
      // 週モード (fixed, liquid, variable)
      weekMode: 'fixed',
      // 週数を表示
      weekNumbers: false,
      // 高さ(px)
      //height: 700,
      // コンテンツの高さ(px)
      //contentHeight: 600,
      // カレンダーの縦横比(比率が大きくなると高さが縮む)
      //aspectRatio: 1.35,
      // ビュー表示イベント
      viewDisplay: function(view) {
        //alert('ビュー表示イベント ' + view.title);
      },
      // ウィンドウリサイズイベント
      windowResize: function(view) {
        //alert('ウィンドウリサイズイベント');
      },
      // 日付クリックイベント
      dayClick: function () {
        //alert('日付クリックイベント');
      },
      // 初期表示ビュー
      defaultView: 'month',
      // 終日スロットを表示
      allDaySlot: true,
      // 終日スロットのタイトル
      allDayText: '終日',
      // スロットの時間の書式
      axisFormat: 'H(:mm)',
      // スロットの分
      slotMinutes: 15,
      // 選択する時間間隔
      snapMinutes: 15,
      // TODO よくわからない
      //defaultEventMinutes: 120,
      // スクロール開始時間
      firstHour: 9,
      // 最小時間
      minTime: 6,
      // 最大時間
      maxTime: 20,
      // 表示する年
      year: 2012,
      // 表示する月
      month: 12,
      // 表示する日
      day: 31,
      // 時間の書式
      timeFormat: 'H(:mm)',
      // 列の書式
      columnFormat: {
        month: 'ddd',    // 月
        week: "d'('ddd')'", // 7(月)
        day: "d'('ddd')'" // 7(月)
      },
      // タイトルの書式
      titleFormat: {
        month: 'yyyy年M月',                             // 2013年9月
        week: "yyyy年M月d日{ ～ }{[yyyy年]}{[M月]d日}", // 2013年9月7日 ～ 13日
        day: "yyyy年M月d日'('ddd')'"                  // 2013年9月7日(火)
      },
      // ボタン文字列
      buttonText: {
        prev:     '&lsaquo;', // <
        next:     '&rsaquo;', // >
        prevYear: '&laquo;',  // <<
        nextYear: '&raquo;',  // >>
        today:    '今日',
        month:    '月',
        week:     '週',
        day:      '日'
      },
      // 月名称
      monthNames: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
      // 月略称
      monthNamesShort: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
      // 曜日名称
      dayNames: ['日曜日', '月曜日', '火曜日', '水曜日', '木曜日', '金曜日', '土曜日'],
      // 曜日略称
      dayNamesShort: ['日', '月', '火', '水', '木', '金', '土'],
      // 選択可
      selectable: true,
      // 選択時にプレースホルダーを描画
      selectHelper: true,
      // 自動選択解除
      unselectAuto: true,
      // 自動選択解除対象外の要素
      unselectCancel: '',
      // イベントソース
      eventSources: [
        {
          events: [
            {
              title: 'event1',
              start: '2019-06-01'
            },
            {
              title: 'event2',
              start: '2019-06-02',
              end: '2019-06-03'
            },
            {
              title: 'event3',
              start: '2019-06-05 12:30:00',
              allDay: false // will make the time show
            }
          ]
        }
      ]
    });
    // 動的にオプションを変更する
    //$('#calendar').fullCalendar('option', 'height', 700);

    // カレンダーをレンダリング。表示切替時などに使用
    //$('#calendar').fullCalendar('render');

    // カレンダーを破棄（イベントハンドラや内部データも破棄する）
    //$('#calendar').fullCalendar('destroy')
