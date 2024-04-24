@extends('layouts.admin')

@section('head.css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css" />
@endsection

@section('body.content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <form action="" class="hstack gap-2">
                        <label for="academic_year_id">Academic Year</label>
                        <div class="hstack gap-2">
                            @if ($academicYears->count() > 0)
                                <select class="form-select my-2" name="academic_year_id" style="width: 150px">
                                    @foreach ($academicYears as $academicYear)
                                        {{-- <option value="0">All</option> --}}
                                        @if ($academicYear->id == $selectedAcademicYear->id)
                                            <option value="{{ $academicYear->id }}" selected>{{ $academicYear->name }}</option>
                                        @else
                                            <option value="{{ $academicYear->id }}">{{ $academicYear->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary d-inline-block">Select</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>


            @if (Auth::user()->role->name == 'Manager')
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="header-title text-center mb-4">Total Contribution by Faculty in
                                    {{ $selectedAcademicYear->name }}</h5>

                                <div dir="ltr">
                                    <div class="mt-2 chartjs-chart">
                                        <canvas id="contributionByFacultyChart"></canvas>
                                    </div>
                                </div>
                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->

                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="header-title text-center mb-4">Number of Contributor Students by Faculty in
                                    {{ $selectedAcademicYear->name }}</h5>

                                <div dir="ltr">
                                    <div class="mt-2 chartjs-chart">
                                        <canvas id="numberOfContributorsEachFacultyChart"></canvas>
                                    </div>
                                </div>
                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="header-title text-center mb-4">Contributions per Faculty By Academic Year</h5>

                                <div dir="ltr">
                                    <div class="mt-2 chartjs-chart">
                                        <canvas id="contributionAcademicYearChart"></canvas>
                                    </div>
                                </div>
                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->
                </div>
            @elseif(Auth::user()->role->name == 'Coordinator')
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="header-title text-center mb-4">Number of Contributor Students in
                                    {{ $selectedAcademicYear->name }}</h5>

                                <div dir="ltr">
                                    <div class="mt-2 chartjs-chart">
                                        <canvas id="numberOfContributorsChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="header-title text-center mb-4">Number of Contribution: With/Without Comments in
                                    {{ $selectedAcademicYear->name }}</h5>

                                <div dir="ltr">
                                    <div class="mt-2 chartjs-chart">
                                        <canvas id="commentChart"></canvas>
                                    </div>
                                </div>
                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div>
                </div>


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="header-title text-center mb-4">Contributions By Academic Year</h5>

                                <div dir="ltr">
                                    <div class="mt-2 chartjs-chart">
                                        <canvas id="contributionAcademicYearChart"></canvas>
                                    </div>
                                </div>
                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->
                </div>
            @endif


        </div>
        <!-- container -->
    </div>
@endsection


@section('body.javascript')
    <!-- Chart.js -->
    <script src="{{ url('public/admin/vendor/chart.js/chart.min.js') }}"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                lengthChange: false,
                scrollX: true,
                searching: false,
                paging: false,
                info: false
            });
        });
    </script>

    @if (Auth::user()->role->name == 'Manager')
        <script>
            // =================================
            // CONTRIBUTION BY FACULTY CHART
            // =================================

            var contributionByFacultyChartData = {
                labels: @json($chart1->facultyNames),
                datasets: [{
                    data: @json($chart1->datasets),
                    backgroundColor: @json($chart1->colors)
                }]
            };

            var contributionByFacultyChartElement = document.getElementById('contributionByFacultyChart').getContext('2d');


            var contributionByFacultyChart = new Chart(contributionByFacultyChartElement, {
                type: 'doughnut',
                data: contributionByFacultyChartData,
                options: {
                    maintainAspectRatio: false,
                    aspectRatio: 1,
                    color: '#8391A2'
                },
                plugins: [{
                    afterDatasetsDraw: function(chart, args, pluginOptions) {
                        const {
                            ctx,
                            data
                        } = chart;

                        var totalValue = contributionByFacultyChartData.datasets[0].data.reduce((
                            total, current) => total + current, 0);

                        ctx.save();
                        const xCoor = chart.getDatasetMeta(0).data[0].x;
                        const yCoor = chart.getDatasetMeta(0).data[0].y;

                        ctx.font = 'bold 30px Figtree';
                        ctx.fillStyle = '#8391A2';
                        ctx.textAlign =
                            'center';
                        ctx.textBaseLine = 'middle';
                        ctx.fillText(totalValue, xCoor,
                            yCoor);
                        ctx.save();
                    }
                }]
            });
        </script>
        <script>
            // ===========================
            // Number Of Contributors Each Faculty CHART
            // ===========================
            var numberOfContributorsElement = document.getElementById('numberOfContributorsEachFacultyChart').getContext('2d');

            var numberOfContributorsData = {
                labels: @json($chart2->facultyNames),
                datasets: [{
                    data: @json($chart2->datasets),
                    backgroundColor: @json($chart2->colors)
                }]
            };

            // Create the Donut Chart
            var numberOfContributorsEachFaculty = new Chart(numberOfContributorsElement, {
                type: 'doughnut',
                data: numberOfContributorsData,
                options: {
                    maintainAspectRatio: false,
                    aspectRatio: 1,
                    color: '#8391A2'
                },
                plugins: [{
                    afterDatasetsDraw: function(chart, args, pluginOptions) {
                        const {
                            ctx,
                            data
                        } = chart;

                        var totalValue = numberOfContributorsData.datasets[0].data.reduce((
                            total, current) => total + current, 0);

                        ctx.save();
                        const xCoor = chart.getDatasetMeta(0).data[0].x;
                        const yCoor = chart.getDatasetMeta(0).data[0].y;

                        ctx.font = 'bold 30px Figtree';
                        ctx.fillStyle = '#8391A2';
                        ctx.textAlign = 'center';
                        ctx.textBaseLine = 'middle';
                        ctx.fillText(totalValue, xCoor, yCoor);
                        ctx.save();
                    },
                }]
            });
        </script>
        <script>
            // ===========================
            // ACADEMIC YEAR BY FACULTY CHART
            // ===========================
            var contributionAcademicYearChartElement = document.getElementById('contributionAcademicYearChart').getContext(
                '2d');

            var contributionAcademicYearChartData = {
                labels: @json($chart3->academicYearNames),
                datasets: @json($chart3->datasets)
            };

            // Chart configuration
            var config = {
                type: 'bar',
                data: contributionAcademicYearChartData,
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: '#8391A2'
                            }
                        },
                        x: {
                            ticks: {
                                color: '#8391A2'
                            }
                        }
                    },
                    color: '#8391A2'
                }
            };

            // Create the chart
            var myChart = new Chart(contributionAcademicYearChartElement, config);
        </script>
    @endif

    @if (Auth::user()->role->name == 'Coordinator')
        <script>
            // ===========================
            // Number Of Contributors Each Faculty CHART
            // ===========================
            var numberOfContributorsElement = document.getElementById('numberOfContributorsChart').getContext('2d');

            var numberOfContributorsData = {
                labels: @json($chart1->labels),
                datasets: [{
                    data: @json($chart1->datasets),
                    backgroundColor: @json($chart1->colors)
                }]
            };

            // Create the Donut Chart
            var numberOfContributorsEachFaculty = new Chart(numberOfContributorsElement, {
                type: 'doughnut',
                data: numberOfContributorsData,
                options: {
                    maintainAspectRatio: false,
                    aspectRatio: 1,
                    color: '#8391A2'
                },
                plugins: [{
                    afterDatasetsDraw: function(chart, args, pluginOptions) {
                        const {
                            ctx,
                            data
                        } = chart;

                        var totalValue = numberOfContributorsData.datasets[0].data.reduce((
                            total, current) => total + current, 0);

                        ctx.save();
                        const xCoor = chart.getDatasetMeta(0).data[0].x;
                        const yCoor = chart.getDatasetMeta(0).data[0].y;

                        ctx.font = 'bold 30px Figtree';
                        ctx.fillStyle = '#8391A2';
                        ctx.textAlign = 'center';
                        ctx.textBaseLine = 'middle';
                        ctx.fillText(totalValue, xCoor, yCoor);
                        ctx.save();
                    },
                }]
            });
        </script>

        <script>
            // ===========================
            // Number Of Contributors Each Faculty CHART
            // ===========================
            var commentElement = document.getElementById('commentChart').getContext('2d');

            var commentData = {
                labels: @json($chart2->labels),
                datasets: [{
                    data: @json($chart2->datasets),
                    backgroundColor: @json($chart2->colors)
                }]
            };

            // Create the Donut Chart
            var commentEachFaculty = new Chart(commentElement, {
                type: 'doughnut',
                data: commentData,
                options: {
                    maintainAspectRatio: false,
                    aspectRatio: 1,
                    color: '#8391A2'
                },
                plugins: [{
                    afterDatasetsDraw: function(chart, args, pluginOptions) {
                        const {
                            ctx,
                            data
                        } = chart;

                        var totalValue = commentData.datasets[0].data.reduce((
                            total, current) => total + current, 0);

                        ctx.save();
                        const xCoor = chart.getDatasetMeta(0).data[0].x;
                        const yCoor = chart.getDatasetMeta(0).data[0].y;

                        ctx.font = 'bold 30px Figtree';
                        ctx.fillStyle = '#8391A2';
                        ctx.textAlign = 'center';
                        ctx.textBaseLine = 'middle';
                        ctx.fillText(totalValue, xCoor, yCoor);
                        ctx.save();
                    },
                }]
            });
        </script>

        <script>
            // ===========================
            // ACADEMIC YEAR BY FACULTY CHART
            // ===========================
            var contributionAcademicYearChartElement = document.getElementById('contributionAcademicYearChart').getContext(
                '2d');

            var contributionAcademicYearChartData = {
                labels: @json($chart3->academicYearNames),
                datasets: [{
                    label: 'Total of Contributions',
                    data: @json($chart3->datasets),
                    backgroundColor: [
                        '#92DCE5',
                        '#FF101F',
                        '#BFFF1F',
                        '#FFA5A5',
                        '#AE5BA9',
                        '#FF6B35',
                        '#DDFFD9'
                    ],
                    borderColor: [
                        '#92DCE5',
                        '#FF101F',
                        '#BFFF1F',
                        '#FFA5A5',
                        '#AE5BA9',
                        '#FF6B35',
                        '#DDFFD9'
                    ],
                    borderWidth: 1,
                }],
            };

            // Chart configuration
            var config = {
                type: 'bar',
                data: contributionAcademicYearChartData,
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: '#8391A2'
                            }
                        },
                        x: {
                            ticks: {
                                color: '#8391A2'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                    },
                    color: '#8391A2'
                }
            };

            // Create the chart
            var myChart = new Chart(contributionAcademicYearChartElement, config);
        </script>
    @endif
@endsection
