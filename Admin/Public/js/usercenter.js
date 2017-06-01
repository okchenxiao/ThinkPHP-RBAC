function checkpassword(value)
{
	var url = $('#nowpassword_').attr('url');
    if(value.length <6){
		$('#nowpassword_').html('密码长度不能小于6');
		return true;
    }
    else{
    	$('#nowpassword_').html('');
    }

	$.post(url,{'password': value},function(e){
		var res = parseInt(e);
		if(res == '1'){
           $('#nowpassword_').html('');
		}
		else{
           $('#nowpassword_').html('密码错误');
		}
	},'html');
}

function checkformat(value)
{
   var format = /^\w+$/;
   if(format.test(value)){
   	   $('#password_1').html('');
   }
   else{
       $('#password_1').html('密码格式不正确');
   }
}

function checkidentical(value)
{
	if(value.length <6){
		$('#password_2').html('密码长度不能小于6');
		return true;
    }
    else{
    	$('#password_2').html('');
    }
	
	var password1 =  $('#newpassword_1').val();
	var password2 =  value;
	// alert(password1);alert(password2);
	if(password1 == password2){
		 $('#password_2').html('');
	}
	else{
		$('#password_2').html('两次密码不一致');
	}

}