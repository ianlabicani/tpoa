<!-- resources/views/articles/show.blade.php -->
@extends('guest.shell')

@section('content')
    <style>
        .article-detail {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .article-detail img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .article-detail .tag {
            display: inline-block;
            background: #ff5722;
            color: #fff;
            border-radius: 20px;
            padding: 5px 15px;
            margin-bottom: 20px;
            font-size: 12px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .article-detail h1 {
            font-size: 36px;
            color: #333;
            margin-bottom: 20px;
        }

        .article-detail p {
            font-size: 16px;
            color: #666;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #007bff;
            font-weight: bold;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>

    <div class="article-detail">
        <img src="{{ asset('image/farming.jpg') }}" alt="" class="article-image">
        <div class="article-content">
            <div class="tag"> dfw</div>
            <h3></h3>
            <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat eaque cupiditate, architecto suscipit consequuntur optio sit nostrum dicta vero inventore quibusdam distinctio tempore nesciunt consectetur.</p>
            
        </div>
        <h1></h1>
       
        <a href="{{ route('culture') }}" class="back-link">&larr; Back to Cultures</a>
    </div>
@endsection
