var editor=CodeMirror.fromTextArea(document.getElementById("editor"),{
    mode: "text/x-python",
    theme: "midnight",
    lineNumbers: true,
    autoCloseBrackets:true, 
});

function theme(){
    var theme=$('#theme').val();
    editor.setOption("theme", theme);
}
var width=window.innerWidth;
editor.setSize(0.643*width,"650");

var option=document.getElementById("selectlang");
option.addEventListener("change",function(){
    if(option.value=="java"){
        editor.setOption("mode","text/x-java")
    }
    else if(option.value=="python3"){
        editor.setOption("mode","text/x-python")
    }
    else{
        editor.setOption("mode","text/x-csrc")
    }
});

function myFunction() 
                    {
                        var x = document.getElementById("selectlang").value;
                        console.log(x);
                        var text;
                        if(x=="c")
                        {
                            text='#include<stdio.h>\nint main()\n{\n   //write code here\n  printf("Hello World");\n  return 0;\n}';
                        }
                        else if(x=="java")
                        {
                            text="class Main\n{\n    public static void main(String arg[])\n     {\n         //write code here\n     }\n}\n";
                        }
                        else if(x=="python3")
                        {
                            text="#write code here\nprint('Hello World')";
                        }
                        else{
                            text="#write code here";
                        }
                        editor.setValue(text);
                        var q=editor.getValue();
                        console.log(q);
                        
                    }