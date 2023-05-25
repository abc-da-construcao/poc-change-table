<?php

namespace App\Http\Controllers;

use App\Services\PedidoService;
use App\Services\ClienteService;
use App\Services\EnderecoClienteService;
use App\Services\ChangeTrackingService;

class PedidoController extends Controller {

    public function index() {
        try {
            //Busco na tabela de configurações a ultima versão que utilizamos
            $lastVersion = ChangeTrackingService::getLastVersionControle(PedidoService::NOME_CONFIGURACOES);

            //Busco a última versão do change tracking do SQL Server
            $updateVersion = ChangeTrackingService::getLastVersionTrackingTable();

            //busco as ultimas alteraçẽos no ERP
            $pedidosTrackingERP = PedidoService::getLastChagingTrackingERP($lastVersion);

            $chunks = array_chunk($pedidosTrackingERP, 500);

            $clientes = [];
            $enderecoCliente = [];
            foreach ($chunks as $chunk) {
                foreach ($chunk as $key => $value) {
                    $clientes[$key] = [
                        'cpf_cnpj' => $value['cpf_cnpj'],
                        'nome' => $value['nome_cliente'],
                        'razao_social' => $value['razaocli'],
                        'inscricao_estadual' => $value['inscli'],
                        'email' => $value['email_cliente'],
                        'celular' => $value['telecli'],
                    ];

                    $enderecoCliente[$key] = [
                        'cpf_cnpj' => $value['cpf_cnpj'],
                        'logradouro' => $value['endercli'],
                        'numero' => $value['NumClie'],
                        'bairro' => $value['bairrcli'],
                        'cidade' => $value['cidadcli'],
                        'cep' => $value['cepcli'],
                        'uf' => $value['estcli'],
                        'complemento' => $value['COMPLCLI'],
                        'contato' => $value['contato'],
                    ];

                    //remover os campos que não existem na tabela de pedido
                    unset($chunk[$key]['nome_cliente']);
                    unset($chunk[$key]['email_cliente']);

                }//FIM FOREACH CHUNCK INTERNO

                /* add/update na tabela "espelho" */
                ClienteService::flushClientes($clientes);

                //add/update na tabela "espelho"
                EnderecoClienteService::flushEndereco($enderecoCliente);

                //add/update na tabela "espelho"
                PedidoService::flushPediCliCad($chunk);
            }//FIM FOREACH CHUNK EXTERNO

            /* atualiza na tabela de configurações */
            ChangeTrackingService::updateLastTrackingTable($updateVersion, PedidoService::NOME_CONFIGURACOES);

            dump('Last Execution: ' . (new \DateTime())->format('Y-m-d H:i:s'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
