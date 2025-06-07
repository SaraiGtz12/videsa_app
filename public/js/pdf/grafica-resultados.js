document.addEventListener('DOMContentLoaded', function () {
    const labels = analitoData.no;

    // Gráfica CO
    new Chart(document.getElementById('graficaCO').getContext('2d'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'CO (ppmv)',
                data: analitoData.co,
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgba(255, 99, 132, 0.3)',
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: { display: true, text: 'Gráfica de CO (ppmv)' }
            }
        }
    });

    // Gráfica O2
    new Chart(document.getElementById('graficaO2').getContext('2d'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'O2 (%)',
                data: analitoData.o2,
                borderColor: 'rgb(54, 162, 235)',
                backgroundColor: 'rgba(54, 162, 235, 0.3)',
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: { display: true, text: 'Gráfica de O2 (%)' }
            }
        }
    });

    // Gráfica CO2
    new Chart(document.getElementById('graficaCO2').getContext('2d'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'CO2 (%)',
                data: analitoData.co2,
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgba(75, 192, 192, 0.3)',
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: { display: true, text: 'Gráfica de CO2 (%)' }
            }
        }
    });
});

document.getElementById('formImagenesGraficas').addEventListener('submit', function(e) {
    // obtener canvases
    const canvasCo = document.getElementById('graficaCO');
    const canvasO2 = document.getElementById('graficaO2');
    const canvasCO2 = document.getElementById('graficaCO2');

    // pasar dataURL a inputs ocultos
    document.getElementById('inputGraficaCO').value = canvasCo.toDataURL('image/png');
    document.getElementById('inputGraficaO2').value = canvasO2.toDataURL('image/png');
    document.getElementById('inputGraficaCO2').value = canvasCO2.toDataURL('image/png');
});


