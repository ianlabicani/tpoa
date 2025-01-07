@extends('user.shell')

@section('content')
    <style>
        .card {
            position: relative;
            overflow: hidden;
        }

        .card-img-top {
            transition: transform 0.3s ease-in-out;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card:hover .card-img-top {
            transform: scale(1.1);
        }

        .gallery-section {
            text-align: center;
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            background-color: #f8f9fa;
            /* Light background for contrast */
            border-radius: 10px;
            padding: 10px;
        }

        .gallery-image {
            display: block;
            width: 100%;
            height: 300px;
            /* Uniform height for all images */
            object-fit: cover;
            /* Fills the space without stretching the image */
            border-radius: 10px;
        }

        .gallery-caption {
            margin-top: 10px;
            font-size: 1rem;
            color: #333;
            /* Dark text for readability */
        }

        .history-image {
            height: 300px;
            object-fit: cover;
        }
    </style>

<!-- Vision and Mission Section -->
<div class="container my-5">
    <div class="row">
        <!-- Vision Column -->
        <div class="col-md-6">
            <h4 class="text-center mb-3">Aparri Vision</h4>
            <p class="lead mb-4" style="text-align: justify">
                “The golden frontier of the North on international and local trade and commerce, education and training, agro-fishery industry and eco-tourism with modern, green, disaster-resilient and balanced infrastructure geared towards an innovative, competitive and sustained economy with God-loving, empowered and self-reliant citizenry living in a safe and ecologically balanced environment under a responsive, transparent and dynamic governance”
            </p>
        </div>
        <!-- Mission Column -->
        <div class="col-md-6">
            <h4 class="text-center mb-3">Aparri Mission</h4>
            <p class="lead mb-4" style="text-align: justify">
                The Local Government of Aparri has to serve with humility and advocate earnestly the provisions and intentions of Republic Act 7160 known as the Local Government Code of 1991 for lifelong excellent governance.
            </p>
        </div>
    </div>
</div>

    <!-- Overview Section -->
    <section class="overview-section py-5"> 
        <div class="container">
            <h2 class="text-center display-6 mb-4">Subdivision Map of Aparri</h2>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="lead mb-4" style="text-align: justify">
                        Aparri is located at the northernmost tip of Luzon Island, 595 kilometers north of Manila. It is
                        bounded on
                        the north by the Babuyan Channel, the municipality of Buguey on the east, the municipalities of
                        Camalaniugan
                        and Allacapan on the south, and the municipality of Ballesteros on the west. Aparri is crisscrossed
                        by the
                        longest river in the country, the Cagayan River, which snakes through the provinces of Cagayan,
                        Isabela, and
                        Nueva Vizcaya, dividing Aparri into two geographical areas – Aparri East and Aparri West.
                    </p>
                    <p class="lead mb-4" style="text-align: justify">
                        The 27,600.88 hectares comprising Aparri is a vast tract of fertile agricultural land. Except for
                        the island
                        barangay of Fuga, it has no mountains, only gently rolling hills in the western part of the
                        territory. Aparri
                        is 0.3 ft below sea level. Its strategic location makes it a convergent zone and a natural
                        commercial,
                        educational, and institutional center in Northern Cagayan. Its national geographical popularity is
                        attributable to the mapping phrase “from Aparri to Jolo.”
                    </p>
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('image/subdivision-map.jpg') }}" alt="Map showing the location of Aparri"
                        class="img-fluid  shadow">
                    <p class="text-center text-muted mt-2">
                        <small>Source: ATOP</small>
                    </p>
                </div>
            </div>
        </div>
    </section>


    <section class="container mt-5">
        <h2 class="text-center display-6 mb-4">How Aparri Got Its Name</h2>
        <p class="lead mb-4" style="text-align: justify">There are no conclusive data on how Aparri got its name. However,
            there are three versions that are widely known to the Aparrianos.</p>

        <div class="mt-5">
            <h5 class=" display-6 mb-4">First Version</h5>
            <div class="row align-items-center">
                <div class="">
                    <p class="lead mb-4" style="text-align: justify">
                        Spanish conquistador Juan Pablo de Carreon, acting upon strict orders to help the Cagayanos fight
                        Japanese soldiers led by Taisufu, docked at Aparri at suppertime.
                        He called the place “aparri,” a colloquial term in his home province in Spain meaning “supper.”
                    </p>
                </div>

                <h3 class=" display-6 mb-4">Second Version</h3>
                <div class="row align-items-center">
                    <div>
                        <p class="lead mb-4" style="text-align: justify">
                            According to Buenaventura Mirafuente, a retired archivist at the National Library, Aparri is
                            derived
                            from the Ibanag word “apparian,” referring to a place where priests
                            (<i>pari</i>) resided.
                        </p>
                    </div>
                </div>

                <h3 class=" display-6 mb-4">Third Version</h3>
                <div class="row align-items-center">
                    <div>
                        <p class="lead mb-4" style="text-align: justify">
                            Historical accounts suggest that Aparri was derived from the Spanish term “aparte” (separate).
                            Initially part of Camalaniugan and Buguey, Aparri became a separate
                            town on May 11, 1680, and the term “aparte” evolved into “Aparri.”
                        </p>
                    </div>

                </div>
            </div>

        </div>


       
    <!-- Gallery of History Section -->
    <section id="gallery-section" class="gallery-section py-5 bg-light">
        <div class="container">
            <h2 class="text-center display-6 mb-4">Gallery of History</h2>
            <p class="lead text-center mb-5" style="text-align: justify">
                Explore the rich history of Aparri through these treasured photographs. Each image tells a story of our
                heritage and traditions that have shaped our vibrant community today.
            </p>
            <div class="row g-4">
                <div class="col-md-4">
                    <a href="{{ route('gallery.show', ['id' => 1]) }}">
                        <div class="gallery-item">
                            <img src="{{ asset('image/history/aparri-town-plaza.jpg') }}" alt="Aparri Town Plaza Image 1"
                                class="gallery-image">
                            <p class="gallery-caption">APARRI TOWN PLAZA, CAGAYAN PROVINCE 1935</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="{{ route('gallery.show', ['id' => 2]) }}">
                        <div class="gallery-item">
                            <img src="{{ asset('image/history/boat-unloading.jpg') }}"
                                alt="Fishing Boat Unloading Image 2" class="gallery-image">
                            <p class="gallery-caption">FISHING BOAT UNLOADING -CA. 1900s-1930s</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="{{ route('gallery.show', ['id' => 3]) }}">
                        <div class="gallery-item">
                            <img src="{{ asset('image/history/cockpit-arena.jpg') }}" alt="Cockpit Arena Image 3"
                                class="gallery-image">
                            <p class="gallery-caption">COCKPIT, APARRI, CAGAYAN PROVINCE, ca.1900s-1930s</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="{{ route('gallery.show', ['id' => 4]) }}">
                        <div class="gallery-item">
                            <img src="{{ asset('image/history/aerial-view.jpg') }}" alt="Aerial View Image 3"
                                class="gallery-image">
                            <p class="gallery-caption">AERIAL VIEW: APARRI, CAGAYAN PROVINCE, 1923</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="{{ route('gallery.show', ['id' => 5]) }}">
                        <div class="gallery-item">
                            <img src="{{ asset('image/history/fish-net-poles.jpg') }}"
                                alt="Fishing Net and Poles Image 3" class="gallery-image">
                            <p class="gallery-caption">FISHING NETS AND POLES, APARRI – CA. 1900S-1930s</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="{{ route('gallery.show', ['id' => 6]) }}">
                        <div class="gallery-item">
                            <img src="{{ asset('image/history/fisherman.jpg') }}" alt="Fisherman 3"
                                class="gallery-image">
                            <p class="gallery-caption">FISHERMAN'S AT APARRI, CAGAYAN PROVINCE, ca. 1900s-1910s</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>


    <!-- Attribution Section -->
    {{-- <section class="attribution-section py-3 text-center">
        <div class="container">
            <p class="small text-muted">
                National Archives and Records Administration (NARA); UMC General Commision on Archives and History
                (UMCGCAH); Pearl Digital Collections, UWM Digital Collections; Library of Congress; NYPL Digital
                Collections; UCSD Library Digital Collections; Wincosin-Madison Image Collection; University of Hawai'i at
                Manoa Library; National Library of the Philippines; UW Libraries Digital Collections; Cornell University
                Library Digital Collections; U-M Library Digital Collections; University of Santo Tomas Miguel de Benavides
                Library and Archives; Filipinas Heritage Library; UPD Library - Special Collections; Wiscosin-Milwaukee
                Digital Photo Archive; University of Washington Digital Resources; UPD Digital Archives; Southeast Asia
                Digital Library; Gerth Archives & Special Collections; Rizal Library; Newberry Library; World History
                Commons; University of Maryland Digital Libraries; Philippine Digital Library, Internet Archive; Yale
                University Library; HathiTrust Digital Collection; Flickr; Peabody Museum of Archeology & Enthology;
                Biodiversity Heritage Library; Indiana University Bloomington Archives Photograph Collection; and more
                un-digitized books, newspapers, bulletins, personal and private memorabilia we've scanned.
            </p>
        </div>
    </section> --}}

    <!-- Call to Action -->
    {{-- <section class="cta-section py-5 text-white" style="background-color: #99bac0;">
        <div class="container text-center">
            <h2 class="display-5">Plan Your Visit to [Province Name]</h2>
            <p class="lead">Start your journey today and explore the wonders of our province.</p>
            <a href="{{ route('destinations.index') }}" class="btn btn-light btn-lg">Explore Destinations</a>
        </div>
    </section> --}}

   
@endsection
