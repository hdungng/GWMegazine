@extends('layouts.home')

@section('body.content')
    <div class="col-md-9 col-lg-7">
        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <!-- Sliders -->
            <div id="carousel" class="carousel slide">
                <div class="carousel-inner slide" data-bs-interval="3000" data-bs-ride="carousel">
                    <div class="carousel-item active">
                        <img src="{{ url('public/home/images/greenwich-sidebg.jpg') }}" class="d-block w-100">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ url('public/home/images/greenwich-insidebg.jpg') }}" class="d-block w-100">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ url('public/home/images/greenwich-domes-night-bg.jpg') }}" class="d-block w-100">
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <div class="list-contributions mt-5">


                <div class="contribution-item mb-3">
                    <a href="detail.html">
                        <div class="card mb-3 p-3">
                            <div class="row g-1">
                                <div class="col-4">
                                    <div class="card-body">
                                        <img src="https://preview.redd.it/master-yi-legendary-v0-mftfq46d911c1.png?width=500&format=png&auto=webp&s=f44d19df32820d3732b084ef010620ada703d5ee"
                                            class="img-fluid rounded-start card-img" alt="...">
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="card-body">
                                        <h3 class="card-title fw-semibold">Do people know how to play this game
                                            or do they simply skim
                                            through it?
                                        </h3>
                                        <p class="card-desc">Lorem ipsum dolor sit amet consectetur adipisicing
                                            elit. Repudiandae
                                            minus quam atque dolore iure, ipsam a molestias blanditiis quod
                                            saepe dolor laudantium ipsa
                                            aut,
                                            veritatis inventore reiciendis sequi deleniti nihil!</p>
                                        <p class="card-author"><span>Yasuo</span> - <span>March 3rd,
                                                2024</span></p>
                                        <div class="hstack gap-5">
                                            <div class="like-box hstack gap-3 ms-auto">
                                                <span><i class="fa-solid fa-heart fa-xl" style="color: #FC6589;"></i></span>
                                                <span class="stats-num">50</span>
                                            </div>
                                            <span class="share-btn"><i class="fa-solid fa-share-nodes fa-xl"
                                                    style="color: #95A4DB;"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Horizontal line -->
                    <hr>
                </div>


                <div class="contribution-item mb-3">
                    <a href="detail.html">
                        <div class="card mb-3 p-3">
                            <div class="row g-1">
                                <div class="col-4">
                                    <div class="card-body">
                                        <img src="https://image.api.playstation.com/vulcan/img/rnd/202104/2507/Xdncb153Sz5UZMaF0X944NP5.png"
                                            class="img-fluid rounded-start card-img" alt="...">
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="card-body">
                                        <h3 class="card-title fw-semibold">Genshin Impact Long-Term Project
                                            Launch: Concept Trailer |
                                            Genshin Impact
                                        </h3>
                                        <p class="card-desc">Lorem ipsum dolor sit amet consectetur adipisicing
                                            elit. Repudiandae
                                            minus quam atque dolore iure, ipsam a molestias blanditiis quod
                                            saepe dolor laudantium ipsa
                                            aut,
                                            veritatis inventore reiciendis sequi deleniti nihil!</p>
                                        <p class="card-author"><span>Yasuo</span> - <span>March 3rd,
                                                2024</span></p>
                                        <div class="hstack gap-5">
                                            <div class="like-box hstack gap-3 ms-auto">
                                                <span><i class="fa-solid fa-heart fa-xl" style="color: #FC6589;"></i></span>
                                                <span class="stats-num">50</span>
                                            </div>
                                            <span class="share-btn"><i class="fa-solid fa-share-nodes fa-xl"
                                                    style="color: #95A4DB;"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <!-- Horizontal line -->
                    <hr>
                </div>


                <div class="contribution-item mb-3">
                    <a href="detail.html">
                        <div class="card mb-3 p-3">
                            <div class="row g-1">
                                <div class="col-4">
                                    <div class="card-body">
                                        <img src="https://preview.redd.it/ai9y8xatmby61.jpg?auto=webp&s=1f2b94dd426563964c2e03451e8686f24b3e41cd"
                                            class="img-fluid rounded-start card-img" alt="...">
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="card-body">
                                        <h3 class="card-title fw-semibold">PC Gamer names Valheim: Game Of the
                                            Year
                                        </h3>
                                        <p class="card-desc">Lorem ipsum dolor sit amet consectetur adipisicing
                                            elit. Repudiandae
                                            minus quam atque dolore iure, ipsam a molestias blanditiis quod
                                            saepe dolor laudantium ipsa
                                            aut,
                                            veritatis inventore reiciendis sequi deleniti nihil!</p>
                                        <p class="card-author"><span>Yasuo</span> - <span>March 3rd,
                                                2024</span></p>
                                        <div class="hstack gap-5">
                                            <div class="like-box hstack gap-3 ms-auto">
                                                <span><i class="fa-solid fa-heart fa-xl" style="color: #FC6589;"></i></span>
                                                <span class="stats-num">50</span>
                                            </div>
                                            <span class="share-btn"><i class="fa-solid fa-share-nodes fa-xl"
                                                    style="color: #95A4DB;"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <!-- Horizontal line -->
                    <hr>
                </div>

            </div>

        </div>
    </div>
    <div class="col-lg-3">
        <div class="position-fixed">
            <div class="right-sidebar pe-3">
                <div class="menu my-5">
                    <div class="item">
                        <i class="fa-regular fa-landmark fa-lg"></i>
                        Contributions of Faculty
                    </div>
                    <div id="faculty-collapse">
                        <ul class="list-group falculty-lists mt-3">
                            <li class="list-group-item"><a href="search-result.html">
                                    <div class="icon">
                                        <i class="fa-solid fa-business-time fa-lg"></i>
                                    </div>
                                    Business Management
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="search-result.html">
                                    <div class="icon">
                                        <i class="fa-solid fa-computer fa-lg"></i>
                                    </div>
                                    Information Technology
                                </a>
                            </li>
                            <li class="list-group-item"><a href="search-result.html">
                                    <div class="icon">
                                        <i class="fa-solid fa-object-ungroup fa-lg"></i>
                                    </div>
                                    Graphic Design
                                </a></li>
                            <li class="list-group-item"><a href="search-result.html">
                                    <div class="icon">
                                        <i class="fa-solid fa-chart-simple fa-lg"></i>
                                    </div>
                                    Marketing
                                </a>
                            </li>
                            <li class="list-group-item"><a href="search-result.html">
                                    <div class="icon">
                                        <i class="fa-solid fa-calendar-days fa-lg"></i>
                                    </div>
                                    Event Management
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

