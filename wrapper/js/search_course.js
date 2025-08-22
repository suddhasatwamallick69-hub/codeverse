$(document).ready(function() {
    $('#search-input').on('input',function() {  
        var search = $(this).val();
        console.log(search);

        if (search.length>0) {
            console.log(search.length);
            $.ajax({
                url: 'fetch_course.php',
                type: 'POST',
                data: { input: search },
                success: function(data) {
                    $('#result').html(data);
                }
            });
        }
        else if(search.length==0)
        {
            console.log(search.length);
            $.ajax({
                url: 'fetch_course.php',
                type: 'POST',
                data: { input_none: search },
                success: function(data) {
                    $('#result').html(data);
                }
            });
        }
    });
});