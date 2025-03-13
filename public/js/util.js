// Display and debug error function
function errorHandler(xhr, status, error){
    $('.errors').html('');
    //for testing 
    // console.log("Error Details: " + status + error + xhr.responseText);
            
    // Display errors
    if (xhr.status === 422) {
        let errors = xhr.responseJSON.errors;
        $(".errors").html(""); 
    
        for (let field in errors) {
            let errorMessage = errors[field][0]; 
            $(`#${field}-error`).html(`<span class="text-danger">${errorMessage}</span>`); 
        }
    }
    
    // else {
    //     $('.errors').text('Something went wrong. Please try again later.');
    // }
}
function displayError(response){
    // response = response.responseJSON.errors;
    response = response.errors;
    if(response){
        errorClean();
        for (let field in response) {
            if(response[field] && response[field].length > 0)
                $('#' + field + '-error').html(response[field].join('<br>'));
        }
    }else{
        errorClean();
        $('.inputs').val('');
        
    }
  
   
}
// Remove displayed errors
function errorClean(){
    $('.errors').html('');
    $('.alert').removeClass('alert-danger').text('');
}

$(document).ready(function(){
      // Print Client Queue
      $(`#printBtn`).click(function(){
        var content = $(`#printClientQueue`).html();
        
        var printWindow = window.open("", "", "width=816,height=1056");

        var styles = `
            <style>
                body {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    flex-direction:column;
                    text-align: center;
                    font-family: Arial, sans-serif;
                    height:90vh;
                }
                .print-container {
                    flex-direction:column;
                    font-size:50px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }
            </style>
        `;

        printWindow.document.head.innerHTML = styles;
        printWindow.document.body.innerHTML = `<div class="print-container">${content}</div>`;

        printWindow.print();
        printWindow.close();
    });

    // Show modal that is not related to post-request
    $(document).on('click',".show-modal", function(){
        const target = $(this).data('target');
        $("#cashier_id").val('');
        $(target).modal('show');
    });
    $(document).on('click',".close-modal", function(){
       errorClean();
       $('.inputs').val('');
    });
})

function displayAlert(message, type = 'alert-danger') {
    let alertBox = $('.alert');

    alertBox
        .removeClass('alert-danger alert-success') 
        .addClass(type) // Add the new alert type
        .text(message) // Set the message
        .fadeIn(300) // Smoothly fade in
        .delay(3000) // Keep visible for 3 seconds
        .fadeOut(300, function() {
            $(this).text(''); // Clear text after fading out
        });
}