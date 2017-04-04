    <li>
        <a href="{{url('/home')}}"><i class="fa fa-fw fa-home"></i> Inicio</a>
    </li>
    <li >
        <a href="#" data-toggle="collapse" data-target="#demo"><i class="glyphicon glyphicon-th-list"></i> <span> Gestionar Empleados</span> <i class="fa fa-angle-left pull-right"></i></a>

        <ul id="demo" class="collapse">

           <li>
                <a href="{{url('/admin/empleado/create')}}"><i class="glyphicon glyphicon-floppy-disk"></i> Agregar Empleado</a>
            </li>
            <li>
                <a href="{{url('/admin/empleado')}}"><i class="fa fa-users"></i> Administrar Empleados</a>
            </li>
            <li>
                <a href="{{url('admin/empleado/nominareport')}}"><i class="glyphicon glyphicon-print"></i> Nomina Empleados</a>
            </li>
        </ul>
    </li>
    <li >
        <a href="#" data-toggle="collapse" data-target="#demo1"><i class="glyphicon glyphicon-folder-open"></i><span>  Gestionar Expedientes Administrativos </span> <i class="fa fa-angle-left pull-right"></i></a>

        <ul id="demo1" class="collapse">

           <li>
                <a href="{{url('/admin/expedienteadministrativo/create')}}"><i class="glyphicon glyphicon-folder-close"></i> Agregar Expediente </a>
            </li>
            <li>
                <a href="{{url('/admin/expedienteadministrativo')}}"><i class="fa fa-users"></i> Administrar Expedientes</a>
            </li>
            <li>
                <a href="{{url('/admin/tiempo')}}"><i class="glyphicon glyphicon-time"></i> Administrar Tiempo Adicional </a>
            </li>
        </ul>
    </li>
    <li>
        <a href="#" data-toggle="collapse" data-target="#demo2"><i class="glyphicon glyphicon-education"></i> <span> Gestionar Expedientes Academicos</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul id="demo2" class="collapse">
            <li>
                <a href="{{url('/admin/expedienteacademico/create')}}"><i class="glyphicon glyphicon-floppy-saved"></i> Agregar Expediente</a>
            </li>
            <li>
                <a href="{{url('/admin/expedienteacademico')}}"><i class="fa fa-users"></i> Administrar Expedientes</a>
            </li>
            <li>
                <a href="{{url('/admin/cargaacademica/create')}}"><i class="glyphicon glyphicon-book"></i> Agregar Carga </a>
            </li>
            <li>
                <a href="{{url('/admin/cargaacademica')}}"><i class="glyphicon glyphicon-pencil"></i> Administrar Carga </a>
            </li>
            <li>
                <a href="{{url('/admin/experiencialaboralacademica/create')}}"><i class="glyphicon glyphicon-tasks"></i> Agregar Experiencia Laboral Academica</a>
            </li>
            <li>
                <a href="{{url('/admin/experiencialaboralacademica')}}"><i class="fa fa-users"></i> Administrar Experiencia Laboral Academica</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="javascript:;" data-toggle="collapse" data-target="#demo3"><i class="glyphicon glyphicon-ok"></i> Control de Asistencias<i class="fa fa-angle-left pull-right"></i></a>
        <ul id="demo3" class="collapse">
            <li>
                <a href="{{url('/admin/asistencia/create')}}"><i class="glyphicon glyphicon-open-file"></i> Agregar Asistencia</a>
            </li>
            <li>
                <a href="{{url('/admin/asistencia')}}"><i class="fa fa-users"></i> Administrar Asistencias</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="#" data-toggle="collapse" data-target="#demo4"><i class="glyphicon glyphicon-list-alt"></i> Gestionar Permisos <i class="fa fa-angle-left pull-right"fa fa-angle-left pull-right></i></a>
        <ul id="demo4" class="collapse">
            <li>
                <a href="{{url('/admin/permiso/create')}}"><i class="fa fa-plus"></i> Agregar Permiso</a>
            </li>
            <li>
                <a href="{{url('/admin/permiso')}}"><i class="fa fa-users"></i> Administrar Permisos</a>
            </li>
        </ul>
    </li>

        
           
            
            
                        
         
       