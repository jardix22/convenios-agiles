<header id="_menu"></header>
<div id="message-box" class="row"></div>
<div class="container">
   <div id="main" class="row"></d iv>
</div>

<!-- >> Menu View Template -->
<script id="menu-template" type="text/template">
  <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="container">
       <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
             <span class="sr-only">Toggle navigation</span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Convenios Agiles</a>
       </div>

       <!-- Collect the nav links, forms, and other content for toggling -->
       <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav">
             <li class="active"><a href="#">Inicio</a></li>
             <li><a href="#list">Lista</a></li>
          </ul>
          
          <ul class="nav navbar-nav navbar-right">
             <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Administrador <b class="caret"></b></a>
                <ul class="dropdown-menu">
                   <!--
                   <li><a href="#">Mi Perfil</a></li>
                   <li><a href="#">Ajustes de Perfil</a></li>
                   -->
                   <li><a href="#logout">Salir</a></li>
                </ul>
             </li>
          </ul>
       </div><!-- /.navbar-collapse -->
    </div>
  </nav>
</script>
<!-- << Menu View Template -->

<!-- *** Search Module Templates *** -->

  <!-- >> Search Layout Template -->
  <script id="search-layout" type="text/template">
    <header class="col-lg-12">
      <h3 class="page-header">
        Búsqueda de Convenios
      </h3>
    </header>
    <div id="search-bar" class="col-lg-12">
      <form>

        <div class="row">
          <div  class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <label>Título: </label> 
          </div>
          <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
            <input type="text" class="form-control" name="title" autocomplete="off" id="searchTerm" value="" required />
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
            <button type="submit" id="search" class="btn btn-info" style="display: inline-block; width: 100%;">Buscar</button>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-offset-1 col-lg-9 col-md-12 more-tools-content">
            <input type="text" class="form-control input-sm" id="responsible" name="responsible" autocomplete="off" value="" style="display: inline-block; width: 250px;"  placeholder="Responsable(s)" />
            <div id="select-date"></div>
            <select class="form-control input-sm" id="coverage_type" name="coverage_type" style="display: inline-block; width: 120px;">
              <option value="">cualquier tipo</option>
              <option value="Marco">Marco</option>
              <option value="Específico">Específico</option>
            </select>
            <select class="form-control input-sm"  id="location_type" name="location_type" style="display: inline-block; width: 150px;">
              <option value="">cualquier localidad</option>
              <option value="Internacional">Internacional</option>
              <option value="Nacional">Nacional</option>
              <option value="Local">Local</option>
            </select>
            <select class="form-control input-sm"  id="is_validity" name="is_validity" style="display: inline-block; width: 100px;">
              <option value="">Estado</option>
              <option value="1">Vigente</option>
              <option value="0">Expirado</option>
            </select>
          </div>
        </div>

      </form>
    </div>
    <section id="agreement-container" class="col-lg-12"></section>
  </script>
  <!-- << Search Layout Template -->

  <!-- >> Select Date Template -->
  <script id="select-date-template" type="text/template">
    <select class="form-control select-item input-sm" name="suscription_date" style="display: inline-block; width: 200px;">
      <option value="">cualquier fecha</option>
      <option value="<%= (new Date()).getFullYear()+'-'+(new Date()).getMonth()+'-'+(new Date()).getDay() %>">ultimo día</option>
      <option value="<%= (new Date()).getFullYear()+'-'+(new Date()).getMonth()+'-'+ '01' %>">ultimo mes</option>
      <option value="<%= (new Date()).getFullYear()+'-01-01' %>">ultimo año</option>
      <option value="<%= (new Date()).getFullYear() - 1 %>-01-01, <%= (new Date()).getFullYear() %>-01-01">ultimos 2 años</option>
      <option value="<%= (new Date()).getFullYear() - 2 %>-01-01,<%= (new Date()).getFullYear() - 1 %>-01-01">ultimos 3 años</option>
      <option value="interval" data-interval-date="true" class="data-interval">intervalo personalizado</option>
    </select>
  </script>
  <!-- << Select Date Template -->

  <!-- >> Interval Date Modal Template -->
  <script id="interval-date-modal" type="text/template">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <div class="modal-title" id="myModalLabel">
            <b>Definir Intervalo</b>         
          </div>
        </div>
        <div class="modal-body">
          <form role="form" id="interval-date-form" class="form-horizontal">
            <div class="form-group">
               <label class="control-label col-md-3">Desde:</label>
               <div class="col-md-6">
                  <input type="date" id="start_date" name="start_date" class="form-control input-sm" required="true">
               </div>
            </div>
            <div class="form-group">
               <label class="control-label col-md-3">Hasta:</label>
               <div class="col-md-6">
                  <input type="date" id="end_date" name="end_date" class="form-control input-sm" required="true">
               </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary btn-sm send-form" >Ir</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </script>
  <!-- << Interval Date Modal Template -->


  <!-- >> Agreement List Search Template -->
  <script id="agreement-list-template" type="text/template">
    <div class="row">
      <div class="col-lg-12">
        <div class="pull-right">
          <div class="icon-file" id="pdf-report">
            <img src="images/pdf.png">
          </div>
          <div  class="icon-file" id="xls-report">
            <img src="images/xls.png">
          </div>
        </div>
      </div>
    </div>

    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th class="center">Título</th>
          <th class="center">Responsable(s)</th>
          <th class="center">Cobertura</th>
          <th class="center">Suscripción</th>
          <th class="center" style="width: 100px;">Estado</th>
          <th>Opciones</th>
        </tr>
      </thead>
      <tbody class="agreements"></tbody>
      <tfoot></tfoot>
    </table>
  </script>
  <!-- << Agreement List Search Template -->

  <!-- >> Agreement Item Search Template -->
  <script id="agreement-template" type="text/template">
     <td><%= title %></td>
     <td><%= responsible %></td>
     <td class="center"><%= coverage_type %></td>
     <td class="center"><%= moment(suscription_date).format("L")  %></td>
     <td class="center"><%=  is_expired %></td>
     <td><button class="btn btn-default btn-xs btn-details">Detalles</button></td>
  </script>
  <!-- << Agreement Item Search  Template -->

