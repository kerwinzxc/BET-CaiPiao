<?php 
define('Copyright', '作者QQ:503064228');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/ExistUser.php';
global $Users, $LoginId;

$news = null;
$db=new DB();
$text = $db->query("SELECT g_text FROM g_news WHERE g_rank_show = 1 ORDER BY g_id DESC LIMIT 1 ", 0);
if ($text){
	$news = strip_tags($text[0][0]);
}
$name = isset($Users[0]['g_lock_1']) ? $Users[0]['g_s_name'] : $Users[0]['g_name'];

if(isset($_GET['act'])&&$_GET['act']=='online'){
global $Users, $LoginId;
$gnidr=$Users[0]['g_nid'];

$db=new DB();

$total1 = $db->query("SELECT g_name,g_count_time,g_out FROM g_user where g_out=1 and g_nid like '$gnidr%'", 1);
$total2 = $db->query("SELECT g_name,g_count_time,g_out FROM g_rank where g_out=1  and g_nid like '$gnidr%'", 1);
$total3 = $db->query("SELECT * FROM g_relation_user where g_out=1  and g_s_nid like '$gnidr%'", 1);
$total=count($total1)+count($total2)+count($total3);
echo $total;
}else{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/SystemControl/css/Index.css" rel="stylesheet" type="text/css"/>
<link href="/SystemControl/css/Top.css" rel="stylesheet" type="text/css"/>
<style>
<!--
#But_Html #a_span a{
    display: inline;
    float: left;
    margin-left: 4px;
    padding: 1px 6px;
    color:blue;
    text-decoration:none;
}
-->
</style>
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/SystemControl/ActionLib/js/sc.js"></script>

<script type="text/javascript">
<!--
function btCoppy(){ 
        var o=document.all.sUrl;
        window.clipboardData.setData("Text",o.innerText); 
        alert("复制成功!"); 
} 

