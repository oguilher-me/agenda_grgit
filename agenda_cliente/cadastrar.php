<?php

include 'view/layouts/header.php';
?>
<div class="col-md-4 col-md-offset-4" style="margin-top:50px;">
                                <form id="store" class="form-horizontal" role="form" class="col-md-6 col-md-offset-3" action="storeContact.php" method="POST">
                                    <div id="signupalert" style="display:none" class="alert alert-danger">
                                        <p>Atenção:</p>
                                        <span></span>
                                    </div>
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input type="text" class="form-control" name="name" value="" placeholder="Nome do contato">
                                    </div>

                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                        <input type="text" class="form-control" name="email" value="" placeholder="E-mail">
                                    </div>

                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                                        <input type="text" class="form-control" name="names[]" value="" placeholder="Tipo de Contato">
                                        <input type="text" class="form-control" name="numbers[]" value="" placeholder="Número">
                                    </div>

                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                                        <input type="text" class="form-control" name="names[]" value="" placeholder="Tipo de Contato">
                                        <input type="text" class="form-control" name="numbers[]" value="" placeholder="Número">
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-3">
                                            <button id="btn-signup" type="button" class="btn btn-danger"><i class="icon-hand-right"></i>Cadastrar</button>
                                        </div>
                                        
                                    </div>
                                </form>
                                </div>
            <?php
include 'view/layouts/footer.php';
