<include file="Public/uc_header" />
<link rel="stylesheet" type="text/css" href="__CSS2__/icon.css">
<link rel="stylesheet" type="text/css" href="__CSS2__/securityCenter.css">

<div class="userbasic_head">
    <a href="{:U('Member/user_center')}">基本信息</a>
    <a href="{:U('Member/back_water')}" class="active">返水领取</a>
</div>
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-3">当前等级：</div>
    <div class="col-md-8"></div>
</div>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<include file="Public/uc_footer" />
