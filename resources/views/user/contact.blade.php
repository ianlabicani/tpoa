@extends('user.shell')

@section('content')
<style>
    #leaflet-map {
        width: 100%;
        height: 500px;
    }
    @media (max-width: 768px) {
        #leaflet-map {
            height: 300px;
        }
    }
</style>


<!-- Map Section -->
<section class="map-section py-5">
    <div class="container">
       
        <div class="row justify-content-center">
            <div class="col-md-10">
                <!-- Leaflet Map -->
                <div id="leaflet-map"></div>
            </div>
        </div>

        <h2 class="text-center display-5 mb-4">Emergency Contact Services in Aparri</h2>

<!-- Contact details for PNP Aparri -->
<div class="row justify-content-center mb-4">
    <h4 class="text-center display-5 mb-3">PNP Aparri</h4>
    <!-- Phone Numbers Column -->
    <div class="col-md-5">
        <h5 class="font-weight-bold">Phone Numbers:</h5>
        <ul>
            <li>0917-203-2003</li>
        </ul>
    </div>
    <!-- Address Column -->
    <div class="col-md-5">
        <h5 class="font-weight-bold">Address:</h5>
        <p>PNP Headquarters, Aparri, Cagayan</p>
    </div>
</div>

<!-- Contact details for Coast Guard -->
<div class="row justify-content-center mb-4">
    <h4 class="text-center display-5 mb-3">Coast Guard</h4>
    <!-- Phone Numbers Column -->
    <div class="col-md-5">
        <h5 class="font-weight-bold">Phone Numbers:</h5>
        <ul>
            <li>0956-830-1802</li>
        </ul>
    </div>
    <!-- Address Column -->
    <div class="col-md-5">
        <h5 class="font-weight-bold">Address:</h5>
        <p>Coast Guard Station, Aparri, Cagayan</p>
    </div>
</div>

<!-- Contact details for Maritime -->
<div class="row justify-content-center mb-4">
    <h4 class="text-center display-5 mb-3">Maritime</h4>
    <!-- Phone Numbers Column -->
    <div class="col-md-5">
        <h5 class="font-weight-bold">Phone Numbers:</h5>
        <ul>
            <li>0906-842-5879</li>
        </ul>
    </div>
    <!-- Address Column -->
    <div class="col-md-5">
        <h5 class="font-weight-bold">Address:</h5>
        <p>Maritime Office, Aparri, Cagayan</p>
    </div>
</div>

<!-- Contact details for BFP Aparri -->
<div class="row justify-content-center mb-4">
    <h4 class="text-center display-5 mb-3">BFP Aparri</h4>
    <!-- Phone Numbers Column -->
    <div class="col-md-5">
        <h5 class="font-weight-bold">Phone Numbers:</h5>
        <ul>
            <li>0916-491-0946</li>
            <li>0956-260-7818</li>
        </ul>
    </div>
    <!-- Address Column -->
    <div class="col-md-5">
        <h5 class="font-weight-bold">Address:</h5>
        <p>BFP Office, Aparri, Cagayan</p>
    </div>
</div>

<!-- Contact details for MDRRMO Aparri -->
<div class="row justify-content-center mb-4">
    <h4 class="text-center display-5 mb-3">MDRRMO Aparri</h4>
    <!-- Phone Numbers Column -->
    <div class="col-md-5">
        <h5 class="font-weight-bold">Phone Numbers:</h5>
        <ul>
            <li>0956-654-2894</li>
            <li>0961-971-2006</li>
        </ul>
    </div>
    <!-- Address Column -->
    <div class="col-md-5">
        <h5 class="font-weight-bold">Address:</h5>
        <p>MDRRMO Office, Aparri, Cagayan</p>
    </div>
</div>

<!-- Contact details for RHU West -->
<div class="row justify-content-center mb-4">
    <h4 class="text-center display-5 mb-3">RHU West</h4>
    <!-- Phone Numbers Column -->
    <div class="col-md-5">
        <h5 class="font-weight-bold">Phone Numbers:</h5>
        <ul>
            <li>0935-951-9786</li>
        </ul>
    </div>
    <!-- Address Column -->
    <div class="col-md-5">
        <h5 class="font-weight-bold">Address:</h5>
        <p>RHU West, Aparri, Cagayan</p>
    </div>
</div>

<!-- Contact details for RHU East -->
<div class="row justify-content-center mb-4">
    <h4 class="text-center display-5 mb-3">RHU East</h4>
    <!-- Phone Numbers Column -->
    <div class="col-md-5">
        <h5 class="font-weight-bold">Phone Numbers:</h5>
        <ul>
            <li>0953-190-8364</li>
        </ul>
    </div>
    <!-- Address Column -->
    <div class="col-md-5">
        <h5 class="font-weight-bold">Address:</h5>
        <p>RHU East, Aparri, Cagayan</p>
    </div>
</div>

    </div>


    
</section>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Initialize the map centered on Aparri, Cagayan
        const map = L.map('leaflet-map').setView([18.3564, 121.6402], 13);

        // Add a tile layer (OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Define emergency locations and contact info
        const emergencyLocations = [
            {
                name: "MDRRMO Aparri",
                coordinates: [18.356580564653186, 121.63725569021658],
                contacts: ["0956-654-2894", "0961-971-2006"]
            },
            {
                name: "PNP Aparri",
                coordinates: [18.358665289774418, 121.637634584608],
                contacts: ["0917-203-2003"]
            },
            {
                name: "BFP Aparri",
                coordinates: [18.357179143194944, 121.63688827724887],
                contacts: ["0916-491-0946", "0956-260-7818"]
            },
            {
                name: "RHU East",
                coordinates: [18.3580, 121.6380],
                contacts: ["0953-190-8364"]
            },
            {
                name: "RHU West",
                coordinates: [18.309552736331312, 121.61265416087967],
                contacts: ["0935-951-9786"]
            },
            {
                name: "Maritime",
                coordinates: [18.359970124838533, 121.6329723077469],
                contacts: ["0906-842-5879"]
            },
            {
                name: "Coast Guard",
                coordinates: [18.354910024649616, 121.63835571678456],
                contacts: ["0956-830-1802"]
            },
          
        ];

        // Add markers for each emergency location
        emergencyLocations.forEach(function (location) {
            const contactList = location.contacts.map(contact => `<a href="tel:+63${contact.replace(/-/g, '')}">${contact}</a>`).join(' / ');
            L.marker(location.coordinates)
                .addTo(map)
                .bindPopup(`
                    <b>${location.name}</b><br>
                    Contact: ${contactList}
                `);
        });
    });
</script>



@endsection
