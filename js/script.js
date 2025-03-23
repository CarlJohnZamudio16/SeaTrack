document.addEventListener("DOMContentLoaded", function () {
    // Auto-generate Registration Number on Registration Page
    if (window.location.pathname.includes('regist.php')) {
        let regNumberField = document.getElementById("registrationNumber");

        if (regNumberField) {
            function generateRegNumber() {
                let randomNum = Math.floor(1000 + Math.random() * 9000);
                let year = new Date().getFullYear();
                return `FV-${year}${randomNum}`;
            }
            regNumberField.value = generateRegNumber();
        } else {
            console.error("Registration Number field not found!");
        }
    }

    // Handle Boat Registration Form Submission
    const boatForm = document.getElementById("boatForm");
    if (boatForm) {
        boatForm.addEventListener("submit", function (event) {
            event.preventDefault();

            let formData = new FormData(this);

            fetch("register_boat.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                let regNumber = document.getElementById("registrationNumber").value;
                this.reset();
                document.getElementById("registrationNumber").value = regNumber;
            })
            .catch(error => console.error("Error:", error));
        });
    }

    // Search Feature for Dashboard
    let currentSearchQuery = '';

    const searchForm = document.getElementById("searchForm");
    if (searchForm) {
        searchForm.addEventListener("submit", function (event) {
            event.preventDefault();
            currentSearchQuery = document.getElementById("searchInput").value.toLowerCase();
            fetchDashboardData();
        });
    }

    let timeout;
    const searchInput = document.getElementById("searchInput");
    if (searchInput) {
        searchInput.addEventListener("input", function () {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                currentSearchQuery = this.value.toLowerCase();
                fetchDashboardData();
            }, 300);
        });
    }

    // Fetch and Display Boat Data on Dashboard
    function fetchDashboardData() {
        const searchQueryParam = currentSearchQuery ? `?search=${currentSearchQuery}` : '';

        fetch("fetch_data.php" + searchQueryParam)
            .then(response => response.json())
            .then(data => {
                document.querySelector("#total-boats").textContent = data.total_boats;
                document.querySelector("#active-licenses").textContent = data.active_licenses;
                document.querySelector("#total-fishermen").textContent = data.total_fishermen;

                let boatList = document.querySelector(".boat-list");
                boatList.innerHTML = "";

                if (data.boats.length === 0) {
                    boatList.innerHTML = "<p>No boats found</p>";
                    return;
                }

                data.boats.forEach(boat => {
                    let boatItem = document.createElement("div");
                    boatItem.className = "boat-item";
                    boatItem.innerHTML = `
                        <div class="boat-name">${boat.boat_name} <span class="boat-id">#${boat.registration_number}</span></div>
                        <div class="boat-owner">Owner: ${boat.owner_name}</div>
                    `;
                    boatItem.addEventListener("click", () => {
                        showBoatDetails(boat);
                        toggleActiveClass(boatItem);
                    });
                    boatList.appendChild(boatItem);
                });
            })
            .catch(error => console.error("Error fetching data:", error));
    }

    // Display Boat Details including License Expiry & Status
    function showBoatDetails(boat) {
        console.log("Boat Data:", boat);

        document.getElementById("boat-name").textContent = boat.boat_name;
        document.getElementById("boat-registration").textContent = boat.registration_number;
        document.getElementById("boat-owner").textContent = boat.owner_name;
        document.getElementById("boat-status").textContent = boat.status;
        document.getElementById("boat-type").textContent = boat.boat_type;
        document.getElementById("boat-length").textContent = boat.length + " meters";
        document.getElementById("boat-material").textContent = boat.hull_material;
        document.getElementById("boat-year").textContent = boat.year_built;
        document.getElementById("boat-port").textContent = boat.home_port;
        document.getElementById("boat-crew").textContent = boat.crew_capacity;
        document.getElementById("boat-engine").textContent = boat.engine_type + " " + boat.engine_model;
        document.getElementById("boat-fuel").textContent = boat.fuel_type;
        document.getElementById("boat-fuel-capacity").textContent = boat.fuel_capacity + " liters";

        // License Expiry & Status
        let licenseExpiryField = document.getElementById("boat-license-expiry");
        let licenseStatusField = document.getElementById("boat-license-status");

        if (boat.license_expiry && boat.license_expiry !== "N/A") {
            licenseExpiryField.textContent = boat.license_expiry;

            // Fix Date Parsing
            let expiryDate = new Date(boat.license_expiry + "T00:00:00");
            let currentDate = new Date();

            console.log("Parsed Expiry Date:", expiryDate);
            console.log("Current Date:", currentDate);

            if (!isNaN(expiryDate)) {
                if (expiryDate >= currentDate) {
                    licenseStatusField.textContent = "Active";
                    licenseStatusField.style.color = "green";
                } else {
                    licenseStatusField.textContent = "Expired";
                    licenseStatusField.style.color = "red";
                }
            } else {
                licenseStatusField.textContent = "Invalid Date Format";
                licenseStatusField.style.color = "orange";
            }
        } else {
            licenseExpiryField.textContent = "No expiry date available";
            licenseStatusField.textContent = "Unknown";
        }
    }

    // Toggle Active Class on Boat Item
    function toggleActiveClass(clickedBoatItem) {
        let boatItems = document.querySelectorAll(".boat-item");
        boatItems.forEach(item => item.classList.remove("active"));
        clickedBoatItem.classList.add("active");
    }

    // Auto-Refresh Dashboard Every 10 Seconds
    fetchDashboardData();
    setInterval(fetchDashboardData, 10000);
});
