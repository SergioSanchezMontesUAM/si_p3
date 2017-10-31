$(function(){
    
    setInterval(function(){
        var xhttp = new XMLHttpRequest();
        
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //document.getElementById("demo").innerHTML = this.responseText;
                $("#num_users_online").html(this.responseText)
                
            }
        };
        
        xhttp.open("GET", "random_number.php");
        xhttp.send();
        
    }, 3000)
    
})