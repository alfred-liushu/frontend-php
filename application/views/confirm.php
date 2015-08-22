<!--
Confirm popup
@author	liushu@qinggukeji.com
//-->

<script src="//cdn.bootcss.com/bootstrap-confirmation/1.0.3/bootstrap-confirmation.js"></script>

<script>
  $("<?='[data-toggle=\"confirm_' . $suffix . '\"]'?>").confirmation({
    title: "<?=$message?>",
    placement: "bottom",
    btnOkLabel: "<?=lang('confirm')?>",
    btnCancelLabel: "<?=lang('cancel')?>",
    popout: true
  });
</script>
