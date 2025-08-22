$(document).ready(function() {
    $('#course').change(function() {  
        var selectedValue = $(this).val();

        if (selectedValue) {
            $.ajax({
                url: 'fetch_results.php',
                type: 'GET',
                data: { option: selectedValue },
                success: function(data) {
                    $('#results').html(data);
                }
            });
        } else {
            $('#results').empty();
        }
    });
});