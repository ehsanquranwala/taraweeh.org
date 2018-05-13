//===============================
// Kayako LiveResponse
// Copyright (c) 2001-2007
// http://www.kayako.com
// License: http://www.kayako.com/license.txt
//===============================

var sessionid = "ec8326e40cd2cea73147ac3c8793c617";
var country = "Pakistan";
var countrycode = "pk";
var hasnotes = "0";
var campaignid = "";
var campaigntitle = "";
var isfirsttime = 1;
var timer = 0;
var imagefetch = 44;
var image1;
var updateurl = "";
var screenHeight = window.screen.availHeight;
var screenWidth = window.screen.availWidth;
var colorDepth = window.screen.colorDepth;
var timeNow = new Date();
var referrer = escape(document.referrer);
var windows, mac, linux;
var ie, op, moz, misc, browsercode, browsername, browserversion, operatingsys;
var dom, ienew, ie4, ie5, ie6, moz_rv, moz_rv_sub, ie5mac, ie5xwin, opnu, op4, op5, op6, op7, saf, konq;
var appName, appVersion, userAgent;
var appname = navigator.appName;
var appVersion = navigator.appVersion;
var userAgent = navigator.userAgent;
var dombrowser = "default";
var isChatRunning = 0;
var title = document.title;
var proactiveImageUse = new Image();
windows = (appVersion.indexOf('Win') != -1);
mac = (appVersion.indexOf('Mac') != -1);
linux = (appVersion.indexOf('Linux') != -1);
if (!document.layers) {
	dom = (document.getElementById ) ? document.getElementById : false;
} else {
	dom = false;
}
  var myWidth = 0, myHeight = 0;
  if( typeof( window.innerWidth ) == 'number' ) {
    //Non-IE
    myWidth = window.innerWidth;
    myHeight = window.innerHeight;
  } else if( document.documentElement &&
      ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
    //IE 6+ in 'standards compliant mode'
    myWidth = document.documentElement.clientWidth;
    myHeight = document.documentElement.clientHeight;
  } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
    //IE 4 compatible
    myWidth = document.body.clientWidth;
    myHeight = document.body.clientHeight;
  }
winH = myHeight;
winW = myWidth;
misc=(appVersion.substring(0,1) < 4);
op=(userAgent.indexOf('Opera') != -1);
moz=(userAgent.indexOf('Gecko') != -1);
ie=(document.all && !op);
saf=(userAgent.indexOf('Safari') != -1);
konq=(userAgent.indexOf('Konqueror') != -1);

if (op) {
	op_pos = userAgent.indexOf('Opera');
	opnu = userAgent.substr((op_pos+6),4);
	op5 = (opnu.substring(0,1) == 5);
	op6 = (opnu.substring(0,1) == 6);
	op7 = (opnu.substring(0,1) == 7);
} else if (moz){
	rv_pos = userAgent.indexOf('rv');
	moz_rv = userAgent.substr((rv_pos+3),3);
	moz_rv_sub = userAgent.substr((rv_pos+7),1);
	if (moz_rv_sub == ' ' || isNaN(moz_rv_sub)) {
		moz_rv_sub='';
	}
	moz_rv = moz_rv + moz_rv_sub;
} else if (ie){
	ie_pos = userAgent.indexOf('MSIE');
	ienu = userAgent.substr((ie_pos+5),3);
	ie4 = (!dom);
	ie5 = (ienu.substring(0,1) == 5);
	ie6 = (ienu.substring(0,1) == 6);
}

if (konq) {
	browsercode = "KO";
	browserversion = appVersion;
	browsername = "Konqueror";
} else if (saf) {
	browsercode = "SF";
	browserversion = appVersion;
	browsername = "Safari";
} else if (op) {
	browsercode = "OP";
	if (op5) {
		browserversion = "5";
	} else if (op6) {
		browserversion = "6";
	} else if (op7) {
		browserversion = "7";
	} else {
		browserversion = appVersion;
	}
	browsername = "Opera";
} else if (moz) {
	browsercode = "MO";
	browserversion = appVersion;
	browsername = "Mozilla";
} else if (ie) {
	browsercode = "IE";
	if (ie4) {
		browserversion = "4";
	} else if (ie5) {
		browserversion = "5";
	} else if (ie6) {
		browserversion = "6";
	} else {
		browserversion = appVersion;
	}
	browsername = "Internet Explorer";
}

