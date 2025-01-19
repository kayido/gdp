let start = document.querySelector('.main-create .form-group .selective .sel1 .start');
let end = document.querySelector('.main-create .form-group .selective .sel2 .end');
let all = document.querySelectorAll('.main-create .form-group .selective  .opt');
let btn_create_group = document.querySelector('.main-create .form-group .selective .sel1  footer button');
let btn_create_group2 = document.querySelector('.main-create .form-group .selective .sel2 footer  button');
all.forEach(element => {
    console.log(element.children[1].checked);
    btn_create_group.addEventListener('click', function treez(){
        if(element.children[1].checked){
            end.appendChild(element);
        }
    })
    if(element.children[1].checked){
            end.appendChild(element);
    }
    btn_create_group2.addEventListener('click', function myfunction(){
        if(element.children[1].checked === false){
            start.appendChild(element);
        }
    })
});
/******************************************************************** */
let start1 = document.querySelector('.main-create .form-project form .selective .sel1 .start');
let end1 = document.querySelector('.main-create .form-project .selective .sel2 .end');
let all1 = document.querySelectorAll('.main-create .form-project .selective  .opt');
let btn_create_group1 = document.querySelector('.main-create .form-project .selective .sel1  footer button');
let btn_create_group21 = document.querySelector('.main-create .form-project .selective .sel2 footer  button');
all1.forEach(element => {
    console.log(element.children[1].checked);
    btn_create_group1.addEventListener('click', function treez(){
        if(element.children[1].checked){
            end1.appendChild(element);
        }
    })
    if(element.children[1].checked){
            end1.appendChild(element);
    }
    btn_create_group21.addEventListener('click', function myfunction(){
        if(element.children[1].checked === false){
            start1.appendChild(element);
        }
    })
});
