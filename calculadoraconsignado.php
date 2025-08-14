<?php
// Quando o formulário for enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Função para converter vírgula em ponto
    function moedaParaFloat($valor) {
        $valor = str_replace('.', '', $valor); // remove separador de milhar
        $valor = str_replace(',', '.', $valor); // troca vírgula por ponto
        return floatval($valor);
    }

    $parcela = moedaParaFloat($_POST["parcela"]);
    $saldodevedor = moedaParaFloat($_POST["saldodevedor"]);
    $desconto = moedaParaFloat($_POST["desconto"]);
    $comissaoesc = moedaParaFloat($_POST["comissaoesc"]);

    $novosaldo = $parcela / 0.02;
    $saldosubtracao = $novosaldo - $saldodevedor - $desconto;
    $investidor = $saldodevedor * 0.10;
    $gerente = $saldosubtracao * 0.15;
    $valorgeral = $saldosubtracao - $investidor - $gerente;
    $oferta = $valorgeral - $comissaoesc;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Calculadora de Comissão</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { max-width: 400px; margin: auto; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input { width: 100%; padding: 8px; margin-top: 4px; }
        button { margin-top: 15px; padding: 10px; width: 100%; background: #28a745; color: white; border: none; cursor: pointer; }
        button:hover { background: #218838; }
        .resultado { margin-top: 20px; padding: 15px; background: #f1f1f1; border-radius: 5px; }
    </style>
</head>
<body>

<h1>Calculadora de Comissão</h1>

<form method="post">
    <label>Valor da Parcela</label>
    <input type="text" name="parcela" required placeholder="Ex: 1.157,55">

    <label>Saldo Devedor</label>
    <input type="text" name="saldodevedor" required placeholder="Ex: 20.000,00">

    <label>Valor a Descontar</label>
    <input type="text" name="desconto" required placeholder="Ex: 1.000,00">

    <label>Comissão Final do Escritório</label>
    <input type="text" name="comissaoesc" required placeholder="Ex: 500,00">

    <button type="submit">Calcular</button>
</form>

<?php if (!empty($oferta)): ?>
<div class="resultado">
    <h2>Resultado</h2>
    <p><strong>Valor da Parcela:</strong> R$ <?= number_format($parcela, 2, ',', '.') ?></p>
    <p><strong>Comissão do Investidor:</strong> R$ <?= number_format($investidor, 2, ',', '.') ?></p>
    <p><strong>Valor Geral Líquido:</strong> R$ <?= number_format($valorgeral, 2, ',', '.') ?></p>
    <p><strong>Comissão do Escritório:</strong> R$ <?= number_format($comissaoesc, 2, ',', '.') ?></p>
    <p><strong>Valor para Oferecer ao Cliente:</strong> R$ <?= number_format($oferta, 2, ',', '.') ?></p>
</div>
<?php endif; ?>

</body>
</html>
