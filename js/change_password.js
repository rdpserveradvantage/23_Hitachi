function validateForm(oldpw, pw1, pw2) {  
    //collect form data in JavaScript variables  
    
      
    //check empty first name field  
    if(oldpw == "") {  
      swal("Oops!", "Old Password Must Required !", "error"); 
      return false;  
    }  
      
    //character data validation  
   /* if(!isNaN(name1)){  
      document.getElementById("blankMsg").innerHTML = "**Only characters are allowed";  
      return false;  
    }  
  
   //character data validation  
    if(!isNaN(name2)){  
      document.getElementById("charMsg").innerHTML = "**Only characters are allowed";  
      return false;  
    }    */
    
    //check empty password field  
    if(pw1 == "") {  
      swal("Oops!", "New Password Must Required !", "error"); 
      return false;  
    }  
    
    //check empty confirm password field  
    if(pw2 == "") {  
      swal("Oops!", "Confirm Password Must Required !", "error");  
      return false;  
    }   
     
    //minimum password length validation  
    if(pw1.length < 6) {  
      //document.getElementById("message1").innerHTML = "**Password length must be atleast 8 characters";  
	  swal("Oops!", "Password length must be atleast 6 characters !", "error");  
      return false;  
    }  
  
    //maximum length of password validation  
    if(pw1.length > 12) {  
     // document.getElementById("message1").innerHTML = "**Password length must not exceed 15 characters";  
	  swal("Oops!", "Password length must not exceed 12 characters !", "error");  
      return false;  
    }  
    
    if(pw1 != pw2) {  
	   swal("Oops!", "Passwords are not same !", "error");  
      //document.getElementById("message2").innerHTML = "**Passwords are not same";  
      return false;  
    } 
	
 }  
 
$("#submitBtn").click(function(){ 
	getPanel_Detail();
	//get_ticketview();
})

	function getPanel_Detail(){
		var inputOldPassword = $("#inputOldPassword").val();
		var inputPassword = $("#inputPassword").val();
		var inputConfirmPassword = $("#inputConfirmPassword").val();
		
		validateForm(inputOldPassword, inputPassword, inputConfirmPassword);
		
		
		$("#load").show();
		$.ajax({
			url: "api/change_password_process.php", 
			type: "POST",
			data: {inputOldPassword:inputOldPassword,inputPassword:inputPassword,inputConfirmPassword:inputConfirmPassword,user_id:user_id},
			success: (function (result) { 
			   $("#load").hide();
			   debugger;
			
			   console.log(result);
			   var obj = JSON.parse(result);
			   if(obj[0].code==200){
				  swal("Success!", "Password has been changed successfully !", "success");   
				   
			   }else{
				   if(obj[0].code==202){
					  swal("Oops!", "Old Password is not correct !", "error");   
				   }else{
					  swal("Oops!", "User not exists !", "error"); 
				   }
			   }
			})
		}); 
	}  
		
		