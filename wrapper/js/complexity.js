$(document).ready(function() {
    // Bind the click event to the "Run" button
    $('#checkcomplexity').click(function() {
        // Get the value from the textarea with id="editor"
        var code =editor.getValue();
        var language = $('#selectlang').val();
        console.log(code);

        $('#complexity').empty();
        $('#analysing').html('<span style="color: black;font-weight:bold;">Analysing...</span>');
        $.ajax({
            url: 'check_time_complexity.php',
            type: 'POST',
            data: {
                code: code,
                language: language
            },
            success: function(data) {
                setTimeout(function() {
                    $('#complexity').text(data); 
                    $('#analysing').empty();
                }, 3000);
                      
            }
        });
    });
});
