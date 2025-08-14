<?php

define('COEFICIENTE', 0.02);

function lerFloat($mensagem) {
    echo $mensagem;
    $valor = trim(fgets(STDIN));
    if (!is_numeric($valor) || $valor < 0) {
        die("Valor inválido.\n");
    }
    return floatval($valor);
}

// Ler as entradas do usuário
$parcela = lerFloat("Qual é o valor da parcela? R$ ");
$saldodevedor = lerFloat("Qual o saldo devedor aproximado (Olhar no gestor ou no corban): ");

$novoSaldo = $parcela / COEFICIENTE;
$desconto = lerFloat("Digite o valor a descontar: R$");

// Calcular o valor base para a distribuição
$saldoSubtracao = $novoSaldo - $saldodevedor - $desconto;

// Perguntar sobre a agência e determinar a taxa do gerente
echo "A agência do cliente é DF? (sim/nao): ";
$resposta = trim(fgets(STDIN));

if (strtolower($resposta) == 'sim') {
    $taxaGerente = 0.15;
} else {
    $taxaGerente = 0.30;
}

// Calcular as comissões
$gerente = $saldoSubtracao * $taxaGerente;

// Calcular o valor geral líquido
$valorGeral = $saldoSubtracao - $gerente;

echo "Valor geral líquido R$ $valorGeral \n";

$comissaoEsc = lerFloat("Qual o valor de comissão final do escritório? R$");

$oferta = $valorGeral - $comissaoEsc;

// Exibir os resultados formatados
echo "\n--- Resultado ---\n";
echo "Valor da parcela: R$ " . number_format($parcela, 2, ',', '.') . "\n";
echo "Comissão gerente: R$ " . number_format($gerente, 2, ',', '.') . "\n";
echo "Comissão escritório: R$ " . number_format($comissaoEsc, 2, ',', '.') . "\n";
echo "Valor geral líquido: R$ " . number_format($valorGeral, 2, ',', '.') . "\n";
echo "Valor para oferecer ao cliente: R$ " . number_format($oferta, 2, ',', '.') . "\n";