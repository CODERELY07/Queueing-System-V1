$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Speech Queue
    let speechQueue = [];
    let isSpeaking = false;

    function speakText(text) {
        return new Promise((resolve, reject) => {
            if (!('speechSynthesis' in window)) {
                reject('Speech synthesis not supported.');
                return;
            }

            speechQueue.push({ text, resolve, reject });
            processQueue(); 
        });
    }

    function processQueue() {
        if (isSpeaking || speechQueue.length === 0) return;

        isSpeaking = true;
        const { text, resolve, reject } = speechQueue.shift();
        
        const msg = new SpeechSynthesisUtterance(text);
        msg.lang = "en-US";
        msg.volume = 1;
        msg.pitch = 1.5;
        msg.rate = 1.5;

        msg.onend = () => {
            isSpeaking = false;
            resolve();
            processQueue(); 
        };

        msg.onerror = (event) => {
            isSpeaking = false;
            reject(`Speech error: ${event.error}`);
            processQueue(); 
        };

        window.speechSynthesis.speak(msg);
    }

    // Cashier Queue
    $(document).on('click', '#nextQueue', function(){
        const url = $(this).data('url');
        const cashier_id = $(this).data('cashier_id');

        $.ajax({
            url: url,
            method: 'POST',
            data: {cashier_id: cashier_id},
            success: function(response){
                const client_id  = String(response.client.id);
                const client_id_pad = client_id.padStart(4, "0");
                console.log(response.client.cashier_id)
                console.log(response);
                if(response.message){
                    alert(response.message);
                }

                $(`#cashier-queue-${cashier_id}`).html(
                    `<div>ID: ${client_id_pad}</div>
                     <div>Name: ${response.client.name}</div>`
                );
            },
            error: function(xhr, status, error){
                errorHandler(xhr, status, error);
            }
        });
    });

    $(document).on('click', '#prevQueue', function(){
        const url = $(this).data('url');
        const cashier_id = $(this).data('cashier_id');

        $.ajax({
            url: url,
            method: 'POST',
            data: {cashier_id: cashier_id},
            success: function(response){
                const client_id  = String(response.client.id);
                const client_id_pad = client_id.padStart(4, "0");
    
                $(`#cashier-queue-${cashier_id}`).html(
                    `<div>ID: ${client_id_pad}</div>
                     <div>Name: ${response.client.name}</div>`
                );
            },
            error: function(xhr, status, error){
                errorHandler(xhr, status, error);
            }
        });
    });

    // Load Queuing Monitoring 
    function loadQueuingMonitoring() {
        $.ajax({
            url: '/queuing/getQueuingMonitoring',
            method: 'GET',
            success: function(clients) {
                $.each(clients, function(index, client) {
                    var cashierSection = $(`.cashier-${client.cashier_Id}-section`);
                    const client_id_pad = String(client.id).padStart(4, "0");
    
                    if (cashierSection.length) {
                        cashierSection.html(`
                            <div class="font-semibold text-2xl"> Cashier: ${client.cashier.name}</div>
                            <div class="font-semibold text-2xl">ID: ${client_id_pad}</div>
                            <div class="font-semibold text-2xl">Name: ${client.name}</div>
                        `);
                    } else {
                        $(`#queue-servicing`).append(
                            `<div class='cashier-${client.cashier_Id}-section cashier-section'>
                                <div class="font-semibold text-2xl"> Cashier: ${client.cashier_Id}</div>
                                <div class="font-semibold text-2xl">ID: ${client_id_pad}</div>
                                <div class="font-semibold text-2xl">Name: ${client.name}</div>
                            </div>`
                        );
                    }
                });
            },
            error: function(error) {
                console.log('Error fetching queuing monitoring data', error);
            },
        });
    }
    
    //loading indicator
    // beforeSend: function() {
    //     $(`#queue-servicing`).html(
    //      `
    //          <!-- From Uiverse.io by barisdogansutcu --> 
    //          <svg viewBox="25 25 50 50">
    //              <circle r="20" cy="50" cx="50"></circle>
    //          </svg>
    //      `
    //     )
    //  },
    // complete: function(){
    //     $(`#queue-servicing svg`).remove();
        
    // }
    console.log("hi")
    loadQueuingMonitoring();
    //load Queuing Cashier
    function loadCashierQueuing() {
        const cashier_id = $('#notifyQueue').data('cashier_id');
       
        $.ajax({
            url: `/cashier/queuingList/${cashier_id}`,
            method: 'GET',
            beforeSend: function() {
               $(`#cashier-queue-${cashier_id}`).html(
                `
                    <!-- From Uiverse.io by barisdogansutcu --> 
                    <svg style="margin:0 auto !important; display:block" viewBox="25 25 50 50">
                        <circle r="20" cy="50" cx="50"></circle>
                    </svg>
                `
               )
            },
            success: function(response) {
                if(response.id){
                    const client_id = String(response.id);
                    const client_id_pad = client_id.padStart(4, "0");
                    console.log(response);
                    $(`#cashier-queue-${cashier_id}`).html(
                        `<div class="text-2xl text-center">ID: ${client_id_pad}</div>
                         <div class="text-2xl text-center">Name: ${response.name}</div>`
                    );
                }else{
                    $(`#cashier-queue-${cashier_id}`).html(
                        `<div>
                            <p class="text-center">No Queue</p>
                            <small class="text-center">Click Next to Start</small>
                        </div>`
                    );  
                }
             
            },
            error: function(error) {
                // Handle error if the request fails
                console.log('Request failed', error);
            }
        });
    }
    
    loadCashierQueuing();

    $(document).on('click', '#notifyQueue', function(){
        const url = $(this).data('url');
        const cashier_id = $(this).data('cashier_id');

        $.ajax({
            url: url,
            method: 'POST',
            data: {cashier_id: cashier_id},
            success: function(response){
                console.log(response);
            },
            error: function(xhr, status, error){
                errorHandler(xhr, status, error);
            }
        });
    });

    // Update queue servicing information in monitoring
    // if (window.location.pathname === '/queuing/monitoring') {
       
        if (window.Echo) {
            window.Echo.channel('queuing-monitoring')
                .listen('Queueing', async function (data) {
                    console.log(data);
                    console.log("hi")
                    const msgText = `Customer number ${data.id}, ${data.name}, please come to ${data.cashier_name}.`;
                 
                    speakText(msgText)
                        .then(() => console.log('Speech finished'))
                        .catch((error) => console.error('Speech error:', error));

                    loadQueuingMonitoring();
              
                 
                });
        } else {
            console.error("Echo is not available!");
        }
    // }
});