<!-- *** Agreements Module Templates *** -->

<!-- >> Agreement Layout Template -->
<script id="resgister-layout" type="text/template">
  <div id="register-message"></div>
  <div id="register-content"></div>
</script>
<!-- << Agreement Layout Template -->

<!-- >> Add Message Template -->
<script id="add-message-template" type="text/template">
 <div class="bs-callout bs-callout-info message-info" >
    <h4>Mensaje</h4>
    <p>
      Se esta registrado un nuevo Convenio, <span tabindex="0" id="spinner">cargando...</span>
    </p>
 </div>
</script>
<!-- << Add Message Template -->

<script id="detail-view-template" type="text/template">
   <div class="modal-dialog" style="width: 80%;">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <div class="modal-title" id="myModalLabel">
               <b><%= title %></b>
               <div><%= location_type %><span> \ </span><%= purpose_type %><span> \ </span><%= institution_type %></div>
            </div>
         </div>
         <div class="modal-body">
            <p><b>objetivo(s):</b> <%= objetives %></p>
            
            <p>
              <b>Resolución:</b> <%= rectory_resolution %>
              <b>Fecha de suscipción:</b> <%= suscription_date %>
              <b>Vigencia:</b> <%= validity %>
              <b>Responsable:</b> <%= responsible %>
            </p>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Cerrar</button>
         </div>
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</script>

<script id="agreement-item-template" type="text/template">
    <td><%= title %></td>
    <td><%= responsible %></td>
    <td class="center"><%= coverage_type %></td>
    <td class="center"><%=  moment(suscription_date).format("L") %></td>
    <td class="center"><%=  validity %></td>
    <!--<td class="center"><%=  moment(expired_date).format("L") %></td>
    <td class="center"><%=  moment(expired_date).diff(moment(), 'days') %></td>-->
    <td class="center"><%=  is_expired %></td>
    <td>
      <button class="btn btn-primary btn-xs show-agreement">
        <span class="glyphicon glyphicon-eye-open"></span>
      </button>
      <button class="btn btn-info btn-xs edit-agreement">
        <span class="glyphicon glyphicon-edit"></span>
      </button>
      <button class="btn btn-danger btn-xs remove-agreement">
        <span class="glyphicon glyphicon-trash"></span>
      </button>
    </td>
