/**************************************************** */
let all_menu2 = document.querySelectorAll(".main-settings .menu_users");
let btn_menu2 = document.querySelectorAll(".main-settings .option button");
console.log(all_menu2);
console.log(btn_menu2);
all_menu2[0].style.display = "block"
all_menu2[1].style.display = "none";
btn_menu2.forEach(element => {
    element.addEventListener('click', function check(){
        let base = index(btn_menu2,element);
        all_menu2[index(btn_menu2,element)].style.display = "block";
        for(i=0;i<all_menu2.length;i++){
            if(i !== base){
                all_menu2[i].style.display = "none";
            }
        }
    })
});

/************************************************ */

let all_table = document.querySelectorAll(".settings_users .users table");
let btn_menu3 = document.querySelectorAll(".settings_users .diff-users button");

all_table[0].style.display = "block"
all_table[1].style.display = "none";
btn_menu3.forEach(element => {
    element.addEventListener('click', function check(){
        let base = index(btn_menu3,element);
        all_table[index(btn_menu3,element)].style.display = "block";
        for(i=0;i<all_table.length;i++){
            if(i !== base){
                all_table[i].style.display = "none";
            }
        }
    })
});
