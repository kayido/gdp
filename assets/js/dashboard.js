let adv = document.querySelectorAll(".group .projets-dash .pro-dash .adv");
let bar2 = document.querySelectorAll('.group .projets-dash .pro-dash .dash-adv .adv-d');

for(i=0;i<adv.length;i++){
    let advance = adv[i].textContent;
    console.log(advance);
    advance = `${advance}%`;
    bar2[i].setAttribute('style',`width: ${advance}`);
}

