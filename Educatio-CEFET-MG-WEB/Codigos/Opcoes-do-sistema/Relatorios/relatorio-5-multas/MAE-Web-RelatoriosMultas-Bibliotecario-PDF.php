<?php

  /*
  Grupo:​ ​ MAE
    Data​ ​ de​ ​ modificação:​ ​ 09/10/2017
    Autor:​ ​ Allan Barbosa
​ ​ ​ ​ ​ ​ ​ ​ ​Objetivo​ ​ da​ ​ modificação:​ Criação do script da impressão via pdf dos relatórios de multas

  */

//Inclui a biblioteca do MPDF
include("../../../../Estaticos/mpdf60/mpdf.php");

// Cria conexão

$conn = new mysqli("localhost", "root", "usbw","educatio");
// Checa conexão

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$multaAluno = array(0);
$podeImprimir = 0;

//recebe via POST o Id do aluno a ser pesquisado,se não tiver nada no input ele manda o pdf com TODAS as multas
if (!empty($_POST["nomeAlunoPesquisa"])) {
  $nomeAluno = $_POST["nomeAlunoPesquisa"];


  //seleciona o ID do aluno pelo seu nome
  $stmt = $conn->prepare("SELECT idCPF FROM alunos WHERE nome = ?");
  $stmt->bind_param('s', $nomeAluno);
  $stmt->execute();
  $rst = $stmt->get_result();

  while($row = $rst->fetch_assoc()){
    $idAluno = $row['idCPF'];
  }

  //seleciona a multa pelo ID do aluno
  $stmt = $conn->prepare("SELECT multa FROM emprestimos WHERE idAluno = ?");
  $stmt->bind_param('s', $idAluno);
  $stmt->execute();
  $rst = $stmt->get_result();

  while($row = $rst->fetch_assoc()){
    $multaAluno[] = $row['multa'];
    
  }

  if( $multaAluno[0] == 0){
  echo "<script>
             alert('Este aluno não possui nenhuma multa!');
             location.href = '../../../Entrada/gerencia-web-interface-bibliotecario.php?acao=acessarMultas';
          </script>";
  }else {$podeImprimir = 1;}

}
else {
  //seleciona as multa e o ID do aluno
  $sql = "SELECT multa,idAluno FROM emprestimos ";
  $rst = mysqli_query($conn, $sql);

  while($row = mysqli_fetch_assoc($rst) ){
    $multaAluno[] = $row['multa'];
    $idAluno= $row['idAluno'];
  }

  //seleciona o nome pelo id aluno correspondente  
  // $stmt = $conn->prepare("SELECT nome FROM alunos WHERE idCPF = ?");
  // $stmt->bind_param('s', $idAluno);
  // $stmt->execute();
  // $rst = $stmt->get_result();

  // while($row = $rst->fetch_assoc()){
  //   $nomeAluno = $row['nome'];
  // }
  $sql = "SELECT nome FROM alunos WHERE idCPF = '$idAluno'";
  $rst = mysqli_query($conn, $sql);

  while($row = mysqli_fetch_assoc($rst) ){
    $nomeAluno = $row['nome'];
  }

  if( $multaAluno[0] == 0){
  echo "<script>
             alert('Não há nenhuma multa!');
             location.href = '../../../Entrada/gerencia-web-interface-bibliotecario.php?acao=acessarMultas';
          </script>";
  }else {$podeImprimir = 1;}
}

if($podeImprimir == 1){
    $html = "<!DOCTYPE html>
              <html lang='pt-br'>
                <head>
                </head>
                  <body>
                    <h3> Relatorio de Multas <h3>
                     <table>
                        <tr>
                          <th>Nome do aluno</th>
                          <th>Id do aluno</th>
                          <th>Multas</th>
                        </tr>";
                //laco que pega todas as multas do aluno
                foreach ($multaAluno as $multas) {
    $html .=            "<tr>
                            <td>". $nomeAluno ."</td>
                            <td>". $idAluno ."</td>
                            <td>". $multas ."</td>
                         </tr>";
                }
    $html .=          "</table>
                      </body>
                     </html>";

    $dataAtual = date("d-m-y"); //cria a Data da geração do arquivo
    $nomeDoArquivo = "Relatorio de multas (" .$dataAtual. ").pdf"; //cria nome do arquivo de acordo com a data atual

    $mpdf = new mPDF();
    $stylesheet = file_get_contents('../css/tabelaPDF.css'); // css da tabela
    $mpdf->WriteHTML($stylesheet,1);

    $mpdf -> SetTitle($nomeDoArquivo);
    $mpdf -> SetDisplayMode('fullpage');
    $mpdf -> WriteHTML($html);

    $mpdf -> Output($nomeDoArquivo, 'D');
}

?>
