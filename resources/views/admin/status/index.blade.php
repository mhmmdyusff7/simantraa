<div>
    <div class="sectioncontent-header">
        <h2 class="sectioncontentheader-title">Manajemen Perangkat</h2>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="bg-white rounded-md custom-shadow">
                <div id="chart" class="chart-1"></div>
            </div>
        </div>
    </div>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            var options = {
                chart: {
                    height: 280,
                    type: "line",
                    animations: {
                        enabled: true,
                        easing: 'easeinout',
                        speed: 800,
                        animateGradually: {
                            enabled: true,
                            delay: 150
                        },
                        dynamicAnimation: {
                            enabled: true,
                            speed: 350
                        }
                    },
                    toolbar: {
                        show: true,
                        tools: {
                            download: true,
                            selection: true,
                            zoom: true,
                            reset: true
                        }
                    }
                },
                dataLabels: {
                    enabled: false
                },
                series: [{
                    name: "Series 1",
                    data: @json($data) // Menggunakan data dari Livewire
                }],
                fill: {
                    type: "gradient",
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.7,
                        opacityTo: 0.9,
                        stops: [0, 90, 100]
                    }
                },
                xaxis: {
                    categories: [
                        "01 Jan",
                        "02 Jan",
                        "03 Jan",
                        "04 Jan",
                        "05 Jan",
                        "06 Jan",
                        "07 Jan"
                    ]
                },
                legend: {
                    show: false
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();

            document.addEventListener('livewire:load', () => {
                @this.updateData(); 
            });

           
        </script>
    @endpush
</div>