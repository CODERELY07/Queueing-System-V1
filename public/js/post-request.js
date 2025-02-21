$(document).ready(function(){
    //add csrf token to all the request
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //display and debug error function
    function errorHandler(xhr, status, error){
        console.log("Error Details: " + status + error + xhr.responseText);
                
        //display errors
        if (xhr.status === 422) {
            let errors = xhr.responseJSON.errors;

            for (let field in errors) {
                $('#' + field + '-error').html(errors[field].join('<br>'));
            }
        } else {
            $('.errors').text('Something went wrong. Please try again later.');
        }
    }

    // remove display errors
    function errorClean(){
        $('.errors').html('');
        $('.alert').removeClass('alert-danger').text('');
        $('.inputs').val('');
    }

    //get client Queue Data
    $('#clientForm').on('submit', function(e){
        e.preventDefault();
        let name = $(`#name`).val();
        const url = $(this).data('url');   
        $.ajax({
            url: url,
            method: 'POST',
            data:{
                name: name,
            },
            success: function(data){
                $('.modal-body').append(`
                <p class="text-center text-medium">${data.transactionNumber} </p> 
                <p class="text-secondary text-center">${data.name} </p>`);
                $('#transactionData').modal('show');
                errorClean();
            },
            error: function(xhr, status, error){
                errorHandler(xhr,status,error);
            }
        })
    });

    // Login 
    $('#loginForm').on('submit', function(e){
        e.preventDefault();

        const url = $(this).data('url');
        const formData = new FormData(this);
    
        $.ajax({
            url: url,
            method: 'POST',
            data: formData,
            contentType:false,
            processData: false,
            success: function(response){
                console.log("hi")
                if(response.success){
                    errorClean();
                    window.location.href = response.redirectUrl;
                }else{
                    errorClean();
                    $('.alert').addClass('alert-danger').text(response.error);
                }
            },
            error: function(xhr,status,error){
                errorHandler(xhr, status, error);
            }
        })
    })

})
