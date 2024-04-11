@extends('layouts.home')

@section('body.content')
    <div class="col-md-9 col-lg-7">
        <!-- Page Content  -->

        <div id="content" class="ms-xl-0 ms-lg-5 p-4 p-md-5 pt-5">
            <h1 class="fw-bold mt-3">{{ $contribution->title }}</h1>
            <div class="author-contribution-info my-4">
                <p>Written by <span>{{ $contribution->student_name }}</span> | Last updated:
                    <span>{{ (new DateTime($contribution->updated_at))->format('F d, Y H:i:s') }}</span></p>
            </div>

            <div class="detail-desc my-5 preview-contribution">
                <div class="description my-5 text-truncate">{{ $contribution->description }}</div>

                @if (isset($htmlContent))
                    {!! $htmlContent !!}
                @endif
            </div>
            <div class="contribution-stats">
                <div class="hstack gap-5 justify-content-end">
                    <div class="like-box hstack gap-3">
                        <span><i class="fa-solid fa-heart fa-xl" style="color: #FC6589;"></i></span>
                        <span>50</span>
                    </div>
                    <span class="share-btn"><i class="fa-solid fa-share-nodes fa-xl" style="color: #95A4DB;"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="position-fixed">
            <div class="right-sidebar pe-3 pt-5">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-primary fw-semibold">Related Contributions</h3>
                        <div class="cards-list mt-3">
                            <div class="card-item p-2">
                                <a href="#">
                                    <h4 class="related-contribution-title">Beyond the Surface: The Art of Playing Yasuo</h4>
                                </a>
                                <div class="hstack gap-2 mt-2">
                                    <p class="text-body-secondary"><small><span>Yasuo</span> - <span>March 3rd,
                                                2024</span></small>
                                    </p>
                                </div>
                                <hr>
                            </div>
                            <div class="card-item p-2">
                                <a href="#">
                                    <h4 class="related-contribution-title">Unveiling the Depth: Playing the Game or Skimming
                                        Through?
                                    </h4>
                                </a>
                                <div class="hstack gap-2 mt-2">
                                    <p class="text-body-secondary"><small><span>John Doe</span> - <span>March 5rd,
                                                2024</span></small>
                                    </p>
                                </div>
                                <hr>
                            </div>
                            <div class="card-item p-2">
                                <a href="#">
                                    <h4 class="related-contribution-title">Eclipse Chronicles: Shadows of Eternity</h4>
                                </a>
                                <div class="hstack gap-2 mt-2">
                                    <p class="text-body-secondary"><small><span>John Doe</span> - <span>March 5rd,
                                                2024</span></small>
                                    </p>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
