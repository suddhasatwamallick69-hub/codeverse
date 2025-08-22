$(document).ready(function() {
    $('#submit').click(function() 
    {
        let userConfirmed = confirm('Are you Sure that you want to submit?\nCheck your code before you submit.\n Your code need to pass all the test cases for it to be marked correct. You have only one chance!! Good Luck');
        if(userConfirmed)
        {
        var code =editor.getValue();
        var language = $('#selectlang').val();
        var qid=$('#qid').val();
        var eid=$('#eid').val();
        console.log(code);
        console.log(language);
        console.log(qid);
        console.log(eid);

        $('#success').empty();
        $('#error').empty();
        $('#inputerror').empty();
        $('#successmsg').empty();
        $('#testresults').empty();
        $('#errormsg').empty();
        $('#errinput').empty();
        $('#queue').html('<span style="color: black; background-color:rgb(255, 155, 155); padding: 12px;font-weight:bold;">Executing Test Cases...</span>');


        $.ajax({
            url: 'contest_compile.php',
            type: 'POST',
            data: {
                code:code,
                language:language,
                question_id:qid,
                exam_id:eid
            },
            
            success: function(data) {
                try {
                    var json = JSON.parse(data);

                    if(json.InvalidCode && json.isMatched==false)
                    {
                            setTimeout(function() {
                                $('#errormsg').html('<span style="color: rgb(6, 75, 13); background-color:rgb(255, 155, 155); padding: 12px;font-weight:bold;">' + json.InvalidCode + '</span>');
                                $('#queue').empty();

                                var testResults = json.testResults;

                                var resultsHtml = '<div>';
                                var count=0;
                                testResults.forEach(function(result) {
                                    count++;
                                       if(result.status=='Pass')
                                       {
                                           resultsHtml += "<p style='background-color: rgb(137, 240, 151);color: green;padding:12px;margin-top:15px;'>";
                                           resultsHtml += 'Test Case ' + count + '- Status : ' +result.status+ '<br>';
                                           resultsHtml += "</p>";
                                       }
                                       if(result.status=='Fail')
                                       {
                                           resultsHtml += "<p style='background-color: red;color:black;padding:12px;margin-top:15px;'>";
                                           resultsHtml += 'Test Case ' + count + '- Status : ' +result.status+ '<br>';
                                           resultsHtml += "</p>";
                                       }                               
                                    
                                });
                                resultsHtml += '</div>';
                            $('#testresults').html(resultsHtml);
                            }, 3000);


                            setTimeout(function() {
                                window.location.href='contest_details.php?cid='+eid;
                            }, 7000);
                    }
                    else if (json.successmsg && json.isPassed==true) {
                        setTimeout(function() {
                            $('#successmsg').html('<span style="color: rgb(6, 75, 13); background-color:rgb(137, 240, 151); padding: 12px;font-weight:bold;">'+ json.successmsg +'</span>');

                             var testResults = json.testResults;

                             var resultsHtml = '<div>';
                             var count=0;
                             testResults.forEach(function(result) {
                                 count++;
                                    if(result.status=='Pass')
                                    {
                                        resultsHtml += "<p style='background-color: rgb(137, 240, 151);color: green;padding:12px;margin-top:15px;'>";
                                        resultsHtml += 'Test Case ' + count + '- Status : ' +result.status+ '<br>';
                                        resultsHtml += "</p>";
                                    }
                                    if(result.status=='Fail')
                                    {
                                        resultsHtml += "<p style='background-color: red;color:black;padding:12px;margin-top:15px;'>";
                                        resultsHtml += 'Test Case ' + count + '- Status : ' +result.status+ '<br>';
                                        resultsHtml += "</p>";
                                    }                               
                                 
                             });
                             resultsHtml += '</div>';
                            $('#testresults').html(resultsHtml);
                            $('#queue').empty();

                        }, 3000);

                        setTimeout(function() {
                            window.location.href='contest_details.php?cid='+eid;
                        }, 7000);
                    }
                    else if(json.isExecutionSuccess==false)
                    {
                        setTimeout(function() {
                            $('#errormsg').html('<span style="color: rgb(6, 75, 13); background-color:rgb(255, 155, 155); padding: 12px;font-weight:bold;">' + json.errormsg + '</span>');
                            $('#queue').empty();

                            var testResults = json.testResults;

                            var resultsHtml = '<div>';
                             var count=0;
                             testResults.forEach(function(result) {
                                 count++;
                                    if(result.status=='Pass')
                                    {
                                        resultsHtml += "<p style='background-color: rgb(137, 240, 151);color: green;padding:12px;margin-top:15px;'>";
                                        resultsHtml += 'Test Case ' + count + '- Status : ' +result.status+ '<br>';
                                        resultsHtml += "</p>";
                                    }
                                    if(result.status=='Fail')
                                    {
                                        resultsHtml += "<p style='background-color: red;color:black;padding:12px;margin-top:15px;'>";
                                        resultsHtml += 'Test Case ' + count + '- Status : ' +result.status+ '<br>';
                                        resultsHtml += "</p>";
                                    }                               
                                 
                             });
                             resultsHtml += '</div>';

                            $('#testresults').html(resultsHtml);
                        }, 3000);  

                        setTimeout(function() {
                            window.location.href='contest_details.php?cid='+eid;
                        }, 7000);
                    }
                    else if(json.isFailed==true)
                    {
                            setTimeout(function() 
                            {
                                $('#errormsg').html('<span style="color: rgb(6, 75, 13); background-color:rgb(255, 155, 155); padding: 12px;font-weight:bold;">' + json.error + '</span>');
                                $('#queue').empty();

                                var testResults = json.testResults;

                                var resultsHtml = '<div>';
                             var count=0;
                             testResults.forEach(function(result) {
                                 count++;
                                    if(result.status=='Pass')
                                    {
                                        resultsHtml += "<p style='background-color: rgb(137, 240, 151);color: green;padding:12px;margin-top:15px;'>";
                                        resultsHtml += 'Test Case ' + count + '- Status : ' +result.status+ '<br>';
                                        resultsHtml += "</p>";
                                    }
                                    if(result.status=='Fail')
                                    {
                                        resultsHtml += "<p style='background-color: red;color:black;padding:12px;margin-top:15px;'>";
                                        resultsHtml += 'Test Case ' + count + '- Status : ' +result.status+ '<br>';
                                        resultsHtml += "</p>";
                                    }                               
                                 
                             });
                             resultsHtml += '</div>';

                            $('#testresults').html(resultsHtml);

                            }, 3000);   

                            setTimeout(function() {
                                window.location.href='contest_details.php?cid='+eid;
                            }, 7000);
                    }
                    else if(json.inputerror)
                    {
                        setTimeout(function() {
                            $('#error').html('<span style="color: rgb(6, 75, 13); background-color:rgb(255, 155, 155); padding: 12px;font-weight:bold;">' + json.inputerror + '</span>');
                            $('#queue').empty();
                        }, 7000);
                    }
                    else 
                    {
                        setTimeout(function() {
                            $('#successmsg').text('No data found');
                            $('#queue').empty();
                        }, 3000);
                    }
                } catch (e) {
                    $('#result').text('Error parsing JSON');
                    $('#queue').empty();
                }
            }
        });
       }
       else
       {
       }
    });
});
