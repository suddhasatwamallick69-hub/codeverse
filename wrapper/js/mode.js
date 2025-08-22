$(document).ready(function() {
    let modebtn = $('#mode1');
    let modebtn2 = $('#mode2');
    let themeStylesheet = $('#theme-stylesheet');

    // Retrieve the theme from localStorage or default to 'light'
    let currentmode = localStorage.getItem('theme') || 'light';

    // Function to apply the theme based on the currentmode
    function applyTheme(mode) {
        if (mode === 'dark') {
            themeStylesheet.attr('href', 'wrapper/css/main2.css');
            modebtn.hide();
            modebtn2.show();
        } else {
            themeStylesheet.attr('href', 'wrapper/css/main.css');
            modebtn.show();
            modebtn2.hide();
        }
    }

    applyTheme(currentmode);

    modebtn.click(function() {
        currentmode = 'dark';
        localStorage.setItem('theme', 'dark');
        applyTheme(currentmode);
    });

    modebtn2.click(function() {
        currentmode = 'light';
        localStorage.setItem('theme', 'light');
        applyTheme(currentmode);
    });
});



// $(document).ready(function(){
//     let modebtn=$('#mode1');
//     let modebtn2=$('#mode2');
//     let themeStylesheet = $('#theme-stylesheet');
//     let currentmode="light";
//     modebtn.click(function(){
        
//         if(currentmode==='light'){
//             currentmode='dark';
//             themeStylesheet.attr('href', 'wrapper/css/main2.css');
//             modebtn.hide();
//             modebtn2.show();
//         }
//         else{
//             currentmode="light";
//             themeStylesheet.attr('href', 'wrapper/css/main.css');
//             console.log('white');
//         }
//         modebtn2.click(function() {
//             themeStylesheet.attr('href', 'wrapper/css/main.css');
//             modebtn2.hide();
//             modebtn.show();
//         });
//     })
// })