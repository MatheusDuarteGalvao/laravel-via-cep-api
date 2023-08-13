# Consumo de API do ViaCEP com exportação de resultados

Um exemplo de consulta de API do ViaCep, retornando os resultados em uma tabela e com a possibilidade de exportar os resultados para CSV.

## Passo a passo para consulta

Basta digitar um ou mais CEPs (separados por vírgula), que os resultados serão retornados conforme o webservice da ViaCEP, tendo a possibilidade de exportar os arquivos ou limpar os resultados da busca para tornar mais fácil o manuseio da aplicação. Ao consultar os CEPs com sucesso, há a possiblidade de efetuar o download do arquivo .csv para consultas posteriores, apresentando as informações de CEP, Logradouro, Bairro, Cidade e UF.

## Validações consideradas

Com a finalidade de evitar erros na aplicação há alguns bloqueios com relação ao formulário, caso o usuário o envie sem nenhum dado, a página só será recarregada normalmente, evitando transtornos. Há também validações com relação ao retorno dos dados de cep, evitando erros ao adicionar as Views. Além disso, as tabelas só serão exibidas caso haja ao menos um cep válido na listagem, impedindo uma visualização da tabela de forma errônea.