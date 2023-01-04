
$(document).on("keyup", ".cartqty", function () {
   

    var id = $(this).data('id'); 

    var qty = document.getElementById(id+'qty').value;  
    var price =  document.getElementById(id+'price').value;
    var subtot; 


         $.ajax({    //create an ajax request to load_page.php
            type:"POST",  
            url: "addcart.php?action=edit",    
            dataType: "text",  //expect html to be returned  
            data:{mealid:id,QTY:qty},               
            success: function(data){   
              // $('#leavecredits').val(data);   
              // alert(data);
               subtot = parseFloat(price) * parseFloat(qty); 
    
              document.getElementById('Osubtot'+id).value  =    subtot;

              var table = document.getElementById('table');
              var items = table.getElementsByTagName('output');

              var sum = 0;
              for(var i=0; i<items.length; i++)
                  sum +=   parseFloat(items[i].value);

              var output = document.getElementById('sum');
              // output.innerHTML =  sum.toFixed(2);
              output.innerHTML =  sum 
            }

        }); 
   
    });

$(document).on("change", ".cartqty", function () {
   

    var id = $(this).data('id'); 


    var qty = document.getElementById(id+'qty').value;  
    var price =  document.getElementById(id+'price').value;
    var subtot; 


         $.ajax({    //create an ajax request to load_page.php
            type:"POST",  
            url: "addcart.php?action=edit",    
            dataType: "text",  //expect html to be returned  
            data:{mealid:id,QTY:qty},               
            success: function(data){   
              // $('#leavecredits').val(data);   
              // alert(data);
               subtot = parseFloat(price) * parseFloat(qty); 
    
              document.getElementById('Osubtot'+id).value  =    subtot;

              var table = document.getElementById('table');
              var items = table.getElementsByTagName('output');

              var sum = 0;
              for(var i=0; i<items.length; i++)
                  sum +=   parseFloat(items[i].value);

              var output = document.getElementById('sum');
              // output.innerHTML =  sum.toFixed(2);
              output.innerHTML =  sum 
            }

        }); 
   
    });
$(document).on("change", ".modalcartqty", function () {
   
    var id = $(this).data('id'); 

alert(id)
    var qty = document.getElementById(id+'qty').value;  
    var price =  document.getElementById(id+'price').value;
    var subtot; 


         $.ajax({    //create an ajax request to load_page.php
            type:"POST",  
            url: "addcart.php?action=edit",    
            dataType: "text",  //expect html to be returned  
            data:{mealid:id,QTY:qty},               
            success: function(data){    

               subtot = parseFloat(price) * parseFloat(qty); 
    
              document.getElementById('Osubtot'+id).value  =    subtot;

              var table = document.getElementById('table');
              var items = table.getElementsByTagName('output');

              var sum = 0;
              for(var i=0; i<items.length; i++)
                  sum +=   parseFloat(items[i].value);

              var output = document.getElementById('sum');
              // output.innerHTML =  sum.toFixed(2);
              output.innerHTML =  sum 
            }

        }); 
   
    });


 
// for the event handler for the text quantity in the orderlist for the cashie side 
        $(document).on("keyup",".orderqty", function(){

            var id = $(this).data("id");
            var inptqty = document.getElementById(id+"orderqty").value;
            var price =  document.getElementById(id+'orderprice').value;
            var subtot; 

             // alert(price)


            $.ajax({
                type:"POST",
                url:  "controller.php?action=edit",
                dataType: "text",
                data:{ORDERID:id,QTY:inptqty,PRICE:price},
                success: function(data) {
                  // alert(data); 

                     subtot = parseFloat(price) * parseFloat(inptqty); 
            
                      document.getElementById('Osubtot'+id).value  =    subtot;

                      var table = document.getElementById('table');
                      var items = table.getElementsByTagName('output');

                      var sum = 0;
                      for(var i=0; i<items.length; i++)
                          sum +=   parseFloat(items[i].value);

                      var output = document.getElementById('totamnt');
                      // output.innerHTML =  sum.toFixed(2);
                      output.value = sum.toFixed(2);

                      document.getElementById("totalamount").value = sum;
                }


            });


        });

        $(document).on("change",".orderqty", function(){

            var id = $(this).data("id");
            var inptqty = document.getElementById(id+"orderqty").value;
            var price =  document.getElementById(id+'orderprice').value;
            var subtot; 

           // alert(price)
 
            $.ajax({
                type:"POST",
                url:  "controller.php?action=edit",
                dataType: "text",
                data:{ORDERID:id,QTY:inptqty,PRICE:price},
                success: function(data) {
                  // alert(data); 
                  
                     subtot = parseFloat(price) * parseFloat(inptqty); 
            
                      document.getElementById('Osubtot'+id).value  =    subtot;

                      var table = document.getElementById('table');
                      var items = table.getElementsByTagName('output');

                      var sum = 0;
                      for(var i=0; i<items.length; i++)
                          sum +=   parseFloat(items[i].value);

                      var output = document.getElementById('totamnt');
                      // output.innerHTML =  sum.toFixed(2);
                      output.value = sum.toFixed(2);

                      document.getElementById("totalamount").value = sum;
                }


            });


        });


$(document).on("click", ".orderqty", function () { 
  $(this).select();
 
}); 
