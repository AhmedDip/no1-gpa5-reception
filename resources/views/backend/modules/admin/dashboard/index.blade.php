@extends('backend.layouts.admin-template.main')

@section('title', $page_content['page_title'] ?? 'Dashboard')

@section('main-content')
    <div class="row">
        <div class="col-md-12 mb-5">

            <div class="row">
                {{-- MTD 1 --}}
                <div class="col-md-6">
                    <div class="card mb-6 ">
                        <h5 class="card-header"> User Summary </h5>

                        <div class="card-body">
                            <div class="demo-vertical-spacing demo-only-element">

                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <p class="mb-0">Total SR</p>
                                    </div>
                                    <div class=" col-md-10">
                                        <div class="progress">
                                            <div class="progress-bar bg-base" role="progressbar" style="width: 85%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class=" col-md-2">
                                        <div>85</div>
                                    </div>
                                </div>

                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <p class="mb-0">Present</p>
                                    </div>
                                    <div class=" col-md-10">
                                        <div class="progress">
                                            <div class="progress-bar bg-base" role="progressbar" style="width: 75%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class=" col-md-2">
                                        <div>75</div>
                                    </div>
                                </div>

                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <p class="mb-0">Absent</p>
                                    </div>
                                    <div class=" col-md-10">
                                        <div class="progress">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class=" col-md-2">
                                        <div>25</div>
                                    </div>
                                </div>

                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <p class="mb-0">Active</p>
                                    </div>
                                    <div class=" col-md-10">
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class=" col-md-2">
                                        <div>60</div>
                                    </div>
                                </div>

                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <p class="mb-0">Inactive</p>
                                    </div>
                                    <div class=" col-md-10">
                                        <div class="progress">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class=" col-md-2">
                                        <div>50</div>
                                    </div>
                                </div>

                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <p class="mb-0">Leave</p>
                                    </div>
                                    <div class=" col-md-10">
                                        <div class="progress">
                                            <div class="progress-bar bg-dark" role="progressbar" style="width: 15%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class=" col-md-2">
                                        <div>15</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
@endsection


