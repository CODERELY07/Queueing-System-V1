// Display and debug error function
function errorHandler(xhr, status, error){
    $('.errors').html('');
    console.log("Error Details: " + status + error + xhr.responseText);
            
    // Display errors
    if (xhr.status === 422) {
        let errors = xhr.responseJSON.errors;
        for (let field in errors) {
            $('#' + field + '-error').html(errors[field].join('<br>'));
        }
    } else {
        $('.errors').text('Something went wrong. Please try again later.');
    }
}

// Remove displayed errors
function errorClean(){
    $('.errors').html('');
    $('.alert').removeClass('alert-danger').text('');
    $('.inputs').val('');
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
        $("#cashierForm")[0].reset();
        $("#cashier_id").val('');
       $(target).modal('show');
    });
})