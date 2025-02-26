$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    // Cashier Queue
    $(document).on('click', '#nextQueue' , function(){
        
        const url = $(this).data('url');

        const cashier_id = $(this).data('cashier_id');

        $.ajax({
            url: url,
            method: 'POST',
            data: {cashier_id: cashier_id},
            success: function(response){
                 console.log(response);
                 if(response.message){
                    alert(response.message);
                 }

                $(`#cashier-queue-${cashier_id}`).html(
                    `
                    <div>ID: ${response.client.id}</div>
                    <div>Name: ${response.client.name}</div>
                    `
                )
            },
            error: function(xhr, status, error){
                errorHandler(xhr, status, error);
            }
        })
    })

    $(document).on('click', '#notifyQueue' , function(){
        
        const url = $(this).data('url');
        const cashier_id = $(this).data('cashier_id');

        $.ajax({
            url: url,
            method: 'POST',
            data: {cashier_id: cashier_id},
            success: function(response){
                console.log(response);            },
            error: function(xhr, status, error){
                errorHandler(xhr, status, error);
            }
        })
    })
    
    //update queue servicing information in monitoring
    if (window.location.pathname === '/queuing/monitoring') {
        if (window.Echo) {
            window.Echo.channel('queuing-monitoring')
            .listen('Queueing', function(data) { 
                var msg = `Customer number ${data.id}, please come in Cashier ${data.cashier_id}.`;
                // Use the Web Speech API to speak the message
                var speech = new SpeechSynthesisUtterance(msg);
                window.speechSynthesis.speak(speech);  
              
                var cashierSection = $(`.cashier-${data.cashier_id}-section`);
                
                if (cashierSection.length) {
                    cashierSection.html(`
                        <div> Cashier: ${data.cashier_id}</div>
                        <div>ID: ${data.id}</div>
                        <div>Name: ${data.name}</div>
                    `);
                } else {
                    $(`#queue-servicing`).append(
                        ` 
                        <div class='cashier-${data.cashier_id}-section'>
                          <div> Cashier: ${data.cashier_id}</div>
                          <div>ID: ${data.id}</div>
                          <div>Name: ${data.name}</div>
                        </div>
                        `
                    );
                }
            });
        } else {
            console.error("Echo is not available!");
        }
    }
    

})
