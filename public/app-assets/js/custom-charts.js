
// DashboardController
// Route::get('/dashboard/orders/{interval}/{status?}/{get_total?}', [App\Http\Controllers\Admin\Api\DashboardController::class, 'ordersIntervalStatus'])->where(['interval' => '(?i)(year|month|day)'])->where(['status' => '[0-2]|(?i)null'])->where(['get_total' => '(?i)(true|false)']);
// Route::get('/dashboard/customers/{interval}', [App\Http\Controllers\Admin\Api\DashboardController::class, 'customersInterval'])->where(['interval' => '(?i)(year|month|day)']);


import {BASE_URL} from "../../env.js"


const openOrders = document.getElementById('open-orders-chart')
const deliverdOrders = document.getElementById('delivered-orders-chart')
const totalPayments = document.getElementById('total-payment-chart')
const newCustomer = document.getElementById('new-customer-chart')

function dashboardChart(data, chart_labal, chartcanvas){
    let chart = Chart.getChart(chartcanvas);
    let total_data = 0
    if(!chart){
        total_data = createChart(data, chart_labal, chartcanvas)
    }else{
        total_data = updateChart(data, chart_labal, chartcanvas)
    }
    // console.log(total_data)
    return total_data
    

}

function updateChart(data, chart_labal, chartcanvas){
    let chart = Chart.getChart(chartcanvas);
    let total_data = data.map(row => row.total);
    
    if(chart){
        chart.data.labels = data.map(row => row.date);
        
        chart.data.datasets[0].data = total_data;
        chart.update();
    }
    console.log(total_data)
    return total_data
}

function createChart(data, chart_labal, chartcanvas){
    let total_data = data.map(row => row.total);
    // console.log(total_data)
    let OrdersChart = new Chart(
    chartcanvas,
    
    {
      type: 'bar',
      data: {
        labels: data.map(row => row.date),
        datasets: [
          {
            label: chart_labal,
            data: total_data
          }
        ]
      }
    }
    );
    
    return total_data
}


function getMonthName(monthNumber) {
  const date = new Date();
  
  date.setMonth(monthNumber - 1);
  return date.toLocaleString('en-US', { month: 'long' });
}

function format_date(interval, data){
    let date = ''
    if(interval == "month"){
        date = getMonthName(data.month)+"-"+data.year
    }else if(interval == "day"){
        date = data.date
    }else if(interval == "year"){
        date = data.year
    }
    return date
}

function getOrders(interval,ordersCanvas, chart_labal , status = null, get_total= false) {
    
    let orders_total = $.ajax({
          url: BASE_URL+"api/dashboard/orders/"+interval+"/"+status+"/"+get_total,
          type: "GET",
          
          success: function (data) {
            let openOrdersData = data.map(row => ({'date': format_date(interval, row), 'total': row.total_orders}))
            // const ordersCanvas = document.getElementById('open-orders-chart')
            
            
            
            let data_total = dashboardChart(openOrdersData, chart_labal, ordersCanvas)
            if(status == 0){
                let openOrdersTotal = document.getElementsByClassName('total-open-orders')[0]
                if(openOrdersTotal){
                const sum = data_total.reduce((accumulator, object) => {
                  return accumulator + object;
                }, 0);
                openOrdersTotal.innerHTML = sum
            }
                
            }else if(status == 1){
                let deliveredOrdersTotal = document.getElementsByClassName('total-delivered-orders')[0]
                if(deliveredOrdersTotal){
                    
                const sum = data_total.reduce((accumulator, object) => {
                  return accumulator + object;
                }, 0);
                
                
                deliveredOrdersTotal.innerHTML = sum
                
            }
            }
            
          }
        });
        
    return orders_total
      
    
}
function getOrdersTotal(interval,ordersCanvas, chart_labal , status = null, get_total= false){
    let orders_total = $.ajax({
          url: BASE_URL+"api/dashboard/orders/"+interval+"/"+status+"/"+get_total,
          type: "GET",
          
          success: function (data) {
            let openOrdersData = data.map(row => ({'date': format_date(interval, row), 'total': row.total}))
            // const ordersCanvas = document.getElementById('open-orders-chart')
            console.log(openOrdersData)
            let data_total = dashboardChart(openOrdersData, chart_labal, ordersCanvas)
            
            let totalPaymentTotal = document.getElementsByClassName('total-payment')[0]
            if(totalPaymentTotal){
            const sum = data_total.reduce((accumulator, object) => {
                  return accumulator + object;
                }, 0);
                totalPaymentTotal.innerHTML = "SEK "+parseFloat(sum)
          }}
        });
        
    return orders_total
}

