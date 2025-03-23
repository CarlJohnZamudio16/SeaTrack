document.addEventListener("DOMContentLoaded", function () {
    fetch('fetch_analytics.php')
        .then(response => response.json())
        .then(data => {
            // Update statistics
            document.getElementById('total-boats').textContent = data.total_boats;
            document.getElementById('active-licenses').textContent = data.active_licenses;
            document.getElementById('total-fishermen').textContent = data.total_fishermen;

            // Update Line Chart (Boats Registered Over Time)
            boatsOverTime.data.labels = data.charts.boatsOverTime.labels;
            boatsOverTime.data.datasets[0].data = data.charts.boatsOverTime.data;
            boatsOverTime.update();

            // Update Pie Chart (License Status)
            licenseStatus.data.labels = data.charts.licenseStatus.labels;
            licenseStatus.data.datasets[0].data = data.charts.licenseStatus.data;
            licenseStatus.update();

            // Update Bar Chart (Boat Types)
            boatTypes.data.labels = data.charts.boatTypes.labels;
            boatTypes.data.datasets[0].data = data.charts.boatTypes.data;
            boatTypes.update();

            // Update Doughnut Chart (Fuel Usage)
            fuelUsage.data.labels = data.charts.fuelUsage.labels;
            fuelUsage.data.datasets[0].data = data.charts.fuelUsage.data;
            fuelUsage.update();
        })
        .catch(error => console.error('Error fetching data:', error));
});
