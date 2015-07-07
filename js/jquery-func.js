$(document).ready(function(){ 
     
   
   $("ul.side-nav li.hass-dd ul.dd").parent().find('a:first').addClass('has-dd');
   $("ul.side-nav li.hass-dd ul.dd li ul.dd2").parent().find('a:first').addClass('has-dd');
   
   
   $("ul.side-nav li.hass-dd").find('a.has-dd').click(function () {
    	 $(this).parent().find('ul.dd:eq(0)').stop(true,true).slideToggle();
   		 $(this).toggleClass("down-arrow");	
   		 return false;
    });
    
    $("ul.side-nav li.hass-dd ul.dd li.hass-dd a.has-dd").click(function () {
    	 $(this).find('ul.dd:eq(0)').stop(true,true).slideToggle();
   		 $(this).toggleClass("down-arrow");	
   		 return false;
    });
    
    $(function(){
            $('.blink').
                focus(function() {
                    if(this.title==this.value) {
                        this.value = '';
                    }
                }).
                blur(function(){
                    if(this.value=='') {
                        this.value = this.title;
                    }
                });
        })



});

