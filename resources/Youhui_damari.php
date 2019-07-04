<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{:GetVar('webtitle')}</title>
    <meta name="keywords" content="{:GetVar('keywords')}" />
    <meta name="description" content="{:GetVar('description')}" />
<meta name="renderer" content="webkit" />
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/reset.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/layout.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/artDialog.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/resources/css/font-awesome.min.css" />
<script type="text/javascript" src="__ROOT__/resources/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="__ROOT__/resources/js/artDialog.js"></script>
<!--[if lt IE 9]>
<script src="__ROOT__/resources/js/html5shiv.js"></script>
<![endif]-->
<script type="text/javascript" src="__ROOT__/resources/js/way.min.js"></script>
<script type="text/javascript" src="__ROOT__/resources/js/jquery.history.js"></script>
<script type="text/javascript" src="__ROOT__/resources/main/common.js"></script>

</head>
 
<body>

{include file="Public/header" /}
            <?php
			$riCommissionBase0_0 = GetVar('riCommissionBase0_0');
			$riCommissionBase0_1 = GetVar('riCommissionBase0_1');
			$riCommissionBase0_2 = GetVar('riCommissionBase0_2');
			
			$riCommissionBase1_0 = GetVar('riCommissionBase1_0');
			$riCommissionBase1_1 = GetVar('riCommissionBase1_1');
			$riCommissionBase1_2 = GetVar('riCommissionBase1_2');
			
			$riCommissionBase2_0 = GetVar('riCommissionBase2_0');
			$riCommissionBase2_1 = GetVar('riCommissionBase2_1');
			$riCommissionBase2_2 = GetVar('riCommissionBase2_2');
			
			$yueCommissionBase0_0 = GetVar('yueCommissionBase0_0');
			$yueCommissionBase0_1 = GetVar('yueCommissionBase0_1');
			$yueCommissionBase0_2 = GetVar('yueCommissionBase0_2');
			
			$yueCommissionBase1_0 = GetVar('yueCommissionBase1_0');
			$yueCommissionBase1_1 = GetVar('yueCommissionBase1_1');
			$yueCommissionBase1_2 = GetVar('yueCommissionBase1_2');
			
			$yueCommissionBase2_0 = GetVar('yueCommissionBase2_0');
			$yueCommissionBase2_1 = GetVar('yueCommissionBase2_1');
			$yueCommissionBase2_2 = GetVar('yueCommissionBase2_2');
			?>
    <div class="active5">
        <img src="__ROOT__/resources/images/youhui/fan_01.jpg" style="width:100%"/>
        <div class="active5_bg ">
            <div class="w1000  container">
                <div class="tc text-c">
                    <img src="__ROOT__/resources/images/youhui/word.png" /></div>
    <p style="color: #b72e04; font-size: 30px; margin-top: 25px; margin-bottom: 15px;">每日打码回馈比例如下：</p>
    <table cellpadding="0" cellspacing="0">
    <tr class="text-c">
    <th>序号</th>
    <th>最低打码反馈金额</th>
    <th>最高打码反馈金额</th>
    <th>本人奖励对应比例</th>
    <th>上家奖励对应比例</th>
    </tr>
    
    
    <tr>
    <td>1</td>
    <td>{:substr($riCommissionBase0_0,0,strpos($riCommissionBase0_0,'~'))}</td>
    <td>{:substr($riCommissionBase0_0,-strpos($riCommissionBase0_0,'~')-1)} </td>
    <td>{$riCommissionBase0_1}%</td>
    <td>{$riCommissionBase0_2}%</td>
    </tr>
    
    <tr>
    <td>2</td>
    <td>{:substr($riCommissionBase1_0,0,strpos($riCommissionBase1_0,'~'))}</td>
    <td>{:substr($riCommissionBase1_0,-strpos($riCommissionBase1_0,'~')-1)} </td>
    <td>{$riCommissionBase1_1}%</td>
    <td>{$riCommissionBase1_2}%</td>
    </tr>
    
    <tr>
    <td>3</td>
    <td>{:substr($riCommissionBase2_0,0,strpos($riCommissionBase2_0,'~'))}</td>
    <td>{:substr($riCommissionBase2_0,-strpos($riCommissionBase2_0,'~')-1)} </td>
    <td>{$riCommissionBase2_1}%</td>
    <td>{$riCommissionBase2_2}%</td>
    </tr>
    
    </table>

                
    <p style="color: #b72e04; font-size: 30px; margin-top: 25px; margin-bottom: 15px;">每月打码回馈比例如下：</p>
    <table cellpadding="0" cellspacing="0">
    <tr class="text-c">
    <th>序号</th>
    <th>最低打码反馈金额</th>
    <th>最高打码反馈金额</th>
    <th>本人奖励对应比例</th>
    <th>上家奖励对应比例</th>
    </tr>
    
    
    <tr>
    <td>1</td>
    <td>{:substr($yueCommissionBase0_0,0,strpos($yueCommissionBase0_0,'~'))}</td>
    <td>{:substr($yueCommissionBase0_0,-strpos($yueCommissionBase0_0,'~')-1)} </td>
    <td>{$yueCommissionBase0_1}%</td>
    <td>{$yueCommissionBase0_2}%</td>
    </tr>
    
    <tr>
    <td>2</td>
    <td>{:substr($yueCommissionBase1_0,0,strpos($yueCommissionBase1_0,'~'))}</td>
    <td>{:substr($yueCommissionBase1_0,-strpos($yueCommissionBase1_0,'~')-1)} </td>
    <td>{$yueCommissionBase1_1}%</td>
    <td>{$yueCommissionBase1_2}%</td>
    </tr>
    
    <tr>
    <td>3</td>
    <td>{:substr($yueCommissionBase2_0,0,strpos($yueCommissionBase2_0,'~'))}</td>
    <td>{:substr($yueCommissionBase2_0,-strpos($yueCommissionBase2_0,'~')-1)} </td>
    <td>{$yueCommissionBase2_1}%</td>
    <td>{$yueCommissionBase2_2}%</td>
    </tr>
    
    </table>

                <div class="tc mt-20 text-c" >
                    <a href="javascript:void(0);" class="active5_btn">
                        <img src="__ROOT__/resources/images/youhui/btn5.png" /></a>
                </div>
                <div class="tc text-c" style="color: #d4004c; font-size: 30px; font-weight: bold; margin-top: 40px;">以上如还不清楚者请和客服联系！谢谢合作！</div>
            </div>
        </div>
    </div>
{include file="Public/footer" /}
</body>
</html>