

//animated nav bar
$('.message a').click(function()
    {
        $('form').animate({height:"toggle",opacity:"toggle"},"slow");
    });

    $(window).on('scroll',function()
    {
    if($(window).scrollTop()){
        $('nav').addClass('black');
    }
    else
        {
            $('nav').removeClass('black');
        }
    });
        $(document).ready(function() {

	  
        $("#cpass").keyup(function(){
		
//confirm password		
		var password = $("#pass").val();
		var confirmPassword = $("#cpass").val();


		if (password === confirmPassword){
		
		
		$("#show").html("Perfect match!").css('color', 'green');
			
        }else{
		
		
		   $("#show").html("Invalid Entry").css('color', 'red');
		   
		}
    
	
	
		});
		   }); 

var myO, myJSON, text, obj;

// Storing data:
myO = { firstname: "Group", lastname:"H", email: "Group-h@gmail.com" };
myJSON = JSON.stringify(myO);
localStorage.setItem("testJSON", myJSON);

// fetching data:
text = localStorage.getItem("testJSON");
obj = JSON.parse(text);
document.getElementById("de").innerHTML = obj.firstname;		   

	
	$(document).ready(function() {

	var emailPattern = /\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}\b/;
    
    
    $("#sub").click(function(event){
        
        isValid=true;

		 // get email field value and validate
        var email = $("#e").val().trim();
        if(email==""){
            $("#e").next().text("Mandatory Field").css('color', 'red');
		
            isValid=false;
        }else if(!emailPattern.test(email)){
            $("#e").next().text("Please Enter a valid email address.").css('color', 'red');;
            isValid=false;
        }else{
            $("#e").next().text("");
			alert("Welcome to MyTrip,now you are able to login..");
        }

		 // prevent default submit function if there is any error
		 
        if (isValid == false) { event.preventDefault();}
        
    });
});		   

$(window).scroll(function(){
		if($(this).scrollTop()>300){
	    	$('.header_bottom').addClass("sticky");
	  	}
	  	else
	  	{
	    	$('.header_bottom').removeClass("sticky");
	  	}
	});

	                 
$("#submit").click(function(evt){
        //define a variables
        var name = $("#name").val().trim();
        var address = $("#address").val().trim();
        var phone = $("#phone").val().trim();
        var phonePattern = /^(\d{3})-+(\d{3})-+(\d{4})$/; 
        var valid = true;
        if(!name)    //to get information about name
            {
                $("#name").next().text("You forgot this!");
                $("#name").focus();
                valid = false;
            }
        else
            {
                $("#name").next().text("");
            }
         if(!address)    //to get information about address
            {
                $("#address").next().text("You must enter a valid email ID!");
                $("#address").focus();
                valid = false;
            }
        else
            {
                $("#address").next().text("");
            }
       /*to get information about phone if(!phone || !phonePattern.test(phone))      
            {
                $("#phone").next().text("You must enter a valid phone number!");
                $("#phone").focus();
                valid = false;
            }
        else
            {
                $("#phone").next().text("");
            }*/
        console.log(valid);
        if(!valid)
            {
                evt.preventDefault();
            }
        }); // end ready                 


//json file

$(document).ready(function(){
			$.getJSON("contact.json", function(data) {
				$.each(data, function() {
					$.each(this, function(key, value) {
						$("#contact").append(
							"<h3>"+value.name +"</h3>" + 
							"<h3>"+value.address +"</h3>" + 
							"<h3>"+value.phone+"</h3>"
						);
					});
				}); 
			});
		});
