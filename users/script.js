let bars = document.getElementById("bars");
let container = document.querySelector('.container');
let sidebar = document.querySelector(".sidebar");
let header = document.querySelector('header');
let header_nav = document.querySelector('.header');
let cancel = document.querySelector('.fa-bars');
bars.addEventListener('click', remove);
function remove(){
    sidebar.classList.toggle("remove");
    header.classList.toggle('remove-header');
    header_nav.classList.toggle('remove-header-nav');
    cancel.classList.toggle('remove-fa-bars');
    container.classList.toggle('extent');
}
let close = document.querySelector(".sidebar .close");
close.addEventListener('click', function close(){
    sidebar.classList.toggle("remove");
    cancel.classList.toggle('remove-fa-bars');

})
