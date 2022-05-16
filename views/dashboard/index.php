<?php require 'views/layout/header.php' ?>

<?php require 'views/layout/aside.php' ?>

<main class="contents">
    <form action="<?php echo constant('URL'); ?>/dashboard/newActa" method="POST">
        <div class="contents-form">
            <div class="row-span3 div-img">
                <img src="assets/img/unicor-acreditada5.png" alt="" class="contents-form-img">
            </div>
            <div class="row-span3 col-span2 titulo">
                <h2>FORMATO ACTA DE REUNION</h2>
            </div>
            <div>
                <p>Codigo: FO-RE-AC01</p>
            </div>
            <div>
                <p>Version: 1.0</p>
            </div>
            <div>
                <p>Fecha version: 11 de Noviembre de 2021</p>
            </div>
            <div><input type="text" name="area" id="area" placeholder="Area:" require></div>
            <div> <select name="sede" id="sede" require>
                    <option disabled selected>Escoga una sede</option>
                    <option>Sede Berástegui</option>
                    <option>Sede Montería</option>
                    <option>Sede Lorica</option>
                    <option>Sede Sahagún</option>
                    <option>Sede Montelíbano</option>
                </select> </div>
            <div> <input type="text" name="municipio" id="municipio" placeholder="Municipio" require> </div>
            <div><input type="text" name="departamento" id="departamento" placeholder="Departamento" require></div>
            <div><input type="text" name="asunto" id="asunto" placeholder="Asunto" require></div>
            <div> <input placeholder="Fecha" name="fecha" type="text" onfocus="(this.type='date')" id="date"> </div>
            <div> <input placeholder="Hora inicio" name="horaInicio" type="text" onfocus="(this.type='time')" id="horaInicio"> </div>
            <div><input placeholder="Hora final" name="horaFinal" type="text" onfocus="(this.type='time')" id="horaFinal"> </div>
            <div class="col-span4 temas"><label for="">
                    <h3>TEMAS TRATADOS</h3>
                </label></div>
            <div class="col-span4"> <textarea name="tema" id="tema" cols="4" rows="10"></textarea require> </div>
            <div  class="col-span4 btn">
                <button type="submit" >GUARDAR</button>
            </div>
        </div>
    </form>
</main>

<?php require 'views/layout/footer.php' ?>