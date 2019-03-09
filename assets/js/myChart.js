<<<<<<< HEAD
function renderChart(data, labels) {
    var ctx = document.getElementById("myChart").getContext('2d');
=======


function renderChart(data, labels,typeG) {
    var ctx = document.getElementById("class").getContext('2d');
    var myChart = new Chart(ctx, {
        type: typeG,
        data: {
            labels: labels,
            datasets: [
				{
                label: 'All time',
                data: data,
                borderColor: 'rgba(8, 71, 110, 1)',
                backgroundColor: 'rgba(8, 71, 110, 0.6)',
            }				
			]
        },
        options: {            
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
//                      
                    }
                }]                
            }
        },
    });
}

function renderDoubleChart(data, data1,labels,typeG) {
    var ctx = document.getElementById("class").getContext('2d');
    var myChart = new Chart(ctx, {
        type: typeG,
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Last Month',
                    data: data,
                    borderColor: 'rgba(255, 153, 153, 1)',
                    backgroundColor: 'rgba(255, 153, 153, 0.6)',
                },
                {
                    label: 'This Month',
                    data: data1,
                    borderColor: 'rgba(8, 71, 110, 1)',
                backgroundColor: 'rgba(8, 71, 110, 0.6)',
                }
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        
                    }
                }]
            },
        }
    });
}
function renderPieChart(data,labels,title){
	
var pie = document.getElementById("class").getContext('2d');
var myChart = new Chart(pie, {
    type: 'pie',
    data: {
        labels: labels,
        datasets: [
            {
                data: data,
                borderColor: ['rgba(8, 71, 110, 1)', 'rgba(192, 0, 0, 1)'],
                backgroundColor: ['rgba(8, 71, 110, 0.6)', 'rgba(192, 0, 0, 0.2)'],
            }
        ]
    },
    options: {
        title: {
            display: true,
            text: title
        }
    }
});
}

function renderLineChart(data,labels){
	 var ctx = document.getElementById("class").getContext('2d');
>>>>>>> 7559023526411b2e7378706a6d7cfeb0e8f53220
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
<<<<<<< HEAD
                label: 'This week',
                data: data,
            }]
        },
    });
}

$("#renderBtn").click(
    function () {
        data = [20000, 14000, 12000, 15000, 18000, 19000, 22000];
        labels =  ["sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday"];
        renderChart(data, labels);
    }
);
=======
                label: 'All time',
                data: data,
                borderColor: 'rgba(8, 71, 110, 1)',
                backgroundColor: 'rgba(8, 71, 110, 0.6)',
            }]
        },
        options: {            
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        
                    }
                }]                
            }
        },
    });
}
function renderDoughnutChart(data,labels){

new Chart(document.getElementById("class"), {
    type: 'doughnut',
    data: {
      labels: labels,
      datasets: [
        {
          label: "Population (millions)",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
          data: data
        }
      ]
    },
    options: {
      title: {
        display: true,
        text: 'Predicted world population (millions) in 2050'
      }
    }
});
}
>>>>>>> 7559023526411b2e7378706a6d7cfeb0e8f53220