if (windows) {
	operatingsys = "Windows";
} else if (linux) {
	operatingsys = "Linux";
} else if (mac) {
	operatingsys = "Mac";
} else {
	operatingsys = "Unkown";
}

if (document.getElementById)
{
	dombrowser = "default";
} else if (document.layers) {
	dombrowser = "NS4";
} else if (document.all) {
	dombrowser = "IE4";
}

function browserObject(objid)
{
	if (dombrowser == "default")
	{
		return document.getElementById(objid);
	} else if (dombrowser == "NS4") {
		return document.layers[objid];		
	} else if (dombrowser == "IE4") {
		return document.all[objid];
	}
}

function doRand()
{
	var num;
	now=new Date();
	num=(now.getSeconds());
	num=num+1;
	return num;
}

function getCookie(name) {
	var crumb = document.cookie;
	var index = crumb.indexOf(name + "=");
	if (index == -1) return null;
	index = crumb.indexOf("=", index) + 1;
	var endstr = crumb.indexOf(";", index);
	if (endstr == -1) endstr = crumb.length;
	return unescape(crumb.substring(index, endstr));
}

function deleteCookie(name) {
	var expiry = new Date();
	document.cookie = name + "=" + "; expires=Thu, 01-Jan-70 00:00:01 GMT" +  "; path=/";
}

function elapsedTime()
{
	if (timer < 3600)
	{
		timer++;
		imagefetch++;

		if (imagefetch > 45) {
			imagefetch = 0;
			doStatusLoop();
		}

		setTimeout("elapsedTime();", 1000);
	}
}

function doStatusLoop() {
	date1 = new Date();
	updateurl = "http://support.sunnipath.com/visitor/index.php?_m=livesupport&_a=updatefootprint&time="+date1.getTime()+"&rand="+doRand()+"&url="+escape(window.location)+"&isfirsttime="+isfirsttime+"&sessionid="+sessionid+"&referrer="+escape(document.referrer)+"&resolution="+screenWidth+"x"+screenHeight+"&colordepth="+escape(colorDepth)+"&platform="+escape(navigator.platform)+"&appversion="+escape(navigator.appVersion)+"&appname="+escape(navigator.appName)+"&browsercode="+escape(browsercode)+"&browserversion="+escape(browserversion)+"&browsername="+escape(browsername)+"&operatingsys="+escape(operatingsys)+"&pagetitle="+escape(title)+"&country="+escape(country)+"&countrycode="+escape(countrycode)+"&hasnotes="+escape(hasnotes)+"&campaignid="+escape(campaignid)+"&campaigntitle="+escape(campaigntitle);
//	alert(updateurl);

	proactiveImageUse = new Image();
	proactiveImageUse.src = updateurl;

//	window.location.href = updateurl;

	proactiveImageUse.onload = imageLoaded;

	isfirsttime = 0;
}

function startChat(proactive)
{
	isChatRunning = 1;

	docWidth = (winW-500)/2;
	docHeight = (winH-480)/2;
	chatwindow = window.open("http://support.sunnipath.com/visitor/index.php?_m=livesupport&_a=startclientchat&sessionid="+sessionid+"&proactive="+proactive+"&departmentid=0&randno="+doRand()+"&fullname=&email=","customerchat"+doRand(), "toolbar=0,location=0,directories=0,status=1,menubar=0,scrollbars=0,resizable=1,width=500,height=480,left="+docWidth+",top="+docHeight);

	hideProactiveChatData();
}

function imageLoaded() {
	if (!proactiveImageUse)
	{
		return;
	}
	proactiveAction = proactiveImageUse.width;

	if (proactiveAction == 3)
	{
		doProactiveForced();
	} else if (proactiveAction == 4) {
		displayProactiveChatData();
	} else {
	}
}

