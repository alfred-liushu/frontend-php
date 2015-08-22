<!--
Pick up dates using bootstrap-datetimepicker
@author	liushu@qinggukeji.com
//-->

<link href="//cdn.bootcss.com/bootstrap-datetimepicker/2.1.30/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script src="//cdn.bootcss.com/moment.js/2.10.6/moment-with-locales.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap-datetimepicker/4.15.35/js/bootstrap-datetimepicker.min.js"></script>

<script>
  $(function () {
    $(<?='"#start_' . $suffix . '"'?>).datetimepicker({
      locale: "zh-CN",
      format: "YYYY-MM-DD",
      dayViewHeaderFormat: "YYYY MMMM",
      minDate: moment(),
      disabledDates: [moment()],
      useCurrent: false
    });
    $(<?='"#end_' . $suffix . '"'?>).datetimepicker({
      locale: "zh-CN",
      format: "YYYY-MM-DD",
      dayViewHeaderFormat: "YYYY MMMM",
      minDate: moment(),
      disabledDates: [moment()],
      useCurrent: false
    });
    $(<?='"#start_' . $suffix . '"'?>).on("dp.change", function (e) {
      $(<?='"#end_' . $suffix . '"'?>).data("DateTimePicker").minDate(e.date);
    });
    $(<?='"#end_' . $suffix . '"'?>).on("dp.change", function (e) {
      $(<?='"#start_' . $suffix . '"'?>).data("DateTimePicker").maxDate(e.date);
    });
  });
</script>