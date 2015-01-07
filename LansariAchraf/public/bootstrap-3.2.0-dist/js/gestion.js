/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */





$(document).ready(function(){
    $('#output_absence').html(" ");
    $('#output_presence').html(" ");
    
 $.ajax({
                        type: "POST",
                        url: "lire/nbabsence",
		    	dataType: 'html',                //data format      
                        success: function(data)          //on recieve of reply
                        {   
                            $('#output_absence').append(data);
                            
                    } 
    });
    
    $.ajax({
                        type: "POST",
                        url: "lire/nbpresence",
		    	dataType: 'html',                //data format      
                        success: function(data)          //on recieve of reply
                        {   
                            $('#output_presence').append(data);
                            
                    } 
    });

$('.photo').click(function(){
   
    $(this).toggleClass("changeBackground");
});

$('.presence').click(function(){
   
   var id = $(this).attr('id');
   var dataString = 'nom='+id;
   
    $.ajax({
			type: "POST",
                        url: "lire/getpresence",
                        dataType: 'html',
                        data: dataString,
		    	success: function(data){
					$('#output_getpresence').append(data);
					
		   		}
			});
    
});

$('.absence').click(function(){
   var id = $(this).attr('id');
   var dataString = 'nom='+id;
   
    $.ajax({
			type: "POST",
                        url: "lire/getabsence",
                        dataType: 'html',
                        data: dataString,
		    	success: function(data){
					$('#output_getabsence').append(data);
					
		   		}
			});
});


$('#valider').click(function(){
    
 //$('.changeBackground').each(function(){ $(this).show().attr("alt"); });
      var tab = new Array();
      var tab2 = new Array();
      var i=0;

      $('.changeBackground').each(function(){ tab[i]=$(this).next().html();i++; });                        
      $('.photo').not('.changeBackground').each(function(){ tab2[i]=$(this).next().html();i++; });                        
      
      var nom_absent = tab.join();
      var nom_present = tab2.join();
      var date;
 
			/* DATASTRING */
		    var dataString = 'nom_absent='+ nom_absent;
		    var dataString2 = 'nom_present='+nom_present;
                    
 
 
 
			if(nom_absent=='' && nom_present=='' ) {
			
                        
                        
                        $('.success').fadeOut(200).hide();
                        $('.error').fadeOut(200).show();
			
			} else {
			$.ajax({
			type: "POST",
                        url: "ecrire/sauveabsence",
                        data: dataString,
		    	success: function(){
					$('.success').fadeIn(200).show();
		    		       $('.error').fadeOut(200).hide();
					
		   		}
			});
                        $.ajax({
			type: "POST",
                        url: "ecrire/sauvepresence",
                        data: dataString2,
		    	success: function(){
					$('.success').fadeIn(200).show();
		    		       $('.error').fadeOut(200).hide();
					
		   		}
			});
                        
                        
				}//EOC
		   return false;
			}); //EOF
 
 
 
$('#btn_up').click(function() {
    $('html,body').animate({scrollTop: 0}, 'slow');
  });

});

$('#vider').click(function(){
  
  $(".changeBackground").toggleClass("changeBackground");
  
});


  $(window).scroll(function(){
     if($(window).scrollTop()>25){
        $('.navbar').fadeOut(1500);
     }else{
        $('.navbar').fadeIn(1500);
     }
     if($(window).scrollTop()<50){
        $('#btn_up').fadeOut();
        
     }else{
        $('#btn_up').fadeIn();
     }
  });

