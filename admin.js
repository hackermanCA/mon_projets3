// admin.js - Dashboard admin avec graphiques Chart.js

document.addEventListener('DOMContentLoaded', function() {
    // Récupération des stats
    const visitors = parseInt(localStorage.getItem('visitorsCount') || '0', 10);
    const sante = parseInt(localStorage.getItem('santeCount') || '0', 10);
    const alimentation = parseInt(localStorage.getItem('alimentationCount') || '0', 10);
    const remedes = parseInt(localStorage.getItem('remedesCount') || '0', 10);
    const exercices = parseInt(localStorage.getItem('exercicesCount') || '0', 10);

    document.getElementById('visitorsCount').textContent = visitors;
    document.getElementById('santeCount').textContent = sante;
    document.getElementById('alimentationCount').textContent = alimentation;
    document.getElementById('remedesCount').textContent = remedes;
    document.getElementById('exercicesCount').textContent = exercices;

    // Bar Chart
    const barCtx = document.getElementById('barChart').getContext('2d');
    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: ['Santé', 'Alimentation', 'Remèdes', 'Exercices'],
            datasets: [{
                label: 'Consultations',
                data: [sante, alimentation, remedes, exercices],
                backgroundColor: [
                    '#7aa87a', '#3cb15f', '#f5b041', '#5e8c5e'
                ],
                borderRadius: 8
            }]
        },
        options: {
            responsive: false,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, precision:0 } }
        }
    });

    // Pie Chart
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: ['Santé', 'Alimentation', 'Remèdes', 'Exercices'],
            datasets: [{
                data: [sante, alimentation, remedes, exercices],
                backgroundColor: [
                    '#7aa87a', '#3cb15f', '#f5b041', '#5e8c5e'
                ]
            }]
        },
        options: {
            responsive: false,
            plugins: { legend: { position: 'bottom' } }
        }
    });
});

function resetStats() {
    if(confirm('Réinitialiser toutes les statistiques ?')) {
        localStorage.setItem('visitorsCount', 0);
        localStorage.setItem('santeCount', 0);
        localStorage.setItem('alimentationCount', 0);
        localStorage.setItem('remedesCount', 0);
        localStorage.setItem('exercicesCount', 0);
        location.reload();
    }
}
