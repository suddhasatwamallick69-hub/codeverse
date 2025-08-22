$(document).ready(function(){
    $('#myForm').on('submit',function(e){
        e.preventDefault();

        var fdata=$(this).serialize();
        console.log(fdata);

        $.ajax({
            url:"check_answers.php",
            type:"POST",
            data:fdata,
            success:function(response){
                window.location.href='result_mcq.php?data='+encodeURIComponent(response.trim());
            }
        })
    })
})