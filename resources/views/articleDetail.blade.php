@extends('front')
@section('content')


<section id="sliderSection">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="slick_slider">

                <h5 style="color: rgb(194, 193, 193);"><span>publié le : {{ $article->created_at }}</span></h5>
                <div class="single_iteam"> <img src="{{ $article->image }}" alt="">

                </div>

            </div>
        </div>

        <!-- ---------------------------------------------- -->

        <!-- ---------------------------------------------- -->
        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="latest_post">
                <h2><span>Articles similaires</span></h2>
                <div class="latest_post_container">
                    <div id="prev-button"><i class="fa fa-chevron-up"></i></div>
                    <ul class="latest_postnav">
                        @foreach ($articles as $art)
                        <li>
                            <div class="media"> <a href="/detail/{{ $art->id }}" class="media-left"> <img alt="" src="{{ $art->image }}"> </a>
                                <div class="media-body"> <a href="/detail/{{ $art->id }}" class="catg_title"> {{ $art->title }}</a> </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    <div id="next-button"><i class="fa  fa-chevron-down"></i></div>
                </div>
            </div>
        </div>
    </div>
</section>


<section id="contentSection">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8">

            <div class="left_content">
                <h1>{{ $article->title }}</h1>
                <div class="single_post_content">
                    <h2><span>Description</span></h2>

                    <div>
                        <aside class="right_content_desc">
                            <div class="single_sidebar">
                                <ul class="spost_nav">
                                    <li>
                                        <div class="media wow fadeInDown">
                                            <div class="media-body" style="text-align:justify"> {{ $article-> text }} </div>
                                            <h5 style="color: #27ae60; float: right;"><span>Ecrit par : {{ $article-> author }}</span></h5>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </aside>
                    </div>

                </div>

            </div>

        </div>

    </div>
</section>

@endsection
