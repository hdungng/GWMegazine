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
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="header-title text-center mb-4">Selected Contribution by Faculty</h5>

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
                            <h5 class="header-title text-center mb-4">Liked Contribution by Faculty</h5>

                            <div dir="ltr">
                                <div class="mt-2 chartjs-chart">
                                    <canvas id="likedByFacultyChart"></canvas>
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
                            <h5 class="header-title text-center mb-4">Last 5 days Activity of Contribution Uploads</h5>

                            <div dir="ltr">
                                <div class="mt-2 chartjs-chart">
                                    <canvas id="contributionActivityChart"></canvas>
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
                            <h5 class="header-title text-center mb-4">Top-5 The Most Liked Contribution</h5>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table id="dataTable" class="table w-100 nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Contribution Name</th>
                                                    <th>Full Name</th>
                                                    <th>Email</th>
                                                    <th>Faculty</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>How to pass the exam with flying colours?</td>
                                                    <td>Tiger Nixon</td>
                                                    <td>johndoe@gmail.com</td>
                                                    <td>Marketing</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>How to success with 'Collabration'?</td>
                                                    <td>Garrett Winters</td>
                                                    <td>johndoe@gmail.com</td>
                                                    <td>Graphic Design</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Five ways to communicate with people effectively</td>
                                                    <td>Ashton Cox</td>
                                                    <td>johndoe@gmail.com</td>
                                                    <td>Information Technology</td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Tips to ace the final exam</td>
                                                    <td>Cedric Kelly</td>
                                                    <td>johndoe@gmail.com</td>
                                                    <td>Business Management</td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td>How to be successful in workplace?</td>
                                                    <td>Airi Satou</td>
                                                    <td>johndoe@gmail.com</td>
                                                    <td>Event Management</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        @include('admin.users.delete-modal')
                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
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

    <script>
        // =================================
        // CONTRIBUTION BY FACULTY CHART
        // =================================

        var contributionByFacultyChartData = {
            labels: ["Business", "IT", "Design", "Event", "Marketing"],
            datasets: [{
                data: [300, 200, 400, 170, 500],
                backgroundColor: ["#EA86A7", "#27CE85", "#FFE7AD", "#C7DB94", "#6B939E"]
            }]
        };

        var contributionByFacultyChartElement = document.getElementById('contributionByFacultyChart').getContext('2d');


        var contributionByFacultyChart = new Chart(contributionByFacultyChartElement, {
            type: 'doughnut',
            data: contributionByFacultyChartData,
            options: {
                maintainAspectRatio: false,
                aspectRatio: 1,
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
        // LIKE BY FACULTY CHART
        // ===========================
        var likedByFacultyChartElement = document.getElementById('likedByFacultyChart').getContext('2d');

        var likedByFacultyChartData = {
            labels: ["Business", "IT", "Design", "Event", "Marketing"],
            datasets: [{
                data: [300, 200, 500, 200, 320],
                backgroundColor: ["#FF5400", "#F5F4F5", "#6DD6DA", "#FF9B71", "#FFFD82"]
            }]
        };

        // Create the Donut Chart
        var likedByFacultyChart = new Chart(likedByFacultyChartElement, {
            type: 'doughnut',
            data: likedByFacultyChartData,
            options: {
                maintainAspectRatio: false,
                aspectRatio: 1,
            },
            plugins: [{
                afterDatasetsDraw: function(chart, args, pluginOptions) {
                    const {
                        ctx,
                        data
                    } = chart;

                    var totalValue = likedByFacultyChartData.datasets[0].data.reduce((
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
                }
            }]
        });
    </script>
    <script>
        // ===========================
        // ACTIVITY BY FACULTY CHART
        // ===========================
        var contributionActivityChartElement = document.getElementById('contributionActivityChart').getContext('2d');

        var contributionActivityChartData = {
            labels: ['1st June, 2024', '2nd June, 2024', '3rd June, 2024', '4th June, 2024', '5th June, 2024'],
            datasets: [{
                    label: 'Business',
                    data: [65, 59, 80, 81, 56],
                    borderColor: '#8B85C1',
                    tension: 0.1,
                    fill: false
                },
                {
                    label: 'IT',
                    data: [28, 48, 40, 19, 86],
                    borderColor: '#1AC8ED',
                    tension: 0.1,
                    fill: false
                },
                {
                    label: 'Graphic',
                    data: [18, 38, 50, 29, 76],
                    borderColor: '#B8B42D',
                    tension: 0.1,
                    fill: false
                }, {
                    label: 'Marketing',
                    data: [45, 30, 70, 65, 55],
                    borderColor: '#FFF199',
                    tension: 0.1,
                    fill: false
                },
                {
                    label: 'Event',
                    data: [20, 45, 60, 35, 70],
                    borderColor: '#DD403A',
                    tension: 0.1,
                    fill: false
                }
            ]
        };

        // Chart configuration
        var config = {
            type: 'line',
            data: contributionActivityChartData,
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
        var myChart = new Chart(contributionActivityChartElement, config);
    </script>
@endsection
