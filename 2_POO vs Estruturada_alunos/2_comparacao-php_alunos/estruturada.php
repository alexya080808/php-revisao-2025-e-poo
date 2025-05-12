<?php
// ==========================================
// PARTE 1: PROGRAMAÇÃO ESTRUTURADA
// ==========================================
// 1ª Digitação (Aqui)
//Dados do primeiro cachorro
$nome_cachorro_1 = "Nelson";
$comida_cachorro_1 = 3;
$sono_cachorro_1 = False;

// Dados do segundo cachorro
$nome_cachorro_2 = "Jeremias";
$comida_cachorro_2 = 1;
$sono_cachorro_2 = true;

//Funções para manipular os dados

function comer($quantidade_comida) {
       return $quantidade_comida - 1;
}

function dormir() {
    return True;
}

// Usando as funções
$comida_cachorro_1 = comer($comida_cachorro_1);
$sono_cachorro_2 = dormir();

// Exibindo os resultados no terminal
//echo $nome_cachorro_1 . " agora tem " . $comida_cachorro_1 . " comidas sobrando ";
//echo "<br>";
//echo $nome_cachorro_2 . " está com sono? " . $sono_cachorro_2;

echo "<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Resultado dos cachorros</title>
</head>
<body>
    <h1>Resultado dos cachorros</h1>
    <p><strong>$nome_cachorro_1</strong> Agora tem <strong>$comida_cachorro_1</strong> Comidas sobrando </p>
    <p><strong>$nome_cachorro_2</strong> Está com sono?" . ($sono_cachorro_2 ? 'Sim' : 'Não') . "</strong> </p>
</body>
</html>";
?>

