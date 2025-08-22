$(document).ready(function() {
    $('#searchSelect2').change(function() {  
        var selectedValue = $(this).val();
        var val=$('#val').val();

        console.log(selectedValue);

        if (selectedValue) {
            $.ajax({
                url: 'fetch_results_a.php',
                type: 'GET',
                data: { option: selectedValue,val:val },
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