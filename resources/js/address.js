document.addEventListener("DOMContentLoaded", function () {
    const regionSelect = document.getElementById("region");
    const provinceSelect = document.getElementById("province");
    const citySelect = document.getElementById("city");
    const barangaySelect = document.getElementById("barangay");

    // Saved values from the database
    const savedRegion = "{{ $generalInfo->region ?? '' }}";
    const savedProvince = "{{ $generalInfo->province ?? '' }}";
    const savedCity = "{{ $generalInfo->city ?? '' }}";
    const savedBarangay = "{{ $generalInfo->barangay ?? '' }}";

    // Load Regions
    fetch('https://psgc.gitlab.io/api/regions/')
        .then(response => response.json())
        .then(data => {
            data.forEach(region => {
                let option = new Option(region.name, region.code, false, region.code === savedRegion);
                regionSelect.appendChild(option);
            });

            if (savedRegion) {
                regionSelect.value = savedRegion;
                loadProvinces(savedRegion, savedProvince);
            }
        });

    // Load Provinces when Region changes
    regionSelect.addEventListener("change", function () {
        let regionCode = this.value;
        provinceSelect.innerHTML = '<option value="">Select Province</option>';
        citySelect.innerHTML = '<option value="">Select City</option>';
        barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

        if (regionCode === "130000000") { // PSGC Code for NCR (No Province)
            provinceSelect.style.display = "none";
            loadCities(regionCode, savedCity);
        } else {
            provinceSelect.style.display = "block";
            loadProvinces(regionCode, savedProvince);
        }
    });

    function loadProvinces(regionCode, selectedProvince) {
        fetch(`https://psgc.gitlab.io/api/regions/${regionCode}/provinces/`)
            .then(response => response.json())
            .then(data => {
                data.forEach(province => {
                    let option = new Option(province.name, province.code, false, province.code === selectedProvince);
                    provinceSelect.appendChild(option);
                });

                if (selectedProvince) {
                    provinceSelect.value = selectedProvince;
                    loadCities(selectedProvince, savedCity);
                }
            });
    }

    // Load Cities when Province changes
    provinceSelect.addEventListener("change", function () {
        let provinceCode = this.value;
        citySelect.innerHTML = '<option value="">Select City</option>';
        barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

        loadCities(provinceCode, savedCity);
    });

    function loadCities(parentCode, selectedCity) {
        fetch(`https://psgc.gitlab.io/api/provinces/${parentCode}/cities/`)
            .then(response => response.json())
            .then(data => {
                data.forEach(city => {
                    let option = new Option(city.name, city.code, false, city.code === selectedCity);
                    citySelect.appendChild(option);
                });

                if (selectedCity) {
                    citySelect.value = selectedCity;
                    loadBarangays(selectedCity, savedBarangay);
                }
            });
    }

    // Load Barangays when City changes
    citySelect.addEventListener("change", function () {
        let cityCode = this.value;
        barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

        loadBarangays(cityCode, savedBarangay);
    });

    function loadBarangays(cityCode, selectedBarangay) {
        fetch(`https://psgc.gitlab.io/api/cities/${cityCode}/barangays/`)
            .then(response => response.json())
            .then(data => {
                data.forEach(barangay => {
                    let option = new Option(barangay.name, barangay.code, false, barangay.code === selectedBarangay);
                    barangaySelect.appendChild(option);
                });

                if (selectedBarangay) {
                    barangaySelect.value = selectedBarangay;
                }
            });
    }
});
