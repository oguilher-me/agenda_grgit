<?php

$service_url = 'http://localhost:8001/contact/'.$_GET['id'];
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

$decoded = $decoded[0];
include 'view/layouts/header.php';
?>
<div class="col-md-4 col-md-offset-4" style="margin-top:50px;">
                                <form id="store" class="form-horizontal" role="form" class="col-md-6 col-md-offset-3" action="updateContact.php" method="POST">
                                    <input type="hidden" value="<?php echo $decoded->id; ?>" name="id">
                                    <div id="signupalert" style="display:none" class="alert alert-danger">
                                        <p>Atenção:</p>
                                        <span></span>
                                    </div>
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input type="text" class="form-control" name="name" value="<?php echo $decoded->name; ?>" placeholder="Nome do contato">
                                    </div>

                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                        <input type="text" class="form-control" name="email" value="<?php echo $decoded->name; ?>" placeholder="E-mail">
                                    </div>
                
                                  <?php 
                                                                                    if (isset($decoded->phones)){
                                                                                    foreach($decoded->phones as $phone){
                                                                                ?>

                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                                        <input type="text" class="form-control" name="names[]" value="<?php echo $phone->number; ?>" placeholder="Tipo de Contato">
                                        <input type="text" class="form-control" name="numbers[]" value="<?php echo $phone->name; ?>" placeholder="Número">
                                    </div>
                                  <?php 
                        }}
                ?>
                                    

                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-3">
                                            <button id="btn-signup" type="button" class="btn btn-danger"><i class="icon-hand-right"></i>Atualizar</button>
                                        </div>
                                        
                                    </div>
                                </form>
                                </div>
            <?php
include 'view/layouts/footer.php';
