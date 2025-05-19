<?php

// Função para conexão com o banco de dados

function conectarBD() {  
    // Definição das variáveis de conexão ao banco de dados
    $host = 'localhost';  // Define o endereço do servidor do banco de dados. Aqui, 'localhost' indica que o banco está rodando na mesma máquina.
    $dbname = 'sistema_perfis_pro';  // Nome do banco de dados ao qual queremos nos conectar.
    $user = 'root';  // Nome de usuário do banco de dados. Aqui, 'root' é o usuário padrão do MySQL em ambientes locais.
    $pass = 'Senai@118';  // Senha do usuário para acessar o banco de dados.

    try {  
        // Tenta estabelecer a conexão com o banco de dados usando a classe PDO (PHP Data Objects)
        /**
         * PDO (PHP Data Objects) é uma extensão do PHP que fornece uma interface uniforme para acessar bancos de dados.
         * Ele suporta diversos bancos (MySQL, PostgreSQL, SQLite, etc.), permitindo maior portabilidade do código.
         *
         * Vantagens do PDO:
         * ✅ Suporte a múltiplos bancos de dados.
         * ✅ Segurança contra SQL Injection com Prepared Statements.
         * ✅ Tratamento de erros aprimorado com exceções.
         * ✅ Suporte a transações para garantir integridade dos dados.
         */
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
        // A string de conexão utiliza o driver MySQL, define o host, o nome do banco e o conjunto de caracteres como utf8mb4.

        // Configura a conexão para lançar exceções em caso de erro
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // O atributo ERRMODE_EXCEPTION faz com que erros na conexão ou nas queries disparem exceções, facilitando a depuração.

        // Define o modo padrão de busca dos dados como FETCH_ASSOC
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        // Isso significa que os resultados das consultas ao banco serão retornados como arrays associativos, onde os índices são os nomes das colunas.

        return $conn;  // Retorna o objeto de conexão para que possa ser utilizado em outras partes do código.
    
    } catch (PDOException $e) {  // Captura erros que possam ocorrer durante a tentativa de conexão.
        die("Erro na conexão: " . $e->getMessage());  
        // Se ocorrer um erro, a execução do script é interrompida e exibe a mensagem de erro específica.
    }
}
