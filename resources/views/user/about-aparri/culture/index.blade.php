@extends('user.shell')


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
            width: 600px;
            /* Fixed width for all images */
            height: 400px;
            /* Fixed height for all images */
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
            text-align: justify
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
                width: 100%;
                /* Full width on smaller screens */
                height: auto;
                /* Maintain aspect ratio */
            }
        }

        a {
            text-decoration: none;
        }

        p {
            text-align: justify
        }
    </style>



    <!-- Articles Section -->
    <div class="container">

        <div class="article-section">
            <div class="section-header text-center">
                <h3>Explore the Aparri Culture</h3>

            </div>
            <!-- Article Item 1 -->
            <div class="article-item">

                <img src="{{ asset('image/farming.jpg') }}" alt="Farming in Aparri" class="article-image">

                <div class="article-content">
                    <span class="tag">Culture</span>
                    <h3>Farming</h3>
                    <p class="text-justify">
                        Farming is integral to Aparri's culture, showcasing traditional agricultural
                    </p>

                </div>
            </div>

            <!-- Article Item 2 -->
            <div class="article-item">

                <img src="{{ asset('image/fishing.jpg') }}" alt="Fishing in Aparri" class="article-image">

                <div class="article-content">
                    <span class="tag">Culture</span>
                    <h3>Fishing</h3>
                    <p class="text-justify">
                        Fishing has been a cornerstone of Aparri's livelihood and culture. The town is known for its
                        sustainable practices and reverence for the sea.
                    </p>
                </div>
            </div>

            <!-- Article Item 3 -->
            <div class="article-item">

                <img src="{{ asset('image/gakka.jpg') }}" alt="Gakka in Aparri" class="article-image">

                <div class="article-content">
                    <span class="tag">Culture</span>
                    <h3>Gakka</h3>
                    <p class="text-justify">
                        Gakka is a kind of sea clam known to be found only in Aparri and neighboring sea towns. Gathering
                        gakka sea clams along the seashore is made convenient by means of a tako, a sieve-like snare of
                        bamboo splits made easier to hold by a long wooden handle. It is cooked by pouring hot water and a
                        little bit of salt but some know of a few who eat them raw. The technique for eating gakka like the
                        way the old people do was pretty hard to master. They pop a single shellfish in their mouth and
                        after a few mouth motions, the shell is magically spit out.
                    </p>
                </div>
            </div>

            <!-- Article Item 4 -->
            <div class="article-item">

                <img src="{{ asset('image/aramang ukuy.jpg') }}" alt="Aramang Ukoy" class="article-image">

                <div class="article-content">
                    <span class="tag">Culture</span>
                    <h3>Aramang Ukoy</h3>
                    <p class="text-justify">

                    </p>
                </div>
            </div>


            <!-- Article Item 5 -->
            <div class="article-item mb-4">

                <img src="{{ asset('image/daing.jpg') }}" alt="Dried Fish" class="article-image">

                <div class="article-content">
                    <span class="tag">Culture</span>
                    <h3>Dried Fish</h3>
                    <p class="text-justify">
                        Dried fish processing is one among the primary source of income for the Aparrianos particularly in
                        Barangay Punta. The oldest traditional way of preserving fish was still observed nowadays which is
                        passed on to every generation.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
