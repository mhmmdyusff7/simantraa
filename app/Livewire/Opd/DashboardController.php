<?php
namespace App\Livewire\Opd;

use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\Perangkat;
use App\Models\Opd;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

class DashboardController extends Component
{
    public $filterOpd = null;
    public $filterKategori = null;
    public $labelOpd = 'Di Semua OPD';
    public $jenisChart = 'donut';

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['filterOpd', 'filterKategori', 'jenisChart'])) {
            $this->js('
                $wire.getChartData().then(data => {
                    const series = data.series;
                    const labels = data.labels;
                    const newChartType = data.chartType; 
                    const chart = ApexCharts.getChartByID("statusPerangkatChart");

                    if (chart) {
                        chart.updateOptions({
                            chart: {
                                type: newChartType, 
                                animations: {
                                    enabled: true,
                                    easing: "easeinout",
                                    speed: 800,
                                }
                            },
                            labels: labels,
                            colors: ["#ff4560", "#00e396", "#feb019"],
                            legend: { show: true, position: "bottom" }, 
                            tooltip: { enabled: true },
                            noData: {
                                text: "Tidak ada data",
                                align: "center",
                                verticalAlign: "middle",
                                style: { color: "#6c757d", fontSize: "14px" }
                            },
                            plotOptions: {
                                pie: {
                                    donut: {
                                        labels: {
                                            show: (newChartType === "donut" || newChartType === "pie"),
                                            total: {
                                                showAlways: true,
                                                show: true,
                                                label: "Total",
                                                formatter: function (w) {
                                                    return w.globals.series.reduce((a, b) => a + b, 0);
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }, false, true);

                        chart.updateSeries(series);
                    }
                });
            ');
        }
    }


      #[Title('Opd || Data Bandwidth')]
    #[Layout('components.layouts.opd.app')]

    public function render()
    {

        $this->filterOpd = Auth::guard('opd')->user()->id;
        $baseQuery = Perangkat::query();

        if ($this->filterOpd) {
            $baseQuery->where('opd_id', $this->filterOpd);
            $xLabelOpd = Opd::find($this->filterOpd);
            $this->labelOpd = 'Di ' . ($xLabelOpd->nama ?? 'Semua OPD');
        } else {
            $this->labelOpd = 'Di Semua OPD';
        }

        if ($this->filterKategori) {
            $baseQuery->where('kategori_perangkat', $this->filterKategori);
        }

        $listPerangkat = $baseQuery->get();

        $data = [
            'listKategori' => Perangkat::select('kategori_perangkat')
                ->whereNotNull('kategori_perangkat')
                ->distinct()
                ->pluck('kategori_perangkat')
                ->toArray(),
            'dataOpd' => Opd::orderBy('id', 'desc')->get(),
            'status_perangkat' => $this->calculateStatusCounts($listPerangkat),
            'umur_perangkat' => $this->calculateUmurPerangkat($listPerangkat),
            'total_perangkat' => $listPerangkat->count(),
            'list_opd' => Opd::all(),
        ];

        // Prepare chart data
        $statusData = $this->calculateStatusCounts($listPerangkat);
        $seriesData = json_encode(array_values($statusData));
        $labels = json_encode(['Rusak Berat', 'Baik', 'Perlu Diperbaiki']);
        $chartType = json_encode($this->jenisChart);

        $this->js(<<<JS
            const options = {
                series: $seriesData,
                chart: {
                    type: $chartType,
                    height: 350,
                    id: 'statusPerangkatChart',
                    animations: {
                        enabled: true,
                        easing: "easeinout",
                        speed: 800,
                    }
                },
                labels: $labels,
                colors: ["#ff4560", "#00e396", "#feb019"], 
                legend: { position: 'right' },
                noData: {
                    text: 'Tidak ada data',
                    align: 'center',
                    verticalAlign: 'middle',
                    style: { color: "#6c757d", fontSize: '14px' }
                },
                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: ($chartType === "donut" || $chartType === "pie"),
                                total: {
                                    showAlways: true,
                                    show: true,
                                    label: 'Total',
                                    formatter: function (w) {
                                        return w.globals.series.reduce((a, b) => a + b, 0);
                                    }
                                }
                            }
                        }
                    }
                }
            };
            
            const chartElement = document.querySelector("#chart");
            if (chartElement) {
                // Destroy existing chart if it exists
                if (chartElement._apexChart) {
                    chartElement._apexChart.destroy();
                }
                
                const chart = new ApexCharts(chartElement, options);
                chart.render();
                chartElement._apexChart = chart;
            }
        JS);

        return view('opd.dashboard', $data);
    }

    public function getChartData()
    {
        $baseQuery = Perangkat::query();

        if ($this->filterOpd) {
            $baseQuery->where('opd_id', $this->filterOpd);
        }
        if ($this->filterKategori) {
            $baseQuery->where('kategori_perangkat', $this->filterKategori);
        }

        $listPerangkat = $baseQuery->get();
        $statusData = $this->calculateStatusCounts($listPerangkat);

        return [
            'series' => array_values($statusData),
            'labels' => ['Rusak Berat', 'Baik', 'Perlu Diperbaiki'],
            'chartType' => $this->jenisChart
        ];
    }

    // DashboardController.php (perbaikan method calculateStatusCounts)
    private function calculateStatusCounts($listPerangkat)
    {
        $statusCounts = [
            'rusak_berat' => 0,
            'baik' => 0,
            'perlu_diperbaiki' => 0
        ];

        foreach ($listPerangkat as $perangkat) {
            $status = null;

            // Determine status based on category
            switch ($perangkat->kategori_perangkat) {
                case 'Perangkat Keras':
                    $status = $perangkat->status_keras;
                    break;
                case 'Perangkat Jaringan':
                    $status = $perangkat->status_jaringan;
                    break;
                case 'Perangkat Keamanan':
                    $status = $perangkat->status_keamanan;
                    break;
            }

            // Count status
            if ($status === 'Rusak Berat') {
                $statusCounts['rusak_berat']++;
            } elseif ($status === 'Baik') {
                $statusCounts['baik']++;
            } elseif ($status === 'Perlu Diperbaiki') {
                $statusCounts['perlu_diperbaiki']++;
            }
        }

        return $statusCounts;
    }

    private function calculateUmurPerangkat($listPerangkat)
    {
        $now = Carbon::now();
        $umurCounts = [
            'lebih_5_tahun' => 0,
            'antara_1_5_tahun' => 0,
            'kurang_1_tahun' => 0
        ];

        foreach ($listPerangkat as $perangkat) {
            $tanggalField = $this->getTanggalField($perangkat->kategori_perangkat);

            if ($tanggalField && isset($perangkat->$tanggalField) && $perangkat->$tanggalField) {
                $tanggal = Carbon::parse($perangkat->$tanggalField);
                $diffYears = $tanggal->diffInYears($now);

                if ($diffYears > 5) {
                    $umurCounts['lebih_5_tahun']++;
                } elseif ($diffYears >= 1) {
                    $umurCounts['antara_1_5_tahun']++;
                } else {
                    $umurCounts['kurang_1_tahun']++;
                }
            }
        }

        return $umurCounts;
    }

    private function getStatusField($kategori)
    {
        return match ($kategori) {
            'Perangkat Keras' => 'status_keras',
            'Perangkat Jaringan' => 'status_jaringan',
            'Perangkat Keamanan' => 'status_keamanan',
            default => null
        };
    }

    private function getTanggalField($kategori)
    {
        return match ($kategori) {
            'Perangkat Keras' => 'tanggal_pembelian_keras',
            'Perangkat Jaringan' => 'tanggal_pembelian_jaringan',
            'Perangkat Keamanan' => 'tanggal_pembelian_keamanan',
            default => null
        };
    }
}
