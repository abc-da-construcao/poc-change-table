<?php

namespace App\Http\Controllers\Plataforma;

use App\Http\Controllers\Controller;
use App\Services\Plataforma\TimestampService;
use App\Services\Plataforma\ClientesService;

class ClientesController extends Controller {

    public function clientes() {
        try {

            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersion = TimestampService::getTimeStampByConfiguracao(ClientesService::NOME_CONFIGURACOES);

            //Busco a última versão do timeStamp do banco
            $updateVersion = TimestampService::getTimeStampBanco();

            //busco as ultimas alteraçẽos na plataforma
            $clientesPlataforma = ClientesService::getDadosPlataforma($lastVersion);
            $chunks = array_chunk($clientesPlataforma, 500);

            $clientes = [];
            $lead = [];
            foreach ($chunks as $chunk) {
                foreach ($chunk as $value) {
                    if ($value['tipoRegistro'] == 'CLIENTE') {
                        $clientes[] = $value;
                    } else {
                        $lead[] = [
                            'idLeadMdm' => $value['idLeadMdm'],
                            'oid' => $value['plataforma_oid'],
                            'nome' => $value['plataforma_nome'],
                            'nasc' => $value['plataforma_nasc'],
                            'pessoa' => $value['plataforma_pessoa'],
                            'email' => $value['plataforma_email'],
                            'telefone' => $value['plataforma_telefone'],
                            'celular' => $value['plataforma_celular'],
                            'inscricao' => $value['plataforma_inscricao'],
                            'contribuinte_icms' => $value['plataforma_contribuinte_icms'],
                            'contato' => $value['plataforma_contato'],
                            'etapa' => $value['plataforma_etapa'],
                            'user_id' => $value['plataforma_user_id'],
                            'origem_id' => $value['plataforma_origem_id'],
                            'possui_especificador' => $value['plataforma_possui_especificador'],
                            'especificador_nome' => $value['plataforma_especificador_nome'],
                            'especificador_telefone' => $value['plataforma_especificador_telefone'],
                            'tipo_obra' => $value['plataforma_tipo_obra']
                        ];
                    }
                }
            }

            //add/update na tabela "espelho"
            ClientesService::flushClientes($clientes);
            ClientesService::flushLead($lead);

            /* atualiza na tabela de configurações */
            TimestampService::updateTimeStamp($updateVersion, ClientesService::NOME_CONFIGURACOES);

            dump('Last Execution: ' . (new \DateTime())->format('Y-m-d H:i:s'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
