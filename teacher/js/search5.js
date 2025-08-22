$(document).ready(function() {
    $('#cname').on('input',function() {  
        var search = $(this).val();
        console.log(search);
        if (search.length>0) 
        {
            console.log(length);
            $.ajax({
                url: 'fetch_results5.php',
                type: 'GET',
                data: { option: search },
                success: function(data) {
                    $('#results').html(data);
                }
            });
        } 
        else if(search.length==0) 
        {
            console.log(length);
            $.ajax({
                url: 'fetch_results5.php',
                type: 'GET',
                data: { option_none: search },
                success: function(data) {
                    $('#results').html(data);
                }
            });
        }
    });
});