const ctx = document.getElementById('myChart');
let ter = parseInt(document.getElementById("ter").value);
let tec = parseInt(document.getElementById("tec").value);
let taa = parseInt(document.getElementById("taa").value);
let ttt = parseInt(document.getElementById("ttt").value);
console.log(ter,tec,taa,ttt);
const data = {
    labels: [/*'tache en retard', 'tache termine', 'tache en cours', 'tache en attende'*/],
    datasets: [{
      label: '# taches',
      data: [ter, ttt, tec, taa],
      borderWidth: 1,
      backgroundColor: ['red', 'green', 'orange', '#aaa'],
    }]
  };
 

new Chart(ctx, {
type: 'pie',
data:data,
options: {
    
    plugins: {
        legend: {
          onHover: handleHover,
          onLeave: handleLeave
        }
      }
}
});


  

// Append '4d' to the colors (alpha channel), except for the hovered index
function handleHover(evt, item, legend) {
    legend.chart.data.datasets[0].backgroundColor.forEach((color, index, colors) => {
      colors[index] = index === item.index || color.length === 9 ? color : color + '4D';
    });
    legend.chart.update();
  }
  // Removes the alpha channel from background colors
function handleLeave(evt, item, legend) {
    legend.chart.data.datasets[0].backgroundColor.forEach((color, index, colors) => {
      colors[index] = color.length === 9 ? color.slice(0, -2) : color;
    });
    legend.chart.update();
  }
  



 