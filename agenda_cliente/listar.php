<?php


$service_url = 'http://localhost:8001/contact';
$curl = curl_init($service_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$curl_response = curl_exec($curl);

if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
    die('Não foi possível realizar a requisição. ' . var_export($info));
}
curl_close($curl);
$decoded = json_decode($curl_response);
if (isset($decoded->status) && $decoded->status == false) {
    die('Não foi possível realizar a requisição: ' . $decoded->message);
}

include 'view/layouts/header.php';
?>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-sm-offset-3">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-list"></span>Agenda de Contatos
                    
                </div>
                <div class="panel-body">  
                    <div class="panel-group" id="accordion">
                    <?php 
                        $aux  = $decoded;
                        $count = 1;
                        /*$aux  = json_decode($conteudoControl->get());*/
                        foreach($aux as $valor){
                            
                    ?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $count; ?>"><span class="glyphicon glyphicon-user"></span> <?php echo $valor->name; ?></a>
                                            </h4>
                                            <div class="pull-right action-buttons">
                                <a href="editar.php?id=<?php echo $valor->id; ?>"><span class="glyphicon glyphicon-pencil text-warning"></span></a>
                                <a href="delete.php?id=<?php echo $valor->id; ?>" class="trash"><span class="glyphicon glyphicon-trash text-danger"></span></a></div>
                                        </div>
                                        <div id="collapse<?php echo $count;  $count++;?>" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <table class="table">
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <a href="#"><span class="glyphicon glyphicon-mail"></span> <?php echo $valor->email; ?></a>
                                                        </td>
                                                    </tr>
                                                    
                                                    <?php 
                                                                                    if (isset($valor->phones)){
                                                                                    foreach($valor->phones as $phone){
                                                                                ?>
                                                    <tr>
                                                        <td>
                                                            <a href="#"><span class="glyphicon glyphicon-earphone text-primary"></span> <?php echo $phone->number . ' (' . $phone->name . ')'; ?></a>
                                                        </td>
                                                    </tr>
                                                    <?php 
                        }}
                ?>
                                                   
                                                </tbody></table>
                                            </div>
                                        </div>
                                    </div>
                                           <?php 
                                            }
                                    ?>
                                    </div>
                    <!-- <ul class="list-group">
                        
                        <li class="list-group-item">
                            <div class="checkbox">
                                <label for="checkbox">
                                    
                                </label>
                            </div>
                            <div class="pull-right action-buttons">
                                <a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="http://www.jquery2dotnet.com" class="trash"><span class="glyphicon glyphicon-trash"></span></a></div>
                        </li>
                        
                    </ul> -->
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6">
                            <h6>
                                Contatos <span class="label label-info"><?php echo count($decoded); ?></span></h6>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
include 'view/layouts/footer.php';