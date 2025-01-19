function aff(){
for(let i = 0;i<select.length;i++){
        select2[i].style.display = 'table-row';
        all_task.style.background = '#00309B';
    }
}
let tt = document.getElementById("advance");
let advance = tt.textContent;
let bar = document.querySelector('.adv_bar');
advance = `${advance}%`;
bar.setAttribute('style',`width: ${advance}`); 
/************************************************* */
let form_task = document.querySelector('.form-add-task');
let new_task = document.querySelectorAll(".btn-new-task");
let main_task = document.querySelector(".main-task-project");
new_task.forEach(element => {
    element.addEventListener("click", task_modal)
    function task_modal(){
        console.log("a");
        form_task.classList.toggle("view-task");
        main_task.classList.toggle('overlay1');
    }    
});
let all_task = document.querySelector('.main-task-project .filt-tout-task');
let task_attende = document.querySelector('.main-task-project .filt-enattente-task');
let task_encours = document.querySelector('.main-task-project .filt-encours-task');
let task_finish = document.querySelector('.main-task-project .filt-termine-task');
let task_retard = document.querySelector('.main-task-project .filt-retard-task');
let select = document.querySelectorAll('.filt');
let select2 = document.querySelectorAll(".calc");
all_task.addEventListener('click', function aff(){
    for(let i = 0;i<select.length;i++){
            all_task.style.background = '#00309B';
            all_task.style.color = '#fff';
            for(let i = 0;i<select.length;i++){
                select2[i].style.display = 'table-row';
                all_task.style.background = '#00309B';
            }
        }
    });
task_attende.addEventListener('click', function aff1(){
    aff();
    for(let i =0 ;i<select.length;i++){
        if(select[i].textContent !== "en attende"){
            select2[i].style.display ='none';
        }
    }   
})
task_finish.addEventListener('click', function aff2(){
    aff();
    for(let i =0 ;i<select.length;i++){
        if(select[i].textContent !== "termine"){
            select2[i].style.display ='none';
        }
    }    
})
task_encours.addEventListener('click', function aff3(){
    aff();
    for(let i =0 ;i<select.length;i++){
        if(select[i].textContent !== "en cours"){
            select2[i].style.display ='none';
        }
    }    
})
task_retard.addEventListener('click', function aff3(){
    aff();
    for(let i =0 ;i<select.length;i++){
        if(select[i].textContent !== "retard"){
            select2[i].style.display ='none';
        }
    }    
})

