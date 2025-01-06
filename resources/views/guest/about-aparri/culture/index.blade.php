@extends('guest.shell')


@section('content')
<style>
    /* Section Styling */
    .article-section {
        display: flex;
        flex-direction: column;
        gap: 30px;
        margin-top: 20px;
    }

    .article-item {
        display: flex;
        align-items: flex-start;
        gap: 20px;
    }

    .article-image {
        flex: 1;
        width: 500px; /* Fixed width for all images */
        height: 300px; /* Fixed height for all images */
        object-fit: cover;
        border-radius: 5px;
    }

    .article-content {
        flex: 2;
        padding: 10px;
    }

    .article-content .tag {
        display: inline-block;
        border: 1px solid #000;
        border-radius: 20px;
        padding: 5px 15px;
        margin-bottom: 10px;
        font-size: 12px;
        text-transform: uppercase;
        color: #000;
    }

    .article-content h3 {
        font-size: 24px;
        font-weight: bold;
        margin: 15px 0;
        color: #333;
    }

    .article-content p {
        font-size: 16px;
        color: #666;
        line-height: 1.6;
    }

    /* Responsive Design */
    @media screen and (max-width: 768px) {
        .article-item {
            flex-direction: column;
        }

        .article-image {
            width: 100%; /* Full width on smaller screens */
            height: auto; /* Maintain aspect ratio */
        }
    }

    a{
        text-decoration: none;  
    }
</style>

    <!-- Page Header Section -->
    <section class="single-page-header">
    </section>

    <!-- Articles Section -->
    <div class="container">
        <div class="article-section">
            <!-- Article Item 1 -->
            <div class="article-item">
                <a href="{{ route('farming') }}">
                    <img src="{{ asset('image/farming.jpg') }}" alt="Farming in Aparri" class="article-image">
                </a>
                <div class="article-content">
                    <span class="tag">Culture</span>
                    <h3><a href="{{ route('farming') }}">Farming</a></h3>
                    <p>
                        Farming is integral to Aparri's culture, showcasing traditional agricultural 
                    </p>
                    <a href="{{ route('farming') }}">see more...</a>
                </div>
            </div>

            <!-- Article Item 2 -->
            <div class="article-item">
                <a href="{{ route('fishing') }}">
                    <img src="{{ asset('image/fishing.jpg') }}" alt="Fishing in Aparri" class="article-image">
                </a>
                <div class="article-content">
                    <span class="tag">Culture</span>
                    <h3><a href="{{ route('fishing') }}">Fishing</a></h3>
                    <p>
                        Fishing has been a cornerstone of Aparri's livelihood and culture. The town is known for its
                        sustainable practices and reverence for the sea.
                    </p>
                </div>
            </div>

            <!-- Article Item 3 -->
            <div class="article-item">
                <a href="{{ route('gakka') }}">
                    <img src="{{ asset('image/gakka.jpg') }}" alt="Gakka in Aparri" class="article-image">
                </a>
                <div class="article-content">
                    <span class="tag">Culture</span>
                    <h3><a href="{{ route('gakka') }}">Gakka</a></h3>
                    <p>
                        Gakka is a kind of sea clam known to be found only in Aparri and neighboring sea towns. Gathering gakka sea clams along the seashore is made convenient by means of a tako, a sieve-like snare of bamboo splits made easier to hold by a long wooden handle. It is cooked by pouring hot water and a little bit of salt but some know of a few who eat them raw. The technique for eating gakka like the way the old people do was pretty hard to master. They pop a single shellfish in their mouth and after a few mouth motions, the shell is magically spit out.
                    </p>
                </div>
            </div>

             <!-- Article Item 4 -->
             <div class="article-item">
                <a href="{{ route('aramang_ukoy') }}">
                    <img src="{{ asset('image/aramang ukuy.jpg') }}" alt="Aramang Ukoy" class="article-image">
                </a>
                <div class="article-content">
                    <span class="tag">Culture</span>
                    <h3><a href="{{ route('aramang_ukoy') }}">Aramang Ukoy</a></h3>
                    <p>
                        The gathering of Gakka sea clams is a unique cultural practice in Aparri. It highlights the
                        ingenuity of the local people and their deep connection to the coastal ecosystem.
                    </p>
                </div>
            </div>

             <!-- Article Item 5 -->
             <div class="article-item">
                <a href="{{ route('miki_niladdit') }}">
                    <img src="{{ asset('image/miki.jpg') }}" alt="Miki Niladdit" class="article-image">
                </a>
                <div class="article-content">
                    <span class="tag">Culture</span>
                    <h3><a href="{{ route('miki_niladdit') }}">Miki Niladdit</a></h3>
                    <p>
                        The gathering of Gakka sea clams is a unique cultural practice in Aparri. It highlights the
                        ingenuity of the local people and their deep connection to the coastal ecosystem.
                    </p>
                </div>
            </div>

             <!-- Article Item 6 -->
             <div class="article-item">
                <a href="{{ route('nipa_thatch') }}">
                    <img src="{{ asset('image/nipa.png') }}" alt="Nipa Thatch" class="article-image">
                </a>
                <div class="article-content">
                    <span class="tag">Culture</span>
                    <h3><a href="{{ route('nipa_thatch') }}">Nipa Thatch</a></h3>
                    <p>
                        Linao and Navagan are one of the Ybanag speaking barangays aside from being the farthest and remotest barangay of the western part of Aparri. These are the places where nipa saps are tradionally distilled by the locals to produce the nipa wine locally known as “Vinarayang”. This associate species of mangroves covers a large part of the total land area of these two barangays. The locals produce nipa shingles or “Pinoc” and organic vinegar “Silam”.e local people and their deep connection to the coastal ecosystem.
                    </p>
                </div>
            </div>

            <!-- Article Item 7 -->
            <div class="article-item">
                <a href="{{ route('dried_fish') }}">
                    <img src="{{ asset('image/daing.jpg') }}" alt="Dried Fish" class="article-image">
                </a>
                <div class="article-content">
                    <span class="tag">Culture</span>
                    <h3><a href="{{ route('dried_fish') }}">Dried Fish</a></h3>
                    <p>
                        Dried fish processing is one among the primary source of income for the Aparrianos particularly in Barangay Punta. The oldest traditional way of preserving fish was still observed nowadays which is passed on to every generation.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
