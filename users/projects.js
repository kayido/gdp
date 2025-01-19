// let start_project = document.querySelectorAll('.btn-modal');
// let form_project = document.querySelector('.main-projects .form-project');
// let overlay_project = document.querySelector('.overlay')
// start_project.forEach(element => {
//     element.addEventListener('click', function show(){
//         overlay_project.classList.toggle('overlay1');
//         form_project.classList.toggle('view');
//     })
// });
function index(a ,chaine){
    for(i = 0; i<a.length;i++){
        if(a[i] === chaine){
            return i;
        }
    }
}
let all_menu  = document.querySelectorAll(".menu_taches");
let btn_menu  = document.querySelectorAll(".main-task-project .option button");
all_menu[0].style.display = "block"
all_menu[1].style.display = "none";
all_menu[2].style.display = "none";

btn_menu.forEach(element => {
    element.addEventListener('click', function check(){
        let base = index(btn_menu,element);
        all_menu[index(btn_menu,element)].style.display = "block";
        for(i=0;i<all_menu.length;i++){
            if(i !== base){
                all_menu[i].style.display = "none"
            }
        }
    })
});