function getNewCustomers(interval,customerCanvas, chart_labal){
    let customer_total = $.ajax({
          url: BASE_URL+"api/dashboard/customers/"+interval,
          type: "GET",
          
          success: function (data) {
            let customersData = data.map(row => ({'date': format_date(interval, row), 'total': row.total_customers}))
            // const ordersCanvas = document.getElementById('open-orders-chart')
            let data_total =  dashboardChart(customersData, chart_labal, customerCanvas)
            let newCustomerTotal = document.getElementsByClassName('total-new-customers')[0]
            console.log(data_total)
            if(newCustomerTotal)
          {
            const sum = data_total.reduce((accumulator, object) => {
                // console.log(object)
                  return accumulator + object;
                }, 0);
                // console.log(sum)
                
                newCustomerTotal.innerHTML = sum
            }
          }
        });
        
    return customer_total
}

// total payment 



let total_open_orders = getOrders("year", openOrders,"Open Orders", 0)
let total_delivered_orders = getOrders("year", deliverdOrders , "Delivered Orders", 1)
let total_payments = getOrdersTotal("year", totalPayments, "Total Payments", null, true)
let total_new_customers = getNewCustomers("year", newCustomer, "New Customers")




let openOrdersSwitch = document.getElementById('open-orders-data')
let deliveredOrdersSwitch = document.getElementById('delivered-orders-data')
let totalPaymentSwitch = document.getElementById('total-payment-data')
let newCustomerSwitch = document.getElementById('new-customer-data')



if(openOrdersSwitch){
    openOrdersSwitch.addEventListener('change', function(){
        getOrders(openOrdersSwitch.value, openOrders,"Open Orders", 0)
    })
}
if(deliveredOrdersSwitch){
    deliveredOrdersSwitch.addEventListener('change', function(){
        
        getOrders(deliveredOrdersSwitch.value, deliverdOrders , "Delivered Orders", 1)
    })
}
if(totalPaymentSwitch){
    totalPaymentSwitch.addEventListener('change', function(){
        
        getOrdersTotal(totalPaymentSwitch.value, totalPayments, "Total Payments", null, true)
    })
}
if(newCustomerSwitch){
    newCustomerSwitch.addEventListener('change', function(){
        
        getNewCustomers(newCustomerSwitch.value, newCustomer, "New Customers")
    })
}


// getOrders("year", newCustomer)


// let data = [
//     { year: 2010, count: 10 },
//     { year: 2011, count: 20 },
//     { year: 2012, count: 15 },
//     { year: 2013, count: 25 },
//     { year: 2014, count: 22 },
//     { year: 2015, count: 30 },
//     { year: 2016, count: 28 },
//   ];
// console.log("data")
// console.log(data)

// // console.log(openOrders)
// // console.log(deliverdOrders)
// // console.log(totalPayments)
// // console.log(newCustomer)
// // console.log(data.map(row => row.year));



// let openOrdersChart = new Chart(
//     openOrders,
    
//     {
//       type: 'bar',
//       data: {
//         labels: data.map(row => row.year),
//         datasets: [
//           {
//             label: 'Open Orders ',
//             data: data.map(row => row.count)
//           }
//         ]
//       }
//     }
//   );
// let deliveredOrdersChart = new Chart(
// deliverdOrders,
// {
//       type: 'bar',
//       data: {
//         labels: data.map(row => row.year),
//         datasets: [
//           {
//             label: 'Delivered Orders',
//             data: data.map(row => row.count)
//           }
//         ]
//       }
//     }
// );
// let totalPaymentChart = new Chart(
// totalPayments,
// {
//       type: 'bar',
//       data: {
//         labels: data.map(row => row.year),
//         datasets: [
//           {
//             label: 'Total Payment',
//             data: data.map(row => row.count)
//           }
//         ]
//       }
//     }
// );
// let newCustomerChart = new Chart(
// newCustomer,
// {
//       type: 'bar',
//       data: {
//         labels: data.map(row => row.year),
//         datasets: [
//           {
//             label: 'New Customers ',
//             data: data.map(row => row.count)
//           }
//         ]
//       }
//     }
// );
