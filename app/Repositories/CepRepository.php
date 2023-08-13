<?php

namespace App\Repositories;

class CepRepository
{

    /**
     * Método responsável por realizar a consulta dos ceps por meio da API da ViaCep
     * @param   array   $ceps   Array com os CEPs a serem consultados
     * @return  array           Array com as informações de cada cep consultado
     */
    public function consultarCeps(array $ceps)
    {
        $results = [];

        foreach ($ceps as $cep) {
            $cep = trim($cep);

            $url = "https://viacep.com.br/ws/{$cep}/json/";

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);

            $result = json_decode($response, true);

            if (!empty($result) && !array_key_exists('erro', $result)) {
                $results[] = $result;
            }
        }

        return $results;
    }
}
