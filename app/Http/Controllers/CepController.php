<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CepRepository;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class CepController extends Controller
{
    protected $cepRepository;

    /**
     * Método construtor da classe CepController
     * @param CepRepository $cepRepository Instância do Repository de CEP
     */
    public function __construct(CepRepository $cepRepository)
    {
        $this->cepRepository = $cepRepository;
    }

    /**
     * Método responsável por exibir a view com o formulário de para consulta e exportação de CEPs
     * @return View
     */
    public function showCepForm()
    {
        return view('cadastro_ceps');
    }

    /**
     * Método responsável por realizar a consulta de um ou mais CEPs
     * @param   Request     $request    Request com os dados de consulta do CEP
     * @return  View
     */
    public function consultaCeps(Request $request)
    {
        $inputCeps = $request->input('ceps');

        if(!strlen($inputCeps)) view('cadastro_ceps', ['resultados' => [], 'ceps' => $inputCeps]);

        $ceps       = explode(',', $inputCeps);
        $resultados = $this->cepRepository->consultarCeps($ceps);

        return view('cadastro_ceps', ['resultados' => $resultados, 'ceps' => $inputCeps]);
    }

    /**
     * Método responsável por realizar a exportação da lista de CEPs para um arquivo CSV
     * @param Request $reqeust Request com o campo de CEPs para exportação
     * @return void
     */
    public function exportarCsv(Request $request)
    {
        $csvData = "CEP,Logradouro,Bairro,Cidade,Estado\n";

        $inputCeps = json_decode($request->input('ceps_exportacao'),true);

        foreach ($inputCeps as $cep) {
            if (!empty($cep['cep'])) {
                $csvData .= "{$cep['cep']},{$cep['logradouro']},{$cep['bairro']},{$cep['localidade']},{$cep['uf']}\n";
            }
        }

        $filename = 'ceps-'.date('d-m-Y-H-i-s').'.csv';

        Storage::disk('local')->put($filename, $csvData);

        return Response::download(storage_path("app/{$filename}"));
    }
}
