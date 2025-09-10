@extends('admin.layouts.app', [
    'activePage' => 'dashboard',
    'subactivePage' => '',
])
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Page Header -->
        <div class="page-header bg-white shadow-sm rounded p-4 mb-6 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1 text-primary d-flex align-items-center">
                    <i class="bx bx-home-smile me-2"></i> Dashboard
                </h5>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="/admin/home">Dashboard</a>
                        </li>
                    </ol>
                </nav>
            </div>
            @if (Auth::user()->level == 1)
                <form method="GET" action="{{ route('admin.report.income-expense') }}"
                    class="d-flex gap-2 align-items-center">
                    <select name="month" class="form-select form-select-sm">
                        @for ($i = 0; $i < 12; $i++)
                            @php
                                $month = date('Y-m', strtotime("-$i months"));
                                $monthName = \Carbon\Carbon::createFromFormat('Y-m', $month)->format('F Y');
                            @endphp
                            <option value="{{ $month }}"
                                {{ request('month', date('Y-m')) == $month ? 'selected' : '' }}>
                                {{ $monthName }}
                            </option>
                        @endfor
                    </select>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="bx bx-download"></i> PDF
                    </button>
                </form>
            @endif
        </div>
        @if (Auth::user()->level == 1)
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-start border-primary border-4">
                        <div class="card-body" style="background: linear-gradient(135deg, #28a745, #218838);">
                            <div class="d-flex align-items-center">
                                <div class="bg-white rounded-circle p-3 me-3 shadow-sm d-flex align-items-center justify-content-center"
                                    style="width:60px; height:60px;">
                                    <i class='bx bx-download' style="font-size:30px; color:#28a745;"></i>
                                </div>
                                <div>
                                    <h5 class="text-white mb-1">Total Pemasukan</h5>
                                    <h2 class="text-white fw-bold mb-0">Rp {{ number_format($pemasukan, 0, ',', '.') }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-start border-danger border-4">
                        <div class="card-body" style="background: linear-gradient(135deg, #dc3545, #b52a37);">
                            <div class="d-flex align-items-center">
                                <div class="bg-white rounded-circle p-3 me-3 shadow-sm d-flex align-items-center justify-content-center"
                                    style="width:60px; height:60px;">
                                    <i class='bx bx-upload' style="font-size:30px; color:#dc3545;"></i>
                                </div>
                                <div>
                                    <h5 class="text-white mb-1">Total Pengeluaran</h5>
                                    <h2 class="text-white fw-bold mb-0">Rp {{ number_format($pengeluaran, 0, ',', '.') }}
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12 mb-4 order-0">
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-primary fw-bold mb-0 d-flex align-items-center">
                            <i class="bx bx-bar-chart fs-3 me-2"></i> Grafik Antrian Perhari
                        </h4>
                        <form method="GET" id="formFilterTanggal" class="mb-3">
                            <label for="tanggal" class="form-label"></label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control"
                                value="{{ isset($tanggalFilter) ? $tanggalFilter : \Carbon\Carbon::now()->format('Y-m-d') }}"
                                onchange="
                                            var tgl = this.value;
                                            window.location.href = '/admin/home/filter/' + tgl;">
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
