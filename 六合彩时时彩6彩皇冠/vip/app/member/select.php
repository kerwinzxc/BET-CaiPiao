<?
session_start();
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");      
header("Pragma: no-cache");
header("Content-type: text/html; charset=utf-8");
include "./include/address.mem.php";
require ("./include/config.inc.php");
include "./include/login_session.php";
$uid=$_REQUEST['uid'];
$langx=$_SESSION['langx'];
$live=$_REQUEST['live'];
require ("./include/traditional.$langx.inc.php");
$sql = "select * from web_member_data where Oid='$uid' and Status<=1";
$result = mysql_db_query($dbname,$sql);
$row = mysql_fetch_array($result);
$cou=mysql_num_rows($result);
$Status=$row['Status'];
if($cou==0){
	echo "<script>window.open('".BROWSER_IP."/tpl/logout_warn.html','_top')</script>";
	exit;
}else{
	$memname=$row['UserName'];
	$loginname=$row['LoginName'];
	$langx=$row['Language'];
	$logindate=date("Y-m-d");
	$datetime=date('Y-m-d h:i:s');
	if ($row['LoginDate']!=$logindate){
		$credit=$row['Credit'];
		$sql="update web_member_data set LoginTime='$datetime', Money='$credit' where UserName='$memname' and Pay_Type=0";
		mysql_db_query($dbname,$sql) or die ("error!");
	}else{
		$credit=$row['Money'];
	}
}

$show=$_REQUEST['show'];
if ($show==''){
	$show='N';
}

