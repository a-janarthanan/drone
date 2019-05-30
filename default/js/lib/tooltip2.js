$(document).ready(function() {
 
     //Select all anchor tag with rel set to tooltip
    $('div[rel=tooltip2]').mouseover(function(e) {
         
        //Grab the title attribute's value and assign it to a variable
        var tip = $(this).attr('title');    
         
        //Remove the title attribute's to avoid the native tooltip from the browser
        $(this).attr('title','');
         
        //Append the tooltip template and its value
        $(this).append('<div id="tooltip2"><div class="tipHeader2"></div><div class="tipBody2">' + tip + '</div><div class="tipFooter2"></div></div>');     
         
        //Set the X and Y axis of the tooltip
        $('#tooltip2').css('top', 15 );
        $('#tooltip2').css('left', 6000 );
/*  A     
        $('#tooltip').css('top', 120 );
        $('#tooltip').css('left', 100 );
*/
        //Show the tooltip with faceIn effect
        $('#tooltip2').fadeIn('500');
        $('#tooltip2').fadeTo('10',0.8);
         
    }).mousemove(function(e) {
     
        //Keep changing the X and Y axis for the tooltip, thus, the tooltip move along with the mouse
        //$('#tooltip').css('top', e.pageY + 10 );
        //$('#tooltip').css('left', e.pageX + 20 );
		$('#tooltip2').css('top',20 );
        $('#tooltip2').css('left', 600 );
		
		/* A
		$('#tooltip').css('top', 120 );
        $('#tooltip').css('left', 110 );*/
          
    }).mouseout(function() {
     
        //Put back the title attribute's value
        $(this).attr('title',$('.tipBody2').html());
     
        //Remove the appended tooltip template
        $(this).children('div#tooltip2').remove();
         
    });

 
});