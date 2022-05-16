<?php require 'views/layout/header.php' ?>

<?php require 'views/layout/aside.php' ?>

<main class="contents">
    <form action="">
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
            <div><input type="text" name="" id="" placeholder="Area:" require></div>
            <div> <select name="" id="" require>
                    <option disabled selected>Escoga una sede</option>
                    <option>Sede Berástegui</option>
                    <option>Sede Montería</option>
                    <option>Sede Lorica</option>
                    <option>Sede Sahagún</option>
                    <option>Sede Montelíbano</option>
                </select> </div>
            <div> <input type="text" name="" id="" placeholder="Municipio" require> </div>
            <div><input type="text" name="" id="" placeholder="Departamento" require></div>
            <div><input type="text" name="" id="" placeholder="Asunto" require></div>
            <div> <input placeholder="Fecha" type="text" onfocus="(this.type='date')" id="date"> </div>
            <div> <input placeholder="Hora inicio" type="text" onfocus="(this.type='time')" id="hora_inicio"> </div>
            <div><input placeholder="Hora final" type="text" onfocus="(this.type='time')" id="hora_final"> </div>
            <div class="col-span4 temas"><label for="">
                    <h3>TEMAS TRATADOS</h3>
                </label></div>
            <div class="col-span4"> <textarea name="" id="" cols="4" rows="10"></textarea require> </div>
            <div  class="col-span4 btn">
                <button type="submit" >GUARDAR</button>
            </div>
        </div>
    </form>
</main>

<?php require 'views/layout/footer.php' ?>