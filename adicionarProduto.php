<?php 
    require "req/database.php";
    require "req/funcoesProduto.php";
    include "inc/head.php";
    include "inc/header.php";

    if($_POST){

        $nome = $_REQUEST['nome'];
        $descricao =  $_REQUEST['descricao'];
        $preco = $_REQUEST['preco'];
        $tag = $_REQUEST['tag'];
        $professor = $_REQUEST['professor'];
        $caminhoCompleto = '';
            
    if ($_FILES) {

        // verificando se não teve erro de upload 
        if ($_FILES["arquivo"]["error"] == UPLOAD_ERR_OK){
         // pegando o nome real do arquivo
         $nomeArquivo = $_FILES["arquivo"]["name"];
         // pegando o nome temporário do arquivo
         $nomeTemp = $_FILES["arquivo"]["tmp_name"];
         // pegando o caminnho até a pasta raiz
         $pastaRaiz = dirname(__FILE__);
         // selecionando a pasta para qual o arquivo será enviado
         $pastaDesejada = "\assets\img\produtos\\";
         // selecionando o caminho completo para ser utilizado na função move_uploaded_file
         $caminhoCompleto = $pastaRaiz . $pastaDesejada . $tag . ".png";
         // movendo o arquivo com a função move_uploaded_file
         move_uploaded_file($nomeTemp, $caminhoCompleto);
        }
     }

     $produto = [
         "nome"=> $nome,
         "descricao"=> $descricao,
         "preco"=> $preco,
         "tag"=> $tag,
         "professor"=> $professor,
         "imagem"=> $caminhoCompleto
     ];
      
     print_r($produto);
     $adicionou = adicionarProduto($produto);

    }




?>
    <div class="page-center">
        <h2>Cadastro de produto</h2>
        <!-- mostra a mensagem de erro caso a variável $erro esteja definida -->
        <?php if (isset($adicionou) && $adicionou) : ?>
            <div class="alert alert-success">
                <span>Produto adicionado com sucesso!</span>
            </div>
        <?php endif; ?>
        <form action="adicionarProduto.php" method="post" class="col-md-7" enctype="multipart/form-data">
           <div class="col-xs-12">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" name="nome" id="nome">
           </div>
           <div class="col-xs-12">
                <label for="descricao">Descrição</label>
                <textarea name="descricao" id="descricao" class="form-control"></textarea>
           </div>
           <div class="col-xs-12">
                <label for="preco">Preco</label>
                <input type="number" class="form-control" name="preco" id="preco">
           </div>
           <div class="col-xs-12">
                <label for="tag">tag</label>
                <input type="text" class="form-control" name="tag" id="tag">
           </div>
           <div class="col-xs-12">
                <label for="professor">Professor</label>
                <select name="professor" id="professor" class="col-xs-12 form-control">
                    <option disabled selected>Selectione um professor</option>
                    <option value="1">Thomaz</option>
                    <option value="2">Hendy</option>
                </select>
           </div>
           <div class="col-xs-12">
                <br>
                <label for="inputArquivo" class="btn btn-info">upload foto do produto</label>
                <input type="file" class="hidden" name="arquivo" id="inputArquivo">
           </div>
           <div class="col-xs-12">
                 <br>
                <button type="submit" class="btn btn-primary">Enviar</button>
           </div>
        </form>
    </div>
<?php 
    include "inc/footer.php";
?>