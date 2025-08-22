$(document).ready(function() {
    // Bind the click event to the "Run" button
    $('#run').click(function() {
        // Get the value from the textarea with id="editor"
        var code =editor.getValue();
        var language = $('#selectlang').val();
        var input=$('#input').val();
        console.log(code);
        console.log(language);
        console.log(input);

        $('#output').empty();
        $('#success').empty();
        $('#error').empty();
        $('#queue').html('<span style="color: black; background-color:rgb(255, 155, 155); padding: 12px;font-weight:bold;">Submission Queued...</span>');


        $.ajax({
            url: 'compile.php',
            type: 'POST',
            data: {
                code:code,
                language:language,
                input:input
            },
            
            success: function(data) {
                try {
                    var json = JSON.parse(data);

                    if (json.output) {
                        setTimeout(function() {
                            $('#output').text(json.output);
                            $('#queue').empty();
                        }, 3000);
                    } 
                    else 
                    {
                        setTimeout(function() {
                            $('#output').text('No data found');
                            $('#queue').empty();
                        }, 3000);
                    }
                    if(json.isExecutionSuccess==true)
                    {
                        setTimeout(function() {
                            $('#success').html('<span style="color: rgb(6, 75, 13); background-color:rgb(137, 240, 151); padding: 12px;font-weight:bold;">' + json.successmsg + '</span>');
                        }, 3000);
                    }
                    else if(json.isExecutionSuccess==false)
                    {
                        setTimeout(function() {
                            $('#error').html('<span style="color: rgb(6, 75, 13); background-color:rgb(255, 155, 155); padding: 12px;font-weight:bold;">' + json.errormsg + '</span>');
                        }, 3000);   
                    }
                } catch (e) {
                    $('#result').text('Error parsing JSON');
                    $('#queue').empty();
                }
            }
        });
    });
});
