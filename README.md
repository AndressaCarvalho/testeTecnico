# API PHP para Gerenciamento e Administração de Bicicletas
Esta API, desenvolvida na linguagem de programação PHP, tem por objetivo fornecer endpoints (operações CRUD) para gerenciar e administrar informações referentes à bicicletas em geral (descrição e valor). O banco de dados utilizado é o MySQL, e a estrutura organizacional segue o modelo MVC, que separa a lógica e a apresentação de maneira consistente e dinâmica, facilitando a manutenção do projeto.



# Execução
Para que o código fosse executado, e assim, testado adequadamente, foram utilizados o servidor HTTP Apache, e a ferramenta para teste de serviços RESTful Postman.


Com o objetivo de fazer com que banco de dados "db_teste_tecnico" seja criado rapidamente, o diretório "db" possui um arquivo SQL com os registros e as estruturas de tabelas. Assim, serão geradas informações fictícias na "tb_bicicleta".


Com as ferramentas e o banco devidamente configurados, é possível então realizar operações HTTP. As rotas definidas para a API são:

/testeTecnico/Bike [GET]: Retorna todas as bicicletas.

/testeTecnico/Bike?id={id} [GET]: Retorna uma bicicleta por ID.

/testeTecnico/Bike [POST]: Adiciona uma nova bicicleta no banco de dados. Requer os parâmetros $ _POST 'descricao' e 'valor'.

/testeTecnico/Bike {id} [PUT]: Atualiza uma bicicleta por ID. Requer os parâmetros $ _POST 'descricao' e 'valor'.

/testeTecnico/Bike?id={id} [PATCH]: Atualiza uma bicicleta por ID. Pode receber os parâmetros $ _POST 'descricao' e 'valor'.

/testeTecnico/Bike?id={id} [DELETE]: Deleta uma bicicleta por ID.



# Exemplos
[GET] /testeTecnico/Bike: Retorna sucesso igual a 1, e os dados do ID, da descrição, e do valor pertencentes às bicicletas. Também pode ser retornada a mensagem "Nenhuma bicicleta encontrada!", caso aplicável.

[GET] /testeTecnico/Bike?id=5: Retorna sucesso igual a 1, e os dados do ID, da descrição, e do valor pertencentes à bicicleta de ID 5. Também pode ser retornada a mensagem "Nenhuma bicicleta encontrada!", caso aplicável.

[POST] /testeTecnico/Bike {"descricao":"BICICLETA PARA TRILHA LEVE","valor":"595"}: Retorna sucesso igual a 1, o ID da bicicleta inserida, e a mensagem "Bicicleta inserida!".

[PUT] /testeTecnico/Bike?id=5 {"descricao":"BICICLETA PARA TRILHA PESADA","valor":"615"}: Retorna sucesso igual a 1, o ID da bicicleta atualizada, e a mensagem "Bicicleta completamente atualizada!".

[PATCH] /testeTecnico/Bike?id=5 {"valor":"620"}: Retorna sucesso igual a 1, o ID da bicicleta atualizada, e a mensagem "Bicicleta atualizada!".

[DELETE] /testeTecnico/Bike?id=5: Retorna sucesso igual a 1, o ID da bicicleta deletada, e a mensagem "Bicicleta deletada!".


Observação: No diretório "db" existe uma arquivo JSON que pode ser usado para aplicação de testes em requests HTTP.



# Implementações Futuras
Para que a referida API PHP possa ser implementada em um ambiente produtivo, é necessário que o banco de dados se torne mais robusto, contendo outras informações pertinentes ao produto "bicicleta". Além disso, investir em mais testes automatizados traria mais facilidade, eficiência e agilidade para que as funcionalidades do sistema sejam avaliadas.



# Referências
API REST com PHP: https://youtu.be/pa6QwLWG12Q

How To Create A Simple REST API in PHP? Step By Step Guide! https://codeofaninja.com/2017/02/create-simple-rest-api-in-php.html

Identificar e pegar variáveis PUT e DELETE: https://pt.stackoverflow.com/questions/172109/identificar-e-pegar-vari%c3%a1veis-put-e-delete

POSTMAN para testes em API's de maneira simples!!.. https://youtu.be/LVVTD4fO-vw
