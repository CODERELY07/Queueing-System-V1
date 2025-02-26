<?php 
    
    // Make the response ok for the client side no error found in the console
    function failsReponse200($validator){
    if($validator->fails()){
        return response()->json([
            'success' => false,
            'errors' => $validator->errors(),
            'status' => 200
        ], 200);
    }
}