function btCoppyw(){ 
        var o=document.all.sUrlw;
        window.clipboardData.setData("Text",o.innerText); 
        alert("复制成功!"); 
} 
	$(function(){
		$("#a_span").html(setHtml[2]);
	});
	var setHtml = new Array();
	var target = "mainFrame";
	var rul = "oddsFile.php";
	var rulgx = "oddsFile_gx.php";
	var rulnc = "oddsFilenc.php";
	var rulpk = "oddsFilepk.php";
	var rulk3 = "oddsFilek3.php";
    setHtml[0] = '<a href="'+rul+'?cid=1" target="'+target+'">第一球</a><span class="split">|</span>'+
						'<a href="'+rul+'?cid=2" target="'+target+'">第二球</a><span class="split">|</span>'+
						'<a href="'+rul+'?cid=3" target="'+target+'">第三球</a><span class="split">|</span>'+
						'<a href="'+rul+'?cid=4" target="'+target+'">第四球</a><span class="split">|</span>'+
						'<a href="'+rul+'?cid=5" target="'+target+'">第五球</a><span class="split">|</span>'+
						'<a href="'+rul+'?cid=6" target="'+target+'">第六球</a><span class="split">|</span>'+
						'<a href="'+rul+'?cid=7" target="'+target+'">第七球</a><span class="split">|</span>'+
						'<a href="'+rul+'?cid=8" target="'+target+'">第八球</a><span class="split">|</span>'+
						'<a href="oddsFile_LH.php?cid=9" target="'+target+'">總和、龍虎</a><span class="split">|</span>'+
						'<a href="oddsFile_LM.php?cid=10" target="'+target+'">連碼</a><span class="split">|</span>' +
						'<a href="Reckoning.php?tid=1" target="'+target+'">帳單</a>';
	setHtml[5] = '<a href="'+rulgx+'?cid=1" target="'+target+'">第一球</a><span class="split">|</span>'+
						'<a href="'+rulgx+'?cid=2" target="'+target+'">第二球</a><span class="split">|</span>'+
						'<a href="'+rulgx+'?cid=3" target="'+target+'">第三球</a><span class="split">|</span>'+
						'<a href="'+rulgx+'?cid=4" target="'+target+'">第四球</a><span class="split">|</span>'+
						'<a href="'+rulgx+'?cid=5" target="'+target+'">特码<span class="split">|</span></a>'+
						'<a href="oddsFile_LH_gx.php?cid=9" target="'+target+'">總和、龍虎</a><span class="split">|</span>'+
						'<a href="oddsFile_LM_gx.php?cid=10" target="'+target+'">連碼</a><span class="split">|</span>' +
						'<a href="Reckoning.php?tid=3" target="'+target+'">帳單</a>';
						
	 setHtml[7] = '<a href="'+rulnc+'?cid=1" target="'+target+'">第一球</a><span class="split">|</span>'+
						'<a href="'+rulnc+'?cid=2" target="'+target+'">第二球</a><span class="split">|</span>'+
						'<a href="'+rulnc+'?cid=3" target="'+target+'">第三球</a><span class="split">|</span>'+
						'<a href="'+rulnc+'?cid=4" target="'+target+'">第四球</a><span class="split">|</span>'+
						'<a href="'+rulnc+'?cid=5" target="'+target+'">第五球</a><span class="split">|</span>'+
						'<a href="'+rulnc+'?cid=6" target="'+target+'">第六球</a><span class="split">|</span>'+
						'<a href="'+rulnc+'?cid=7" target="'+target+'">第七球</a><span class="split">|</span>'+
						'<a href="'+rulnc+'?cid=8" target="'+target+'">第八球</a><span class="split">|</span>'+
						'<a href="oddsFile_LH_nc.php?cid=9" target="'+target+'">總和、家禽野兽</a><span class="split">|</span>'+
						'<a href="oddsFile_LM_nc.php?cid=10" target="'+target+'">連碼</a><span class="split">|</span>' +
						'<a href="Reckoning.php?tid=5" target="'+target+'">帳單</a>';
	setHtml[8] = '<a href="'+rulpk+'?cid=1" target="'+target+'">冠、亞軍 組合</a><span class="split">|</span>'+
						'<a href="'+rulpk+'?cid=2" target="'+target+'">三、四、伍、六名</a><span class="split">|</span>'+
						'<a href="'+rulpk+'?cid=3" target="'+target+'">七、八、九、十名</a><span class="split">|</span>'+
						'<a href="Reckoning.php?tid=6" target="'+target+'">帳單</a>';
						
						
	setHtml[9] = '<a href="'+rulk3+'?cid=1" target="'+target+'">大小骰寶</a><span class="split">|</span>'+
						'<a href="Reckoning.php?tid=7" target="'+target+'">帳單</a>';
						
    setHtml[1] = <?php if ($LoginId==89){?>'<a href="Actfor.php?cid=1" target="'+target+'">分公司</a><span class="split">|</span>'+<?php }?>
    					<?php if ($LoginId==89||$LoginId==56){?>'<a href="Actfor.php?cid=2" target="'+target+'">股東</a><span class="split">|</span>'+<?php }?>
    					<?php if ($LoginId==89||$LoginId==56||$LoginId==22){?>'<a href="Actfor.php?cid=3" target="'+target+'">總代理</a><span class="split">|</span>'+<?php }?>
    					<?php if ($LoginId==89||$LoginId==56||$LoginId==22||$LoginId==78){?>'<a href="Actfor.php?cid=4" target="'+target+'">代理</a><span class="split">|</span>'+<?php }?>
						'<a href="Actfor.php?cid=5" target="'+target+'">會員</a><span class="split">|</span>'+
						<?php if (!isset($Users[0]['g_lock_6'])){?>
						'<a href="AccountSon_List.php" target="'+target+'">子帳號</a>'+
						<?php }else if (isset($Users[0]['g_lock_6']) && $Users[0]['g_lock_6'] ==1){?>
						'<a href="AccountSon_List.php" target="'+target+'">子帳號</a>'+
						<?php }?>
						'';
	setHtml[2] = 
    <?php if (($LoginId==22||$LoginId==78||$LoginId==48||$LoginId==56) && !isset($Users[0]['g_lock_2'])) {?>
    					'<a href="CreditInfo.php" target="'+target+'">信用資料</a><span class="split">|</span>'+
    					<?php }?>
					    '<a href="LoginLog.php" target="'+target+'">登錄日記</a><span class="split">|</span>'+
						'<a href="UpdatePwd.php" target="'+target+'">變更密碼</a><span class="split">|</span>'
						<?php  if ($LoginId!=89 && $LoginId!=56 && $Users[0]['g_Immediate_lock'] == 1 && !isset($Users[0]['g_lock_3'])){?>
						+
						'<a href="AutoLet.php" target="'+target+'" style="color:red">自動補倉設定</a><span class="split">|</span>'+
						'<a href="Amend_Log.php" target="'+target+'">自動補倉更變記錄</a><span class="split">|</span>';
					    <?php } else if ($LoginId!=89 && $LoginId!=56 && isset($Users[0]['g_lock_3']) && $Users[0]['g_lock_3'] == 1) {?>
					    +
						'<a href="AutoLet.php" target="'+target+'" style="color:red">自動補倉設定</a><span class="split">|</span>'+
						'<a href="Amend_Log.php" target="'+target+'">自動補倉更變記錄</a><span class="split">|</span>';
					    <?php echo ';';}?>
	<?php if ($LoginId==89){?>
	setHtml[3] = 
						<?php if (!isset($Users[0]['g_lock_1_1'])){?>	 
						 '<a href="Manages.php" target="'+target+'">系統設置</a><span class="split">|</span>'+
						 <?php }else if (isset($Users[0]['g_lock_1_1']) && $Users[0]['g_lock_1_1'] == 1){?>
						 '<a href="Manages.php" target="'+target+'">系統設置</a><span class="split">|</span>'+
						 <?php }?>

						 <?php if (!isset($Users[0]['g_lock_1_1'])){?>
						 '<a href="oddsInfo.php" target="'+target+'">賠率設置</a><span class="split">|</span>'+
						 <?php }else if (isset($Users[0]['g_lock_1_1']) && $Users[0]['g_lock_1_2'] == 1){?>
						 '<a href="oddsInfo.php" target="'+target+'">賠率設置</a><span class="split">|</span>'+
						 <?php }?>
						 
						  <?php if (!isset($Users[0]['g_lock_1_1'])){?>
						 '<a href="OddsBC.php" target="'+target+'">盘賠率差設置</a><span class="split">|</span>'+
						 <?php }else if (isset($Users[0]['g_lock_1_1']) && $Users[0]['g_lock_1_2'] == 1){?>
						 '<a href="OddsBC.php" target="'+target+'">盘賠率差設置</a><span class="split">|</span>'+
						 <?php }?>

						 <?php if (!isset($Users[0]['g_lock_1_1'])){?>
						 '<a href="newsInfo.php" target="'+target+'">公告設置</a><span class="split">|</span>'+
						 <?php }else if (isset($Users[0]['g_lock_1_1']) && $Users[0]['g_lock_1_3'] == 1){?>
						 '<a href="newsInfo.php" target="'+target+'">公告設置</a><span class="split">|</span>'+
						 <?php }?>

						 <?php if (!isset($Users[0]['g_lock_1_1'])){?>
						 '<a href="CrystalInfo.php" target="'+target+'">注單設置</a><span class="split">|</span>'+
						 <?php }else if (isset($Users[0]['g_lock_1_1']) && $Users[0]['g_lock_1_4'] == 1){?>
						 '<a href="CrystalInfo.php" target="'+target+'">注單設置</a><span class="split">|</span>'+
						 <?php }?>

						 <?php if (!isset($Users[0]['g_lock_1_1'])){?>
						 '<a href="NumbeInclude.php" target="'+target+'">開獎設置</a><span class="split">|</span>'+
						 <?php }else if (isset($Users[0]['g_lock_1_1']) && $Users[0]['g_lock_1_5'] == 1){?>
						 '<a href="NumbeInclude.php" target="'+target+'">開獎設置</a><span class="split">|</span>'+
						 <?php }?>

						 <?php if (!isset($Users[0]['g_lock_1_1'])){?>
						 '<a href="NumberInclude.php" target="'+target+'">開盤設置</a><span class="split">|</span>'+
						 <?php }else if (isset($Users[0]['g_lock_1_1']) && $Users[0]['g_lock_1_6'] == 1){?>
						 '<a href="NumberInclude.php" target="'+target+'">開盤設置</a><span class="split">|</span>'+
						 <?php }?>
						 
						 <?php if (!isset($Users[0]['g_lock_1_1'])){?>
						 '<a href="mrp.php" target="'+target+'">默认退水設置</a><span class="split">|</span>'+
						 <?php }else if (isset($Users[0]['g_lock_1_1']) && $Users[0]['g_lock_1_6'] == 1){?>
						 '<a href="mrp.php" target="'+target+'">默认退水設置</a><span class="split">|</span>'+
						 <?php }?>

						 <?php if (!isset($Users[0]['g_lock_1_1'])){?>
						 '<a href="dataBak.php" target="'+target+'">數據備份</a><span class="split">|</span>'+
						 <?php }else if (isset($Users[0]['g_lock_1_1']) && $Users[0]['g_lock_1_7'] == 1){?>
						 '<a href="dataBak.php" target="'+target+'">數據備份</a><span class="split">|</span>'+
						 <?php }?>
						 '';
	 					 <?php }?>
	setHtml[4] = '<a href="oddsFilecq.php" target="'+target+'">總項盤口</a><span class="split">|</span>'+
							   '<a href="Reckoning.php?tid=2" target="'+target+'">帳單</a>';
							   
	setHtml[6] = '<a href="oddsFilejx.php" target="'+target+'">總項盤口</a><span class="split">|</span>'+
							   '<a href="Reckoning.php?tid=4" target="'+target+'">帳單</a>';
	function Loading_But (str){
		var a_span = $("#a_span");
		switch (str) {
			case 1 :
				var lt = document.getElementById("LT");
				if (lt.value == 1){
					a_span.html(setHtml[0]); 
				} else if(lt.value == 3){
					a_span.html(setHtml[5]); 
				}else if(lt.value == 4){
					a_span.html(setHtml[6]); 
				}else if(lt.value == 5){
					a_span.html(setHtml[7]); 
				}
				else  if(lt.value == 6){
					a_span.html(setHtml[8]); 
				}
				else  if(lt.value == 7){
					a_span.html(setHtml[9]); 
				}else {
					a_span.html(setHtml[4]); 
				}
				break;
			case 2 :a_span.html(setHtml[1]); break;
			case 3 :a_span.html(setHtml[2]); break;
			<?php if ($LoginId==89){?>
			case 4 :a_span.html(setHtml[3]); break;
			<?php }?>
		}
	}
	function GoForm (url){
	var f=document.createElement("form");
			f.action=url;
			f.target="mainFrame";
			f.method="get";
			document.body.appendChild(f);
			f.submit();
	}
	function selectType(p_type,target){
		$("#LT").val(p_type);
		//$("#bST_1").removeClass("bST_3_s");
		//$("#bST_2").removeClass("bST_3_s");
		//$("#bST_3").removeClass("bST_3_s");
		//$("#bST_4").removeClass("bST_3_s");
		//$("#bST_5").removeClass("bST_3_s");
		//$("#bST_6").removeClass("bST_3_s");
		//$("#bST_7").removeClass("bST_3_s");
		//$("#bST_"+p_type).addClass("bST_3_s");
		$('.switch').removeClass('switch-on');   $(target).addClass('switch-on');
		$.post("/SystemControl/ActionLib/ajax/json.php", {typeid : "gameCode", id : p_type }, function(data){
			Loading_But (1);
		});
	}
