<?php

namespace App;

use App\Agenda;

class ClientRepository
{
    
    /**
     * retorna todos os registros
     * @author Cassio Dal Castel Lorenzett
     * @return JSON
     */
    public function All()
    {
        return Agenda::all();
    }


    /**
     * Pesquisa um registro
     * @author Cassio Dal Castel Lorenzett
     * @param $id
     * @return JSON
     */
    public function Find($id)
    {
        return Agenda::find($id);
    }

    /**
     * Pesquisa registro via Between na coluna especificada
     * @author Cassio Dal Castel Lorenzett
     * @param $namecol
     * @param $param
     * @return JSON
     */
    public function WhereBetween($namecol="",$param=[])
    {
        return Agenda::whereBetween($namecol,$param)->get();
    }

    /**
     * Deleta um registro
     * @author Cassio Dal Castel Lorenzett
     * @param $id
     * @return JSON
     */
    public function Deleta($id)
    {
        $msg = ["message"=>"Nenhuma Agenda foi identificada para a exclusao !"];
        $agenda = self::Find($id);
        
        if($agenda){
            $agenda->delete();
            $msg = ["message"=>"Exclusao efetuada com sucesso !"];
        }

        return $msg;
    }

    /**
     * Insere no bganco um registro/agenda
     * @author Cassio Dal Castel Lorenzett
     * @param $agenda
     * @return JSON
     */
    public function Create($agenda)
    {
        return Agenda::create($agenda);
    }


    /**
     * Filtra a data inicial na base
     * @author Cassio Dal Castel Lorenzett
     * @param $data
     * @return JSON
     */
    public function Filtro($data)
    {
        return Agenda::whereRaw("datainicio = ? ",array($data))->get();
    }

}