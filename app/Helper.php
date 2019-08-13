<?php

namespace App;

use App\ClientRepository;

class Helper
{


    /**
     * validacoes para inclusao e alteracao de agendas
     * @author Cassio Dal Castel Lorenzett
     * @param $date
     * @return boolean|STRING
     */
    public function valid($dateini,$datefinal,$dateprazo,$inclusao) {

        if(!self::isweek($dateini)){
            if(!self::isweek($datefinal)){
                if(!self::isweek($dateprazo)){
                    
                    if (!$inclusao){ //se for alteracao 
                        return array(true,"");
                    }

                    $client = new ClientRepository();
                    if (count($client->Filtro($dateini)) > 0){
                        return array(false,"Ja existe um agendamento para a data inicial ".date('d/m/Y',strtotime($dateini)));
                    }else{
                        return array(true,"");
                    }
                    
                }else{
                    return array(false,"Data Prazo nao pode ser final de semana !");
                }

            }else{
                return array(false,"Data Conclusao nao pode ser final de semana !");
            }

        }else{
            return array(false,"Data Inicial nao pode ser final de semana !");
        }


    }


    /**
     * Valida se data passada Ã© final de semana
     * @author Cassio Dal Castel Lorenzett
     * @param $date
     * @return boolean
     */
    private function isweek($date) {
        $weekDay = date('w', strtotime($date));
        return ($weekDay == 0 || $weekDay == 6);
          
    }


    
    /**
     * Transforma a data passada no padroa DD/MM/YYYY para YYYYMMDD
     * @author Cassio Dal Castel Lorenzett
     * @param $date
     * @return STRING
     */
    public function FormatDate($date){
        $date = str_replace("/","-",trim($date));
        return date('Ymd', strtotime($date));
    }

}