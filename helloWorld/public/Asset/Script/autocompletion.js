
        $('#personne_adresse_nomRue').keyup(function(event){
            queryNumero= $('#personne_adresse_nomRue').val();
            queryNomRue= $('#personne_adresse_numeroRue').val(); 
            $.ajax({url: "https://api-adresse.data.gouv.fr/search/?q="+queryNumero+"+"+queryNomRue+"",  
                 success: function(response){
                    $('#search').remove()
                    div = $('<div id="search">')
                    list = $('<ul class="list-group">')
                    response.data.features.forEach(function (index){
                        item = $('<li class="list-group-item list-group-item-action">');
                        a = $('<a onclick="fillFields(event, this)" href="">');
                        a.html(index.properties.label);
                        item.append(a);
                        list.append(item);
                    })
                    div.append(list);
                    $('#personne_adresse_nomRue').after(div);

                },        
                error:function(event){
                    alert("adresse non trouvée veuillez vérifier l'orthographe");
                }
            });    
    
        });
        




  
    



