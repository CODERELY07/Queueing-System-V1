<x-app-layout>
    <x-slot name="header">
        <h2 class="p-3">
            {{ __('Queue - Client Registration') }}
        </h2>
    </x-slot>

    <div class="p-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container mx-auto p-6">
                    <h1 class="text-2xl font-bold">Welcome to Queuing System</h1>
                    <p>Please Input your name.</p>
                    <form id="clientForm">
                        @csrf
                        <div class="mb-3">
                            <label for="name">Name:</label>
                            <input type="text" class="inputs form-control" name="name" id="name">
                            <div id="name-error" class="errors"></div>
                        </div>
                        <div class="mb-3">
                            <input type="submit" class="btn btn-primary show-modal"  value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
     {{-- Modal --}}
    <div class="modal fade " id="transactionData" tabindex="-1" aria-labelledby="transactionDataLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="transactionDataLabel">Your Queue</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="printClientQueue">
                
            </div>
            <div class="modal-footer">
            <button type="button" id="printBtn" class="btn btn-success">Print</button>
            </div>
        </div>
        </div>
    </div>
    @section('scripts')
        <script>
            $(document).ready(function(){
                //add csrf token to all the request
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                //get client Queue Data
                $('#clientForm').on('submit', function(e){
                    e.preventDefault();
                    let name = $(`#name`).val();
                    const url = "{{route('get.store.name')}}"   
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
                            $('.errors').html('');
                            $('.inputs').val('');
                        },
                        error: function(xhr, status, error){
                            console.log("Error Details: " + status + error + xhr.responseText);
                           
                            //display errors
                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON.errors;
                                let errorMessages = '';

                                for (let field in errors) {
                                    $('#' + field + '-error').html(errors[field].join('<br>'));
                                }
                            } else {
                                $('.errors').text('Something went wrong. Please try again later.');
                            }
                        }
                    })
                });

                $(`#printBtn`).click(function(){
                    var content = $(`#printClientQueue`).html();
                    
                    var printWindow = window.open("", "", "width=816,height=1056");

                    var styles = `
                        <style>
                            @page {
                            size: 5.5in 8.5in landscape; 
                                margin: 0;
                            }
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

               
            })
        </script>
    @endsection
</x-app-layout>

