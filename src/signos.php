<?php

if(!isset($_POST['data_nascimento'])) header('Location: /');

setlocale(LC_TIME, 'portuguese'); 
date_default_timezone_set('America/Sao_Paulo');

$signos = simplexml_load_file('infos_signos.xml');
$data_aniversario = date('m-d', strtotime($_POST['data_nascimento']));

$signo_atual;
 
foreach($signos as $signo){
    $data_inicio_signo = (string) $signo->dataInicio;
    $data_fim_signo = (string) $signo->dataFim;

    if($data_aniversario >= $data_inicio_signo && $data_aniversario <= $data_fim_signo) {
        $signo_atual = $signo;
        break;
    };
}

$data_inicio_signo = new DateTime('1900-' . $signo_atual->dataInicio);
$data_fim_signo = new DateTime('1900-' . $signo_atual->dataFim);

?>

<!DOCTYPE html>
<html lang="en" class="h-100">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<!-- CSS only -->
		<link
			href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
			rel="stylesheet"
			integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT"
			crossorigin="anonymous"
		/>
		<style>
			main {
				max-width: 900px;
			}
		</style>
		<title>Seu signo é: <?= $signo_atual->signoNome ?></title>
	</head>
	<body class="text-center h-100">
		<main class="form-signin w-100 m-auto my-5 px-5">
			<div class="jumbotron">
				<h1 class="display-4"><?= $signo_atual->signoNome ?></h1>
				<h2 class="display-6 text-muted"><?= $data_inicio_signo->format('d \d\e M') ?> - <?= $data_fim_signo->format('d \d\e M') ?></h2>
				<p class="lead">
                <?= $signo_atual->descricao ?>
				</p>
				<hr class="my-4" />
				<p>Clique no botão abaixo para voltar ao formulário.</p>
				<p class="lead">
					<a
						class="btn btn-primary btn-lg"
						href="/"
						role="button"
						>Voltar</a
					>
				</p>
			</div>
		</main>
	</body>
</html>
