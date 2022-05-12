function ajoutPanier(id){
	const idInput= document.getElementById(id).value;
      var tab = Array();
	
	$.ajax(
	{
    		url: 'commande.php',
    		dataType: 'json',
    		type: 'post',
    		data: {type: 'panier', id: id, val: idInput},
    		processData: true,
    		asynch : true,
    		success: function( data )
		{
			console.log( data );
    		},
    		error: function( errorThrown ){
        		console.log( errorThrown );
    		}
  	});
}
