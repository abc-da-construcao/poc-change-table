<?php

namespace App\Services;

use App\Models\EnderecosClientes;

class EnderecoClienteService {

    /**
     * inserir/update os dados de endereços do clientes
     */
    public static function flushEndereco($dados) {

        EnderecosClientes::upsert(
                $dados,
                ['numped', 'filial', 'cpf_cnpj'],
                [
                    "numped",
                    "filial",
                    "cpf_cnpj",
                    "logradouro",
                    "numero",
                    "bairro",
                    "cidade",
                    "cep",
                    "uf",
                    "complemento",
                    "contato",
                ]
        );
    }

}
