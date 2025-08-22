$(document).ready(function() {
    $('#searchSelect').change(function() {  
        var selectedValue = $(this).val();
        console.log(selectedValue);

        if (selectedValue) {
            $.ajax({
                url: 'fetch_results.php',
                type: 'GET',
                data: { option: selectedValue },
                success: function(data) {
                    $('#results').html(data);
                    console.log(data);
                }
            });
        } else {
            $('#results').empty();
        }
    });
});