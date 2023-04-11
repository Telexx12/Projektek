<?php

use App\Imports\OTPImport;

if(!function_exists('importHandler')){
        function importHandler($account){

            switch($account->bank->import_class){
                case 'OTPImport':
                    return new OTPImport($account->id);
                    break;



            }

        }
    }


?>
