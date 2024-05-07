<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title> SISTEMA CRECHE PROJETO 1  </title>

    <h1> VITIELLO JULES e MARINA FARIAS  ALUNO IFSC(ADS)</h1>
</head>
<body>
    <div class=" container my-5"> 
     <h2> LISTAGEM DE  USUARIO </h2>
     <a class="btn btn-primary" href="/creche/usuario.php" role= "button"> casdatrar</a>
     <button type="button" class="btn btn-blue" onclick="location.href='/creche/formulario_creche.php'">proximo</button>
     
     
<br>
<table class="table">
    <thead>0
<tr>
<th> ID</th>
<th> nomeCompleto </th>
<th> endereco </th>
<th> telefone </th>
 <th>email</th>
 <th>tipoResponsavel</th>
 <th>cpfCrianca </th>
 <th>CREATED AT </th>
</tr>
</thead>
<tbody> 

<?php
$servername = "localhost";
$username = "root";
$password = "";
$datebase = "creche";

$connection = new mysqli($servername,$username,$password,$datebase);


if($connection->connect_error) {
    die (" banco nao encontrado : ".$connection -> connect_error);
}

$sql = " SELECT * FROM usuarios";
$result = $connection ->query($sql);

if(!$result){
    die (" dados ivalido : ".$connection -> error);
}

while( $row = $result ->fetch_assoc()){
    echo "

 <tr>
<td> $row[id] </td>
<td> $row[nomeCompleto]</td>
<td> $row[endereco] </td>
<td> $row[telefone]</td>
<td> $row[email]</td>
<td> $row[tipoResponsavel]</td>
<td> $row[cpfCrianca]</td>
<td> $row[created_at]</td>


<td>
<a  class = 'btn btn-primary btn-sm' href='/creche/editar.php?id=$row[id]'>editar </a>
<a  class='btn btn-danger btn-sm' href='/creche/cancelar.php?id=$row[id]'>cancelar</a>
</td>
</tr>
    
    ";
}
 
?>
</tbody>
</table>
    </div>
</body>
</html>