 <!-- --> 















	




















	
	












		
			





		
		
		
			








	



<script language="JavaScript">
<!--
function formValidator() {
	var email = document.theForm.email;
	var firstname = document.theForm.nameFirst;
	var lastname = document.theForm.nameLast;
	var Password = document.theForm.password;
	var rePassword = document.theForm.passwordConfirm;
	var strPassword = new String(document.theForm.password.value);
	var country = document.theForm.country;
	var city = document.theForm.city;
	var postalCode = document.theForm.postalCode;
	var tos= document.theForm.tos; // checkbox for Terms of service
	var screenname = document.theForm.screenname;

	strPassword = strPassword.toUpperCase();

	

	// Email Checker
	if (email.value == 0) {
		//alert("Please enter your email address");
		alert("Please enter your email address");
		email.focus();
		return false;
	} else if (email.value.indexOf("@") < 0) {
		//alert("Incorrect email address. Please re-enter");
		alert("Incorrect email address. Please re-enter");
		email.focus();
		return false;
	} else if (email.value.indexOf(".") < 0) {
		//alert("Incorrect email address. Please re-enter");
		alert("Incorrect email address. Please re-enter");
		email.focus();
		return false;
	} else if (email.value.indexOf(" ") >= 0) {
		//alert("Incorrect email address. Please re-enter");
		alert("Incorrect email address. Please re-enter");
		email.focus();
		return false;
	}
		
	//First Name Checker
	if (firstname.value == 0) {
		//alert("Please enter your first name");
		alert("Please enter your first name");
		firstname.focus();
		return false;
	}
	// Last Name Checker
	if (lastname.value == 0) {
		//alert("Please enter your last name");
		alert("Please enter your last name");
		lastname.focus();
		return false;
	}

	// Check DOB is not less than 18 yrs old
	/*var lowlimit = new Date();
	lowlimit.setYear(lowlimit.getYear()-14);
	// the + 1 below is because js months are indexed from zero
	var enteredAge = new Date(document.theForm.bYear.value, (document.theForm.bMonth.value - 1) , document.theForm.bDay.value);
	// Birthday date must be entered
	with (document.theForm) {
		if (!bYear.value|!bDay.value|!bMonth.value) {
			//alert ("Please enter a valid date for your birthday.");
			alert ("Please enter a valid date for your birthday.");
			return false;
		}
	}
	if (enteredAge > lowlimit) {
		//alert ("You must be 14 or older to use this site.");
		alert ("You must be 14 or older to use this site.");
		return false;
	}
	*/

	// Password Checker
	if (Password.value =="") {
		//alert ("Please enter a password (min 6 characters)");
		alert ("Please enter a password (min 6 characters)");
		Password.focus();
		return false;
	} else if (strPassword.length < 6) {
		//alert ("Password must have at least 6 characters. Please Re-enter.");
		alert ("Password must have at least 6 characters. Please Re-enter.");
		Password.focus();
		return false;
	} else if (!strPassword.match(/[0-9!@#\$%\^&\*\(\)\-_\+=\{\}\[\|:;'\?<>\.,~`"]/)) {
		//alert ("Password must contain at least 1 number or punctuation character.");
		alert ("Password must contain at least 1 number or punctuation character.");
		Password.focus();
		return false;
	} else if (!strPassword.match(/[A-Za-z]/)) {
		//alert ("Password must have contain least 1 letter.");
		alert ("Password must have contain least 1 letter.");
		Password.focus();
		return false;
	} else if (firstname.value.length > 2 && strPassword.lastIndexOf(firstname.value.toUpperCase()) > -1) {
		//alert ("Password too closely resembles first name.");
		alert ("Password too closely resembles first name.");
		Password.focus();
		return false;
	} else if (lastname.value.length > 2 && strPassword.lastIndexOf(lastname.value.toUpperCase()) > -1) {
		//alert ("Password too closely resembles last name.");
		alert ("Password too closely resembles last name.");
		Password.focus();
		return false;
	} else if (strPassword.lastIndexOf(email.value.toUpperCase()) > -1) {
		//alert ("Password too closely resembles email.");
		alert ("Password too closely resembles email.");
		Password.focus();
		return false;
	} else if (Password.value.indexOf(" ") >= 0) {
		//alert ("Space is not ALLOWED for password. Please re-enter.");
		alert ("Space is not ALLOWED for password. Please re-enter.");
		Password.focus();
		return false;
	} else if (Password.value != rePassword.value) {
		//alert ("Passwords do not match. Please re-enter");
		alert ("Password do not matched. Please re-enter.");
		rePassword.focus();
		return false;
	}
	// Postal Code Checker
	if(!validatePostalCode()) {
		postalCode.focus();
		return false;
	}

	// Gender Check
	myOption = -1;
	for (i=0; i<document.theForm.gender.length; i++) {
		if (document.theForm.gender[i].checked) {
			myOption = i;
		}
	}
	if (myOption == -1) {
		//alert("Please select your Gender.");
		alert("Please select your Gender.");
		return false;
	}
	// TOS check
	if (!tos.checked) {
		//alert("Please check the agree to our terms box.");
		alert("Please check the agree to our terms box.");
		tos.focus();
		return false;
	}
}

function DropDownSelect(obj, val) {
	var i;
	var len = obj.options.length;
	for (i=0; i<len; i++) {
		if (obj.options[i].value == val) {
			obj.selectedIndex = i;
			break;
		}
	}
}

function getCountryCode(countryName) {
	var countryCodeList = [
		
			{country: "Afghanistan", countryCode: "AF"},
		
			{country: "Albania", countryCode: "AL"},
		
			{country: "Algeria", countryCode: "DZ"},
		
			{country: "American Samoa", countryCode: "AS"},
		
			{country: "Andorra", countryCode: "AD"},
		
			{country: "Angola", countryCode: "AO"},
		
			{country: "Anguilla", countryCode: "AI"},
		
			{country: "Antarctica", countryCode: "AQ"},
		
			{country: "Antigua and Barbuda", countryCode: "AG"},
		
			{country: "Argentina", countryCode: "AR"},
		
			{country: "Armenia", countryCode: "AM"},
		
			{country: "Aruba", countryCode: "AW"},
		
			{country: "Australia", countryCode: "AU"},
		
			{country: "Austria", countryCode: "AT"},
		
			{country: "Azerbaijan", countryCode: "AZ"},
		
			{country: "Bahamas", countryCode: "BS"},
		
			{country: "Bahrain", countryCode: "BH"},
		
			{country: "Bangladesh", countryCode: "BD"},
		
			{country: "Barbados", countryCode: "BB"},
		
			{country: "Belarus", countryCode: "BY"},
		
			{country: "Belgium", countryCode: "BE"},
		
			{country: "Belize", countryCode: "BZ"},
		
			{country: "Benin", countryCode: "BJ"},
		
			{country: "Bermuda", countryCode: "BM"},
		
			{country: "Bhutan", countryCode: "BT"},
		
			{country: "Bolivia", countryCode: "BO"},
		
			{country: "Bosnia and Herzegowina", countryCode: "BA"},
		
			{country: "Botswana", countryCode: "BW"},
		
			{country: "Bouvet Island", countryCode: "BV"},
		
			{country: "Brazil", countryCode: "BR"},
		
			{country: "British Indian Ocean Territory", countryCode: "IO"},
		
			{country: "Brunei Darussalam", countryCode: "BN"},
		
			{country: "Bulgaria", countryCode: "BG"},
		
			{country: "Burkina Faso", countryCode: "BF"},
		
			{country: "Burundi", countryCode: "BI"},
		
			{country: "Cambodia", countryCode: "KH"},
		
			{country: "Cameroon", countryCode: "CM"},
		
			{country: "Canada", countryCode: "CA"},
		
			{country: "Cape Verde", countryCode: "CV"},
		
			{country: "Cayman Islands", countryCode: "KY"},
		
			{country: "Central African Republic", countryCode: "CF"},
		
			{country: "Chad", countryCode: "TD"},
		
			{country: "Chile", countryCode: "CL"},
		
			{country: "China", countryCode: "CN"},
		
			{country: "Christmas Island", countryCode: "CX"},
		
			{country: "Cocoa (Keeling) Islands", countryCode: "CC"},
		
			{country: "Colombia", countryCode: "CO"},
		
			{country: "Comoros", countryCode: "KM"},
		
			{country: "Congo", countryCode: "CG"},
		
			{country: "Cook Islands", countryCode: "CK"},
		
			{country: "Costa Rica", countryCode: "CR"},
		
			{country: "Cote Divoire", countryCode: "CI"},
		
			{country: "Croatia (Hrvatska)", countryCode: "CT"},
		
			{country: "Cuba", countryCode: "CU"},
		
			{country: "Cyprus", countryCode: "CY"},
		
			{country: "Czech Republic", countryCode: "CZ"},
		
			{country: "Denmark", countryCode: "DK"},
		
			{country: "Djibouti", countryCode: "DJ"},
		
			{country: "DoDDs Schools", countryCode: "DS"},
		
			{country: "Dominica", countryCode: "DM"},
		
			{country: "Dominican Republic", countryCode: "DO"},
		
			{country: "East Timor", countryCode: "TP"},
		
			{country: "Ecuador", countryCode: "EC"},
		
			{country: "Egypt", countryCode: "EG"},
		
			{country: "El Salvador", countryCode: "SV"},
		
			{country: "Equatorial Guinea", countryCode: "GQ"},
		
			{country: "Eritrea", countryCode: "ER"},
		
			{country: "Estonia", countryCode: "EE"},
		
			{country: "Ethiopia", countryCode: "ET"},
		
			{country: "Falkland Islands (Malvinas)", countryCode: "FK"},
		
			{country: "Faroe Islands", countryCode: "FO"},
		
			{country: "Fiji", countryCode: "FJ"},
		
			{country: "Finland", countryCode: "FI"},
		
			{country: "France", countryCode: "FR"},
		
			{country: "Gabon", countryCode: "GA"},
		
			{country: "Gambia", countryCode: "GM"},
		
			{country: "Georgia", countryCode: "GE"},
		
			{country: "Germany", countryCode: "DE"},
		
			{country: "Ghana", countryCode: "GH"},
		
			{country: "Gibraltar", countryCode: "GI"},
		
			{country: "Greece", countryCode: "GR"},
		
			{country: "Greenland", countryCode: "GL"},
		
			{country: "Grenada", countryCode: "GD"},
		
			{country: "Guam", countryCode: "GU"},
		
			{country: "Guatemala", countryCode: "GT"},
		
			{country: "Guinea", countryCode: "GN"},
		
			{country: "Guinea-Bissau", countryCode: "GW"},
		
			{country: "Guyana", countryCode: "GY"},
		
			{country: "Haiti", countryCode: "HT"},
		
			{country: "Heard and Mc Donald Islands", countryCode: "HM"},
		
			{country: "Honduras", countryCode: "HN"},
		
			{country: "Hong Kong", countryCode: "HK"},
		
			{country: "Hungary", countryCode: "HU"},
		
			{country: "Iceland", countryCode: "IS"},
		
			{country: "India", countryCode: "IN"},
		
			{country: "Indonesia", countryCode: "ID"},
		
			{country: "Iran (Islamic Republic of)", countryCode: "IR"},
		
			{country: "Iraq", countryCode: "IQ"},
		
			{country: "Ireland", countryCode: "IE"},
		
			{country: "Israel", countryCode: "IL"},
		
			{country: "Italy", countryCode: "IT"},
		
			{country: "Jamaica", countryCode: "JM"},
		
			{country: "Japan", countryCode: "JP"},
		
			{country: "Jordan", countryCode: "JO"},
		
			{country: "Kazakhstan", countryCode: "KZ"},
		
			{country: "Kenya", countryCode: "KE"},
		
			{country: "Kiribati", countryCode: "KI"},
		
			{country: "Korea,  Democratic Peoples Republic of", countryCode: "KP"},
		
			{country: "Korea,  Republic of", countryCode: "KR"},
		
			{country: "Kuwait", countryCode: "KW"},
		
			{country: "Kyrgyzstan", countryCode: "KG"},
		
			{country: "Lao Peoples Democratic Republic", countryCode: "LA"},
		
			{country: "Latvia", countryCode: "LV"},
		
			{country: "Lebanon", countryCode: "LB"},
		
			{country: "Lesotho", countryCode: "LS"},
		
			{country: "Liberia", countryCode: "LR"},
		
			{country: "Libyan Arab Jamahiriya", countryCode: "LY"},
		
			{country: "Liechtenstein", countryCode: "LI"},
		
			{country: "Lithuania", countryCode: "LT"},
		
			{country: "Luxembourg", countryCode: "LU"},
		
			{country: "Macau", countryCode: "MO"},
		
			{country: "Macedonia, The Former Yugoslav Republic of", countryCode: "MK"},
		
			{country: "Madagascar", countryCode: "MG"},
		
			{country: "Malawi", countryCode: "MW"},
		
			{country: "Malaysia", countryCode: "MY"},
		
			{country: "Maldives", countryCode: "MV"},
		
			{country: "Mali", countryCode: "ML"},
		
			{country: "Malta", countryCode: "MT"},
		
			{country: "Marshall Islands", countryCode: "MH"},
		
			{country: "Mauritania", countryCode: "MR"},
		
			{country: "Mauritius", countryCode: "MU"},
		
			{country: "Mexico", countryCode: "MX"},
		
			{country: "Micronesia, Federated States of", countryCode: "FM"},
		
			{country: "Moldova,  Republic of", countryCode: "MD"},
		
			{country: "Monaco", countryCode: "MC"},
		
			{country: "Mongolia", countryCode: "MN"},
		
			{country: "Montserrat", countryCode: "MS"},
		
			{country: "Morocco", countryCode: "MA"},
		
			{country: "Mozambique", countryCode: "MZ"},
		
			{country: "Myanmar", countryCode: "MM"},
		
			{country: "Namibia", countryCode: "NA"},
		
			{country: "Nauru", countryCode: "NR"},
		
			{country: "Nepal", countryCode: "NP"},
		
			{country: "Netherlands", countryCode: "NL"},
		
			{country: "Netherlands Antilles", countryCode: "AN"},
		
			{country: "New Zealand", countryCode: "NZ"},
		
			{country: "Nicaragua", countryCode: "NI"},
		
			{country: "Niger", countryCode: "NE"},
		
			{country: "Nigeria", countryCode: "NG"},
		
			{country: "Niue", countryCode: "NU"},
		
			{country: "Norfolk Island", countryCode: "NF"},
		
			{country: "Northern Mariana Islands", countryCode: "MP"},
		
			{country: "Norway", countryCode: "NO"},
		
			{country: "Oman", countryCode: "OM"},
		
			{country: "Pakistan", countryCode: "PK"},
		
			{country: "Palau", countryCode: "PW"},
		
			{country: "Panama", countryCode: "PA"},
		
			{country: "Papua New Guinea", countryCode: "PG"},
		
			{country: "Paraguay", countryCode: "PY"},
		
			{country: "Peru", countryCode: "PE"},
		
			{country: "Philippines", countryCode: "PH"},
		
			{country: "Pitcairn", countryCode: "PN"},
		
			{country: "Poland", countryCode: "PL"},
		
			{country: "Portugal", countryCode: "PT"},
		
			{country: "Puerto Rico", countryCode: "PR"},
		
			{country: "Qatar", countryCode: "QA"},
		
			{country: "Romania", countryCode: "RO"},
		
			{country: "Russian Federation", countryCode: "RU"},
		
			{country: "Rwanda", countryCode: "RW"},
		
			{country: "Saint Kitts and Nevis", countryCode: "KN"},
		
			{country: "Saint Lucia", countryCode: "LC"},
		
			{country: "Saint Vincent and the Grenadines", countryCode: "VC"},
		
			{country: "Samoa", countryCode: "WS"},
		
			{country: "San Marino", countryCode: "SM"},
		
			{country: "Sao Tome and Principe", countryCode: "ST"},
		
			{country: "Saudi Arabia", countryCode: "SA"},
		
			{country: "Senegal", countryCode: "SN"},
		
			{country: "Seychelles", countryCode: "SC"},
		
			{country: "Sierra Leone", countryCode: "SL"},
		
			{country: "Singapore", countryCode: "SG"},
		
			{country: "Slovakia (Slovak Republic)", countryCode: "SK"},
		
			{country: "Slovenia", countryCode: "SI"},
		
			{country: "Solomon Islands", countryCode: "Sb"},
		
			{country: "Somalia", countryCode: "SO"},
		
			{country: "South Africa", countryCode: "ZA"},
		
			{country: "South Georgia and the South Sandwich Islands", countryCode: "GS"},
		
			{country: "Spain", countryCode: "ES"},
		
			{country: "Sri Lanka", countryCode: "LK"},
		
			{country: "St. Helena", countryCode: "SH"},
		
			{country: "Sudan", countryCode: "SD"},
		
			{country: "Suriname", countryCode: "SR"},
		
			{country: "Svalbard and Jan Mayen Islands", countryCode: "SJ"},
		
			{country: "Swaziland", countryCode: "SZ"},
		
			{country: "Sweden", countryCode: "SE"},
		
			{country: "Switzerland", countryCode: "CH"},
		
			{country: "Syrian ArabRepublic", countryCode: "SY"},
		
			{country: "Taiwan", countryCode: "TW"},
		
			{country: "Tajikistan", countryCode: "TJ"},
		
			{country: "Tanzania,  United Republic of", countryCode: "TZ"},
		
			{country: "Thailand", countryCode: "TH"},
		
			{country: "Togo", countryCode: "TG"},
		
			{country: "Tokelau", countryCode: "TK"},
		
			{country: "Tonga", countryCode: "TO"},
		
			{country: "Trinidad and Tobago", countryCode: "TT"},
		
			{country: "Tunisia", countryCode: "TN"},
		
			{country: "Turkey", countryCode: "TR"},
		
			{country: "Turkmenistan", countryCode: "TM"},
		
			{country: "Turks and Caicos Islands", countryCode: "TC"},
		
			{country: "Tuvalu", countryCode: "TV"},
		
			{country: "Uganda", countryCode: "UG"},
		
			{country: "Ukraine", countryCode: "UA"},
		
			{country: "United ArabEmirates", countryCode: "AE"},
		
			{country: "United Kingdom", countryCode: "UK"},
		
			{country: "United States", countryCode: "US"},
		
			{country: "United States Minor Outlying Islands", countryCode: "UM"},
		
			{country: "Uruguay", countryCode: "UY"},
		
			{country: "Uzbekistan", countryCode: "UZ"},
		
			{country: "Vanuatu", countryCode: "VU"},
		
			{country: "Vatican City State(Holy See)", countryCode: "VA"},
		
			{country: "Venezuela", countryCode: "VE"},
		
			{country: "Viet Nam", countryCode: "VN"},
		
			{country: "Virgin Islands (British)", countryCode: "VG"},
		
			{country: "Virgin Islands (U.S.)", countryCode: "VI"},
		
			{country: "Western Sahara", countryCode: "EH"},
		
			{country: "Yeman", countryCode: "YE"},
		
			{country: "Yugoslavia", countryCode: "YU"},
		
			{country: "Zaire", countryCode: "ZR"},
		
			{country: "Zambia", countryCode: "ZM"},
		
			{country: "Zimbabwe", countryCode: "ZW"},
		
	];
	var count = 0;
	var userBrowser = navigator.userAgent.toLowerCase();
	
	if( !(userBrowser.indexOf('msie') + 1) )
		count = countryCodeList.length;
	else
		count = countryCodeList.length - 1;
	
	// Special case for US.
	if(countryName=="USA")
		countryName = "United States";
	
	// Special case for China.
	if(countryName=="CN")
		countryName = "China";
	
	
	for (var i=0; i < count; i++ ) {
		if(countryName==countryCodeList[i].country)
			return countryCodeList[i].countryCode;
	}	
	
	return "";
}	
	
function populateState(countryCode)
{
	
	var form=document.forms['theForm'];
	var objstate=form.elements['region'];
	   	objstate.options.length = 1;
	var userBrowser = navigator.userAgent.toLowerCase();
	
  //changed for chinese support
		
  //changed over
		 if(countryCode!="JP")
		 {
			var statelist= [
				
						{id: 484, title: "Buenos Aires (Ciudad Autónoma de)", refID: "Argentina"},
				
						{id: 485, title: "Buenos Aires (provincia) ", refID: "Argentina"},
				
						{id: 486, title: "Catamarca ", refID: "Argentina"},
				
						{id: 487, title: "Chaco ", refID: "Argentina"},
				
						{id: 488, title: "Chubut ", refID: "Argentina"},
				
						{id: 489, title: "Córdoba ", refID: "Argentina"},
				
						{id: 490, title: "Corrientes ", refID: "Argentina"},
				
						{id: 491, title: "Entre Ríos ", refID: "Argentina"},
				
						{id: 492, title: "Formosa ", refID: "Argentina"},
				
						{id: 493, title: "Jujuy ", refID: "Argentina"},
				
						{id: 494, title: "La Pampa ", refID: "Argentina"},
				
						{id: 495, title: "La Rioja ", refID: "Argentina"},
				
						{id: 496, title: "Mendoza ", refID: "Argentina"},
				
						{id: 497, title: "Misiones ", refID: "Argentina"},
				
						{id: 498, title: "Neuquén ", refID: "Argentina"},
				
						{id: 499, title: "Río Negro ", refID: "Argentina"},
				
						{id: 500, title: "Salta ", refID: "Argentina"},
				
						{id: 501, title: "San Juan ", refID: "Argentina"},
				
						{id: 502, title: "San Luis ", refID: "Argentina"},
				
						{id: 503, title: "Santa Cruz ", refID: "Argentina"},
				
						{id: 504, title: "Santa Fe ", refID: "Argentina"},
				
						{id: 505, title: "Santiago del Estero ", refID: "Argentina"},
				
						{id: 506, title: "Tierra del Fuego ", refID: "Argentina"},
				
						{id: 507, title: "Tucumán ", refID: "Argentina"},
				
						{id: 75, title: "Australian Capital Territory", refID: "Australia"},
				
						{id: 76, title: "New South Wales", refID: "Australia"},
				
						{id: 77, title: "Northern Territory", refID: "Australia"},
				
						{id: 78, title: "Queensland", refID: "Australia"},
				
						{id: 79, title: "South Australia ", refID: "Australia"},
				
						{id: 80, title: "Tasmania", refID: "Australia"},
				
						{id: 110, title: "Victoria", refID: "Australia"},
				
						{id: 82, title: "Western Australia", refID: "Australia"},
				
						{id: 673, title: "Burgenland", refID: "Austria"},
				
						{id: 674, title: "Kärnten", refID: "Austria"},
				
						{id: 675, title: "Niederösterreich", refID: "Austria"},
				
						{id: 676, title: "Oberösterreich", refID: "Austria"},
				
						{id: 677, title: "Salzburg", refID: "Austria"},
				
						{id: 678, title: "Steiermark", refID: "Austria"},
				
						{id: 679, title: "Tirol", refID: "Austria"},
				
						{id: 680, title: "Vorarlberg", refID: "Austria"},
				
						{id: 681, title: "Wien", refID: "Austria"},
				
						{id: 53, title: "Alberta", refID: "Canada"},
				
						{id: 56, title: "British Columbia", refID: "Canada"},
				
						{id: 58, title: "Manitoba", refID: "Canada"},
				
						{id: 60, title: "New Brunswick", refID: "Canada"},
				
						{id: 55, title: "Newfoundland", refID: "Canada"},
				
						{id: 401, title: "Northwest Territories", refID: "Canada"},
				
						{id: 59, title: "Nova Scotia", refID: "Canada"},
				
						{id: 57, title: "Nunavut", refID: "Canada"},
				
						{id: 52, title: "Ontario", refID: "Canada"},
				
						{id: 54, title: "Prince Edward", refID: "Canada"},
				
						{id: 62, title: "Quebec", refID: "Canada"},
				
						{id: 61, title: "Saskatchewan", refID: "Canada"},
				
						{id: 63, title: "Yukon", refID: "Canada"},
				
						{id: 650, title: "Aisén del General Carlos Ibáñez del Campo", refID: "Chile"},
				
						{id: 640, title: "Antofagasta", refID: "Chile"},
				
						{id: 641, title: "Atacama", refID: "Chile"},
				
						{id: 647, title: "Biobío", refID: "Chile"},
				
						{id: 642, title: "Coquimbo", refID: "Chile"},
				
						{id: 648, title: "La Araucanía", refID: "Chile"},
				
						{id: 645, title: "Libertador", refID: "Chile"},
				
						{id: 649, title: "Los Lagos", refID: "Chile"},
				
						{id: 651, title: "Magallanes y Antártica Chilena", refID: "Chile"},
				
						{id: 646, title: "Maule", refID: "Chile"},
				
						{id: 644, title: "Metropolitana de Santiago", refID: "Chile"},
				
						{id: 639, title: "Tarapacá", refID: "Chile"},
				
						{id: 643, title: "Valparaíso", refID: "Chile"},
				
						{id: 453, title: "上海市", refID: "CN"},
				
						{id: 470, title: "云南省", refID: "CN"},
				
						{id: 479, title: "内蒙古自治区", refID: "CN"},
				
						{id: 450, title: "北京市", refID: "CN"},
				
						{id: 475, title: "台湾省", refID: "CN"},
				
						{id: 455, title: "吉林省", refID: "CN"},
				
						{id: 472, title: "四川省", refID: "CN"},
				
						{id: 452, title: "天津市", refID: "CN"},
				
						{id: 477, title: "宁夏回族自治区", refID: "CN"},
				
						{id: 464, title: "安徽省", refID: "CN"},
				
						{id: 468, title: "山东省", refID: "CN"},
				
						{id: 458, title: "山西省", refID: "CN"},
				
						{id: 469, title: "广东省", refID: "CN"},
				
						{id: 478, title: "广西壮族自治区", refID: "CN"},
				
						{id: 480, title: "新疆维吾尔族自治区", refID: "CN"},
				
						{id: 465, title: "江苏省", refID: "CN"},
				
						{id: 467, title: "江西省", refID: "CN"},
				
						{id: 463, title: "河北省", refID: "CN"},
				
						{id: 460, title: "河南省", refID: "CN"},
				
						{id: 466, title: "浙江省", refID: "CN"},
				
						{id: 473, title: "海南省", refID: "CN"},
				
						{id: 462, title: "湖北省", refID: "CN"},
				
						{id: 461, title: "湖南省", refID: "CN"},
				
						{id: 483, title: "澳门特别行政区", refID: "CN"},
				
						{id: 476, title: "甘肃省", refID: "CN"},
				
						{id: 474, title: "福建省", refID: "CN"},
				
						{id: 481, title: "西藏自治区", refID: "CN"},
				
						{id: 471, title: "贵州省", refID: "CN"},
				
						{id: 456, title: "辽宁省", refID: "CN"},
				
						{id: 451, title: "重庆市", refID: "CN"},
				
						{id: 459, title: "陕西省", refID: "CN"},
				
						{id: 457, title: "青海省", refID: "CN"},
				
						{id: 482, title: "香港特别行政区", refID: "CN"},
				
						{id: 454, title: "黑龙江省", refID: "CN"},
				
						{id: 540, title: "Amazonas", refID: "Colombia"},
				
						{id: 541, title: "Antioquia", refID: "Colombia"},
				
						{id: 542, title: "Arauca", refID: "Colombia"},
				
						{id: 543, title: "Atlántico", refID: "Colombia"},
				
						{id: 544, title: "Bogotá (Distrito Capital)", refID: "Colombia"},
				
						{id: 545, title: "Bolívar", refID: "Colombia"},
				
						{id: 546, title: "Boyacá", refID: "Colombia"},
				
						{id: 547, title: "Caldas", refID: "Colombia"},
				
						{id: 548, title: "Caquetá", refID: "Colombia"},
				
						{id: 549, title: "Casanare", refID: "Colombia"},
				
						{id: 550, title: "Cauca", refID: "Colombia"},
				
						{id: 551, title: "Cesar", refID: "Colombia"},
				
						{id: 552, title: "Chocó", refID: "Colombia"},
				
						{id: 553, title: "Córdoba", refID: "Colombia"},
				
						{id: 554, title: "Cundinamarca", refID: "Colombia"},
				
						{id: 555, title: "Guainía", refID: "Colombia"},
				
						{id: 556, title: "Guaviare", refID: "Colombia"},
				
						{id: 557, title: "Huila", refID: "Colombia"},
				
						{id: 558, title: "La Guajira", refID: "Colombia"},
				
						{id: 559, title: "Magdalena", refID: "Colombia"},
				
						{id: 560, title: "Meta", refID: "Colombia"},
				
						{id: 561, title: "Nariño", refID: "Colombia"},
				
						{id: 562, title: "Norte de Santander", refID: "Colombia"},
				
						{id: 563, title: "Putumayo", refID: "Colombia"},
				
						{id: 564, title: "Quindío", refID: "Colombia"},
				
						{id: 565, title: "Risaralda", refID: "Colombia"},
				
						{id: 566, title: "San Andrés and Providencia", refID: "Colombia"},
				
						{id: 567, title: "Santander", refID: "Colombia"},
				
						{id: 568, title: "Sucre", refID: "Colombia"},
				
						{id: 569, title: "Tolima", refID: "Colombia"},
				
						{id: 570, title: "Valle del Cauca", refID: "Colombia"},
				
						{id: 571, title: "Vaupés", refID: "Colombia"},
				
						{id: 572, title: "Vichada", refID: "Colombia"},
				
						{id: 508, title: "Alajuela", refID: "Costa Rica"},
				
						{id: 509, title: "Cartago", refID: "Costa Rica"},
				
						{id: 510, title: "Guanacaste", refID: "Costa Rica"},
				
						{id: 511, title: "Heredia", refID: "Costa Rica"},
				
						{id: 512, title: "Limón", refID: "Costa Rica"},
				
						{id: 513, title: "Puntarenas", refID: "Costa Rica"},
				
						{id: 514, title: "San José", refID: "Costa Rica"},
				
						{id: 112, title: "All", refID: "Denmark"},
				
						{id: 113, title: "All", refID: "DoDDs Schools"},
				
						{id: 573, title: "Azuay", refID: "Ecuador"},
				
						{id: 574, title: "Bolívar", refID: "Ecuador"},
				
						{id: 575, title: "Cañar", refID: "Ecuador"},
				
						{id: 576, title: "Carchi", refID: "Ecuador"},
				
						{id: 577, title: "Chimborazo", refID: "Ecuador"},
				
						{id: 578, title: "Cotopaxi", refID: "Ecuador"},
				
						{id: 579, title: "El Oro", refID: "Ecuador"},
				
						{id: 580, title: "Esmeraldas", refID: "Ecuador"},
				
						{id: 581, title: "Galápagos", refID: "Ecuador"},
				
						{id: 582, title: "Guayas", refID: "Ecuador"},
				
						{id: 583, title: "Imbabura", refID: "Ecuador"},
				
						{id: 584, title: "Loja", refID: "Ecuador"},
				
						{id: 585, title: "Los Ríos", refID: "Ecuador"},
				
						{id: 586, title: "Manabí", refID: "Ecuador"},
				
						{id: 587, title: "Morona Santiago", refID: "Ecuador"},
				
						{id: 588, title: "Napo", refID: "Ecuador"},
				
						{id: 589, title: "Orellana", refID: "Ecuador"},
				
						{id: 590, title: "Pastaza", refID: "Ecuador"},
				
						{id: 591, title: "Pichincha", refID: "Ecuador"},
				
						{id: 592, title: "Sucumbíos", refID: "Ecuador"},
				
						{id: 593, title: "Tungurahua", refID: "Ecuador"},
				
						{id: 594, title: "Zamora Chinchipe", refID: "Ecuador"},
				
						{id: 114, title: "All", refID: "Finland"},
				
						{id: 157, title: "Alsace", refID: "France"},
				
						{id: 152, title: "Aquitaine", refID: "France"},
				
						{id: 155, title: "Auvergne", refID: "France"},
				
						{id: 159, title: "Basse-Normandie", refID: "France"},
				
						{id: 164, title: "Bourgogne", refID: "France"},
				
						{id: 167, title: "Bretagne", refID: "France"},
				
						{id: 161, title: "Centre", refID: "France"},
				
						{id: 160, title: "Champagne-Ardenne", refID: "France"},
				
						{id: 162, title: "Corse", refID: "France"},
				
						{id: 145, title: "DOM", refID: "France"},
				
						{id: 165, title: "Franche-Comté", refID: "France"},
				
						{id: 150, title: "Haute-Normandie", refID: "France"},
				
						{id: 147, title: "Ile-de-France", refID: "France"},
				
						{id: 163, title: "Languedoc-Roussillon", refID: "France"},
				
						{id: 151, title: "Limousin", refID: "France"},
				
						{id: 168, title: "Lorraine", refID: "France"},
				
						{id: 148, title: "Midi-Pyrénées", refID: "France"},
				
						{id: 156, title: "Nord-Pas-de-Calais", refID: "France"},
				
						{id: 153, title: "PACA", refID: "France"},
				
						{id: 154, title: "Pays de la Loire", refID: "France"},
				
						{id: 158, title: "Picardie", refID: "France"},
				
						{id: 149, title: "Poitou-Charentes", refID: "France"},
				
						{id: 166, title: "Rhône-Alpes", refID: "France"},
				
						{id: 146, title: "TOM", refID: "France"},
				
						{id: 324, title: "Baden-Württemberg", refID: "Germany"},
				
						{id: 326, title: "Bayern", refID: "Germany"},
				
						{id: 320, title: "Berlin", refID: "Germany"},
				
						{id: 336, title: "Brandenburg", refID: "Germany"},
				
						{id: 328, title: "Bremen", refID: "Germany"},
				
						{id: 327, title: "Hamburg", refID: "Germany"},
				
						{id: 335, title: "Hessen", refID: "Germany"},
				
						{id: 322, title: "Mecklenburg-Vorpommern", refID: "Germany"},
				
						{id: 334, title: "Niedersachsen", refID: "Germany"},
				
						{id: 321, title: "Nordrhein-Westfalen", refID: "Germany"},
				
						{id: 329, title: "Rheinland-Pfalz", refID: "Germany"},
				
						{id: 323, title: "Saarland", refID: "Germany"},
				
						{id: 330, title: "Sachsen ", refID: "Germany"},
				
						{id: 325, title: "Sachsen-Anhalt", refID: "Germany"},
				
						{id: 333, title: "Schleswig-Holstein", refID: "Germany"},
				
						{id: 331, title: "Thüringen", refID: "Germany"},
				
						{id: 87, title: "Central And Western", refID: "Hong Kong"},
				
						{id: 88, title: "Eastern", refID: "Hong Kong"},
				
						{id: 89, title: "Islands", refID: "Hong Kong"},
				
						{id: 90, title: "Kowloon City", refID: "Hong Kong"},
				
						{id: 91, title: "Kwai Tsing", refID: "Hong Kong"},
				
						{id: 92, title: "Kwun Tong", refID: "Hong Kong"},
				
						{id: 93, title: "North", refID: "Hong Kong"},
				
						{id: 94, title: "Sai Kung", refID: "Hong Kong"},
				
						{id: 95, title: "Sha Tin", refID: "Hong Kong"},
				
						{id: 96, title: "Sham Shui Po", refID: "Hong Kong"},
				
						{id: 97, title: "Southern", refID: "Hong Kong"},
				
						{id: 98, title: "Tai Po", refID: "Hong Kong"},
				
						{id: 99, title: "Tsuen Wan", refID: "Hong Kong"},
				
						{id: 100, title: "Tuen Mun", refID: "Hong Kong"},
				
						{id: 101, title: "Wan Chai", refID: "Hong Kong"},
				
						{id: 102, title: "Wong Tai Sin", refID: "Hong Kong"},
				
						{id: 103, title: "Yau Tsim Mong", refID: "Hong Kong"},
				
						{id: 104, title: "Yuen Long", refID: "Hong Kong"},
				
						{id: 119, title: "Carlow", refID: "Ireland"},
				
						{id: 120, title: "Cavan", refID: "Ireland"},
				
						{id: 121, title: "Clare", refID: "Ireland"},
				
						{id: 122, title: "Cork", refID: "Ireland"},
				
						{id: 123, title: "Donegal", refID: "Ireland"},
				
						{id: 124, title: "Dublin", refID: "Ireland"},
				
						{id: 125, title: "Galway", refID: "Ireland"},
				
						{id: 126, title: "Kerry", refID: "Ireland"},
				
						{id: 127, title: "Kildare", refID: "Ireland"},
				
						{id: 128, title: "Kilkenny", refID: "Ireland"},
				
						{id: 129, title: "Laois", refID: "Ireland"},
				
						{id: 130, title: "Leitrim", refID: "Ireland"},
				
						{id: 131, title: "Limerick", refID: "Ireland"},
				
						{id: 132, title: "Longford", refID: "Ireland"},
				
						{id: 133, title: "Louth", refID: "Ireland"},
				
						{id: 134, title: "Mayo", refID: "Ireland"},
				
						{id: 135, title: "Meath", refID: "Ireland"},
				
						{id: 136, title: "Monaghan", refID: "Ireland"},
				
						{id: 137, title: "Offaly", refID: "Ireland"},
				
						{id: 138, title: "Roscommon", refID: "Ireland"},
				
						{id: 139, title: "Sligo", refID: "Ireland"},
				
						{id: 140, title: "Tipperary", refID: "Ireland"},
				
						{id: 141, title: "Waterford", refID: "Ireland"},
				
						{id: 142, title: "Westmeath", refID: "Ireland"},
				
						{id: 143, title: "Wexford", refID: "Ireland"},
				
						{id: 144, title: "Wicklow", refID: "Ireland"},
				
						{id: 217, title: "Agrigento", refID: "Italy"},
				
						{id: 218, title: "Alessandria", refID: "Italy"},
				
						{id: 219, title: "Ancona", refID: "Italy"},
				
						{id: 220, title: "Aosta", refID: "Italy"},
				
						{id: 221, title: "Arezzo", refID: "Italy"},
				
						{id: 222, title: "Ascoli Piceno", refID: "Italy"},
				
						{id: 223, title: "Asti", refID: "Italy"},
				
						{id: 224, title: "Avellino", refID: "Italy"},
				
						{id: 225, title: "Bari", refID: "Italy"},
				
						{id: 226, title: "Belluno", refID: "Italy"},
				
						{id: 227, title: "Benevento", refID: "Italy"},
				
						{id: 228, title: "Bergamo", refID: "Italy"},
				
						{id: 229, title: "Biella", refID: "Italy"},
				
						{id: 230, title: "Bologna", refID: "Italy"},
				
						{id: 231, title: "Bolzano", refID: "Italy"},
				
						{id: 232, title: "Brescia", refID: "Italy"},
				
						{id: 233, title: "Brindisi", refID: "Italy"},
				
						{id: 234, title: "Cagliari", refID: "Italy"},
				
						{id: 235, title: "Caltanissetta", refID: "Italy"},
				
						{id: 236, title: "Campobasso", refID: "Italy"},
				
						{id: 237, title: "Caserta", refID: "Italy"},
				
						{id: 238, title: "Catania", refID: "Italy"},
				
						{id: 239, title: "Catanzaro", refID: "Italy"},
				
						{id: 240, title: "Chieti", refID: "Italy"},
				
						{id: 241, title: "Como", refID: "Italy"},
				
						{id: 242, title: "Cosenza", refID: "Italy"},
				
						{id: 243, title: "Cremona", refID: "Italy"},
				
						{id: 244, title: "Crotone", refID: "Italy"},
				
						{id: 245, title: "Cuneo", refID: "Italy"},
				
						{id: 246, title: "Enna", refID: "Italy"},
				
						{id: 247, title: "Ferrara", refID: "Italy"},
				
						{id: 248, title: "Firenze", refID: "Italy"},
				
						{id: 249, title: "Foggia", refID: "Italy"},
				
						{id: 250, title: "Forlì - Cesena", refID: "Italy"},
				
						{id: 251, title: "Frosinone", refID: "Italy"},
				
						{id: 252, title: "Genova", refID: "Italy"},
				
						{id: 253, title: "Gorizia", refID: "Italy"},
				
						{id: 254, title: "Grosseto", refID: "Italy"},
				
						{id: 255, title: "Imperia", refID: "Italy"},
				
						{id: 256, title: "Isernia", refID: "Italy"},
				
						{id: 257, title: "La Spezia", refID: "Italy"},
				
						{id: 258, title: "L'Aquila", refID: "Italy"},
				
						{id: 259, title: "Latina", refID: "Italy"},
				
						{id: 260, title: "Lecce", refID: "Italy"},
				
						{id: 261, title: "Lecco", refID: "Italy"},
				
						{id: 262, title: "Livorno", refID: "Italy"},
				
						{id: 263, title: "Lodi", refID: "Italy"},
				
						{id: 264, title: "Lucca", refID: "Italy"},
				
						{id: 265, title: "Macerata", refID: "Italy"},
				
						{id: 266, title: "Mantova", refID: "Italy"},
				
						{id: 267, title: "Massa Carrara", refID: "Italy"},
				
						{id: 268, title: "Matera", refID: "Italy"},
				
						{id: 269, title: "Messina", refID: "Italy"},
				
						{id: 270, title: "Milano", refID: "Italy"},
				
						{id: 271, title: "Modena", refID: "Italy"},
				
						{id: 272, title: "Napoli", refID: "Italy"},
				
						{id: 273, title: "Novara", refID: "Italy"},
				
						{id: 274, title: "Nuoro", refID: "Italy"},
				
						{id: 275, title: "Oristano", refID: "Italy"},
				
						{id: 276, title: "Padova", refID: "Italy"},
				
						{id: 277, title: "Palermo", refID: "Italy"},
				
						{id: 278, title: "Parma", refID: "Italy"},
				
						{id: 279, title: "Pavia", refID: "Italy"},
				
						{id: 280, title: "Perugia", refID: "Italy"},
				
						{id: 281, title: "Pesaro", refID: "Italy"},
				
						{id: 282, title: "Pescara", refID: "Italy"},
				
						{id: 283, title: "Piacenza", refID: "Italy"},
				
						{id: 284, title: "Pisa", refID: "Italy"},
				
						{id: 285, title: "Pistoia", refID: "Italy"},
				
						{id: 286, title: "Pordenone", refID: "Italy"},
				
						{id: 287, title: "Potenza", refID: "Italy"},
				
						{id: 288, title: "Prato", refID: "Italy"},
				
						{id: 289, title: "Ragusa", refID: "Italy"},
				
						{id: 290, title: "Ravenna", refID: "Italy"},
				
						{id: 291, title: "Reggio Calabria", refID: "Italy"},
				
						{id: 292, title: "Reggio Emilia", refID: "Italy"},
				
						{id: 293, title: "Rieti", refID: "Italy"},
				
						{id: 294, title: "Rimini", refID: "Italy"},
				
						{id: 295, title: "Roma", refID: "Italy"},
				
						{id: 296, title: "Rovigo", refID: "Italy"},
				
						{id: 297, title: "Salerno", refID: "Italy"},
				
						{id: 298, title: "Sassari", refID: "Italy"},
				
						{id: 299, title: "Savona", refID: "Italy"},
				
						{id: 300, title: "Siena", refID: "Italy"},
				
						{id: 301, title: "Siracusa", refID: "Italy"},
				
						{id: 302, title: "Sondrio", refID: "Italy"},
				
						{id: 303, title: "Taranto", refID: "Italy"},
				
						{id: 304, title: "Teramo", refID: "Italy"},
				
						{id: 305, title: "Terni", refID: "Italy"},
				
						{id: 306, title: "Torino", refID: "Italy"},
				
						{id: 307, title: "Trapani", refID: "Italy"},
				
						{id: 308, title: "Trento", refID: "Italy"},
				
						{id: 309, title: "Treviso", refID: "Italy"},
				
						{id: 310, title: "Trieste", refID: "Italy"},
				
						{id: 311, title: "Udine", refID: "Italy"},
				
						{id: 312, title: "Varese", refID: "Italy"},
				
						{id: 313, title: "Venezia", refID: "Italy"},
				
						{id: 314, title: "Verbania-Cusio-Ossola", refID: "Italy"},
				
						{id: 315, title: "Vercelli", refID: "Italy"},
				
						{id: 316, title: "Verona", refID: "Italy"},
				
						{id: 317, title: "Vibo Valenza", refID: "Italy"},
				
						{id: 318, title: "Vicenza", refID: "Italy"},
				
						{id: 319, title: "Viterbo", refID: "Italy"},
				
						{id: 195, title: "三重県", refID: "Japan"},
				
						{id: 170, title: "京都府", refID: "Japan"},
				
						{id: 210, title: "佐賀県", refID: "Japan"},
				
						{id: 202, title: "兵庫県", refID: "Japan"},
				
						{id: 205, title: "北海道", refID: "Japan"},
				
						{id: 180, title: "千葉県", refID: "Japan"},
				
						{id: 186, title: "和歌山県", refID: "Japan"},
				
						{id: 216, title: "埼玉県", refID: "Japan"},
				
						{id: 187, title: "大分県", refID: "Japan"},
				
						{id: 172, title: "大阪府", refID: "Japan"},
				
						{id: 208, title: "奈良県", refID: "Japan"},
				
						{id: 204, title: "宮城県", refID: "Japan"},
				
						{id: 214, title: "宮崎県", refID: "Japan"},
				
						{id: 185, title: "富山県", refID: "Japan"},
				
						{id: 215, title: "山口県", refID: "Japan"},
				
						{id: 190, title: "山形県", refID: "Japan"},
				
						{id: 193, title: "山梨県", refID: "Japan"},
				
						{id: 177, title: "岐阜県", refID: "Japan"},
				
						{id: 178, title: "岡山県", refID: "Japan"},
				
						{id: 188, title: "岩手県", refID: "Japan"},
				
						{id: 213, title: "島根県", refID: "Japan"},
				
						{id: 176, title: "広島県", refID: "Japan"},
				
						{id: 200, title: "徳島県", refID: "Japan"},
				
						{id: 173, title: "愛媛県", refID: "Japan"},
				
						{id: 194, title: "愛知県", refID: "Japan"},
				
						{id: 203, title: "新潟県", refID: "Japan"},
				
						{id: 199, title: "東京都", refID: "Japan"},
				
						{id: 192, title: "栃木県", refID: "Japan"},
				
						{id: 206, title: "沖縄県", refID: "Japan"},
				
						{id: 181, title: "滋賀県", refID: "Japan"},
				
						{id: 183, title: "熊本県", refID: "Japan"},
				
						{id: 175, title: "石川県", refID: "Japan"},
				
						{id: 174, title: "神奈川県", refID: "Japan"},
				
						{id: 209, title: "福井県", refID: "Japan"},
				
						{id: 201, title: "福岡県", refID: "Japan"},
				
						{id: 184, title: "福島県", refID: "Japan"},
				
						{id: 191, title: "秋田県", refID: "Japan"},
				
						{id: 189, title: "群馬県", refID: "Japan"},
				
						{id: 196, title: "茨城県", refID: "Japan"},
				
						{id: 179, title: "長崎県", refID: "Japan"},
				
						{id: 198, title: "長野県", refID: "Japan"},
				
						{id: 207, title: "青森県", refID: "Japan"},
				
						{id: 171, title: "静岡県", refID: "Japan"},
				
						{id: 197, title: "香川県", refID: "Japan"},
				
						{id: 182, title: "高知県", refID: "Japan"},
				
						{id: 211, title: "鳥取県", refID: "Japan"},
				
						{id: 212, title: "鹿児島県", refID: "Japan"},
				
						{id: 418, title: "Aguascalientes", refID: "Mexico"},
				
						{id: 419, title: "Baja California", refID: "Mexico"},
				
						{id: 420, title: "Baja California Sur", refID: "Mexico"},
				
						{id: 421, title: "Campeche", refID: "Mexico"},
				
						{id: 422, title: "Chiapas", refID: "Mexico"},
				
						{id: 423, title: "Chihuahua", refID: "Mexico"},
				
						{id: 424, title: "Coahuila", refID: "Mexico"},
				
						{id: 425, title: "Colima", refID: "Mexico"},
				
						{id: 426, title: "Distrito Federal", refID: "Mexico"},
				
						{id: 427, title: "Durango", refID: "Mexico"},
				
						{id: 428, title: "Guanajuato", refID: "Mexico"},
				
						{id: 429, title: "Guerrero", refID: "Mexico"},
				
						{id: 430, title: "Hidalgo", refID: "Mexico"},
				
						{id: 431, title: "Jalisco", refID: "Mexico"},
				
						{id: 432, title: "México", refID: "Mexico"},
				
						{id: 433, title: "Michoacán", refID: "Mexico"},
				
						{id: 434, title: "Morelos", refID: "Mexico"},
				
						{id: 435, title: "Nayarit", refID: "Mexico"},
				
						{id: 436, title: "Nuevo León", refID: "Mexico"},
				
						{id: 437, title: "Oaxaca", refID: "Mexico"},
				
						{id: 438, title: "Puebla", refID: "Mexico"},
				
						{id: 439, title: "Querétaro", refID: "Mexico"},
				
						{id: 440, title: "Quintana Roo", refID: "Mexico"},
				
						{id: 441, title: "San Luis Potosí", refID: "Mexico"},
				
						{id: 442, title: "Sinaloa", refID: "Mexico"},
				
						{id: 443, title: "Sonora", refID: "Mexico"},
				
						{id: 444, title: "Tabasco", refID: "Mexico"},
				
						{id: 445, title: "Tamaulipas", refID: "Mexico"},
				
						{id: 446, title: "Tlaxcala", refID: "Mexico"},
				
						{id: 447, title: "Veracruz", refID: "Mexico"},
				
						{id: 448, title: "Yucatán", refID: "Mexico"},
				
						{id: 449, title: "Zacatecas ", refID: "Mexico"},
				
						{id: 389, title: "Drenthe", refID: "Netherlands"},
				
						{id: 390, title: "Flevoland", refID: "Netherlands"},
				
						{id: 391, title: "Friesland", refID: "Netherlands"},
				
						{id: 392, title: "Gelderland", refID: "Netherlands"},
				
						{id: 393, title: "Groningen", refID: "Netherlands"},
				
						{id: 394, title: "Limburg", refID: "Netherlands"},
				
						{id: 395, title: "Noord-Brabant", refID: "Netherlands"},
				
						{id: 396, title: "Noord-Holland", refID: "Netherlands"},
				
						{id: 397, title: "Overijssel", refID: "Netherlands"},
				
						{id: 398, title: "Utrecht", refID: "Netherlands"},
				
						{id: 399, title: "Zeeland", refID: "Netherlands"},
				
						{id: 400, title: "Zuid-Holland", refID: "Netherlands"},
				
						{id: 402, title: "Auckland", refID: "New Zealand"},
				
						{id: 403, title: "Bay of Plenty", refID: "New Zealand"},
				
						{id: 404, title: "Canterbury", refID: "New Zealand"},
				
						{id: 405, title: "Gisborne", refID: "New Zealand"},
				
						{id: 406, title: "Hawke's Bay", refID: "New Zealand"},
				
						{id: 407, title: "Manawatu-Wanganui", refID: "New Zealand"},
				
						{id: 408, title: "Marlborough", refID: "New Zealand"},
				
						{id: 409, title: "Nelson", refID: "New Zealand"},
				
						{id: 410, title: "Northland", refID: "New Zealand"},
				
						{id: 411, title: "Otago", refID: "New Zealand"},
				
						{id: 412, title: "Southland", refID: "New Zealand"},
				
						{id: 413, title: "Taranaki", refID: "New Zealand"},
				
						{id: 414, title: "Tasman", refID: "New Zealand"},
				
						{id: 415, title: "Waikato", refID: "New Zealand"},
				
						{id: 416, title: "Wellington", refID: "New Zealand"},
				
						{id: 417, title: "West Coast", refID: "New Zealand"},
				
						{id: 118, title: "All", refID: "Norway"},
				
						{id: 595, title: "Amazonas", refID: "Peru"},
				
						{id: 596, title: "Ancash", refID: "Peru"},
				
						{id: 597, title: "Apurímac", refID: "Peru"},
				
						{id: 598, title: "Arequipa", refID: "Peru"},
				
						{id: 599, title: "Ayacucho", refID: "Peru"},
				
						{id: 600, title: "Cajamarca", refID: "Peru"},
				
						{id: 601, title: "Callao", refID: "Peru"},
				
						{id: 602, title: "Cusco", refID: "Peru"},
				
						{id: 603, title: "Huancavelica", refID: "Peru"},
				
						{id: 604, title: "Huánuco", refID: "Peru"},
				
						{id: 605, title: "Ica", refID: "Peru"},
				
						{id: 606, title: "Junín", refID: "Peru"},
				
						{id: 607, title: "La Libertad", refID: "Peru"},
				
						{id: 608, title: "Lambayeque", refID: "Peru"},
				
						{id: 609, title: "Lima", refID: "Peru"},
				
						{id: 610, title: "Loreto", refID: "Peru"},
				
						{id: 611, title: "Madre de Dios", refID: "Peru"},
				
						{id: 612, title: "Moquegua", refID: "Peru"},
				
						{id: 613, title: "Pasco", refID: "Peru"},
				
						{id: 614, title: "Piura", refID: "Peru"},
				
						{id: 615, title: "Puno", refID: "Peru"},
				
						{id: 616, title: "San Martín", refID: "Peru"},
				
						{id: 617, title: "Tacna", refID: "Peru"},
				
						{id: 618, title: "Tumbes", refID: "Peru"},
				
						{id: 619, title: "Ucayali", refID: "Peru"},
				
						{id: 111, title: "All", refID: "Singapore"},
				
						{id: 105, title: "East", refID: "Singapore"},
				
						{id: 106, title: "North", refID: "Singapore"},
				
						{id: 107, title: "South", refID: "Singapore"},
				
						{id: 108, title: "West", refID: "Singapore"},
				
						{id: 337, title: "Álava", refID: "Spain"},
				
						{id: 338, title: "Albacete", refID: "Spain"},
				
						{id: 339, title: "Alicante", refID: "Spain"},
				
						{id: 340, title: "Almería", refID: "Spain"},
				
						{id: 341, title: "Asturias", refID: "Spain"},
				
						{id: 342, title: "Ávila", refID: "Spain"},
				
						{id: 343, title: "Badajoz", refID: "Spain"},
				
						{id: 344, title: "Balears, Illes", refID: "Spain"},
				
						{id: 345, title: "Barcelona", refID: "Spain"},
				
						{id: 346, title: "Burgos", refID: "Spain"},
				
						{id: 347, title: "Cáceres", refID: "Spain"},
				
						{id: 348, title: "Cádiz", refID: "Spain"},
				
						{id: 349, title: "Cantabria", refID: "Spain"},
				
						{id: 350, title: "Castellón", refID: "Spain"},
				
						{id: 351, title: "Ceuta", refID: "Spain"},
				
						{id: 352, title: "Ciudad Real", refID: "Spain"},
				
						{id: 353, title: "Córdoba", refID: "Spain"},
				
						{id: 354, title: "Coruña, A", refID: "Spain"},
				
						{id: 355, title: "Cuenca", refID: "Spain"},
				
						{id: 356, title: "Girona/Gerona", refID: "Spain"},
				
						{id: 357, title: "Granada", refID: "Spain"},
				
						{id: 358, title: "Guadalajara", refID: "Spain"},
				
						{id: 359, title: "Guipúzcoa", refID: "Spain"},
				
						{id: 360, title: "Huelva", refID: "Spain"},
				
						{id: 361, title: "Huesca", refID: "Spain"},
				
						{id: 362, title: "Jaén", refID: "Spain"},
				
						{id: 363, title: "León", refID: "Spain"},
				
						{id: 364, title: "Lérida/Lleida", refID: "Spain"},
				
						{id: 365, title: "Lugo", refID: "Spain"},
				
						{id: 366, title: "Madrid", refID: "Spain"},
				
						{id: 367, title: "Málaga", refID: "Spain"},
				
						{id: 368, title: "Melilla", refID: "Spain"},
				
						{id: 369, title: "Murcia", refID: "Spain"},
				
						{id: 370, title: "Navarra", refID: "Spain"},
				
						{id: 371, title: "Ourense", refID: "Spain"},
				
						{id: 372, title: "Palencia", refID: "Spain"},
				
						{id: 373, title: "Palmas, Las", refID: "Spain"},
				
						{id: 374, title: "Pontevedra", refID: "Spain"},
				
						{id: 375, title: "Rioja, La", refID: "Spain"},
				
						{id: 376, title: "Salamanca", refID: "Spain"},
				
						{id: 377, title: "Santa Cruz de Tenerife", refID: "Spain"},
				
						{id: 378, title: "Segovia", refID: "Spain"},
				
						{id: 379, title: "Sevilla", refID: "Spain"},
				
						{id: 380, title: "Soria", refID: "Spain"},
				
						{id: 381, title: "Tarragona", refID: "Spain"},
				
						{id: 382, title: "Teruel", refID: "Spain"},
				
						{id: 383, title: "Toledo", refID: "Spain"},
				
						{id: 384, title: "Valencia", refID: "Spain"},
				
						{id: 385, title: "Valladolid", refID: "Spain"},
				
						{id: 386, title: "Vizcaya", refID: "Spain"},
				
						{id: 387, title: "Zamora", refID: "Spain"},
				
						{id: 388, title: "Zaragoza", refID: "Spain"},
				
						{id: 117, title: "All", refID: "Sweden"},
				
						{id: 660, title: "Blekinge län", refID: "Sweden"},
				
						{id: 667, title: "Dalarnas län", refID: "Sweden"},
				
						{id: 668, title: "Gävleborgs län", refID: "Sweden"},
				
						{id: 659, title: "Gotlands län", refID: "Sweden"},
				
						{id: 662, title: "Hallands län", refID: "Sweden"},
				
						{id: 670, title: "Jämtlands län", refID: "Sweden"},
				
						{id: 656, title: "Jönköpings län", refID: "Sweden"},
				
						{id: 658, title: "Kalmar län", refID: "Sweden"},
				
						{id: 657, title: "Kronobergs län", refID: "Sweden"},
				
						{id: 672, title: "Norrbottens län", refID: "Sweden"},
				
						{id: 665, title: "Örebro län", refID: "Sweden"},
				
						{id: 655, title: "Östergötlands län", refID: "Sweden"},
				
						{id: 661, title: "Skåne län", refID: "Sweden"},
				
						{id: 654, title: "Södermanlands län", refID: "Sweden"},
				
						{id: 652, title: "Stockholms län", refID: "Sweden"},
				
						{id: 653, title: "Uppsala län", refID: "Sweden"},
				
						{id: 664, title: "Värmlands län", refID: "Sweden"},
				
						{id: 671, title: "Västerbottens län", refID: "Sweden"},
				
						{id: 669, title: "Västernorrlands län", refID: "Sweden"},
				
						{id: 666, title: "Västmanlands län", refID: "Sweden"},
				
						{id: 663, title: "Västra Götalands län", refID: "Sweden"},
				
						{id: 65, title: "Channel Islands", refID: "United Kingdom"},
				
						{id: 64, title: "East", refID: "United Kingdom"},
				
						{id: 84, title: "Isle Of Man", refID: "United Kingdom"},
				
						{id: 66, title: "London and South East", refID: "United Kingdom"},
				
						{id: 67, title: "Midlands", refID: "United Kingdom"},
				
						{id: 68, title: "Northeast", refID: "United Kingdom"},
				
						{id: 69, title: "Northern Ireland", refID: "United Kingdom"},
				
						{id: 70, title: "Northwest", refID: "United Kingdom"},
				
						{id: 71, title: "Scotland", refID: "United Kingdom"},
				
						{id: 72, title: "South", refID: "United Kingdom"},
				
						{id: 73, title: "Southwest", refID: "United Kingdom"},
				
						{id: 74, title: "Wales", refID: "United Kingdom"},
				
						{id: 620, title: "Artigas", refID: "Uruguay"},
				
						{id: 621, title: "Canelones", refID: "Uruguay"},
				
						{id: 622, title: "Cerro Largo", refID: "Uruguay"},
				
						{id: 623, title: "Colonia", refID: "Uruguay"},
				
						{id: 624, title: "Durazno", refID: "Uruguay"},
				
						{id: 625, title: "Flores", refID: "Uruguay"},
				
						{id: 626, title: "Florida", refID: "Uruguay"},
				
						{id: 627, title: "Lavalleja", refID: "Uruguay"},
				
						{id: 628, title: "Maldonado", refID: "Uruguay"},
				
						{id: 629, title: "Montevideo", refID: "Uruguay"},
				
						{id: 630, title: "Paysandú", refID: "Uruguay"},
				
						{id: 631, title: "Río Negro", refID: "Uruguay"},
				
						{id: 632, title: "Rivera", refID: "Uruguay"},
				
						{id: 633, title: "Rocha", refID: "Uruguay"},
				
						{id: 634, title: "Salto", refID: "Uruguay"},
				
						{id: 635, title: "San José", refID: "Uruguay"},
				
						{id: 636, title: "Soriano", refID: "Uruguay"},
				
						{id: 637, title: "Tacuarembó", refID: "Uruguay"},
				
						{id: 638, title: "Treinta y Tres", refID: "Uruguay"},
				
						{id: 1, title: "Alabama", refID: "USA"},
				
						{id: 2, title: "Alaska", refID: "USA"},
				
						{id: 3, title: "Arizona", refID: "USA"},
				
						{id: 4, title: "Arkansas", refID: "USA"},
				
						{id: 5, title: "California", refID: "USA"},
				
						{id: 6, title: "Colorado", refID: "USA"},
				
						{id: 7, title: "Connecticut", refID: "USA"},
				
						{id: 8, title: "Delaware", refID: "USA"},
				
						{id: 10, title: "Florida", refID: "USA"},
				
						{id: 11, title: "Georgia", refID: "USA"},
				
						{id: 12, title: "Hawaii", refID: "USA"},
				
						{id: 13, title: "Idaho", refID: "USA"},
				
						{id: 14, title: "Illinois", refID: "USA"},
				
						{id: 15, title: "Indiana", refID: "USA"},
				
						{id: 16, title: "Iowa", refID: "USA"},
				
						{id: 17, title: "Kansas", refID: "USA"},
				
						{id: 18, title: "Kentucky", refID: "USA"},
				
						{id: 19, title: "Louisiana", refID: "USA"},
				
						{id: 20, title: "Maine", refID: "USA"},
				
						{id: 21, title: "Maryland", refID: "USA"},
				
						{id: 22, title: "Massachusetts", refID: "USA"},
				
						{id: 23, title: "Michigan", refID: "USA"},
				
						{id: 24, title: "Minnesota", refID: "USA"},
				
						{id: 25, title: "Mississippi", refID: "USA"},
				
						{id: 26, title: "Missouri", refID: "USA"},
				
						{id: 27, title: "Montana", refID: "USA"},
				
						{id: 28, title: "Nebraska", refID: "USA"},
				
						{id: 29, title: "Nevada", refID: "USA"},
				
						{id: 30, title: "New Hampshire", refID: "USA"},
				
						{id: 31, title: "New Jersey", refID: "USA"},
				
						{id: 32, title: "New Mexico", refID: "USA"},
				
						{id: 33, title: "New York", refID: "USA"},
				
						{id: 34, title: "North Carolina", refID: "USA"},
				
						{id: 35, title: "North Dakota", refID: "USA"},
				
						{id: 36, title: "Ohio", refID: "USA"},
				
						{id: 37, title: "Oklahoma", refID: "USA"},
				
						{id: 38, title: "Oregon", refID: "USA"},
				
						{id: 39, title: "Pennsylvania", refID: "USA"},
				
						{id: 40, title: "Rhode Island", refID: "USA"},
				
						{id: 41, title: "South Carolina", refID: "USA"},
				
						{id: 42, title: "South Dakota", refID: "USA"},
				
						{id: 43, title: "Tennessee", refID: "USA"},
				
						{id: 44, title: "Texas", refID: "USA"},
				
						{id: 45, title: "Utah", refID: "USA"},
				
						{id: 46, title: "Vermont", refID: "USA"},
				
						{id: 47, title: "Virginia", refID: "USA"},
				
						{id: 48, title: "Washington", refID: "USA"},
				
						{id: 9, title: "Washington DC", refID: "USA"},
				
						{id: 49, title: "West Virginia", refID: "USA"},
				
						{id: 50, title: "Wisconsin", refID: "USA"},
				
						{id: 51, title: "Wyoming", refID: "USA"},
				
						{id: 515, title: "Amazonas", refID: "Venezuela"},
				
						{id: 516, title: "Anzoátegui", refID: "Venezuela"},
				
						{id: 517, title: "Apure", refID: "Venezuela"},
				
						{id: 518, title: "Aragua", refID: "Venezuela"},
				
						{id: 519, title: "Barinas", refID: "Venezuela"},
				
						{id: 520, title: "Bolívar", refID: "Venezuela"},
				
						{id: 521, title: "Carabobo", refID: "Venezuela"},
				
						{id: 522, title: "Cojedes", refID: "Venezuela"},
				
						{id: 523, title: "Delta Amacuro  ", refID: "Venezuela"},
				
						{id: 524, title: "Dependencias Federales", refID: "Venezuela"},
				
						{id: 525, title: "Distrito Capital", refID: "Venezuela"},
				
						{id: 526, title: "Falcón", refID: "Venezuela"},
				
						{id: 527, title: "Guárico", refID: "Venezuela"},
				
						{id: 528, title: "Lara", refID: "Venezuela"},
				
						{id: 529, title: "Mérida", refID: "Venezuela"},
				
						{id: 530, title: "Miranda", refID: "Venezuela"},
				
						{id: 531, title: "Monagas", refID: "Venezuela"},
				
						{id: 532, title: "Nueva Esparta  ", refID: "Venezuela"},
				
						{id: 533, title: "Portuguesa", refID: "Venezuela"},
				
						{id: 534, title: "Sucre", refID: "Venezuela"},
				
						{id: 535, title: "Táchira", refID: "Venezuela"},
				
						{id: 536, title: "Trujillo", refID: "Venezuela"},
				
						{id: 537, title: "Vargas", refID: "Venezuela"},
				
						{id: 538, title: "Yaracuy", refID: "Venezuela"},
				
						{id: 539, title: "Zulia", refID: "Venezuela"},
				
				];
		 }
		 
		 else
		 {
		 	var statelist= [
				
						{id: 205, title: "Hokkaido", refID: "Japan"},
				
						{id: 207, title: "Aomori", refID: "Japan"},
				
						{id: 191, title: "Akita", refID: "Japan"},
				
						{id: 188, title: "Iwate", refID: "Japan"},
				
						{id: 204, title: "Miyagi", refID: "Japan"},
				
						{id: 190, title: "Yamagata", refID: "Japan"},
				
						{id: 184, title: "Fukushima", refID: "Japan"},
				
						{id: 196, title: "Ibaraki", refID: "Japan"},
				
						{id: 192, title: "Tochigi", refID: "Japan"},
				
						{id: 189, title: "Gunma", refID: "Japan"},
				
						{id: 216, title: "Saitama", refID: "Japan"},
				
						{id: 180, title: "Chiba", refID: "Japan"},
				
						{id: 199, title: "Tokyo", refID: "Japan"},
				
						{id: 174, title: "Kanagawa", refID: "Japan"},
				
						{id: 193, title: "Yamanashi", refID: "Japan"},
				
						{id: 198, title: "Nagano", refID: "Japan"},
				
						{id: 203, title: "Niigata", refID: "Japan"},
				
						{id: 185, title: "Toyama", refID: "Japan"},
				
						{id: 175, title: "Ishikawa", refID: "Japan"},
				
						{id: 209, title: "Fukui", refID: "Japan"},
				
						{id: 177, title: "Gifu", refID: "Japan"},
				
						{id: 171, title: "Shizuoka", refID: "Japan"},
				
						{id: 194, title: "Aichi", refID: "Japan"},
				
						{id: 195, title: "Mie", refID: "Japan"},
				
						{id: 181, title: "Shiga", refID: "Japan"},
				
						{id: 170, title: "Kyoto", refID: "Japan"},
				
						{id: 172, title: "Osaka", refID: "Japan"},
				
						{id: 202, title: "Hyogo", refID: "Japan"},
				
						{id: 208, title: "Nara", refID: "Japan"},
				
						{id: 186, title: "Wakayama", refID: "Japan"},
				
						{id: 211, title: "Tottori", refID: "Japan"},
				
						{id: 213, title: "Shimane", refID: "Japan"},
				
						{id: 178, title: "Okayama", refID: "Japan"},
				
						{id: 176, title: "Hiroshima", refID: "Japan"},
				
						{id: 215, title: "Yamaguchi", refID: "Japan"},
				
						{id: 200, title: "Tokushima", refID: "Japan"},
				
						{id: 197, title: "Kagawa", refID: "Japan"},
				
						{id: 173, title: "Ehime", refID: "Japan"},
				
						{id: 182, title: "Kochi", refID: "Japan"},
				
						{id: 201, title: "Fukuoka", refID: "Japan"},
				
						{id: 210, title: "Saga", refID: "Japan"},
				
						{id: 179, title: "Nagasaki", refID: "Japan"},
				
						{id: 183, title: "Kumamoto", refID: "Japan"},
				
						{id: 187, title: "Oita", refID: "Japan"},
				
						{id: 214, title: "Miyazaki", refID: "Japan"},
				
						{id: 212, title: "Kagoshima", refID: "Japan"},
				
						{id: 206, title: "Okinawa", refID: "Japan"},
				
				];
		 
		 }	
	
	objstate.options.length = 1;

		if( !(userBrowser.indexOf('msie') + 1) )
			statesNum = statelist.length;
		else
			statesNum = statelist.length - 1;
		
		cid =document.theForm.country[document.theForm.country.selectedIndex].value;
		var counter = 0;
		for ( i=0; i < statesNum; i++ ){
			
			if ( getCountryCode(statelist[i].refID)==cid){
				counter++;
				objstate.options[counter]=new Option( statelist[i].title, statelist[i].title+"|"+statelist[i].id);
			}
		}	
		
	
		if(counter>0 && countryCode!='US')
		{
		 	document.getElementById('regionDropdown').style.display='';
		}
		
		else
		{
			document.getElementById('regionDropdown').style.display='none';
		}


}
function handleOnChangePreferredCulture() 
{
		
		d = document.theForm.preferredCulture;
		i = d.selectedIndex;
		val = d[i].value;
	
	
	var userAgreementTextarea = document.getElementById('userAgreementTextarea');
	if (val == 'ja-JP') {
		if (userAgreementTextarea) userAgreementTextarea.style.display='';
	} else {
		if (userAgreementTextarea) userAgreementTextarea.style.display='none';
	}
	
	strDisclaimer=GetDisclaimer(val);
	document.getElementById('sp_legal').innerHTML= strDisclaimer;	
}

function GetDisclaimer (val)
{

	TermsURL =document.getElementById('TermsURL').value;
	strTermsURL="<a href=\""+TermsURL+"\"  target=\"_blank\" style=\"text-decoration:underline;font-size:10px;color:0000FF;font-weight:normal;\">Terms of Service</a>";
	 
	strPrivacyURL="<a href=\"http://www.myspace.com/Modules/Common/Pages/Privacy.aspx\"  target=\"_blank\" style=\"text-decoration:underline;font-size:10px;color:0000FF;font-weight:normal;\">Privacy Policy</a>";
	strTermsURL1="";
    strPrivacyURL1="";
	strDisclaimerMultiCulture="";
	 
	switch (val){	
	case "en-IE": 
		strDisclaimer="By checking the box, you confirm that you know MySpace.com is a website operated by MySpace in the U.S., and you consent to the transfer of your personal data to the U.S. , where your personal data will be subject to U.S. law and where the level of data protection is different and may be less favorable to you compared to your country. You also agree to the MySpace {0} and {1} which describe how your personal data will be used.";
		if("" != "")	  
			strDisclaimerMultiCulture="By checking the box, you confirm that you know MySpace.com is a website operated by MySpace in the U.S., and you consent to the transfer of your personal data to the U.S. , where your personal data will be subject to U.S. law and where the level of data protection is different and may be less favorable to you compared to your country. You also agree to the MySpace {0} and {1} which describe how your personal data will be used.";
		break;
	case "en-US": 
		strDisclaimer="By checking the box you agree to the MySpace {0} and {1}.";
		if("" != "")	  
			strDisclaimerMultiCulture="By checking the box you agree to the MySpace {0} and {1}.";
		break;
  case "zh-CN": 
		strDisclaimer="By checking the box, you confirm that you know MySpace.com is a website operated by MySpace in the U.S., and you consent to the transfer of your personal data to the U.S. , where your personal data will be subject to U.S. law and where the level of data protection is different compared to your country. You also agree to the MySpace {0} and {1} which describe how your personal data will be used.";
		if("" != "")	  
			strDisclaimerMultiCulture="By checking the box, you confirm that you know MySpace.com is a website operated by MySpace in the U.S., and you consent to the transfer of your personal data to the U.S. , where your personal data will be subject to U.S. law and where the level of data protection is different compared to your country. You also agree to the MySpace {0} and {1} which describe how your personal data will be used.";
		break;
	//Ireland and the US have different disclaimers.  If it is any other country, we can default to the generic Australian disclaimer
	default : 
		strDisclaimer="By checking the box, you confirm that you know MySpace.com is a website operated by MySpace in the U.S., and you consent to the transfer of your personal data to the U.S. , where your personal data will be subject to U.S. law and where the level of data protection is different compared to your country. You also agree to the MySpace {0} and {1} which describe how your personal data will be used.";
 		if("" != "")   
   			strDisclaimerMultiCulture="By checking the box, you confirm that you know MySpace.com is a website operated by MySpace in the U.S., and you consent to the transfer of your personal data to the U.S. , where your personal data will be subject to U.S. law and where the level of data protection is different compared to your country. You also agree to the MySpace {0} and {1} which describe how your personal data will be used.";
 	    break;
	}
	
	strDisclaimer=strDisclaimer.replace("{0}",strTermsURL);
	strDisclaimer=strDisclaimer.replace("{1}",strPrivacyURL);	
	
	//strDisclaimerMultiCulture is just for Canada.  Because Canada is a bilingual country, we show the disclaimer in both languages.
	//strDisclaimerMultiCulture is the second chunk of text.  It can be either French or English.1
	if(strDisclaimerMultiCulture != "")
	{
		strTermsURLMultiCulture="<a href=\""+TermsURL+"\"  target=\"_blank\" style=\"text-decoration:underline;font-size:10px;color:0000FF;font-weight:normal;\">Terms of Service</a>"; 
		strPrivacyURLMultiCulture="<a href=\"http://www.myspace.com/Modules/Common/Pages/Privacy.aspx\"  target=\"_blank\" style=\"text-decoration:underline;font-size:10px;color:0000FF;font-weight:normal;\">Privacy Policy</a>";
		
		strDisclaimerMultiCulture=strDisclaimerMultiCulture.replace("{0}",strTermsURLMultiCulture);
		strDisclaimerMultiCulture=strDisclaimerMultiCulture.replace("{1}",strPrivacyURLMultiCulture);
		strDisclaimer=strDisclaimer+"<br/><br/>"+strDisclaimerMultiCulture;
		
	}
		
	return strDisclaimer;
}

//-->

String.prototype.trim = function() { return this.replace(/^\s+|\s+$/g, ""); };
	
function validatePostalCode() {
	var country = document.theForm.country;
	var postalCode = document.theForm.postalCode;
	var countryZipCodeKey = "";
	var isValid = true;
	
	countryZipCodeKey = getCountryZipCodeKey(country.value)
	if(countryZipCodeKey!="") {
		var items = countryZipCodeKey.split(":")
		
		//Strip space from SE postal code
		if (items[0] == "SE" && postalCode.value.indexOf(" " ) >= 0)
		{	
			var temp = postalCode.value;
			postalCode.value = temp.replace(/\s/g,"");
		}
		if(items[1]=="1") {
			if(postalCode.value.trim()=="") {
				alert("Please enter a Postal Code.");
				postalCode.focus();
				return false;
			}
			else if(!isNumeric(postalCode.value.trim())) {
				if(items[0] != "US" && items[0] != "UK" && 
					items[0] != "JP" && items[0] != "CA" && 
					items[0] != "NL" && items[0] != "SE") {
					
					alert("Please enter a valid Postal Code.");
					postalCode.focus();
					return false;
				}
			}
			else {
				isValid = isValidPostalCode(items[0],
					postalCode.value.trim());
			}
		}
		else {
			isValid = isValidPostalCode(items[0],
				postalCode.value.trim());
		}
		
		if(!isValid) {
			alert("Invalid zip code");
			return false;
		}
	}
	
	return isValid;
}

function isValidPostalCode(countryCode, postalCodeValue) {
	if(countryCode=="AU") {
		if(postalCodeValue.length != 4) {
			return false;
		}
	}
	else if(countryCode=="FR" || countryCode=="DE" || 
		countryCode=="IT" || countryCode=="ES" || 
		countryCode=="MX" || countryCode=="SE" ) {
		if(postalCodeValue.length != 5) {
			return false;
		}
	}
	else if(countryCode=="AT" || countryCode=="BE" || 
		countryCode=="CH") {
		
		if(postalCodeValue.length == 4) {
			if(postalCodeValue.charAt(0)=="0") {
				return false;
			}
		}
		else {
			return false;
		}
	}
	else if(countryCode=="NL") {
		
		if(postalCodeValue.length <= 6) {
			if(postalCodeValue.charAt(0)=="0") {
				return false;
			}
		}
		else {
			return false;
		}
		
	}

	return true;
}

function getCountryZipCodeKey(countryCode) {
	// Key - "US:0" (CountryCode:IsZipCodeRequired)
	var countryCheckList = new Array("AU:1","AT:1","BE:1","CA:1","FR:1",
					  "DE:1","IT:1","JP:1","ES:1",
					  "NL:1","CH:1","UK:1", "US:1", 
					  "MX:1", "SE:1");
	var items;
					  
	for(var i=0; i<countryCheckList.length; i++) {
		items = countryCheckList[i].split(":");
		if(countryCode==items[0])
			return countryCheckList[i].toString();
	}
	
	return "";
}

function displayPostalCodeSample(countryCode) {
	var sampleText = "example: ";
	var e = document.getElementById("postalCodeSample");
	
	e.innerHTML = "";
	if(countryCode=="AU") {
		e.innerHTML = sampleText + " 0123";
	}
	else if(countryCode=="FR" || countryCode=="DE" || 
		countryCode=="IT" || countryCode=="ES" || 
		countryCode=="MX") {
		e.innerHTML = sampleText + " 01234";
	}
	else if(countryCode=="AT" || countryCode=="BE" || 
		countryCode=="NL" || countryCode=="CH") {
		e.innerHTML = sampleText + " 1234";
	}
	else if(countryCode=="SE") {
		e.innerHTML = sampleText + "012 34";
	}
}

function isNumeric(s) { 
	var validChars = "0123456789"; 
	var c;
	 
	for (i = 0; i < s.length; i++) {
		c = s.charAt(i);
		if (validChars.indexOf(c) == -1) {
			return false;
		}
	}
	
	return true;
}

</script>


	

<!-- 1400123034382 -->
<html lang="en" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="en" />
	<title>Myspace.com</title>
	<meta name="description" content="Find old friends and meet new friends as you network, share photos, create blogs, and more at MySpace.com">
	<meta name="keywords" content="friends networking sharing photos finding friends blogs journals blogging journaling bands music rate pics join groups forums classifieds online social networking">
	<meta http-equiv="expires" content="0">
	<meta http-equiv="Pragma" content="no-cache">
	<link rel="stylesheet" type="text/css" href="http://x.myspace.com/js/myspace.css">
	<link rel="stylesheet" type="text/css" href="http://x.myspace.com/js/google-003.css">
<script type="text/javascript">
	randomseed = Date.parse(new Date());
	var ad_Topic_ID =	0;	
</script>


	<script type="text/javascript">
		var	ad_Video_CID =	0;
		var	ad_Video_RID =	0;
	</script>

<script type="text/javascript">
function InsertWatermark(searchtype){
	if ("en-US" != "ja-JP")
		return;
	var strWarning = "CurrOnlySearchEnglish";
	if (document.srch.q.value == strWarning)
		document.srch.q.value = '';
	switch (searchtype){
		case "tms": document.srch.q.value = strWarning; break;
	}
}
function ChangeAction(){
	var searchvalue = document.SearchFormHeader.searchrequest.value;
	if(document.SearchFormHeader.searchrequest.value !=="") {
		if (document.SearchFormHeader.searchtype[1].checked) {
			
				document.SearchFormHeader.action = "http://searchresults.myspace.com/index.cfm?fuseaction=advancedFind.results&websearch=1&spotId=3&Mytoken=050DFECD-081B-4A83-AFABE341DF372E5350712054";
			
		}
		else if (document.SearchFormHeader.searchtype[0].checked) {
			
				document.SearchFormHeader.action = "http://searchresults.myspace.com/index.cfm?fuseaction=advancedFind.web&websearch=1&spotId=3&Mytoken=050DFECD-081B-4A83-AFABE341DF372E5350712054";
			
		}
		return true;
	}
}

function full(vid){
	var fs = window.open( "http://vids.myspace.com/index.cfm?fuseaction=vids.fullscreen&videoid=" +vid, "fsv",
		"toolbar=no,width=" +screen.availWidth  +",height=" +screen.availHeight +",status=no,resizable=yes,fullscreen=yes,scrollbars=no");
	fs.focus();
}
</script>
<script type="text/javascript" src="http://x.myspace.com/js/myspaceJS037.js"></script>










<!-- CMS:29be3023-326a-4472-b34d-a9cb8ad7be06:20061115.1 -->
<!-- CMS Placement ID = "" -->
<!-- End CMS Content -->


</head>
<body bgcolor="e5e5e5" bottommargin="0" leftmargin="0" rightmargin="0" topmargin="0" onLoad="" text="000000" alink="003399" vlink="003399" link="003399">
<script type="text/javascript">if(top != self){top.location.replace(self.location.href);}</script>
<div id="tipDiv" style="position:absolute; visibility:hidden; z-index:100"></div>
<div align="center">
	<table width="800" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="003399">
	
		<tr valign="top">
			<td style="padding:8px 0 0 27px;">&nbsp;
			
				
				
				<a class="navbar" href="http://www.myspace.com/" style="color:#fff">MySpace.com</a>&nbsp;<font color="FFFFFF">|</font>
				<a class="man" href="http://www.myspace.com/Modules/Help/Pages/HelpCenter.aspx?&Mytoken=050DFECD-081B-4A83-AFABE341DF372E5350712054">
					<font color="FFFFFF">Help</font>
				</a><font color="FFFFFF" size="1">|</font>
				
					<a class="man" href="http://signup.myspace.com/index.cfm?fuseaction=Join&Mytoken=050DFECD-081B-4A83-AFABE341DF372E5350712054"><font color="FFFFFF">SignUp</font></a>&nbsp;
				

				
				
			
			</td>
			
			<td align="left">&nbsp;</td>
		</tr>
	
	</table>
	

	
<table width="800" border="0" align="center" cellspacing="0" cellpadding="0">
	<tr>
		<td height="96" align="center" valign="top" bgcolor="003399" id="leaderboardRegion">
	
		
		
			

			
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
				
					<td align="center"><img src="http://x.myspace.com/images/bnr_join_v3.gif"></td>
				  
				</tr>
			</table>
			
		

	
		</td>
	</tr>
</table>








<script type="text/javascript" src="http://x.myspace.com/js/searchHeader-004.js"></script>
<link rel="stylesheet" type="text/css" href="http://x.myspace.com/js/searchHeader-002.css" media="all" />
<script type="text/javascript">
	var searchMenu = new MySpaceSearchMenu('searchMenu', 'en-US');
	searchMenu.invalidSearchMessage = 'This search term is too short or blank.';
	searchMenu.AddTab('tweb', "Web");
	searchMenu.AddTab('tms', "MySpace");
	searchMenu.AddTab('tpeople', "People");
	searchMenu.AddTab('tmusic', "Music");
	searchMenu.AddTab('tvideos', "Music Videos");
	searchMenu.AddTab('tblog', "Blogs");
	searchMenu.AddTab('tvid', "Videos");
	searchMenu.AddTab('tfilm', "Film");
	searchMenu.AddTab('tbooks', "Books");
	searchMenu.AddTab('tclass', "Classifieds");
	searchMenu.AddTab('tevents', "Events");
	searchMenu.AddTab('tcomedy', "Comedy");
	searchMenu.AddTab('tgroups', "Groups");
	searchMenu.AddTab('tjobs', "Jobs");
	searchMenu.AddTab('tclassmates', "Classmates");

	searchMenu.tabOrder = new Array('tms','tpeople','tweb','tmusic','tvideos','tblog','tvid','tevents','tgroups','tfilm','tbooks','tclass','tcomedy','tjobs');
	searchMenu.enableWarningMessages = "false";
	
</script>
<div id="header_search0">

<div id="header_search" class="greset google_powered" >
	<form name="srch" id="srch" action="http://searchresults.myspace.com/index.cfm" method="get" onsubmit="return chkGHeader();">
		<script type="text/javascript">searchMenu.Create("q");</script>
		<input type="text" id="q" name="q" class="txt" /><input type="submit" id="submitBtn" value="Search" />
		<input type="hidden" name="SearchBoxID" value="SplashHeader" />
		<input type="hidden" name="fuseaction" value="advancedFind.hub" />
	</form>
</div>
<script type="text/javascript">
	searchMenu.SetSearchTarget("tms")
	searchMenu.Resize();
</script>

</div>



	
<div align="center">

<table border="0" cellspacing="0" cellpadding="0" width="800">
	
	<tr>
		<td style="height:26px;background:#6698CB;color:#000;text-align:center;vertical-align:middle;font-family:Arial,Helvetica,sans-serif;">
			<a class="navbar" href="http://www.myspace.com/index.cfm?fuseaction=splash&Mytoken=050DFECD-081B-4A83-AFABE341DF372E5350712054">Home</a> &nbsp;|&nbsp;
			<a class="navbar" href="http://browseusers.myspace.com/Browse/Browse.aspx?z=1&Mytoken=050DFECD-081B-4A83-AFABE341DF372E5350712054">Browse</a> &nbsp;|&nbsp;
			<a class="navbar" href="http://search.myspace.com/index.cfm?fuseaction=find&Mytoken=050DFECD-081B-4A83-AFABE341DF372E5350712054">Search</a> &nbsp;|&nbsp;
			<a class="navbar" href="http://invite.myspace.com/index.cfm?fuseaction=invite&Mytoken=050DFECD-081B-4A83-AFABE341DF372E5350712054">Invite</a> &nbsp;|&nbsp;
			
				<a class="navbar" href="http://collect.myspace.com/index.cfm?fuseaction=film&Mytoken=050DFECD-081B-4A83-AFABE341DF372E5350712054">Film</a> &nbsp;|&nbsp;
			
			<a class="navbar"href="http://messaging.myspace.com/index.cfm?fuseaction=mail.inbox&Mytoken=050DFECD-081B-4A83-AFABE341DF372E5350712054">Mail</a> &nbsp;|&nbsp;
			<a class="navbar" href="http://blog.myspace.com/index.cfm?fuseaction=blog.home&Mytoken=050DFECD-081B-4A83-AFABE341DF372E5350712054">Blog</a>&nbsp;|&nbsp;
			<a class="navbar" href="http://favorites.myspace.com/index.cfm?fuseaction=user.favorites&Mytoken=050DFECD-081B-4A83-AFABE341DF372E5350712054">Favorites</a> &nbsp;|&nbsp;
			<a class="navbar" href="http://forum.myspace.com/index.cfm?fuseaction=messageboard.categories&Mytoken=050DFECD-081B-4A83-AFABE341DF372E5350712054">Forum</a> &nbsp;|&nbsp;
			<a class="navbar" href="http://groups.myspace.com/index.cfm?fuseaction=groups.categories&Mytoken=050DFECD-081B-4A83-AFABE341DF372E5350712054">Groups</a> &nbsp;|&nbsp;
			
				<a class="navbar" href="http://events.myspace.com/index.cfm?fuseaction=events&Mytoken=050DFECD-081B-4A83-AFABE341DF372E5350712054">Events</a> &nbsp;|&nbsp;
			
			
      
      
			  <a class="navbar" href="http://www.myspace.com/index.cfm?fuseaction=vids.home">Videos</a> &nbsp;|&nbsp;
      
			<a class="navbar" href="http://music.myspace.com/index.cfm?fuseaction=music&Mytoken=050DFECD-081B-4A83-AFABE341DF372E5350712054">Music</a>
			
				&nbsp;|&nbsp; <a class="navbar" href="http://www.myspace.com/index.cfm?fuseaction=comedian.home&Mytoken=050DFECD-081B-4A83-AFABE341DF372E5350712054">Comedy</a>
			
			
				&nbsp;|&nbsp; <a class="navbar" href="http://collect.myspace.com/index.cfm?fuseaction=classifieds&Mytoken=050DFECD-081B-4A83-AFABE341DF372E5350712054">Classifieds</a>
			
		</td>
	</tr>
</table>

</div>


<center>






<table cellspacing="0" cellpadding="5" width="800" bgcolor="#ffffff" border="0">
	
	<tr>
		<td valign="top">
			<table cellspacing="0" cellpadding="0" width="100%" border="0">
				
				<tr>
					<td valign="top" width="60%">
						<table cellspacing="0" cellpadding="8" width="100%" border="0">
							<tr>
								<td class="blacktext15">
								
								</td>
							</tr>
							<tr>
								<td align="right">
									
									<table cellspacing="0" cellpadding="1" width="430"  border="0">
										<tr>
											<td valign="top">
												<table cellspacing="0" cellpadding="5" width="100%" bgcolor="#ffffff" border="0">
													<tr>
														<td valign="top">
															<table cellspacing="0" cellpadding="0" width="100%" border="0">
																<tr>
																
																</tr>
															</table>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
									
								</td>
							</tr>
							<tr>
								<td align="right"><div align=left>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Already a member? <a href="index.cfm?fuseaction=login&Mytoken=050DFECD-081B-4A83-AFABE341DF372E5350712054">Click Here to Log In</a><br><br></div>
									
									<table width="430" border="0" cellpadding="1" cellspacing="0" bgcolor="6699cc">
										<tr>
											<td valign="top">
												<table width="100%" border="0" cellspacing="0" cellpadding="5">
													<tr>
														<td align="left" style="color:white; font-weight:bold; font-size:10pt;">
														
														JOIN MYSPACE HERE!
														</td>
													</tr>
													<tr>
														<td align="left" valign="top" bgcolor="ffffff">
															<table width="100%" border="0" cellspacing="0" cellpadding="2">
															<form action="http://signup.myspace.com/index.cfm?fuseaction=join.step1verify" method="post" name="theForm" id="theForm" onSubmit="return formValidator();">
															
															<input type="hidden" name="isKSolo" value="FALSE">
															<input type="hidden" name="formFuseAction" value="join.processStep1">
															<input type="hidden" name="iID" value="">
															<input type="hidden" name="rID" value="0">
															<input type="hidden" name="gID" value="0">
															<input type="hidden" name="fileKey" value="F0F50D52-50DA-CAFC-40D056EB9196A404">
																
																
																<tr>
																	<td colspan="2">Please enter a valid e-mail address. You will need to confirm your e-mail address to activate your account.</td>
																</tr>
																<tr>
																	<td class="required">Email Address:</td>
																	<td class="required"><input type="text" name="email" value="" size="40" maxlength="255"></td>
																</tr>
																
																
																	<tr>
																		<td class="required">First Name:</td>
																		<td class="required"><input type="text" name="nameFirst" value="" maxlength="255"></td>
																	</tr>
																	<tr>
																		<td class="required">Last Name:</td>
																		<td class="required"><input type="text" name="nameLast" value="" maxlength="255"></td>
																	</tr>																
																
																
																<tr>
																	<td class="required">Password:</td>
																	<td class="required"><input type="password" name="password" size="20" maxlength="10"></td>
																</tr>
                                
                                
																
																<tr>
																	<td class="required">Confirm Password:</td>
																	<td class="required"><input type="password" name="passwordConfirm" size="20" maxlength="10"></td>
																</tr>
																<tr>
																	<td class="required">Country:</td>
																	<td><select name="country" onChange="displayPostalCodeSample(this.value);populateState(this.options[this.selectedIndex].value);" class="normalarial" style="width:220px" ><option value="AF">Afghanistan</option><option value="AL">Albania</option><option value="DZ">Algeria</option><option value="AS">American Samoa</option><option value="AD">Andorra</option><option value="AO">Angola</option><option value="AI">Anguilla</option><option value="AQ">Antarctica</option><option value="AG">Antigua and Barbuda</option><option value="AR">Argentina</option><option value="AM">Armenia</option><option value="AW">Aruba</option><option value="AU">Australia</option><option value="AT">Austria</option><option value="AZ">Azerbaijan</option><option value="BS">Bahamas</option><option value="BH">Bahrain</option><option value="BD">Bangladesh</option><option value="BB">Barbados</option><option value="BY">Belarus</option><option value="BE">Belgium</option><option value="BZ">Belize</option><option value="BJ">Benin</option><option value="BM">Bermuda</option><option value="BT">Bhutan</option><option value="BO">Bolivia</option><option value="BA">Bosnia and Herzegowina</option><option value="BW">Botswana</option><option value="BV">Bouvet Island</option><option value="BR">Brazil</option><option value="IO">British Indian Ocean Territory</option><option value="BN">Brunei Darussalam</option><option value="BG">Bulgaria</option><option value="BF">Burkina Faso</option><option value="BI">Burundi</option><option value="KH">Cambodia</option><option value="CM">Cameroon</option><option value="CA">Canada</option><option value="CV">Cape Verde</option><option value="KY">Cayman Islands</option><option value="CF">Central African Republic</option><option value="TD">Chad</option><option value="CL">Chile</option><option value="CN">China</option><option value="CX">Christmas Island</option><option value="CC">Cocoa (Keeling) Islands</option><option value="CO">Colombia</option><option value="KM">Comoros</option><option value="CG">Congo</option><option value="CK">Cook Islands</option><option value="CR">Costa Rica</option><option value="CI">Cote Divoire</option><option value="CT">Croatia (Hrvatska)</option><option value="CU">Cuba</option><option value="CY">Cyprus</option><option value="CZ">Czech Republic</option><option value="DK">Denmark</option><option value="DJ">Djibouti</option><option value="DS">DoDDs Schools</option><option value="DM">Dominica</option><option value="DO">Dominican Republic</option><option value="TP">East Timor</option><option value="EC">Ecuador</option><option value="EG">Egypt</option><option value="SV">El Salvador</option><option value="GQ">Equatorial Guinea</option><option value="ER">Eritrea</option><option value="EE">Estonia</option><option value="ET">Ethiopia</option><option value="FK">Falkland Islands (Malvinas)</option><option value="FO">Faroe Islands</option><option value="FJ">Fiji</option><option value="FI">Finland</option><option value="FR">France</option><option value="GA">Gabon</option><option value="GM">Gambia</option><option value="GE">Georgia</option><option value="DE">Germany</option><option value="GH">Ghana</option><option value="GI">Gibraltar</option><option value="GR">Greece</option><option value="GL">Greenland</option><option value="GD">Grenada</option><option value="GU">Guam</option><option value="GT">Guatemala</option><option value="GN">Guinea</option><option value="GW">Guinea-Bissau</option><option value="GY">Guyana</option><option value="HT">Haiti</option><option value="HM">Heard and Mc Donald Islands</option><option value="HN">Honduras</option><option value="HK">Hong Kong</option><option value="HU">Hungary</option><option value="IS">Iceland</option><option value="IN">India</option><option value="ID">Indonesia</option><option value="IR">Iran (Islamic Republic of)</option><option value="IQ">Iraq</option><option value="IE">Ireland</option><option value="IL">Israel</option><option value="IT">Italy</option><option value="JM">Jamaica</option><option value="JP">Japan</option><option value="JO">Jordan</option><option value="KZ">Kazakhstan</option><option value="KE">Kenya</option><option value="KI">Kiribati</option><option value="KP">Korea,  Democratic Peoples Republic of</option><option value="KR">Korea,  Republic of</option><option value="KW">Kuwait</option><option value="KG">Kyrgyzstan</option><option value="LA">Lao Peoples Democratic Republic</option><option value="LV">Latvia</option><option value="LB">Lebanon</option><option value="LS">Lesotho</option><option value="LR">Liberia</option><option value="LY">Libyan Arab Jamahiriya</option><option value="LI">Liechtenstein</option><option value="LT">Lithuania</option><option value="LU">Luxembourg</option><option value="MO">Macau</option><option value="MK">Macedonia, The Former Yugoslav Republic of</option><option value="MG">Madagascar</option><option value="MW">Malawi</option><option value="MY">Malaysia</option><option value="MV">Maldives</option><option value="ML">Mali</option><option value="MT">Malta</option><option value="MH">Marshall Islands</option><option value="MR">Mauritania</option><option value="MU">Mauritius</option><option value="MX">Mexico</option><option value="FM">Micronesia, Federated States of</option><option value="MD">Moldova,  Republic of</option><option value="MC">Monaco</option><option value="MN">Mongolia</option><option value="MS">Montserrat</option><option value="MA">Morocco</option><option value="MZ">Mozambique</option><option value="MM">Myanmar</option><option value="NA">Namibia</option><option value="NR">Nauru</option><option value="NP">Nepal</option><option value="NL">Netherlands</option><option value="AN">Netherlands Antilles</option><option value="NZ">New Zealand</option><option value="NI">Nicaragua</option><option value="NE">Niger</option><option value="NG">Nigeria</option><option value="NU">Niue</option><option value="NF">Norfolk Island</option><option value="MP">Northern Mariana Islands</option><option value="NO">Norway</option><option value="OM">Oman</option><option value="PK">Pakistan</option><option value="PW">Palau</option><option value="PA">Panama</option><option value="PG">Papua New Guinea</option><option value="PY">Paraguay</option><option value="PE">Peru</option><option value="PH">Philippines</option><option value="PN">Pitcairn</option><option value="PL">Poland</option><option value="PT">Portugal</option><option value="PR">Puerto Rico</option><option value="QA">Qatar</option><option value="RO">Romania</option><option value="RU">Russian Federation</option><option value="RW">Rwanda</option><option value="KN">Saint Kitts and Nevis</option><option value="LC">Saint Lucia</option><option value="VC">Saint Vincent and the Grenadines</option><option value="WS">Samoa</option><option value="SM">San Marino</option><option value="ST">Sao Tome and Principe</option><option value="SA">Saudi Arabia</option><option value="SN">Senegal</option><option value="SC">Seychelles</option><option value="SL">Sierra Leone</option><option value="SG">Singapore</option><option value="SK">Slovakia (Slovak Republic)</option><option value="SI">Slovenia</option><option value="Sb">Solomon Islands</option><option value="SO">Somalia</option><option value="ZA">South Africa</option><option value="GS">South Georgia and the South Sandwich Islands</option><option value="ES">Spain</option><option value="LK">Sri Lanka</option><option value="SH">St. Helena</option><option value="SD">Sudan</option><option value="SR">Suriname</option><option value="SJ">Svalbard and Jan Mayen Islands</option><option value="SZ">Swaziland</option><option value="SE">Sweden</option><option value="CH">Switzerland</option><option value="SY">Syrian ArabRepublic</option><option value="TW">Taiwan</option><option value="TJ">Tajikistan</option><option value="TZ">Tanzania,  United Republic of</option><option value="TH">Thailand</option><option value="TG">Togo</option><option value="TK">Tokelau</option><option value="TO">Tonga</option><option value="TT">Trinidad and Tobago</option><option value="TN">Tunisia</option><option value="TR">Turkey</option><option value="TM">Turkmenistan</option><option value="TC">Turks and Caicos Islands</option><option value="TV">Tuvalu</option><option value="UG">Uganda</option><option value="UA">Ukraine</option><option value="AE">United ArabEmirates</option><option value="UK">United Kingdom</option><option value="US">United States</option><option value="UM">United States Minor Outlying Islands</option><option value="UY">Uruguay</option><option value="UZ">