$( document ).ready(function() {

    $sortable =  $( "#sortable" );

    $sortable.sortable({
        stop : function( event, ui ) {
         updateItems();
        }
       });

    function updateItems(){
  
        $sortable.find('li').each(function(index,element){
          
          let n = index ;
          n++;
            
         // console.log(parseInt($(element).data('position')),n);
          if(parseInt($(element).data('position')) !== n){

            $(element).attr('data-position', n);

            const id = $(element).data('id');
            const position = $(element).data('position');

            $.post( "ajax/items.php", { id : id , position : n });

          }

    
           /* 
           
           $(element).attr('data-position', index + 1);

            const id = $(element).data('id');
            const position = $(element).data('position');
        

            $.post( "ajax/items.php", { id : id , position : position });*/
          
        });
    }
  
  
  });