</script>
<script id="agreement-list-composite-template" type="text/template">
   <div class="col-md-12">
      <h3 class="page-header">
         Lista de Convenios
         <div class="pull-right">
            <button class="btn btn-success btn-sm" id="add-agreement">
               <span class="glyphicon glyphicon-plus"></span>
               Nuevo Convenio
            </button>
         </div>
      </h3>
      <table class="table table-striped table-bordered">
         <thead>
            <tr>
               <th>Título</th>
               <th class="center">Responsable(s)</th>
               <th class="center" style="width: 100px;">Cobertura</th>
               <th>Suscripción</th>
               <th style="width: 100px;">Vigencia</th>
               <!--<th style="width: 100px;">Vigencia2</th>
               <th style="width: 100px;">:P</th>-->
               <th style="width: 100px;">Estado</th>
               <th style="width: 98px;">Opciones</th>
            </tr>
         </thead>
         <tbody class="agreement-list">
            
         </tbody>
         <tfoot></tfoot>
      </table>          
   </div>
</script>

<script id="edit-form-template" type="text/template">
   <div class="modal-dialog" style="width: 80%;">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <div class="modal-title" id="myModalLabel">
               <b>Editar Convenio</b>
            </div>
         </div>
         
         <div class="modal-body">
            <div class="form-content"></div>
         </div>
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</script>

