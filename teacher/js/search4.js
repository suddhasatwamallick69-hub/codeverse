$(document).ready(function() {
    $('#cname').on('input',function() {  
        var search = $(this).val();

        if (search.length>0) 
        {
            $.ajax({
                url: 'fetch_results4.php',
                type: 'GET',
                data: { option: search },
                success: function(data) {
                    $('#results').html(data);
                }
            });
        } 
        else if(search.length==0) 
        {
            $.ajax({
                url: 'fetch_results4.php',
                type: 'GET',
                data: { option_none: search },
                success: function(data) {
                    $('#results').html(data);
                }
            });
        }
    });
});