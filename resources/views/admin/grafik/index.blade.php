@extends('admin.layouts.app', [
    'activePage' => 'grafik',
    'subactivePage' => '',
])
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Page Header -->
        <div class="page-header bg-white shadow-sm rounded p-4 mb-6 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1 text-primary d-flex align-items-center">
                    <i class="bx bx-book-content me-2"></i> Data Master
                </h5>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">Data Grafik</li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="/admin/grafik">Grafik</a></li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- List Grafik -->
        <div class="row">
            <div class="col-xxl-8 mb-4 order-0">
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-primary fw-bold mb-0 d-flex align-items-center">
                        <i class="bx bx-bar-chart fs-3 me-2"></i> Grafik Antrian Perhari
                    </h4>
                    <form method="GET" action="{{ route('admin.grafik.read') }}" class="mb-3">
                        <label for="tanggal" class="form-label">Filter Tanggal:</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ isset($tanggalFilter) ? $tanggalFilter : \Carbon\Carbon::now()->format('Y-m-d') }}" onchange="this.form.submit()">
                    </form>
                </div>
                <hr class="mt-0">
                <!-- Alert Messages -->
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="table-responsive text-nowrap">
                    <div style="width: 80%; margin: auto;">
                        <canvas id="antrianChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = @json($labels);
        const datasets = @json($datasets);

        const ctx = document.getElementById('antrianChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'nearest',
                    axis: 'x',
                    intersect: false,
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Tanggal',
                            font: {
                                size: 14,
                                weight: 'bold'
                            }
                        },
                        ticks: {
                            maxRotation: 45,
                            minRotation: 45,
                            autoSkip: true,
                            maxTicksLimit: 15,
                        },
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Jumlah Antrian',
                            font: {
                                size: 14,
                                weight: 'bold'
                            }
                        },
                        ticks: {
                            precision: 0,
                            beginAtZero: true,
                        },
                        grid: {
                            color: '#e0e0e0',
                            borderDash: [5, 5]
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            boxWidth: 12,
                            padding: 15,
                            font: {
                                size: 12,
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                        mode: 'nearest',
                        intersect: false,
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.parsed.y;
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Grafik Antrian Perhari',
                        font: {
                            size: 18,
                            weight: 'bold'
                        },
                        padding: {
                            top: 10,
                            bottom: 30
                        }
                    }
                }
            }
        });
    </script>
@endsection
