    
  $(document).ready(function(){
      var x=0;
      var tamanio=$(".foto").length;
        $(".foto").each(function(){
            
             if(x%2!=0){
                $(this).addClass("impar");                
            }if(x%2==0){
                $(this).addClass("par");
            }
            
            x++;
        });

    });
    
   
