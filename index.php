<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>jQuery UI Autocomplete - Remote JSONP datasource</title>
  <script src="js/jquery-1.10.2.js"></script>
  <script src="js/jquery-ui.js"></script>
  <link rel="stylesheet" href="css/jquery-ui-1.8.16.custom.css"/>
  <style>
  .ui-autocomplete-loading {
    background: white url("images/ui-anim_basic_16x16.gif") right center no-repeat;
  }
  #city { width: 25em; }
  </style>
  <script>
 $(function() {
        $("#city").bind( "keydown", function( event ) {
            console.log(event.keyCode+"->"+$.ui.keyCode.ENTER);
        if ( event.keyCode === $.ui.keyCode.ENTER && !$(this).data("suggestionDialogVisible") ) {
            // Your code
        //    console.log('enter done'+ui.item.slug);
           var rurl = $('#slugurl').val();
           window.open("/"+rurl);
        }
    }).autocomplete({
        open: function() {
            $(this).data("suggestionDialogVisible", true);
        },
        close: function() {
            $(this).data("suggestionDialogVisible", false);
        },
        source: function(request, response) {
          //  console.log(request.term);
            $.ajax({
                url: "city.php",
                type: 'post',
                data: 'action=load_city_pop&str='+request.term,
                dataType: 'json',
                success: function( data ) {
                    response( data );
                  }
            });
        },
        minLength: 3,
        select: function(event, ui) {
        event.preventDefault();
        $(this).val(ui.item.location);
        $('#slugurl').val(ui.item.slug)
        
    },
    focus: function(event, ui) {
        event.preventDefault();
        $(this).val(ui.item.location);
        $('#slugurl').val(ui.item.slug)
    },
        response: function(event, ui) {
            if (!ui.content.length) {
                $("#message").text("No results found");
            } else {
                $("#message").empty();
            }
        }
    }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
							return $( "<li></li>" )
								.data( "item.autocomplete", item )
								.append( "<a><strong>" + item.location + "</strong> </a>" )
								.appendTo( ul );
							};
        
  });    
  
  
  </script>
</head>
<body>
 
<div>
  <label for="city">Your city: </label>
  <input id="city" type="text" value="">
  <span id="message"></span>
  <input type="hidden"  id="slugurl"/>	
</div>
</body>
</html>