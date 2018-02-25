define([], function () {
   $(".accordianTitle").on("click",function(e){
     e.preventDefault();
     $accordianWrapper = $(this).closest(".accordianWrapper");
     $accordianContent = $accordianWrapper.find(".accordianContent");
     if($accordianContent.is(":visible")){
       $accordianContent.hide();
     }else{
       $accordianContent.show();
     }
   });

}); // END require