@push('script')
    <script>
        // Options for the "Visited" chart
        var visitedOptions = {
            series: [74],
            chart: {
                height: 200,
                type: "radialBar",
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: "70%",
                    },
                    dataLabels: {
                        name: {
                            show: true,
                            fontSize: "16px",
                            color: "#666",
                            offsetY: -10,
                        },
                        value: {
                            fontSize: "22px",
                            color: "#333",
                            offsetY: 5,
                            formatter: function(val) {
                                return val + "%";
                            },
                        },
                    },
                },
            },
            labels: ["Visited"],
            colors: ["#28a745"], // Green color
        };

        // Options for the "Strike Rate" chart
        var strikeRateOptions = {
            series: [22],
            chart: {
                height: 200,
                type: "radialBar",
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: "70%",
                    },
                    dataLabels: {
                        name: {
                            show: true,
                            fontSize: "16px",
                            color: "#666",
                            offsetY: -10,
                        },
                        value: {
                            fontSize: "22px",
                            color: "#333",
                            offsetY: 5,
                            formatter: function(val) {
                                return val + "%";
                            },
                        },
                    },
                },
            },
            labels: ["Strike Rate"],
            colors: ["#007bff"], // Blue color
        };

        // Options for the "Strike Rate" chart
        // var visitedOptions2 = {
        //     series: [22],
        //     chart: {
        //         height: 200,
        //         type: "radialBar",
        //     },
        //     plotOptions: {
        //         radialBar: {
        //             hollow: {
        //                 size: "70%",
        //             },
        //             dataLabels: {
        //                 name: {
        //                     show: true,
        //                     fontSize: "16px",
        //                     color: "#666",
        //                     offsetY: -10,
        //                 },
        //                 value: {
        //                     fontSize: "22px",
        //                     color: "#333",
        //                     offsetY: 5,
        //                     formatter: function(val) {
        //                         return val + "%";
        //                     },
        //                 },
        //             },
        //         },
        //     },
        //     labels: ["Strike Rate"],
        //     colors: ["#007bff"], // Blue color
        // };
        // Options for the "Strike Rate" chart
        // var memoOptions = {
        //     series: [22],
        //     chart: {
        //         height: 200,
        //         type: "radialBar",
        //     },
        //     plotOptions: {
        //         radialBar: {
        //             hollow: {
        //                 size: "70%",
        //             },
        //             dataLabels: {
        //                 name: {
        //                     show: true,
        //                     fontSize: "16px",
        //                     color: "#666",
        //                     offsetY: -10,
        //                 },
        //                 value: {
        //                     fontSize: "22px",
        //                     color: "#333",
        //                     offsetY: 5,
        //                     formatter: function(val) {
        //                         return val + "%";
        //                     },
        //                 },
        //             },
        //         },
        //     },
        //     labels: ["Strike Rate"],
        //     colors: ["#007bff"], // Blue color
        // };

        // Render the charts
        var visitedChart = new ApexCharts(document.querySelector("#visitedChart"), visitedOptions);
        var strikeRateChart = new ApexCharts(document.querySelector("#strikeRateChart"), strikeRateOptions);

        visitedChart.render();
        strikeRateChart.render();

        // var visitedChart2 = new ApexCharts(document.querySelector("#visitedChart2"), visitedOptions2);
        // var memoChart = new ApexCharts(document.querySelector("#memoChart"), memoOptions);

        visitedChart2.render();
        memoChart.render();
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var options = {
                series: [28, 19, 21, 34],
                chart: {
                    type: 'donut',
                    width: '100%'
                },
                labels: ["Category 1", "Category 2", "Category 3", "Category 4"],
                colors: ['#28a745', '#6f42c1', '#dc3545', '#007bff'],
                dataLabels: {
                    enabled: false
                },
                legend: {
                    show: false
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '65%',
                            labels: {
                                show: true,
                                total: {
                                    show: true,
                                    label: 'Total',
                                    fontSize: '16px',
                                    fontWeight: 600,
                                    color: '#333',
                                    formatter: function(w) {
                                        return "৳7,845";
                                    }
                                }
                            }
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#donutChart1"), options);
            var chart2 = new ApexCharts(document.querySelector("#donutChart2"), options);
            chart.render();
            chart2.render();
        });
    </script>

    <script>
        var options = {
            series: [{
                data: [400, 540, 690, 1100]
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    borderRadiusApplication: 'end',
                    horizontal: true,
                }
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                categories: ['Sadar Bazar', 'Badda', 'Rup Nagar', 'Jatrabari'],
            }
        };

        var chart = new ApexCharts(document.querySelector("#demand_sales_chart"), options);
        chart.render();
    </script>

    <script>
        var options = {
            series: [{
                name: 'New',
                data: [4]
            }, {
                name: 'Active',
                data: [60]
            }, {
                name: 'To Be Dormant',
                data: [36]
            }, {
                name: 'No Order',
                data: [5]
            }, {
                name: 'Not Visited',
                data: [1]
            }],
            chart: {
                type: 'bar',
                height: 130,
                stacked: true,
                stackType: '100%'
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                },
            },
            stroke: {
                width: 0,
                colors: ['#fff']
            },
            // title: {
            //     text: '100% Stacked Bar'
            // },
            xaxis: {
                categories: ['Outlets'],
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + "K"
                    }
                }
            },
            fill: {
                opacity: 1

            },
            legend: {
                position: 'top',
                horizontalAlign: 'left',
                offsetX: 40
            },
            responsive: [{
                breakpoint: 480, // For screens smaller than 480px
                options: {
                    chart: {
                        height: 175 // Increase height for better visibility
                    },
                    legend: {
                        position: 'bottom', // Adjust legend position
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#stack_bar_chart"), options);
        chart.render();
    </script>






    <script>
        var options1 = {
            series: [84, 16],
            labels: ['Visited', 'Shop'],
            dataLabels: {
                style: {
                    colors: ['#384551', '#384551'] // Set colors for labels
                },
                dropShadow: {
                    enabled: false // Disable shadow
                }
            },
            colors: ['#008FFB', '#D3D3D3'],
            chart: {
                type: 'donut'
            },
            legend: {
                show: false
            }
        };

        var options2 = {
            series: [55, 45],
            labels: ['Memo', 'Shop'],
            dataLabels: {
                style: {
                    colors: ['#384551', '#384551'] // Set colors for labels
                },
                dropShadow: {
                    enabled: false // Disable shadow
                }
            },
            colors: ['#13C471', '#D3D3D3'],
            chart: {
                type: 'donut'
            },
            legend: {
                show: false
            }
        };

        var chart1 = new ApexCharts(document.querySelector("#visitedChart2"), options1);
        var chart2 = new ApexCharts(document.querySelector("#memoChart"), options2);

        chart1.render();
        chart2.render();
    </script>
@endpush
