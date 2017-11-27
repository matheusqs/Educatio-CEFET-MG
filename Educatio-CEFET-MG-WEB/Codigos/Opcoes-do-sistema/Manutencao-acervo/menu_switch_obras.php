<!DOCTYPE html>
<html>
<head>
	
	<!-- CSS do Bootstrap -->
	<link href="../../../Estaticos/Bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="../../../Estaticos/Bootstrap/css/bootstrap.css" rel="stylesheet"/>

	<!-- CSS do grupo -->
	 <link href="pagina_inicial.css" rel="stylesheet" />

	<!-- Arquivos js -->
	<script src="../../../Estaticos/Bootstrap/js/popper.js"></script>
	<script src="../../../Estaticos/Bootstrap/js/jquery-3.2.1.js" type="text/javascript"></script>
	<script src="../../../Estaticos/Bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

	<!-- Fontes e icones -->
	<link href="../../../Estaticos/Bootstrap/css/nucleo-icons.css" rel="stylesheet">
		<script type="text/javascript">

		function func1(){
			window.location.href="periodico.php?"
		}
		
		function func2(){
			window.location.href="midias.php?"
		}

		function func3(){
			window.location.href="livro.php?"
		}

		function func4(){
			window.location.href="acad.php?"
		}

		function func5(){
			window.location.href="../../Entrada/gerencia-web-interface-bibliotecario.php?acao=acessarManutencaoAcervo"
		}

	</script>


	<title></title>
</head>
<body>

	<div class="wrapper">
		<div class="title" style="text-align: center;">
			<h1><b>Manutenção de Acervo</b></h1>
		</div>
			<p id="p1">Crie, edite e exclua obras do acervo</p>
		<div class="container">
			
			<div class="row">
				<div class="col">
					<div class="card">
						<div class="card-body">	
							<h5 class="card-title">Crie um novo livro</h5>
							<button type="button" onclick="func3()" class="btn btn-neutral btn-lg">Criar Livro</button>
						</div>
					</div>
				</div>
                <div class="col">
					<div class="card">
						<div class="card-body">	
							<h5 class="card-title">Crie um novo academico</h5>
							<button type="button" onclick="func4()" class="btn btn-neutral btn-lg">Criar Academico</button>
						</div>
					</div>
				</div>
	
            </div>
            <div class="row"> 
                <div class="col">
					<div class="card">
						<div class="card-body">	
							<h5 class="card-title">Crie uma nova midia</h5>
							<button type="button"  onclick="func2()" class="btn btn-neutral btn-lg">Criar Midia</button>
						</div>
					</div>
				</div>
            
				<div class="col">
					<div class="card">
						<div class="card-body">	
							<h5 class="card-title">Crie um novo periodico</h5>
							<button type="button" onclick="func1()" class="btn btn-neutral btn-lg">Criar Periodico</button>
						</div>
					</div>
				</div>
			</div>
            <button id="voltar" class="btn btn-neutral" onclick="func5()">Voltar</button>
        </div>  
	</div>

</body>
</html>