if($show=='Y'){
   $chk_fun='Show';
   $open='visible';
}else if($show=='N'){
   $chk_fun='None';
   $open='hidden';
}
if($row['Pay_Type']==0){
	$sel_line="$Sel_Credit_Line";
}else if($row['Pay_Type']==1){
	$sel_line="$Sel_Cash_Line";
}
?>
<script>
var username = '<?=$memname?>';
var maxcredit = '<?=$credit?>';
var currency = '<?=$row['CurType']?>';
var chk_fun = '';
var pass_safe = '<?=$loginname?>';
chk_fun = '<?=$chk_fun?>';
var show_live = false;
show_live = true;
</script>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Welcome</title>
<style type="text/css">
body {
    margin-left: 0px;
    margin-top: 10px;
    margin-right: 0px;
    margin-bottom: 0px;
    background-color: #FFF;
    
}
.f_12_02{color: #224c05; line-height:25px;font-size:12px;}
.f_12_02:link { TEXT-DECORATION:none; color: #224c05; line-height:25px;font-size:12px;}
.f_12_02:visited { COLOR: #224c05; text-decoration: none; line-height:25px;font-size:12px;}
.f_12_02:active { COLOR: #FF8F19; TEXT-DECORATION: none; line-height:25px;font-size:12px;}
.f_12_02:hover { COLOR: #FF8F19; TEXT-DECORATION: none; line-height:25px;font-size:12px;}
</style>
<SCRIPT src="/js/header.js" type=text/javascript></SCRIPT>
<script language="javascript" src="/js/jquery.js"></script>
<script language="Javascript">
document.oncontextmenu=new Function("event.returnValue=false");
document.onselectstart=new Function("event.returnValue=false");
</script>
</head>
<body>
<script language="javascript">
var old_menu = ''
var old_cell = '';
var type = "";
var betType = 0;
var gg = "";
var flag = 0;

window.onload = function() {
    getRequestUrl();
    if (type != "") {
        if (type < 1 || type > 8)
            type = 1;
        menuclick('submenu' + type + '', 'cellbar' + type + '');
    }
    else{
        menuclick('submenu1', 'cellbar1');
	}
	
	$.ajax({
		type: "POST",
		url: "",
		dataType: "text",
		cache:false,
		success: function(msg){
			msg=trim(msg);
			var Num_Array = msg.split(',');
			for(var j=0;j<Num_Array.length;j++){
				if(j<10){
				$("#Num0"+j).empty(); 
				$("#Num0"+j).append("("+Num_Array[j]+")"); 	
				}else{
				$("#Num"+j).empty(); 
				$("#Num"+j).append("("+Num_Array[j]+")"); 
				}
			}
		}
	}); 	
}


function trim(ui){ 
        var notValid=/(^\s)|(\s$)/; 
        while(notValid.test(ui)){ 
                ui=ui.replace(notValid,"");
        } 
        return ui;
} 


function menuclick(submenu, cellbar) {
    if (old_menu != submenu) {
        if (old_menu != '') {
            document.getElementById(old_menu).style.display = 'none';
            document.getElementById(old_cell).src = '/images/jia.jpg';
        }
        document.getElementById(submenu).style.display = 'block';
        document.getElementById(cellbar).src = '/images/jian.jpg';
        old_menu = submenu;
        old_cell = cellbar;
		iFrameHeight1();
    }else {
        document.getElementById(submenu).style.display = 'none';
        document.getElementById(cellbar).src = '/images/jia.jpg';
        old_menu = '';
        old_cell = '';
		iFrameHeight1();
    }
}
function getRequestUrl() {
    var url = location.href;
    var paraString = url.substring(url.indexOf("?") + 1, url.length).split("&");

    var paraObj = {}
    for (i = 0; j = paraString[i]; i++) {
        switch (j.substring(0, j.indexOf("=")).toLowerCase()) {
            case 'bettype': betType = j.substring(j.indexOf("=") + 1, j.length); break;
            case 'type': type = j.substring(j.indexOf("=") + 1, j.length); break;
            case 'gg': gg = j.substring(j.indexOf("=") + 1, j.length); break;
            case 'flag': flag = j.substring(j.indexOf("=") + 1, j.length); break;
        }
    }
}

</script>
<script language="javascript">
function iFrameHeight1() { 
var ifm= parent.document.getElementById("mem_order"); 
var subWeb = parent.document.frames ? parent.document.frames["mem_order"].document : ifm.contentDocument; 
if(ifm != null && subWeb != null) { 
ifm.height = subWeb.body.scrollHeight; 
} 
}
</script>
<table width="240" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="/images/s7.gif.pagespeed.ce.jjgGNhULWr.gif" width="240" height="37"/></td>
  </tr>
  <tr>
    <td valign="top" background="/images/l_03.jpg">
    <table width="240" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr id="cellbar1">
        <td id="bar1" onClick="menuclick('submenu1','cellbar1')"><img src="/images/240x24xleft_01.jpg.pagespeed.ic.Vwxx5Qs7nB.jpg" width="240" height="24" style="cursor:pointer;"/></td>
      </tr>
      <tr id="submenu1" style="display:none;">
        <td background="/images/left_01_bj.jpg" bgcolor="#fefacd" width="240">
        <table width="140" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/FT_browse/index.php?rtype=r&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3&showtype=<?=$showtype?>');" class="f_12_02">单式</a></td>
          	<td class="f_12_02" id="Num00">&nbsp;</td>
          </tr>
          <tr>
          	<td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/FT_browse/index.php?rtype=hr&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3&showtype=<?=$showtype?>');" class="f_12_02"><?=$half_1st?></a></td>
          	<td class="f_12_02" id="Num01">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/FT_browse/index.php?rtype=re&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3&showtype=<?=$showtype?>');" class="f_12_02">滚球</a></td>
          	<td class="f_12_02" id="Num02">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/FT_browse/index.php?rtype=pd&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3&showtype=<?=$showtype?>');" class="f_12_02">波胆</a></td>
            <td class="f_12_02" id="Num03">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/FT_browse/index.php?rtype=hpd&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3&showtype=<?=$showtype?>');" class="f_12_02">上半波胆</a></td>
            <td class="f_12_02" id="Num04">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/FT_browse/index.php?rtype=t&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3&showtype=<?=$showtype?>');" class="f_12_02">入球数</a></td>
            <td class="f_12_02" id="Num05">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/FT_browse/index.php?rtype=f&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3&showtype=<?=$showtype?>');" class="f_12_02">半全场</a> </td>
            <td class="f_12_02" id="Num06">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/FT_browse/index.php?rtype=p3&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3&showtype=<?=$showtype?>');" class="f_12_02">综合过关</a></td>
            <td class="f_12_02" id="Num07">&nbsp;</td>
          </tr>
        </table>
        </td>
      </tr>
      <tr id="cellbar11">
        <td id="bar11" onClick="menuclick('submenu11','cellbar11')"><img src="/images/240x24xleft_11.jpg.pagespeed.ic.dO1CzqJV4P.jpg" width="240" height="24" style="cursor:pointer;"/></td>
      </tr>
      <tr id="submenu11" style="display:none;">
        <td background="/images/left_01_bj.jpg" bgcolor="#fefacd" width="240">
        <table width="140" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/FT_future/index.php?rtype=r&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3&showtype=<?=$showtype?>');" class="f_12_02">单式</a></td>
            <td class="f_12_02" id="Num08">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/FT_future/index.php?rtype=hr&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3&showtype=<?=$showtype?>');" class="f_12_02"><?=$half_1st?></a></td>
            <td class="f_12_02" id="Num09">&nbsp;</td>
          </tr>          
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/FT_future/index.php?rtype=pd&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3&showtype=<?=$showtype?>');" class="f_12_02">波胆</a></td>
            <td class="f_12_02" id="Num10">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/FT_future/index.php?rtype=hpd&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3&showtype=<?=$showtype?>');" class="f_12_02">上半波胆</a></td>
            <td class="f_12_02" id="Num11">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/FT_future/index.php?rtype=t&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3&showtype=<?=$showtype?>');" class="f_12_02">入球数</a></td>
            <td class="f_12_02" id="Num12">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/FT_future/index.php?rtype=f&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3&showtype=<?=$showtype?>');" class="f_12_02">半全场</a> </td>
            <td class="f_12_02" id="Num13">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/FT_future/index.php?rtype=p3&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3&showtype=<?=$showtype?>');" class="f_12_02">综合过关</a></td>
            <td class="f_12_02" id="Num14">&nbsp;</td>
          </tr>
        </table>
        </td>
      </tr>
      <tr id="cellbar2">
        <td id="bar2" onClick="menuclick('submenu2','cellbar2')"><img src="/images/240x24xleft_02.jpg.pagespeed.ic.AegnVXtH-D.jpg" width="240" height="24" style="cursor:pointer;"/></td>
      </tr>
      <tr id="submenu2" style="display:none;">
        <td background="/images/left_01_bj.jpg" bgcolor="#fefacd" width="240">
        <table width="140" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/BK_browse/index.php?rtype=all&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02"><?=$Straight_All?></a></td>
            <td class="f_12_02" id="Num15">&nbsp;</td>
          </tr>          
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/BK_browse/index.php?rtype=r&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02">单式</a></td>
            <td class="f_12_02" id="Num16">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/BK_browse/index.php?rtype=rq4&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02"><?=$Quarter?></a></td>
            <td class="f_12_02" id="Num17">&nbsp;</td>
          </tr> 
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/BK_browse/index.php?rtype=re&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02">滚球</a></td>
            <td class="f_12_02" id="Num18">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/BK_browse/index.php?rtype=pr&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02">让分过关</a></td>
            <td class="f_12_02" id="Num19">&nbsp;</td>
          </tr>
        </table>
        </td>
      </tr>
      <tr id="cellbar22">
        <td id="bar2" onClick="menuclick('submenu22','cellbar22')"><img src="/images/240x24xleft_08.jpg" width="240" height="24" style="cursor:pointer;"/></td>
      </tr>
      <tr id="submenu22" style="display:none;">
        <td background="/images/left_01_bj.jpg" bgcolor="#fefacd" width="240">
        <table width="140" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/BK_future/index.php?rtype=all&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02"><?=$Straight_All?></a></td>
            <td class="f_12_02" id="Num20">&nbsp;</td>
          </tr>          
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/BK_future/index.php?rtype=r&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02">单式</a></td>
            <td class="f_12_02" id="Num21">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/BK_future/index.php?rtype=rq4&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02"><?=$Quarter?></a></td>
            <td class="f_12_02" id="Num22">&nbsp;</td>
          </tr>          
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/BK_future/index.php?rtype=pr&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02">让分过关</a></td>
            <td class="f_12_02" id="Num23">&nbsp;</td>
          </tr>
        </table>
        </td>
      </tr>      
      <tr id="cellbar3">
        <td id="bar3" onClick="menuclick('submenu3','cellbar3')"><img src="/images/240x24xleft_03.jpg.pagespeed.ic.Cp-lkMUDCH.jpg" width="240" height="24" style="cursor:pointer;"/></td>
      </tr>
      <tr id="submenu3" style="display:none;">
        <td background="/images/left_01_bj.jpg" bgcolor="#fefacd" width="240">
        <table width="140" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/BS_browse/index.php?rtype=r&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02">单式</a></td>
            <td class="f_12_02" id="Num24">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/BS_browse/index.php?rtype=hr&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02"><?=$half_1st?></a></td>
            <td class="f_12_02" id="Num25">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/BS_browse/index.php?rtype=re&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02"><?=$Running_Ball?></a></td>
            <td class="f_12_02" id="Num26">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/BS_browse/index.php?rtype=pd&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02"><?=$Correct_Score?></a></td>
            <td class="f_12_02" id="Num27">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/BS_browse/index.php?rtype=t&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02"><?=$Total_Goals?></a></td>
            <td class="f_12_02" id="Num28">&nbsp;</td>
          </tr>                                        
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/BS_browse/index.php?rtype=p&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02">标准过关</a></td>
            <td class="f_12_02" id="Num29">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/BS_browse/index.php?rtype=pr&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02">让分过关</a></td>
            <td class="f_12_02" id="Num30">&nbsp;</td>
          </tr>
        </table>
        </td>
      </tr>
      <tr id="cellbar33">
        <td id="bar3" onClick="menuclick('submenu33','cellbar33')"><img src="/images/240x24xleft_03.jpg" width="240" height="24" style="cursor:pointer;"/></td>
      </tr>
      <tr id="submenu33" style="display:none;">
        <td background="/images/left_01_bj.jpg" bgcolor="#fefacd" width="240">
        <table width="140" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/BS_future/index.php?rtype=r&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02">单式</a></td>
            <td class="f_12_02" id="Num31">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/BS_future/index.php?rtype=hr&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02"><?=$half_1st?></a></td>
            <td class="f_12_02" id="Num32">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/BS_future/index.php?rtype=pd&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02"><?=$Correct_Score?></a></td>
            <td class="f_12_02" id="Num33">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/BS_future/index.php?rtype=t&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02"><?=$Total_Goals?></a></td>
            <td class="f_12_02" id="Num34">&nbsp;</td>
          </tr>                              
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/BS_future/index.php?rtype=p&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02">标准过关</a></td>
            <td class="f_12_02" id="Num35">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/BS_future/index.php?rtype=pr&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02">让分过关</a></td>
            <td class="f_12_02" id="Num36">&nbsp;</td>
          </tr>
        </table>
        </td>
      </tr>      
      <tr id="cellbar4">
        <td id="bar4" onClick="menuclick('submenu4','cellbar4')"><img src="/images/240x24xleft_04.jpg.pagespeed.ic.tEz4yDZGQR.jpg" width="240" height="24" style="cursor:pointer;"/></td>
      </tr>
      <tr id="submenu4" style="display:none;">
        <td background="/images/left_01_bj.jpg" bgcolor="#fefacd" width="240">
        <table width="140" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/TN_browse/index.php?rtype=r&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02">单式</a></td>
            <td class="f_12_02" id="Num37">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/TN_browse/index.php?rtype=re&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02"><?=$Running_Ball?></a></td>
            <td class="f_12_02" id="Num38">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/TN_browse/index.php?rtype=pd&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02"><?=$Correct_Score?></a></td>
            <td class="f_12_02" id="Num39">&nbsp;</td>
          </tr>                    
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/TN_browse/index.php?rtype=p&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02">标准过关</a></td>
            <td class="f_12_02" id="Num40">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/TN_browse/index.php?rtype=pr&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02">让分过关</a></td>
            <td class="f_12_02" id="Num41">&nbsp;</td>
          </tr>
        </table>
        </td>
      </tr>
      <tr id="cellbar44">
        <td id="bar4" onClick="menuclick('submenu44','cellbar44')"><img src="/images/240x24xleft_04.jpg" width="240" height="24" style="cursor:pointer;"/></td>
      </tr>
      <tr id="submenu44" style="display:none;">
        <td background="/images/left_01_bj.jpg" bgcolor="#fefacd" width="240">
        <table width="140" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/TN_future/index.php?rtype=r&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02">单式</a></td>
            <td class="f_12_02" id="Num42">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/TN_future/index.php?rtype=pd&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02"><?=$Correct_Score?></a></td>
            <td class="f_12_02" id="Num43">&nbsp;</td>
          </tr>          
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/TN_future/index.php?rtype=p&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02">标准过关</a></td>
            <td class="f_12_02" id="Num44">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/TN_future/index.php?rtype=pr&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02">让分过关</a></td>
            <td class="f_12_02" id="Num45">&nbsp;</td>
          </tr>
        </table>
        </td>
      </tr>      
      <tr id="cellbar5">
        <td id="bar5" onClick="menuclick('submenu5','cellbar5')"><img src="/images/240x24xleft_05.jpg.pagespeed.ic.33ZkC4jwzb.jpg" width="240" height="24" style="cursor:pointer;"/></td>
      </tr>
      <tr id="submenu5" style="display:none;">
        <td background="/images/left_01_bj.jpg" bgcolor="#fefacd" width="240">
        <table width="140" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/VB_browse/index.php?rtype=r&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02">单式</a></td>
            <td class="f_12_02" id="Num46">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/VB_browse/index.php?rtype=re&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02"><?=$Running_Ball?></a></td>
            <td class="f_12_02" id="Num47">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/VB_browse/index.php?rtype=pd&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02"><?=$Correct_Score?></a></td>
            <td class="f_12_02" id="Num48">&nbsp;</td>
          </tr>                    
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/VB_browse/index.php?rtype=p&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02">标准过关</a></td>
            <td class="f_12_02" id="Num49">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/VB_browse/index.php?rtype=pr&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02">让分过关</a></td>
            <td class="f_12_02" id="Num50">&nbsp;</td>
          </tr>
        </table>
        </td>
      </tr>
      <tr id="cellbar55">
        <td id="bar5" onClick="menuclick('submenu55','cellbar55')"><img src="/images/240x24xleft_05.jpg" width="240" height="24" style="cursor:pointer;"/></td>
      </tr>
      <tr id="submenu55" style="display:none;">
        <td background="/images/left_01_bj.jpg" bgcolor="#fefacd" width="240">
        <table width="140" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/VB_future/index.php?rtype=r&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02">单式</a></td>
            <td class="f_12_02" id="Num51">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/VB_future/index.php?rtype=pd&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02"><?=$Correct_Score?></a></td>
            <td class="f_12_02" id="Num52">&nbsp;</td>
          </tr>          
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/VB_future/index.php?rtype=p&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02">标准过关</a></td>
            <td class="f_12_02" id="Num53">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/VB_future/index.php?rtype=pr&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02">让分过关</a></td>
            <td class="f_12_02" id="Num54">&nbsp;</td>
          </tr>
        </table>
        </td>
      </tr>      
      <tr id="cellbar6">
        <td id="bar6" onClick="menuclick('submenu6','cellbar6')"><img src="/images/240x24xleft_06.jpg.pagespeed.ic.cuBb0KfbFA.jpg" width="240" height="24" style="cursor:pointer;"/></td>
      </tr>
      <tr id="submenu6" style="display:none;">
        <td background="/images/left_01_bj.jpg" bgcolor="#fefacd" width="240">
        <table width="140" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/OP_browse/index.php?rtype=r&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02">单式</a></td>
            <td class="f_12_02" id="Num55">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/OP_browse/index.php?rtype=hr&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02"><?=$half_1st?></a></td>
            <td class="f_12_02" id="Num56">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/OP_browse/index.php?rtype=re&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02"><?=$Running_Ball?></a></td>
            <td class="f_12_02" id="Num57">&nbsp;</td>
          </tr>                    
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/OP_browse/index.php?rtype=pd&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02">波胆</a></td>
            <td class="f_12_02" id="Num58">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/OP_browse/index.php?rtype=hpd&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02">上半波胆</a></td>
            <td class="f_12_02" id="Num59">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/OP_browse/index.php?rtype=t&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02">入球数</a></td>
            <td class="f_12_02" id="Num60">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/OP_browse/index.php?rtype=f&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02">半全场</a> </td>
            <td class="f_12_02" id="Num61">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/OP_browse/index.php?rtype=p3&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02">综合过关</a></td>
            <td class="f_12_02" id="Num62">&nbsp;</td>
          </tr>
        </table>
        </td>
      </tr>
      <tr id="cellbar66">
        <td id="bar6" onClick="menuclick('submenu66','cellbar66')"><img src="/images/240x24xleft_06.jpg" width="240" height="24" style="cursor:pointer;"/></td>
      </tr>
      <tr id="submenu66" style="display:none;">
        <td background="/images/left_01_bj.jpg" bgcolor="#fefacd" width="240">
        <table width="140" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/OP_future/index.php?rtype=r&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02">单式</a></td>
            <td class="f_12_02" id="Num63">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/OP_future/index.php?rtype=hr&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02"><?=$half_1st?></a></td>
            <td class="f_12_02" id="Num64">&nbsp;</td>
          </tr>          
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/OP_future/index.php?rtype=pd&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02">波胆</a></td>
            <td class="f_12_02" id="Num65">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/OP_future/index.php?rtype=hpd&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02">上半波胆</a></td>
            <td class="f_12_02" id="Num66">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/OP_future/index.php?rtype=t&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02">入球数</a></td>
            <td class="f_12_02" id="Num67">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/OP_future/index.php?rtype=f&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02">半全场</a> </td>
            <td class="f_12_02" id="Num68">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/OP_future/index.php?rtype=p3&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02">综合过关</a></td>
            <td class="f_12_02" id="Num69">&nbsp;</td>
          </tr>
        </table>
        </td>
      </tr>      
      <tr id="cellbar8">
        <td id="bar2" onClick="menuclick('submenu8','cellbar8')"><img src="/images/l01.jpg" width="240" height="24" style="cursor:pointer;"/></td>
      </tr>
      <tr id="submenu8" style="display:none;">
        <td background="/images/left_01_bj.jpg" bgcolor="#fefacd" width="240">
        <table width="140" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/FS_browse/loadgame_R.php?rtype=fs&uid=<?=$uid?>&langx=<?=$langx?>&mtype=3');" class="f_12_02">冠军</a></td>
            <td class="f_12_02" id="Num70">&nbsp;</td>
          </tr>
        </table>
        </td>
      </tr>
      
	<tr id="cellbar7">
        <td id="bar7" onClick="menuclick('submenu7','cellbar7')"><img src="/images/240x24xleft_07.jpg" width="240" height="24" style="cursor:pointer;"/></td>
      </tr>
      <tr id="submenu7" style="display:none;">
        <td background="/images/left_01_bj.jpg" bgcolor="#fefacd" width="240">
        <table width="140" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/six/index.php?action=k_tm');" class="f_12_02">特码</a></td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/six/index.php?action=k_zm');" class="f_12_02">正码</a></td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/six/index.php?action=k_zt');" class="f_12_02">正码特</a></td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/six/index.php?action=k_zm6');" class="f_12_02">正码1-6</a></td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/six/index.php?action=k_gg');" class="f_12_02">过关</a> </td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/six/index.php?action=k_lm');" class="f_12_02">连码</a></td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/six/index.php?action=k_bb');" class="f_12_02">半波</a></td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/six/index.php?action=k_sxp');" class="f_12_02">一肖/尾数</a></td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/six/index.php?action=k_sx');" class="f_12_02">特码生肖</a></td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/six/index.php?action=k_sx6');" class="f_12_02">合肖</a></td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/six/index.php?action=k_sxt2');" class="f_12_02">生肖连</a> </td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/six/index.php?action=k_wsl');" class="f_12_02">尾数连</a></td>
          </tr>  
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/six/index.php?action=k_wbz');" class="f_12_02">全不中</a> </td>
          </tr>
          <tr>
            <td height="25" align="left"><a href="javascript:void(0);" onClick="chg_type('/app/member/six/index.php?action=kakithe');" class="f_12_02">开奖结果</a></td>
          </tr>                    
        </table>
        </td>
      </tr>      
    </table>
    <table width="240" align="center" cellpadding=0 cellspacing=0>
      <tr>      <tr id="cellbar882">
        <td id="bar882" onClick="menuclick('submenu882','cellbar882')"><a href="http://83suncity.cm/game.aspx" target="body"><img src="/images/ylc.jpg" width="240" height="24" border="0" style="cursor:pointer;"/></a></td>
      </tr>
      <tr id="submenu882" style="display:none;">
        <td background="/images/left_01_bj.jpg" bgcolor="#fefacd" width="240">
        <table width="140" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr></tr>
        </table>
        </td>
      </tr>
      
        <td height="25" align="center"><a href="javascript:void(0);" onClick="chg_type('/app/member/result/result.php?game_type=FT&uid=<?=$uid?>&langx=<?=$langx?>');" class="f_12_02">比赛结果</a></font></SPAN></td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td><img src="/images/bottom.gif.pagespeed.ce.8-FwSa4BBu.gif" width="240" height="27"/></td>
  </tr>
</table>
</body>
</html>
