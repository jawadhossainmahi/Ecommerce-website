import {BASE_URL} from "../../env.js"


function currentDates(){
    
    let date = new Date()
    let dates = [date]
    for (let i = 1; i < 31; i++) {
        const newDate = new Date(date.getFullYear(), date.getMonth(), date.getDate()+i)
        
        dates.push(newDate)
        
    }
    
    return dates
}

function minTwoDigits(n) {
  return (n < 10 ? '0' : '') + n;
}

let weekdays = new Array(7);
weekdays[0] = "Sunday";
weekdays[1] = "Monday";
weekdays[2] = "Tuesday";
weekdays[3] = "Wednesday";
weekdays[4] = "Thursday";
weekdays[5] = "Friday";
weekdays[6] = "Saturday";
let deliveryDate = document.getElementById("delivery-date")
const dates = currentDates()
let deliverydate = ""
let deliverytime = ""
if(deliveryDate){
    $.ajax({
        url: BASE_URL+"api/admin/deliverytime",
        async: false,
        type: "GET",
        success: function(response){
            
            let disabled = response.filter(item => (item.status == 0 && item.start_time == "00:00:00"))
            let disableddates = disabled.map(data => data.date)
            // console.log(disableddates[0])
            
            
            for (let i = 0; i < dates.length; i++) {
                let dateformat = `${dates[i].getFullYear()}-${minTwoDigits(dates[i].getMonth()+1)}-${minTwoDigits(dates[i].getDate())}`
                let deliverydatadisabled = disableddates.includes(dateformat) ? 'Enable': "Disable"
                
                deliverydate += 
                `
   
    
                <tr id="remove">
                
                    <td><input type="checkbox" class="checkeds" name="ids" id="" value=" "></td>
                    <td>${i+1}</td>
                    <td><a href="${BASE_URL}admin/deliverytime/${dates[i].getFullYear()}-${dates[i].getMonth()+1}-${dates[i].getDate()}"> ${dates[i].getDate()} ${dates[i].toLocaleString('en-us', { month: 'long' })} ${dates[i].getFullYear()}</a></td>
                    <td>
                        <a  id="${dates[i].getFullYear()}-${dates[i].getMonth()+1}-${dates[i].getDate()}" class="cursor-pointer toggle-date" >${deliverydatadisabled}</a>
                    </td>
                    
                    
                </tr>
                `
                
            }
            
            deliveryDate.innerHTML = deliverydate
            
            
            
            let toggleDates = document.getElementsByClassName('toggle-date')
            toggleDates = [...toggleDates]
            console.log(toggleDates)
            // console.log(toggleDates.length)
            
            for (let i = 0; i < toggleDates.length; i++) {
                const toggleDate = toggleDates[i];
                // console.log(toggleDate)
                toggleDate.addEventListener('click', function(){
                    const res = ToggleDate(toggleDate.id)
                    // console.log(res.status)
                    // console.log(toggleDate.innerHTML == "Disable")
                        if((toggleDate.innerHTML == "Disable")){
                            toggleDate.innerHTML = "Enable"
                        }else{
                            toggleDate.innerHTML = "Disable"
                        }
                        
                    
                    
                })
                
            }
          
        }
    })
       
    
    
}


function checkDate(firstdate, seconddate){
    firstdate = new Date(firstdate)
    seconddate = new Date(seconddate)
    
}




function ToggleDate(date, start_time="00:00:00", end_time="24:00:00"){
    let temp = null
    $.ajax({
        url: BASE_URL+"admin/deliverytime/store",
        
        headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
        type: "POST",
        data: {
          "date":date,
          "start_time":start_time,
          "end_time":end_time
        },
        
        success: function(response){
            console.log(response)
            temp = response
        }
    })
    return temp
}

function DeliveryDate(){
    let temp = []
    $.ajax({
        url: BASE_URL+"api/admin/deliverytime",
        async: false,
        type: "GET",
        success: function(response){
            temp = response
        }
    })
    return temp
}
// console.log(DeliveryDate())
function DeliveryTime(date){
    $.ajax({
        url: BASE_URL+"api/admin/deliverytime/"+date,
        async: false,
        type: "GET",
        success: function(response){
            // console.log(response)
            for (let i = 0; i < response.length; i++) {
                const element = response[i]
                if(!(element.start_time == "00:00:00")){
                    const timeRange = element.start_time + "-"+ element.end_time
                    const timeRangeDiv = document.getElementById(timeRange)
                    if(timeRangeDiv){
                        timeRangeDiv.innerHTML = "Enable"
                    }
                }
            }
            
        }
    })
}


let deliveryTime = document.getElementById("delivery-time")

