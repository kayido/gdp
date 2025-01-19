let btn_act = document.querySelectorAll('.main-taches .head-menu button');
let menu_act = document.querySelectorAll('.main-taches .menu-act');

menu_act[0].style.display = "block"
menu_act[1].style.display = "none";
btn_act.forEach(element => {
    element.addEventListener('click', function check(){
        let base = index(btn_act,element);
        menu_act[index(btn_act,element)].style.display = "block";
        for(i=0;i<menu_act.length;i++){
            if(i !== base){
                menu_act[i].style.display = "none";
            }
        }
    })
});
