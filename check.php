<?php
   
    if(isset($_GET['date']) && !empty($_GET['date']) && isset($_GET['email']) && !empty($_GET['email'])){
        
        $date  = explode('/',$_GET['date']);
        $day   = $date[0];
        $month = $date[1]; 
        $year  = $date[2]; 

        $current_server_month = date('m');
        $current_server_day   = date('d');
        $current_server_year   = date('Y');

        $invalide_date = false;

        if($month < $current_server_month || $month > $current_server_month){
            $invalide_date = true;
        }

        if($year < $current_server_year || $year > $current_server_year){
            $invalide_date = true;
        }
        
        if($invalide_date == true){
            echo json_encode(['success'=>false,'data'=>[],'message'=> 'Veuillez mettre à jour la date']);
        }else{

            $token = password_hash(time(), PASSWORD_DEFAULT);

            $file_name = $_GET['email'].'.txt';

            file_put_contents($file_name,$token);

            echo json_encode(['success'=>true,'data'=>[
                'token'=>$token,
                'day'=>$current_server_day,
                'month'=>$current_server_month,
                'year'=> $current_server_year
            ]]);            
        }
    }else{
        echo json_encode(['success'=>false,'data'=>[],'message'=>'Erreur survenue']); 
    }   
   
?>