if(deliveryTime){
    
    const urlpath = window.location.pathname
    const date = urlpath.substr(urlpath.search(/\d+-\d+-\d/))
    DeliveryTime(date)
    
    let timeRanges = document.getElementsByClassName('time-range')

    for (let i = 0; i < timeRanges.length; i++) {
        const timeRange = timeRanges[i]
        timeRange.addEventListener('click', function(){
            timeRangeArray = timeRange.id.split('-')
            const start_time = timeRangeArray[0]
            const end_time = timeRangeArray[1]
            ToggleDate(date, start_time, end_time)
            // console.log(timeRange)
            timeRange.innerHTML = (timeRange.innerHTML == "Disable") ? "Enable" : "Disable"
        })
    }

}

   
const select_all = document.getElementById("select-all")

if(select_all){
    select_all.addEventListener('click', function(){
        let checkList = document.getElementsByClassName('checkeds')
        // console.log(select_all.checked)
        for(let i=0; i<checkList.length; i++){
            // console.log(checkList[i].checked)
            if(select_all.checked)
            {
                checkList[i].checked = true;
            }else{
                // console.log(checkList[i].checked)
                checkList[i].checked = false;
            }
            
        }
    
    })
}

const export_products = document.getElementById("export_products")

if(export_products){
    export_products.addEventListener('click', function(){
        let checkList = document.getElementsByClassName('checkeds')
        let ids = []
        for(let i=0; i<checkList.length; i++){
            if(checkList[i].checked)
            {
                ids.push(checkList[i].value)
            }
        }
        $.ajax({
            url:BASE_URL+"admin/product/export",
            type:"POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                "ids":ids
            },
            xhrFields: {
                responseType: 'blob' // Set the response type to 'blob' for file download
            },
            success: function(response) {
                // Use the FileSaver library to trigger the download
                const blob = new Blob([response], { type: 'text/csv' });
                saveAs(blob, 'products.csv'); // Set the desired file name
            },
            error: function(error) {
                console.log('Error exporting data: ', error);
            }
            
    })
})

}




$(document).ready(function(){
 
     $("#all_select").click(function(){
         $(".checkeds").prop("checked", $(this).prop("checked"));
         
     });
     
     $("#all_delete").click(function(e){
         e.preventDefault();
         let checkList = $(".checkeds");
        
         for(let i=0; i<checkList.length; i++){
             let element = checkList[i].checked;
             if(element){
                //  console.log(checkList[i])
                 let id= checkList[i].parentNode.parentNode.getElementsByClassName('toggle-date')[0].id
                //  console.log(id);
                 $.ajax({
            url:"/admin/deliverytime/disable"+id,
            type:"POST",
             headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
            data:{
                "check":id
            },
            success:function(response){
                
               
                  window.location.href=BASE_URL+"admin/deliverytime";
               
                                 
                
            }
        });
             }
             
         
         }

         
     });

    //  Enable buttons
 
     $("#all_select").click(function(){
         $(".checkeds").prop("checked", $(this).prop("checked"));
         
     });
     
     $("#enables").click(function(e){
         e.preventDefault();
         let checkList = $(".checkeds");
     
        
         for(let i=0; i<checkList.length; i++){
             let element = checkList[i].checked;
             if(element){
                
                 let id= checkList[i].parentNode.parentNode.getElementsByClassName('toggle-date')[0].id
        
                 $.ajax({
            url:"/admin/deliverytime/enable"+id,
            type:"POST",
             headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
            data:{
                "check":id
            },
            success:function(response){
               
                    window.location.href=BASE_URL+"admin/deliverytime";
                
                 
                
            }
        });
             }
             
            
             
         }

         
     });
    }); 


  
          

         
    

   





    

// affam
  
    //  $("#all_delete").click(function(e){
    //      e.preventDefault();
    //       var check=[];
    //     $("input:checkbox[name=ids]:checked").each(function(){
    //         check.push($(this).val());
    //     });
    //                     console.log(check);
//                         function ToggleDate(date, start_time="00:00:00", end_time="24:00:00"){
//     let temp = null
//     $.ajax({
//         url: BASE_URL+"admin/deliverytime/disable",
//         headers: {
//              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//           },
//         type: "POST",
//         data: {
//           "date":check
          
//         },
        
//         success: function(response){
//             console.log(response)
//             temp = response
//         }
//     })
//     return temp
// }
    //     $.ajax({
    //         url:"/admin/deliverytime/disable",
    //         type:"POST",
    //          headers: {
    //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    // },
    //         data:{
    //             "check":check,
    //         // "_token": "{{ csrf_token() }}",
    //         },
    //         success:function(response){
    //             console.log(response);
    //         }
    //     });
    //  });



    
    
    
    