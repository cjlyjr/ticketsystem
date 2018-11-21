$(function() {
    $(".patt span" ).click(function(event) {
        
      // $(this).closest( ".attachement").slideToggle( "slow", function() {
        //$(this).closest( ".attachement").css({"background-color":"red"});
        $( event.target ).closest('ul').find('.attachement').slideToggle( "slow", function() {
            
          });
          $(this).text(function(i, text){
            return text === "Close attachement" ? "Click attachement" : "Close attachement";
           
        })

        
      });
   
     //$(".useranswer").closest('li .replyli').find('.replybutton').css( "background-color", "red" );
  $(".useranswer").closest('li .replyli').find('.replybutton').hide();
     
});


