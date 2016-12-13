<div class="container animated bigEntrance">
    <div class="row centered-form">
        <div class="col-xs-12 col-sm-4 col-md-4 col-sm-offset-2 col-md-offset-4">
            <div class="panel panel-primary">

                <div class="panel-heading">
                    <h3 class="panel-title">Ingrese Material <small id="titulo">Alta</small></h3>
                </div>

                <div class="panel-body">
                    <form role="form">

                        <div class="form-group">
                            <input type="text" name="nombre" id="nombre" class="form-control input-sm" placeholder="Nombre">
                        </div>

                        <div class="form-group">
                            <input type="text" name="precio" id="precio" class="form-control input-sm" placeholder="Precio">
                        </div>

                         <div class="form-group">
                            <select class="form-control form-control-sm"" id="tipo">
                              <option value="solido">Solido</option>
                              <option value="liquido">Liquido</option>
                            </select>
                          </div>

                        <button type="button" id="agregar" class="btn btn-info btn-block" onclick="NuevoMaterial()">Agregar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>