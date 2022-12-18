$(document).ready(function() {
    $("form").submit(function() {
        e.preventDefault(); 
        $("form input[type='submit']").attr("disabled", true);
    })
})