function writeProactiveRequestData()
{
	docWidth = (winW-450)/2;
	docHeight = (winH-400)/2;
	classData = "DISPLAY: none; FLOAT: left; POSITION: absolute; TOP:"+docHeight+"px; LEFT:"+docWidth+"px; WIDTH: 450px; HEIGHT: 400px; Z-INDEX: 500;";
	writedata = "<style type=\"text/css\"> <!-- #proactivechatdiv { "+classData+" } --> </style>";
	writedata += "<div id=\"proactivechatdiv\" style=\""+classData+"\">";
	writedata += "<table width=\"450\" height=\"200\"  border=\"0\" cellpadding=\"1\" cellspacing=\"0\">  <tr>    <td bgcolor=\"#3894E5\"><table width=\"450\" height=\"200\"  border=\"0\" cellpadding=\"0\" cellspacing=\"0\">      <tr>        <td align=\"left\" valign=\"top\" bgcolor=\"#EDF4FF\"><table width=\"100%\"  border=\"0\" cellpadding=\"0\" cellspacing=\"0\">          <tr bgcolor=\"#FFFFFF\">            <td height=\"29\" colspan=\"2\" align=\"center\" valign=\"top\"><img src=\"http://support.sunnipath.com/themes/client_default/supportsuite.gif\"></td>          </tr>          <tr align=\"center\" bgcolor=\"#3894E5\">            <td height=\"1\" colspan=\"2\" valign=\"top\"><img src=\"http://support.sunnipath.com/themes/client_default/space.gif\" width=\"1\" height=\"1\"></td>          </tr>          <tr align=\"center\">            <td colspan=\"2\" valign=\"top\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><br>              <br>              Need Assistance? Click &quot;Chat Now&quot; to chat with a Live Operator.<br>              <br>              </font><br>              <br></td>          </tr>          <tr>            <td width=\"47%\" align=\"center\" valign=\"top\"><a href=\"javascript:doProactiveRequest();\"><font color=\"#FF3300\" size=\"4\" face=\"Trebuchet MS, Verdana, Arial, Helvetica, sans-serif\">Chat Now</font></a> </td>            <td width=\"53%\" align=\"center\" valign=\"top\"><a href=\"javascript:closeProactiveRequest();\"><font color=\"#6666FF\" size=\"4\" face=\"Trebuchet MS, Verdana, Arial, Helvetica, sans-serif\">No Thanks!</a></font></td>          </tr>        </table></td>      </tr>    </table></td>  </tr></table>";
	writedata += "</div>";
	document.write(writedata);
}

function displayProactiveChatData()
{
	writeObj = browserObject("proactivechatdiv");
	if (writeObj)
	{
		docWidth = (winW-450)/2;
		docHeight = (winH-400)/2;
		writeObj.top = docWidth;
		writeObj.left = docHeight;
	}
	switchDisplay("proactivechatdiv");
}

function hideProactiveChatData()
{
	hideDisplay("proactivechatdiv");
}

function doProactiveForced()
{
	switchDisplay("proactivechatdiv");
	startChat("6");
}

function doProactiveRequest()
{
	startChat("4");
}

function closeProactiveRequest()
{
	rejectProactive = new Image();
	date1 = new Date();
	rejectProactive.src = "http://support.sunnipath.com/visitor/index.php?_m=livesupport&_a=resetproactivestatus&time="+date1.getTime()+"&rand="+doRand()+"&sessionid="+sessionid;

	hideProactiveChatData();
}

function switchDisplay(objid)
{
	result = browserObject(objid);
	if (!result)
	{
		return;
	}

	if (result.style.display == "none")
	{
		result.style.display = "block";
	} else {
		result.style.display = "none";
	}
}

function hideDisplay(objid)
{
	result = browserObject(objid);
	if (!result)
	{
		return;
	}

	result.style.display = "none";
}

function resetChatStatus()
{
	isChatRunning = 0;
}

function runURL(url)
{
	runURLImg = new Image();
	date1 = new Date();
	runURLImg.src = url;
}

writeProactiveRequestData();
elapsedTime();
document.write("<a href=\"javascript:startChat(\'0\');\" onMouseOver=\"window.status=\'Live Support is offline. Click Here to leave a message\'; return true;\" onMouseOut=\"window.status=\'\'; return true;\"><img src=\"http://www.SunniPath.com/images/181x081-LiveHelp-01x01.gif\" border=\"0\" alt=\"Live Support is offline. Click Here to leave a message\" title=\"Live Support is offline. Click Here to leave a message\"></a>");
