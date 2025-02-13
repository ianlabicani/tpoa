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
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: #f9f9f9;
            border-radius: 10px;
            overflow: hidden;
        }

        .article-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .article-image {
            flex: 1;
            width: 600px;
            height: 400px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .article-item:hover .article-image {
            transform: scale(1.05);
        }

        .article-content {
            flex: 2;
            padding: 20px;
        }

        .article-content .tag {
            display: inline-block;
            background: #ff5722;
            color: #fff;
            border-radius: 20px;
            padding: 5px 15px;
            margin-bottom: 10px;
            font-size: 12px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .article-content h3 {
            font-size: 28px;
            font-weight: bold;
            margin: 15px 0;
            color: #333;
        }

        .article-content p {
            font-size: 16px;
            color: #666;
            line-height: 1.8;
        }

        .read-more-btn {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background: #007bff;
            color: #fff;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            transition: background 0.3s ease;
            text-decoration: none;
        }

        .read-more-btn:hover {
            background: #0056b3;
        }

        /* Section Header */
        .section-header {
            margin-bottom: 40px;
        }

        .section-header h3 {
            font-size: 36px;
            font-weight: bold;
            color: #007bff;
            text-transform: uppercase;
            position: relative;
        }

        .section-header h3::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background: #ff5722;
            margin-top: 10px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            .article-item {
                flex-direction: column;
            }

            .article-image {
                width: 100%;
                height: auto;
            }
        }
    </style>

    <!-- Articles Section -->
    <div class="container">
        <div class="article-section">
            <div class=" text-center">
                <h2 class="text-center display-6 mb-4">Explore the culture of Aparri</h2>
            </div>

            <!-- Article Items -->
         
                <div class="article-item">
                    <a href=" {{ route('farming') }}" ><img src="{{ asset('image/farming.jpg') }}" alt="" class="article-image"></a>
                    <div class="article-content">
                        <div class="tag"> dfw</div>
                        <h3></h3>
                        <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat eaque cupiditate, architecto suscipit consequuntur optio sit nostrum dicta vero inventore quibusdam distinctio tempore nesciunt consectetur.</p>
                        
                    </div>
                </div>

                <div class="article-item">
                    <a href=" {{ route('farming') }}" ><img src="{{ asset('image/farming.jpg') }}" alt="" class="article-image"></a>
                    <div class="article-content">
                        <div class="tag"> dfw</div>
                        <h3></h3>
                        <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat eaque cupiditate, architecto suscipit consequuntur optio sit nostrum dicta vero inventore quibusdam distinctio tempore nesciunt consectetur.</p>
                        
                    </div>
                </div>
         
        </div>
    </div>
@endsection
