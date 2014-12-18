<!--
//Browser Support Code
function ajaxFunction(){
 var ajaxRequest;  // The variable that makes Ajax possible!
	
 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }
 // Create a function that will receive data 
 // sent from the server and will update
 // div section in the same page.
 ajaxRequest.onreadystatechange = function(){
   if(ajaxRequest.readyState == 4){
      var ajaxDisplay = document.getElementById('ajaxDiv');
      var x=document.forms["search_form"]["q"].value;
      var response = ajaxRequest.responseText; // Holds the response information
      var check = response.indexOf("div");

      if(x.length < 1 || check == -1)
         ajaxDisplay.style.borderWidth = "0px";
      else
         ajaxDisplay.style.borderWidth = "1px";

      ajaxDisplay.innerHTML = response;
   }
 }
 // Now get the value from user and pass it to
 // server script.
 var search = document.getElementById('search').value;
 var queryString = "?q=" + search ;
 ajaxRequest.open("GET", "search_db.php" + queryString, true);
 ajaxRequest.send(null); 
}
//-->