//-->
</script>
<title></title>
<style type="text/css">
<!--
.STYLE1 {color: #FF0000}
.but_1,.but_1_m{
	cursor:pointer;
}
-->
</style>
</head>
<form action="">
<body onselectstart="return false" oncut="return false" oncopy="return false">
<table width="100%" border="0" cellSpacing="0" cellPadding="0">
<tr><td width="10%" rowspan="2"></td>
<td width="90%">
<table width="100%" border="0" cellSpacing="0" cellPadding="0">
<TBODY>
<TR>
<TD height=10 width="84%">
<TABLE class=header border=0 cellSpacing=0 cellPadding=0 width="100%">
<TBODY>
<TR>
<TD noWrap class="top-op"><SPAN class=tleft></SPAN><SPAN><A class="switch switch-on" onclick=selectType(1,this);>廣東快樂十分<B></B></A></SPAN> <SPAN><A class=switch onclick=selectType(2,this);>重慶時時彩<B></B></A></SPAN> <SPAN><A class=switch onclick=selectType(6,this);>北京賽車<B></B></A></SPAN> <SPAN><A class=switch onclick=selectType(5,this);>幸运农场<B></B></A></SPAN> <SPAN><A class=switch onclick=selectType(7,this);>江苏骰寶<B></B></A></SPAN> <SPAN class="split gray">|</SPAN> <SPAN class="blue bold">在线： <SPAN id=online_num class=yel2>1</SPAN></SPAN>
<DIV class="right gray"><SPAN class=user_logo></SPAN>账号：<SPAN id=member_id><?php echo $name.','.$Users[0]['g_Lnid'][0]?></SPAN> <A id=logout class=logout-link href="Quit.php" target=_top>退出</A> </DIV></TD></TR>
<TR>
<TD class=marquee>
<P class=left></P>
<P class=marqueeBox>
<marquee whdth="100%" onmouseout="this.start()" onmouseover="this.stop()" scrolldelay="120" scrollamount="5" style="position: relative; top: 2px"><?php 
			if($LoginId==89) {?>
			<a target="mainFrame" href="NewsInfo.php"><font class="Font_Count" id="Affiche"><?php echo $news?></font></a>
			<?php } else { ?>
			<font class="Font_Count" id="Affiche"><?php echo $news?>
			<?php } ?>
</marquee></P><SPAN class=kefu_announce><A class="more more_announcement" href="newFile.php" target=mainFrame>更多</A>&nbsp; |&nbsp;&nbsp; </SPAN></TD></TR></TBODY></TABLE></TD></TR></TBODY>
</table>

</td>
</tr><tr><td>
<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tr>
    <td width="94%" height="26" valign="top">
<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tr>
    <td height="26" style="text-align:left;" class="navbtn">
                        	<?php if (($Users[0]['g_Immediate2_lock'] == 1 || $Users[0]['g_login_id']==89) && !isset($Users[0]['g_lock_4'])) {?>
                        	<input type="button" value="即時註單" onmouseover="this.className='but_1_m'" onmouseout="this.className='but_1'" onclick="Loading_But(1);" name="but_1" class="but_1">
                            <?php }else if ($Users[0]['g_lock_4'] == 1){?>
                           <input type="button" value="即時註單" onmouseover="this.className='but_1_m'" onmouseout="this.className='but_1'" onclick="Loading_But(1);" name="but_1" class="but_1">
                            <?php }?>
                        	<?php if (isset($Users[0]['g_lock_2'])) {
                            	if ($Users[0]['g_lock_2'] == 1){
                            	?>
                            <input type="button" value="用戶管理" onmouseover="this.className='but_1_m'" onmouseout="this.className='but_1'" onclick="Loading_But(2);" name="but_2" class="but_1">
                            <?php }}else{?>
                           <input type="button" value="用戶管理" onmouseover="this.className='but_1_m'" onmouseout="this.className='but_1'" onclick="Loading_But(2);" name="but_2" class="but_1">
                            <?php }?>
                          <input type="button" value="個人管理" onmouseover="this.className='but_1_m'" onmouseout="this.className='but_1'" onclick="Loading_But(3);" name="but_3" class="but_1">
                            <?php if ($LoginId==89 && !isset($Users[0]['g_lock_1'])){?>
                            <input type="button" value="内部管理" onmouseover="this.className='but_1_m'" onmouseout="this.className='but_1'" onclick="Loading_But(4);" name="but_4" class="but_1">
                            <?php }else if (isset($Users[0]['g_lock_1']) && $Users[0]['g_lock_1'] == 1){?>
                           <input type="button" value="内部管理" onmouseover="this.className='but_1_m'" onmouseout="this.className='but_1'" onclick="Loading_But(4);" name="but_4" class="but_1">
                            <?php }?>
                             <?php if (isset($Users[0]['g_lock_5'])) {
                            	if ($Users[0]['g_lock_5'] == 1){?>
	<input type="button" value="報表查詢" onmouseover="this.className='but_1_m'" onmouseout="this.className='but_1'" onclick="GoForm('Report_Center.php');" name="but_5" class="but_1">
                            	<?php }}else {?>
	<input type="button" value="報表查詢" onmouseover="this.className='but_1_m'" onmouseout="this.className='but_1'" onclick="GoForm('Report_Center.php');" name="but_5" class="but_1">
                            	<?php }?>
	<input type="button" value="歷史開獎" onmouseover="this.className='but_1_m'" onmouseout="this.className='but_1'" onclick="GoForm('Lottery_Result.php');" name="but_6" class="but_1">
	<input type="button" value="站內消息" onmouseover="this.className='but_1_m'" onmouseout="this.className='but_1'" onclick="GoForm('newFile.php');" name="but_7" class="but_1">
	<input type="button" value="在线人数" onmouseover="this.className='but_1_m'" onmouseout="this.className='but_1'" onclick="GoForm('online.php');" name="but_9" class="but_1">
							<?php if($Users[0]['g_login_id']==89){?>
	<input type="button" value="客服中心" onmouseover="this.className='but_1_m'" onmouseout="this.className='but_1'" onclick="GoForm('gkfzx.php');" name="but_10" class="but_1">
							<?php } else{
							?>
	<input type="button" value="客服中心" onmouseover="this.className='but_1_m'" onmouseout="this.className='but_1'" onclick="GoForm('kfzx.php');" name="but_10" class="but_1">
							<?php
							}?>
	<input type="button" value="系统退出" onmouseover="this.className='but_1_m'" onmouseout="this.className='but_1'" onclick="top.location.href='Quit.php';" name="but_8" class="but_1"></td>
	    </tr>
</tbody></table></td></tr>
</table>


	</td>
  </tr>
  <tr>
    <td height="28" colspan="2"><table width="100%" cellspacing="0" cellpadding="0" border="0">
      <tbody><tr>
        <td  rowspan="2" class="buthtml" id="But_Html"><span id="a_span" ></span></td>
      </tr>
    </table></td>
  </tr>
</tbody></table>
		<input type="hidden" id="LT" name="LT" value="1" />
<script type="text/javascript">
$('.switch-on').trigger('click'); 
var tm=2000; 
function refreshOnline(){  $.get('topMenu.php?act=online&d='+escape(new Date()),function(data){  
				 $('#online_num').html( data );  
				 setTimeout(refreshOnline,tm);  });
				   } 
				   refreshOnline();
				   </script>

</body>
</html>
<?php }?>