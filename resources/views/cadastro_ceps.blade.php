<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de CEPs</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <div class="container">
        <h1>Consulta e exportação de CEPs</h1>
        <form action="/" method="POST">
            @csrf
            <label for="ceps">Lista de CEPs (separados por vírgula):</label>
            <textarea name="ceps" id="ceps" rows="5" cols="40" placeholder="Digite os CEPs aqui">{{ $ceps ?? '' }}</textarea>
            <button type="submit">Consultar</button>
        </form>

        @if(isset($resultados) && !empty($resultados))
        <h2>Resultados</h2>
        <table>
            <thead>
                <tr>
                    <th>CEP</th>
                    <th>Logradouro</th>
                    <th>Bairro</th>
                    <th>Cidade</th>
                    <th colspan="2">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($resultados as $resultado)
                <tr>
                    <td>{{ $resultado['cep'] }}</td>
                    <td>{{ $resultado['logradouro'] }}</td>
                    <td>{{ $resultado['bairro'] }}</td>
                    <td>{{ $resultado['localidade'] }}</td>
                    <td>{{ $resultado['uf'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <form action="/exportar-csv" method="POST">
            @csrf
            <input type="hidden" name="ceps_exportacao" value="{{ json_encode($resultados) }}">
            <button type="submit">Exportar para CSV</button>
        </form>

        <div class="container-button">
            <button id="limpar-resultados" class="btn-red btn-limpar">Limpar Resultados</button>
        </div>
        @endif

    </div>

    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>