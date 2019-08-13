<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AgendaTest extends TestCase
{
    /**
     * Teste para a aplicacao
     *
     * @return void
     */
    public function testExample()
    {
        $this->get('/api/agenda/1')
        ->seeJsonEquals([
           'message' => "Nenhuma Agenda foi identificada !",
        ]);

        $this->get('/api/agenda')
        ->seeJsonEquals([
           'message' => "Nenhuma agenda foi encontrada para o filtro executado!",
        ]);

        $this->get('/api/agenda?datade=20/08/2019&dataate=22/08/2019')
        ->seeJsonEquals([
           'message' => "Nenhuma agenda foi encontrada para o filtro executado!",
        ]);

        $this->delete('/api/agenda/123')
        ->seeJsonEquals([
           'message' => "Nenhuma Agenda foi identificada para a exclusao !",
        ]);

        $this->delete('/api/agenda/7')
        ->seeJsonEquals([
           'message' => "Exclusao efetuada com sucesso !",
        ]);
        
        $this->get('/api/agendaall')
        ->assertEquals(200,$this->response->status());

        $this->get('/api/agenda')
        ->assertEquals(200,$this->response->status());
       

    }
}
