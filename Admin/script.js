let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
  sidebar.classList.toggle("active");
  if(sidebar.classList.contains("active")){
  sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
}else
  sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
}
let contain = document.querySelector(".home-section");
console.log(contain);
let form = document.getElementById("form-filter");
console.log(form);
let a = document.querySelectorAll(".open-close-filter");
console.log(a);
a.forEach(element=>{
    element.addEventListener("click", function show_filter(){
        form.classList.toggle('view'); 
        contain.classList.toggle('overlay');
    })
})

function getxhr(){
    try{xhr= new XMLHttpRequest("Microsoft.XMLHTTP");}
    catch(e){
        try{
            xhr = new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch(e1){
            alert("erreur");
        }
    }
    return xhr;
}
function ajaxing(){

        xhr = getxhr();
        //xhr.readyState montre etat de connexuion avec le serveur
        //xhr.status verifie si il y a pas erreur
        //interroger le server et de traitement de la reponse
        xhr.onreadystatechange = function(){
            if(xhr.readyState == 4 && xhr.status == 200){
                document.getElementById("rem").innerHTML = '';
                document.getElementById("sugg").innerHTML = xhr.responseText;
            }else{
                document.getElementById('sugg').innerHTML="en cours..";
            }
                
            }
            //specifier la ressource et le methode access et eventuellement le passage des argumrnts si il y en a
            xhr.open("post","result.php",true);
            xhr.setRequestHeader("content-type","application/x-www-form-urlencoded")
            try{
                xhr.send("mot="+document.getElementById("mot").value);
            }
            catch{
                xhr.send("mot2="+document.getElementById("mot").value)
            }
            
    }
function ajaxing2(){

    xhr = getxhr();
    //xhr.readyState montre etat de connexuion avec le serveur
    //xhr.status verifie si il y a pas erreur
    //interroger le server et de traitement de la reponse
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            document.getElementById("rem").innerHTML = '';
            document.getElementById("sugg").innerHTML = xhr.responseText;
        }else{
            document.getElementById('sugg').innerHTML="en cours..";
        }
            
        }
        //specifier la ressource et le methode access et eventuellement le passage des argumrnts si il y en a
        xhr.open("post","result2.php",true);
        xhr.setRequestHeader("content-type","application/x-www-form-urlencoded")
        xhr.send("mot2="+document.getElementById("mot2").value);
        
}    

    // document.getElementById("sugg").onclick = function(){
    // document.getElementById("mot").value = event.target.textContent;
let id= document.getElementById("sub_search");
console.log(id);
id.addEventListener("submit", function submit(e){
    e.preventDefault();
    xhr = getxhr;
    xhr.onreadystatechange = function (){
        if(readyState==4 && xhr.status == 200){
            document.getElementById("rem").innerHTML = '';
            document.getElementById("sugg".innerHTML) = xhr.responseText;
        }else{
            document.getElementById('sugg').innerHTML ="aucun element trouve a ce nom";
        }
    }
    xhr.open("post","result3.php",true);
    xhr.setRequestHeader("content-type","application/x-www-form-urlencoded")
    xhr.send("mot3="+document.getElementById("mot3").value);
})