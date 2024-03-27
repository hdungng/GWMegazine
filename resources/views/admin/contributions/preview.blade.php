@extends('layouts.admin')

@section('head.css')
    <!-- Grid Images -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <link rel="stylesheet" href="{{ url('public/admin/css/images-grid.css') }}">
@endsection

@section('body.content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Contributions</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Contribution Overview</a></li>
                                <li class="breadcrumb-item active">Contribution Preview</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Contribution Preview</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <!-- project card -->
                    <div class="card d-block">
                        <div class="card-body">
                            <div id="content" class="p-2">
                                <h1 class="fw-bold mt-3">Do people know how to play this game or do they simply
                                    skim through it?</h1>
                                <div class="author-contribution-info my-4">
                                    <p>Written by <span class="text-primary">Master Yi</span> | Last updated:
                                        <span class="text-primary">March 3rd,
                                            2024</span>
                                    </p>
                                </div>
                                <div class="background">
                                    <div id="gallery"></div>
                                </div>
                                <div class="detail-desc mt-5">
                                    <div class="description my-3">
                                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aperiam
                                        possimus dicta consequuntur autem
                                        expedita, voluptates iste? Tenetur porro reprehenderit qui quibusdam
                                        soluta eveniet. Quae perspiciatis,
                                        accusantium esse voluptate debitis quis.
                                    </div>
                                    <p>In the vast landscape of gaming, League of Legends: Mastery with Yi
                                        stands as a testament to immersive
                                        experiences and
                                        intricate gameplay. As players venture into this virtual realm, a
                                        question lingers: Do they truly
                                        comprehend the art of playing this game, or do they simply skim through
                                        its surface?</p>
                                    <p>Playing League of Legends: Mastery with Yi is akin to navigating a rich
                                        tapestry of challenges,
                                        strategies, and hidden
                                        treasures. Each level is a meticulously crafted puzzle, and every
                                        storyline nuance contributes to the
                                        overarching narrative. However, the temptation to skim through levels
                                        and rush towards completion is
                                        ever-present in our fast-paced world.</p>
                                    <p>At League of Legends: Mastery with Yi, we believe in the power of
                                        discovery. Players who invest time in
                                        understanding the
                                        mechanics, exploring the lore, and mastering the gameplay are rewarded
                                        with a profound gaming experience.
                                        While skimming may offer momentary gratification, the true essence of
                                        League of Legends: Mastery with Yi
                                        unfolds for those
                                        who dare to dive deeper.</p>
                                    <img src="https://i.ytimg.com/vi/2cN3FeeSltw/maxresdefault.jpg" alt="">
                                    <p>What drives players to skim through the game? Is it the ticking clock,
                                        the pursuit of achievements, or
                                        the anticipation of what lies ahead? While skimming provides a glimpse,
                                        true mastery demands a willingness
                                        to unravel the layers and savor the intricacies.</p>
                                    <p>For those who choose to play beyond the surface, League of Legends:
                                        Mastery with Yi becomes more than a
                                        mere pastime; it
                                        transforms into a journey of self-discovery and skill refinement. Delve
                                        into the mysteries, decode the
                                        challenges, and relish the sense of accomplishment that comes with
                                        conquering each level with finesse.</p>
                                    <p>The choice between skimming and playing is a personal one, and both paths
                                        offer distinct experiences.
                                        However, for those seeking the true essence of League of Legends:
                                        Mastery with Yi, we invite you to
                                        embrace the adventure,
                                        savor the details, and unlock the full potential of this extraordinary
                                        gaming odyssey.</p>
                                    <p>Embark on this journey with us, and let League of Legends: Mastery with
                                        Yi be not just a game but a
                                        captivating exploration
                                        of skill, strategy, and the boundless possibilities that await those who
                                        choose to play with heart and
                                        curiosity.</p>
                                </div>
                            </div>
                        </div>
                        <!-- end card-body-->
                    </div>
                    <!-- end card-->

                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-4 mt-0 fs-16">Comments (51)</h4>

                            <div class="clerfix"></div>

                            <div class="d-flex align-items-start">
                                <img class="me-2 rounded-circle" src="{{ url('public/admin/images/users/avatar-3.jpg') }}"
                                    alt="Generic placeholder image" height="32" />
                                <div class="w-100">
                                    <h5 class="mt-0">Jeremy Tomlinson <small class="text-muted float-end">5
                                            hours ago</small></h5>
                                    Nice work, makes me think of The Money Pit.
                                </div>
                            </div>

                            <div class="d-flex align-items-start mt-3">
                                <img class="me-2 rounded-circle" src="{{ url('public/admin/images/users/avatar-5.jpg') }}"
                                    alt="Generic placeholder image" height="32" />
                                <div class="w-100">
                                    <h5 class="mt-0">Kevin Martinez <small class="text-muted float-end">1 day
                                            ago</small></h5>
                                    It would be very nice to have.

                                    <br />
                                </div>
                            </div>

                            <div class="border rounded mt-4">
                                <form action="#" class="comment-area-box">
                                    <textarea rows="3" class="form-control border-0 resize-none" placeholder="Your comment..."></textarea>
                                    <div class="p-2 bg-light d-flex justify-content-between align-items-center">
                                        <div>
                                            <a href="#" class="btn btn-sm px-1 btn-light"><i
                                                    class='ri-upload-line'></i></a>
                                            <a href="#" class="btn btn-sm px-1 btn-light"><i
                                                    class='ri-at-line'></i></a>
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-success"><i
                                                class="ri-send-plane-2 me-1"></i>Submit</button>
                                    </div>
                                </form>
                            </div>
                            <!-- end .border-->
                        </div>
                        <!-- end card-body-->
                    </div>
                    <!-- end card-->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->
@endsection

@section('body.javascript')
    <script src="{{ url('public/admin/js/images-grid.js') }}"></script>

    <script>
        $(function() {
            $('#gallery').imagesGrid({
                images: [
                    'https://unsplash.it/750/500?image=928',
                    'https://unsplash.it/660/455?image=538',
                    'https://unsplash.it/860/455?image=726',
                    'https://unsplash.it/640/455?image=573',
                    'https://unsplash.it/230/455?image=632',
                ],
                align: true,
                cells: 4,
                getViewAllText: function(imgsCount) {
                    return 'View all'
                }
            });
        });
    </script>
@endsection
