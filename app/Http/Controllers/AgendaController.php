<?php

namespace App\Http\Controllers;

use App\Agenda;
use App\Helper;
use App\ClientRepository;
use Illuminate\Http\Request;


class AgendaController extends Controller
{

    protected $user = null;
    
    public function __construct(ClientRepository $user)
    {
        $this->user = $user;
    }

    /**
     * Cria agenda 
     * @author Cassio Dal Castel Lorenzett
     * @param $request
     * @return JSON
     */
    public function create(Request $request)
    {
        $helper = new Helper();
        
        $this->validate($request, [
            'datainicio' => 'required|date|date_format:Ymd', //DATA NO FORMATO YYYYMMDD
            'dataprazo' => 'required|date|date_format:Ymd|after:datainicio', //DATA NO FORMATO YYYYMMDD
            'dataconclusao' => 'required|date|date_format:Ymd|after:datainicio', //DATA NO FORMATO YYYYMMDD
            'titulo' => 'required',
            'descricao' => 'required',
            'responsavel' => 'required',
            'status' => 'required'
        ]);

        $valid = $helper->valid($request->input('datainicio'), $request->input('dataconclusao'), $request->input('dataprazo'),true); 
        
        if ( !$valid[0] ){
            return response()->json(['message'=>$valid[1]]);
        }

        return response()->json($this->user->Create($request->all()));
    }


    /**
     * Atualiza uma agenda
     * @author Cassio Dal Castel Lorenzett
     * @param $request
     * @param $id
     * @return JSON
     */
    public function update($id,Request $request)
    {   
        $helper = new Helper();
        
        $this->validate($request, [
            'datainicio' => 'required|date|date_format:Ymd', //DATA NO FORMATO YYYYMMDD
            'dataprazo' => 'required|date|date_format:Ymd|after:datainicio', //DATA NO FORMATO YYYYMMDD
            'dataconclusao' => 'required|date|date_format:Ymd|after:datainicio', //DATA NO FORMATO YYYYMMDD
            'titulo' => 'required',
            'descricao' => 'required',
            'status' => 'required'
        ]);
        
        $valid = $helper->valid($request->input('datainicio'), $request->input('dataconclusao'), $request->input('dataprazo'),false); 
        
        if ( !$valid[0] ){
            return response()->json(['message'=>$valid[1]]);
        }

        $agenda= $this->user->Find($id);
        
        if ($agenda){
            $agenda->datainicio = $request->input('datainicio');
            $agenda->dataprazo = $request->input('dataprazo');
            $agenda->dataconclusao = $request->input('dataconclusao');
            $agenda->titulo = $request->input('titulo');
            $agenda->descricao = $request->input('descricao');
            $agenda->status = $request->input('status');
            
            $agenda->save();
        }else{
            $agenda = ["message"=>"Nenhuma informacao foi afetada para agenda referenciada !"];
        }
        
        return response()->json($agenda);
    }


    /**
     * deleta uma agenda 
     * @author Cassio Dal Castel Lorenzett
     * @param $id
     * @return STRING
     */
    public function deleta($id)
    {  
        return response()->json($this->user->Deleta($id));
    }

    /**
     * Retorna/visualiza uma agenda
     * @author Cassio Dal Castel Lorenzett
     * @param $id
     * @return JSON|STRING
     */
    public function show($id)
     {
        $agenda = $this->user->Find($id);
        
        if(!$agenda){
            $agenda = ["message"=>"Nenhuma Agenda foi identificada !"];
        }

        return response()->json($agenda);
     }

     /**
     * Retorna/visualiza todas as agendas
     * @author Cassio Dal Castel Lorenzett
     * @return JSON|STRING
     */
    public function showall()
    {   
        $result = $this->user->All();

        if (count($result) == 0){
            $result = ["message"=>"Nenhuma Agenda foi identificada !"];
        }
        return response()->json($result);
    }


     /**
     * Retorna/visualiza datas com base no filtro de datas
     * @author Cassio Dal Castel Lorenzett
     * @return JSON|STRING
     */
    public function showfilter(Request $request)
    {   
        $helper = new Helper();
        $msg = ["message"=>"Nenhuma agenda foi encontrada para o filtro executado!"];

        if ($request->datade && $request->dataate){
            $msg = $this->user->WhereBetween('datainicio', [$helper->FormatDate($request->datade),  $helper->FormatDate($request->dataate)]);
        
            if (count($msg) == 0){
                $msg = ["message"=>"Nenhuma agenda foi encontrada para o filtro executado!"];
            }
        }
        
        return response()->json($msg);
    }


}
