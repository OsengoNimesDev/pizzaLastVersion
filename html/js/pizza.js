var tab=[];
function ajoutPanier(id){
let idInput= document.getElementById(id);


tab[id] = idInput.value;

    

  
$.ajax({
    url: 'commande.html',
    dataType: 'json',
    type: 'post',
    data: tab,
    processData: true,
    asynch : true,
    success: function( data ){
      for(element in data) {
        console.log(element);
        console.log(data.element);
    }
    },
    error: function( errorThrown ){
        // console.log( errorThrown );
    }
  });
}