<script id="add-form-modal-template" type="text/template">
   <div class="modal-dialog" style="width: 80%;">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <div class="modal-title" id="myModalLabel">
               <b>Nuevo Convenio</b>
            </div>
         </div>
         
         <div class="modal-body">
            <div class="form-content">
              <form role="form" id="new-agreement-form" class="">
                <div class="col-lg-12"> 
                  <div class="form-group">
                    <label class="control-label" style="color: #555;">Título</label>
                      <textarea id="title" name="title" class="form-control i-focus" rows="3" required="" placeholder=""></textarea> 
                      
                  </div>
                </div>

                <div class="col-lg-12"> 
                  <div class="form-group">
                    <label class="control-label" style="color: #555;">Objetivos</label>
                    <textarea id="objetives" name="objetives" class="form-control " rows="6" required="" placeholder=""></textarea> 
                  </div>
                </div>
                <div class="col-lg-4"> 
                  <div class="form-group">
                    <label class="control-label" style="color: #555;">Según tipo de covertura</label>
                    <div class="radio">
                      <label><input type="radio" name="coverage_type" id="coverage_type" value="Marco" required="" checked="">Marco</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="coverage_type" id="coverage_type" value="Específico" required="">Específico</label>
                    </div> 
                  </div>
                </div>
                <div class="col-lg-4"> 
                  <div class="form-group">
                    <label class="control-label" style="color: #555;">Según tipo de propósito</label>
                    <select class="form-control " name="purpose_type" id="purpose_type" multiple="" required="" style=""> 
                      <option value="Coolaboración">Coolaboración</option>
                      <option value="Cooperación">Cooperación</option>
                      <option value="Docente Asistencial">Docente Asistencial</option>
                      <option value="Interinstitucional">Interinstitucional</option>
                      <option value="Investigación">Investigación</option>
                      <option value="Institucional">Institucional</option>
                      <option value="Movilidad Académica">Movilidad Académica</option>
                      <option value="Prestaciones Reciprocas">Prestaciones Recíprocas</option>
                      <option value="Otros">Otros</option>
                    </select> 
                  </div>
                </div>
                <div class="col-lg-4"> 
                  <div class="form-group">
                    <label class="control-label" style="color: #555;">Según tipo de localización</label>
                    <select class="form-control " name="location_type" id="location_type" required="" style=""> 
                      <option value=""></option>
                      <option value="Internacional">Internacional</option>
                      <option value="Nacional">Nacional</option>
                      <option value="Local">Local</option>
                    </select> 
                  </div>
                </div>
                <div class="col-lg-4"> 
                  <div class="form-group">
                    <label class="control-label" style="color: #555;">Según tipo de Institución</label>
                    <select class="form-control " name="institution_type" id="institution_type" required="" style=""> 
                      <option value=""></option>
                      <option value="Compañias Mineras">Compañias Mineras</option>
                      <option value="Direcciones Regionales de Salud">Direcciones Regionales de Salud</option>
                      <option value="Direcciones Regionales de Educación">Direcciones Regionales de Educación</option>
                      <option value="EsSalud">EsSalud</option>
                      <option value="Fundaciones">Fundaciones</option>
                      <option value="Municipios">Municipios</option>
                      <option value="Ministerios">Ministerios</option>
                      <option value="ONG" s'="">ONG's</option>
                      <option value="Gobierno Regionales">Gobierno Regionales</option>
                      <option value="Universidades">Universidades</option>
                      <option value="Unidades de Gestion Ejecutoras Locales (UGEL)">Unidades de Gestion Ejecutoras Locales (UGEL)</option>
                      <option value="Otros">Otros</option>
                    </select> 
                  </div>
                </div>
                <div class="row">

                </div>
                <div class="col-lg-12">
                  <fieldset>
                    <legend>Suscripción</legend>
                    <div class="row">
                      <div class="col-lg-3"> 
                        <div class="form-group">
                          <label class="control-label" style="color: #555;">Resolución Rectoral</label>
                          <input type="text" id="rectory_resolution" name="rectory_resolution" class="form-control " required="" value="" placeholder=""> 
                        </div>
                      </div>
                    <div class="col-lg-3"> 
                      <div class="form-group">
                        <label class="control-label" style="color: #555;">Fecha de Suscripción</label>
                        <input type="text" id="suscription_date" name="suscription_date" class="form-control datepicker-item" required="" value="" placeholder="" data-format="DD/MM/YYYY"> 
                        <span class="tips">Ejm. 31/01/2014</span>
                      </div>
                    </div>
                    <div class="col-lg-6"> 
                      <div class="form-group">
                        <label class="control-label" style="color: #555;">Vigencia</label>
                        <input type="text" id="validity" name="validity" class="form-control " required="" value="" placeholder=""> 
                        <span class="tips">Ejm. 2 días | 15 meses | 5 años | 30/10/2014 | indefinido</span>
                        
                      </div>
                    </div>
                    <div class="row"></div>
                    <div class="col-lg-12"> 
                      <div class="form-group">
                        <label class="control-label" style="color: #555;">Responsables</label>
                        <input type="text" id="responsible" name="responsible" class="form-control " required="" value="" placeholder=""> 
                      </div>
                    </div>
                    </div>
                  </fieldset>
                </div>
                <div class="col-lg-12" style="clear: both; margin-bottom: 30px; padding-top: 5px; text-align: center;">
                  <button type="submit" id="save" name="save" class="btn btn-default">Guardar</button>
                </div>
              </form>
            </div>
         </div>
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</script>


<script id="alert-modal-template" type="text/template">
  <div class="modal-dialog" style="width: 400px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <div class="modal-title" id="myModalLabel">
           <b>Alerta!</b>
        </div>
      </div>
      <div class="modal-body">
        ¿Esta seguro de eliminar este convenio?            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm acepted" >Si</button>
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">No</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</script>

<script id="show-modal-template" type="text/template">
   <div class="modal-dialog" style="width: 80%;">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <div class="modal-title" id="myModalLabel">
               <b><%= title %></b>
               <div><%= location_type %><span>\</span><%= purpose_type %><span>\</span><%= institution_type %></div>
            </div>
         </div>
         <div class="modal-body">
            <p><b>objetivo(s):</b> <%= objetives %></p>
            <p>
              <b>Resolución:</b> <%= rectory_resolution %>
              <b>Fecha de suscipción:</b> <%= suscription_date %>
              <b>Vigencia:</b> <%= validity %>
              <b>Responsable:</b> <%= responsible %>
            </p>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Cerrar</button>
         </div>
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</script>

 
<!-- >> Region Layout -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
<!-- << Region Layout -->