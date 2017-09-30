function getPasswordStrength(pw){
	var pwlength=(pw.length);
	if(pwlength>5)pwlength=5;
	var numnumeric=pw.replace(/[0-9]/g,"");
	var numeric=(pw.length-numnumeric.length);
	if(numeric>3)numeric=3;
	var symbols=pw.replace(/\W/g,"");
	var numsymbols=(pw.length-symbols.length);
	if(numsymbols>3)numsymbols=3;
	var numupper=pw.replace(/[A-Z]/g,"");
	var upper=(pw.length-numupper.length);
	if(upper>3)upper=3;
	var pwstrength=((pwlength*10)-20)+(numeric*10)+(numsymbols*15)+(upper*10);if(pwstrength<0){pwstrength=0}
	if(pwstrength>100){
		pwstrength=100
	}
	return pwstrength
}

function updatePasswordStrength_new(pwbox,pwdiv,divorderlist){
	var bpb=""+pwbox.value;
	var pwstrength=getPasswordStrength(bpb);
	var bars=(parseInt(pwstrength/10)*10);
	var pwdivEl=document.getElementById(pwdiv);
	if(!pwdivEl){
		alert('Password Strength Display Element Missing')
	}
	var divlist=pwdivEl.getElementsByTagName('div');
	var maindiv=divlist[0].getElementsByTagName('div');
	maindiv[0].className='pass_bar_base pass_bar_'+bars;
	var txtdivnum=1;if(divorderlist&&divorderlist.text>-1){txtdivnum=divorderlist.text}
	var txtdiv=divlist[txtdivnum];
	if(txtdiv&&self.pass_strength_phrases){
		txtdiv.innerHTML=pass_strength_phrases[bars]}
	}

function updatePasswordStrength(pwbox,pwdiv,divorderlist){
	var bpb=""+pwbox.value;
	var pwstrength=getPasswordStrength(bpb);
	var bars=(parseInt(pwstrength/10)*10);
	var pwdivEl=document.getElementById(pwdiv);
	if(!pwdivEl){
		alert('Password Strength Display Element Missing')
	}
	var divlist=pwdivEl.getElementsByTagName('div');
	var imgdivnum=0;var txtdivnum=1;
	if(divorderlist&&divorderlist.text>-1){
		txtdivnum=divorderlist.text
	}
	if(divorderlist&&divorderlist.image>-1){
		imgdivnum=divorderlist.image
	}
	var imgdiv=divlist[imgdivnum];imgdiv.id='ui-passbar-'+bars;
	var txtdiv=divlist[txtdivnum];
	if(txtdiv&&self.pass_strength_phrases){
		txtdiv.innerHTML=pass_strength_phrases[bars]
	}
}
