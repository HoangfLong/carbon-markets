@extends('layouts.admin.app');

@section('content')
<div class="row">
    <div class="col-lg-8 d-flex align-items-strech">
      <div class="card w-100">
        <div class="card-body">
          <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
            <div class="mb-3 mb-sm-0">
              <h5 class="card-title fw-semibold">Sales Overview</h5>
            </div>
            <div>
              <select id="yearFilter" class="form-select">
                <option value="">Year</option>
                  @foreach ($monthlyRevenue->unique('year') as $revenue)
                    <option value="{{ $revenue->year }}">{{ $revenue->year }}</option>
                  @endforeach
              </select>
            </div>
          </div>
          <div id="chart_sales"></div>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="row">
        <div class="col-lg-12">
          <!-- Yearly Breakup -->
          <div class="card overflow-hidden">
            <div class="card-body p-4">
              <h5 class="card-title mb-9 fw-semibold">Yearly Breakup</h5>
              <div class="row align-items-center">
                <div class="col-8">
                  <h4 class="fw-semibold mb-3">${{ number_format($totalRevenue, 2) }}</h4>
                  <div class="d-flex align-items-center mb-3">
                    <span
                      class="me-1 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                      <i class="ti ti-arrow-up-left text-success"></i>
                    </span>
                    <p class="text-dark me-1 fs-3 mb-0">+9%</p>
                    <p class="fs-3 mb-0">last year</p>
                  </div>
                  <div class="d-flex align-items-center">
                    <div class="me-4">
                      <span class="round-8 bg-primary rounded-circle me-2 d-inline-block"></span>
                      <span class="fs-2">2023</span>
                    </div>
                    <div>
                      <span class="round-8 bg-light-primary rounded-circle me-2 d-inline-block"></span>
                      <span class="fs-2">2023</span>
                    </div>
                  </div>
                </div>
                <div class="col-4">
                  <div class="d-flex justify-content-center">
                    <div id="breakup"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <!-- Monthly Earnings -->
          <div class="card">
            <div class="card-body">
              <div class="row alig n-items-start">
                <div class="col-8">
                  <h5 class="card-title mb-9 fw-semibold"> Monthly Earnings </h5>
                  <h4 class="fw-semibold mb-3">$6,820</h4>
                  <div class="d-flex align-items-center pb-1">
                    <span
                      class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                      <i class="ti ti-arrow-down-right text-danger"></i>
                    </span>
                    <p class="text-dark me-1 fs-3 mb-0">+9%</p>
                    <p class="fs-3 mb-0">last year</p>
                  </div>
                </div>
                <div class="col-4">
                  <div class="d-flex justify-content-end">
                    <div
                      class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                      <i class="ti ti-currency-dollar fs-6"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div id="earning"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-4 d-flex align-items-stretch">
      <div class="card w-100">
        <div class="card-body p-4">
          <div class="mb-4">
            <h5 class="card-title fw-semibold">Recent Transactions</h5>
          </div>
          <ul class="timeline-widget mb-0 position-relative mb-n5">
            <li class="timeline-item d-flex position-relative overflow-hidden">
              <div class="timeline-time text-dark flex-shrink-0 text-end">09:30</div>
              <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                <span class="timeline-badge-border d-block flex-shrink-0"></span>
              </div>
              <div class="timeline-desc fs-3 text-dark mt-n1">Payment received from John Doe of $385.90</div>
            </li>
            <li class="timeline-item d-flex position-relative overflow-hidden">
              <div class="timeline-time text-dark flex-shrink-0 text-end">10:00 am</div>
              <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                <span class="timeline-badge border-2 border border-info flex-shrink-0 my-8"></span>
                <span class="timeline-badge-border d-block flex-shrink-0"></span>
              </div>
              <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">New sale recorded <a
                  href="javascript:void(0)" class="text-primary d-block fw-normal">#ML-3467</a>
              </div>
            </li>
            <li class="timeline-item d-flex position-relative overflow-hidden">
              <div class="timeline-time text-dark flex-shrink-0 text-end">12:00 am</div>
              <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                <span class="timeline-badge border-2 border border-success flex-shrink-0 my-8"></span>
                <span class="timeline-badge-border d-block flex-shrink-0"></span>
              </div>
              <div class="timeline-desc fs-3 text-dark mt-n1">Payment was made of $64.95 to Michael</div>
            </li>
            <li class="timeline-item d-flex position-relative overflow-hidden">
              <div class="timeline-time text-dark flex-shrink-0 text-end">09:30 am</div>
              <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                <span class="timeline-badge border-2 border border-warning flex-shrink-0 my-8"></span>
                <span class="timeline-badge-border d-block flex-shrink-0"></span>
              </div>
              <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">New sale recorded <a
                  href="javascript:void(0)" class="text-primary d-block fw-normal">#ML-3467</a>
              </div>
            </li>
            <li class="timeline-item d-flex position-relative overflow-hidden">
              <div class="timeline-time text-dark flex-shrink-0 text-end">09:30 am</div>
              <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                <span class="timeline-badge border-2 border border-danger flex-shrink-0 my-8"></span>
                <span class="timeline-badge-border d-block flex-shrink-0"></span>
              </div>
              <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">New arrival recorded 
              </div>
            </li>
            <li class="timeline-item d-flex position-relative overflow-hidden">
              <div class="timeline-time text-dark flex-shrink-0 text-end">12:00 am</div>
              <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                <span class="timeline-badge border-2 border border-success flex-shrink-0 my-8"></span>
              </div>
              <div class="timeline-desc fs-3 text-dark mt-n1">Payment Done</div>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-lg-8 d-flex align-items-stretch">
      <div class="card w-100">
        <div class="card-body p-4">
          <h5 class="card-title fw-semibold mb-4">Recent Transactions</h5>
          <div class="table-responsive">
            <table class="table text-nowrap mb-0 align-middle">
              <thead class="text-dark fs-4">
                <tr>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Id</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Assigned</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Name</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Quantity</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Amount</h6>
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach($latestOrders as $order)
                <tr>
                  <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $order->id }}</h6></td>
                  <td class="border-bottom-0">
                      <h6 class="fw-semibold mb-1">{{ $order->user->name }}</h6>
                      <span class="fw-normal">{{ $order->user->company }}</span>                          
                  </td>
                  <td class="border-bottom-0">
                    <p class="mb-0 fw-normal">{{ $order->orderItems->first()->credit->projects->name }}</p>
                  </td>
                  <td class="border-bottom-0">
                    <div class="d-flex align-items-center gap-2">
                      <span class="badge bg-primary rounded-3 fw-semibold">{{ $order->orderItems->first()->quantity }} UD</span>
                    </div>
                  </td>
                  <td class="border-bottom-0">
                    <h6 class="fw-semibold mb-0 fs-4">${{ $order->total_amount }}</h6>
                  </td>
                </tr> 
                @endforeach                      
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        const monthlyRevenue = @json($monthlyRevenue); // Get data from Blade

        let chart; // Define the chart variable
        const chartElement = document.querySelector('#chart_sales'); // Ensure this element exists

        // Check if chartElement exists before proceeding
        if (!chartElement) {
            console.error('Element #chart_sales not found');
            return;
        }

        // Function to initialize the chart
        function initializeChart() {
            if (chart) {
                chart.destroy();  // Destroy the existing chart
            }

            const options = {
                series: [{
                    name: 'Monthly Revenue',
                    data: monthlyRevenue.map(sale => sale.total),
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    id: 'revenueChart',
                    toolbar: { show: false },  // Hide toolbar for a cleaner look
                    animations: { 
                        enabled: true, 
                        easing: 'easeinout', 
                        speed: 800 
                    },
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        endingShape: 'rounded',
                        columnWidth: '60%',
                    }
                },
                xaxis: {
                    categories: monthlyRevenue.map(sale => `${sale.month_name} ${sale.year}`),
                },
                yaxis: {
                    labels: { style: { colors: '#6c757d', fontSize: '14px' } }
                },
                fill: {
                    opacity: 0.9,
                    colors: ['#35a3c6'],
                    type: 'gradient',
                    gradient: { shade: 'light', type: 'horizontal', shadeIntensity: 0.3, stops: [0, 100] },
                },
                tooltip: {
                    theme: 'dark',
                    y: {
                        formatter: function (val) {
                            return '$' + val.toLocaleString(); // Format as currency
                        }
                    }
                },
                title: {
                    text: 'Monthly Revenue Overview',
                    align: 'center',
                    style: { fontSize: '16px', fontWeight: 'bold', color: '#333' },
                },
                grid: {
                    borderColor: '#e3e3e3',
                    row: { colors: ['#fff', '#f9f9f9'], opacity: 0.5 },
                }
            };

            // Create the chart
            chart = new ApexCharts(chartElement, options);
            chart.render();
        }

        // Initialize the chart on page load
        initializeChart();

        // Event Listener for Year Filter
        document.querySelector('#yearFilter').addEventListener('change', function (e) {
            const selectedYear = e.target.value;

            let filteredData = monthlyRevenue;

            // If a year is selected, filter by year
            if (selectedYear) {
                filteredData = monthlyRevenue.filter(sale => sale.year == selectedYear);
            }

            // Add smooth transition effect when changing the year
            chart.updateOptions({
                xaxis: {
                    categories: filteredData.map(sale => `${sale.month_name} ${sale.year}`),
                },
                // Add smooth animation for both series update and chart options
                animations: {
                    enabled: true,  // Enable animations
                    easing: 'easeinout',  // Smooth transition
                    speed: 800,  // Duration of animation
                    animateGradients: true,  // Optionally animate the gradient fill
                },
            });

            // Update the series data with animation
            chart.updateSeries([{
                name: 'Monthly Revenue',
                data: filteredData.map(sale => sale.total),
            }]);
        });
    });
</script>
@endsection