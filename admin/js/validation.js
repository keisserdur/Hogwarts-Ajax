(function ()
{
 var parar=false;   
$("#idGroup").on("click",function(){
    alert("feo");
    if($(this).val()==""){
        $(this).after("<span class='error'>*</span>")
        parar=true;
    }
});

});