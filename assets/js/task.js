let select_all = document.getElementById("select_task_all");
select_check = document.querySelectorAll(".show-task table tr td input");
select_all.addEventListener("click", function select_all(){
    for(i=0;i<select_check.length;i++){
        select_check[i].setAttribute("checked","");
    }
});
