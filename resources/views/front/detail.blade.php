@extends('front.template.master')
@section('title', $news->title?? 'Not found')

<style>
    #news-content {
        width: 70%;
        padding-left: 20px;
        line-height: 1.5;
        text-align: justify;
    }

    .slideshow-container {
        max-width: 1000px;
        position: relative;
        margin: auto;
    }

    /* Hide the images by default */
    .mySlides {
        display: none;
    }

    /* Next & previous buttons */
    .prev,
    .next {
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        margin-top: -22px;
        padding: 16px;
        color: white;
        font-weight: bold;
        font-size: 18px;
        transition: 0.6s ease;
        border-radius: 0 3px 3px 0;
        user-select: none;
    }

    /* Position the "next button" to the right */
    .next {
        right: 0;
        border-radius: 3px 0 0 3px;
    }

    /* On hover, add a black background color with a little bit see-through */
    .prev:hover,
    .next:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }

    /* Caption text */
    .text {
        color: #f2f2f2;
        font-size: 15px;
        padding: 8px 12px;
        position: absolute;
        bottom: 8px;
        width: 100%;
        text-align: center;
    }

    /* Number text (1/3 etc) */
    .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
    }

    /* The dots/bullets/indicators */
    .dot {
        cursor: pointer;
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.6s ease;
    }

    .active,
    .dot:hover {
        background-color: #717171;
    }

    /* Fading animation */
    .fade {
        animation-name: fade;
        animation-duration: 1.5s;
    }

    .mySlides {
        display: flex !important;
        flex-direction: row;
    }

    .slide {
        width: 270px;
        border-radius: 2px;
        border: 1px solid cornflowerblue;
        padding: 10px;
        margin: 0 10px;
    }

    @keyframes fade {
        from {
            opacity: .4
        }

        to {
            opacity: 1
        }
    }
</style>

@section('content')
@component('front.template.CategoryList', ['categories' => $categories])
@endcomponent
@if($news)
<div id="news-content">
    <h1>{{ $news->title }}</h1>
    <p style="color: cornflowerblue; margin-bottom:10px;"><i>By {{ $news->username }}</i> - {{ $news->created_at->format('d/m/Y')}}</p>
    <div>{!! $news-> content !!}</div>
    <h4 style="margin:20px 0 10px 0;color:cornflowerblue;">Các bài viết khác của {{$news->username}}</h4>
    <div>
        <div class="slideshow-container">
            @if($newsByAuthor)
            @foreach ($newsByAuthor->chunk(3) as $chunk)
            <div class="mySlides fade">
                @foreach ($chunk as $ne)
                <div class="slide">
                    <a href="{{ url('/post/'.$ne->alias)}}">
                        <h5>{{$ne->title}}</h6>
                            <p style="color: #888;font-size:small;"><i>{{$ne->username}} - {{$news->created_at->format('d/m/Y')}}</i></p>
                            <p style="color: #888;"><i class="fa fa-eye">{{ $ne->view}}</i></p>
                    </a>
                </div>
                @endforeach
            </div>
            @endforeach
            @endif

            <!-- Next and previous buttons -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
        <br>

        <!-- The dots/circles -->
        <div style="text-align:center">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div>
        <script>
            let slideIndex = 1;
            showSlides(slideIndex);

            // Next/previous controls
            function plusSlides(n) {
                showSlides(slideIndex += n);
            }

            // Thumbnail image controls
            function currentSlide(n) {
                showSlides(slideIndex = n);
            }

            function showSlides(n) {
                let i;
                let slides = document.getElementsByClassName("mySlides");
                let dots = document.getElementsByClassName("dot");
                if (n > slides.length) {
                    slideIndex = 1
                }
                if (n < 1) {
                    slideIndex = slides.length
                }
                for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";
                }
                for (i = 0; i < dots.length; i++) {
                    dots[i].className = dots[i].className.replace(" active", "");
                }
                slides[slideIndex - 1].style.display = "block";
                dots[slideIndex - 1].className += " active";
            }
        </script>
    </div>
</div>
@else
<img src="{{ asset('assets/no-results.png')}}"/>
@endif

@stop