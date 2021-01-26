<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends AbstractController
{

    public function index(): Response
    {
        if(!empty($_POST)){

            $safe = array_map('trim', array_map('strip_tags', $_POST));

                $input = $safe['input'];

    
                $ch = curl_init();

                curl_setopt($ch,CURLOPT_URL,'https://rolz.org/api/?'.$input.'.json');
                curl_setopt($ch,CURLOPT_RETURNTRANSFER, true );  
                curl_setopt($ch,CURLOPT_FOLLOWLOCATION, true ); 
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
           
                $response = curl_exec($ch);
                curl_close($ch);
                
                $rolz = json_decode($response, true);
                
        }

        return $this->render('api/index.html.twig', [
            'input' => $rolz ?? null ,
        ]);
    }
}
