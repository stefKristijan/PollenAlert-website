
        function getPollenData(){
            jQuery.ajax({
                url:"get_pollen_data.php",
                dataType:'json',
                success:function(data){
                    var pollen = data.pollen_data;
                    var optGroup='tree';
                    var prevOptGroup='tree';
                    $("#pollen").append('<optgroup label="Trees">');
                    $.each(pollen,function(index,element){
                        if(element.category=='grass'){
                            if(optGroup=='tree' && prevOptGroup=='tree'){
                                optGroup=element.category;
                                $("#pollen").append('</optgroup>');
                                $("#pollen").append('<optgroup label="Grass">');
                            }
                        }
                        else if(element.category=='weed'){
                            if(optGroup=='grass' && prevOptGroup=='tree'){
                                prevOptGroup=optGroup;
                                optGroup=element.category;
                                $("#pollen").append('</optgroup>');
                                $("#pollen").append('<optgroup label="Weed">');
                            }
                        }
                        $("#pollen").append('<option value="'+element.id+'">'+element.name+'</option>');
                    })
                    $("#pollen").append('</optgroup>');
                     $('#pollen').multiselect('rebuild');
                },
                error:function(){}
            });
        }

        var userFlag = false;
        var passFlag = false;
        var emailFlag = false;

        function checkAvailability() {
            var username_tocheck = $("#sign-up-username").val();
            var username_available = document.getElementById("username-available");
            if(username_tocheck.length>4){
                //$.ajax
                jQuery.ajax({
                url: "include/checkUserExists.php",
                data: { username :  username_tocheck },
                method: "POST",
                dataType:'json',
                success:function(data){
                    if(data.exists){
                        userFlag=false;
                        $("#signUp").attr('disabled','disabled');
                        $("#sign-up-username").css({"background-color":"red","color":"white"});
                    }
                    else{
                        $("#sign-up-username").css({"background-color":"green","color":"white"});
                        userFlag=true;
                        if(userFlag && passFlag && emailFlag){
                            $("#signUp").removeAttr('disabled');
                        }
                    }
                },
                error:function ( jqXHR, textStatus ){
                      
                }
            });
        }else if(username_tocheck){
            userFlag=false;
            $("#signUp").attr('disabled','disabled');
            $("#sign-up-username").css({"background-color":"red","color":"white"});
        }else{
                $("#sign-up-username").css({"background-color":"white","color":"black"});
                userFlag=false;
                $("#signUp").attr('disabled','disabled');
            }
        }

        function validateEmail(email) 
			 {
    			var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    			return re.test(email);
				}

		function validate()
			{
				var email = $("#email").val();
                if(email){
                    if (!validateEmail(email)) 
                        {
                            $("#email").css({"background-color": "red", "color": "white"});
                            emailFlag=false;
                            $("#signUp").attr('disabled','disabled');
                            
                        }else{
                            $("#email").css({"background-color": "green", "color": "white"});
                            emailFlag=true;
                            if(userFlag && passFlag && emailFlag){
                                    $("#signUp").removeAttr('disabled');
                                }
                            
                    }
				return false;
                }
                else{
                    $("#email").css({"background-color": "white", "color": "black"});
                    emailFlag=false;
                    $("#signUp").attr('disabled','disabled');
                }
            }
  
         function checkPasswordMatch() {
            var password = $("#sign-up-password").val();
            var confirmPassword = $("#confirm").val();
            if(password && confirmPassword){
                 if (password != confirmPassword){
                $("#sign-up-password").css({"background-color": "red", "color": "white"});
                $("#confirm").css({"background-color": "red", "color": "white"});
                passFlag=false;
                $("#signUp").attr('disabled','disabled');
            }
            else{
                $("#confirm").css({"background-color": "green", "color": "white"});
                $("#sign-up-password").css({"background-color": "green", "color": "white"});
                passFlag=true;
                 if(userFlag && passFlag && emailFlag){
                            $("#signUp").removeAttr('disabled');
                        }
            }
            }else{
                 $("#sign-up-password").css({"background-color": "white", "color": "black"});
                $("#confirm").css({"background-color": "white", "color": "black"});
                passFlag=false;
                $("#signUp").attr('disabled','disabled');
            }
           
         }
            $(document).ready(function () {
                $("#confirm, #sign-up-password").keyup(checkPasswordMatch);
            });
  
        $(document).ready(function(){
            $('#pollen').multiselect({
                nonSelectedText: 'Select pollen',
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                maxHeight:'200',
                buttonWidth:'300px'
            });
            
           /* $('#framework_form').on('submit', function(event){
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                url:"insert.php",
                method:"POST",
                data:form_data,
                success:function(data)
                {
                    $('#framework option:selected').each(function(){
                    $(this).prop('selected', false);
                    });
                    $('#framework').multiselect('refresh');
                    alert(data);
                }
                });
            });*/
        });