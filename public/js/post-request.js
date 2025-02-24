
$(document).ready(function(){
    // TODO:: Make this more short but readbable
    // Add CSRF token to all requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Client Queue form submission
    $('#clientForm').on('submit', function(e){
        
        e.preventDefault();
        errorClean();
        let name = $('#name').val();
        const url = $(this).data('url');   
        $.ajax({
            url: url,
            method: 'POST',
            data:{
                name: name,
            },
            success: function(data){
                $('.modal-body').append(`
                    <p class="text-center text-medium">${data.transactionNumber}</p>
                    <p class="text-secondary text-center">${data.name}</p>
                `);
                $('#transactionData').modal('show');
                errorClean();
            },
            error: function(xhr, status, error){
                errorHandler(xhr, status, error);
            }
        });
    });

    // Login form submission
    $('#loginForm').on('submit', function(e){
        e.preventDefault();
        const url = $(this).data('url');
        const formData = new FormData(this);
    
        $.ajax({
            url: url,
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response){
                if(response.success){
                    errorClean();
                    window.location.href = response.redirectUrl;
                } else {
                    errorClean();
                    $('.alert').addClass('alert-danger').text(response.error);
                }
            },
            error: function(xhr, status, error){
                errorHandler(xhr, status, error);
            }
        });
    });

    // Listens for 'CashierLogStatus' on 'cashier-status' channel and updates cashier data in real-time.
    if(window.Echo){
        // console.log("Echo is initialized...");
        window.Echo.channel('cashier-status')
    .listen('CashierLogStatus', function(data) { 
        console.log('Received event:', data);
        loadCashier();
    });
    } else {
        console.error("Echo is not available!");
    }
    
    //logout also trigger the cashierLogStatus event
    $('#logout').on('click', function(){
        const url = $(this).data('url');
        $.ajax({
            url: url,
            method: 'POST',
            success: function(data){
                window.location.href = data.redirectUrl;
            },
            error: function(xhr, status, error){
                console.error('Logout error:', error);
            }
        });
    });
    
    //create and update cashier List
    $("#cashierForm").submit(function(e){
        e.preventDefault();
        errorClean();
        let id = $("#cashier_id").val();
        let url = id ? `/admin/cashier-list/${id}` : '/admin/cashier-list';
        let method = id ? 'PUT' : 'POST';
        
        $.ajax({
            url: url,
            method: method,
            data: {
                name: $("#name").val(),
                password: $("#password").val(),
            },
            success: function(){
                $("#cashierForm")[0].reset();
                $("#cashier_id").val('');
                errorClean();
                loadCashier(); 
            },
            error: function(xhr, status, error){
                errorHandler(xhr, status, error);
                
            }
        });
    });

    // Function to load cashier list
    function loadCashier(){
        $.get('/admin/cashier-list', function(cashiers){
            let rows = '';
            $.each(cashiers, function(index, cashier){
                rows += `<tr>
                    <td>${cashier.name}</td>
                    <td>${cashier.log_status}</td>
                    <td>${cashier.status}</td>
                    <td>
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Action
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item edit" data-id="${cashier.id}">Edit</a></li>
                            <li><a class="dropdown-item delete" data-id="${cashier.id}">Delete</a></li>
                        </ul>
                    </td>
                </tr>`;
            });
            $("#cashierTableList").html(rows);
        });
    }

    // Delete cashierList
    $(document).on('click', '.delete', function(){
        errorClean();
        let id = $(this).data('id');
        $.ajax({
            url: `/admin/cashier-list/${id}`,
            method: 'DELETE',
            success: function(){
                loadCashier();
            },
            error: function(xhr, status, error){
                errorHandler(xhr, status, error);
            }
        });
    });

    // Edit cashierList
    $(document).on('click', '.edit', function(){
        errorClean();
        $('#cashierModalPopUp').modal('show');
        let id = $(this).data('id');
        $.get(`/admin/cashier-list/${id}`, function(cashier){
            $('#cashier_id').val(cashier.id);
            $('#name').val(cashier.name);
        });
    });

    loadCashier();
});
