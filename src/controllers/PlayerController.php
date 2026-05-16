<?php
require_once __DIR__ . '/../service/PlayerService.php';
class PlayerController{
    
    public function registerPlayer(){
        $json = file_get_contents('php://input');
        $service = new PlayerService();
        $data = json_decode($json,true);
        $service->createPlayer($data);

        header('Content-Type: application/json');
        print_r($data);


    }
    public function updatePlayer(){
        //recebendo apenas os meta dados
        echo"Updating Player request";
        $json = file_get_contents('php://input');
        $service = new PlayerService();
        $data = json_decode($json,true);
       // $service->updateDataPlayer($data);
        print_r($data);

       // header('Content-Type: application/json');
       // print_r($data);


    }
    public function showAllPlayers(){
        $json = file_get_contents('php://input');
        $data = json_decode($json,true);

        
        /*$service =new  ContentFilesService();
        $service->deleteFile($mediaFiles);*/
        header('Content-Type: application/json');
        echo json_encode(["status" => "success", "received" => $data]);
        
        

    }
}