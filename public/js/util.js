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
})