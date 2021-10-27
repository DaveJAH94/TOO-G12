<template>
    <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Usuarios
                        <button type="button" @click="abrirModal('usuario','registrar')" class="btn btn-secondary" >
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre">Nombre</option>
                                      <option value="apellido">Apellido</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarUsuario(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarUsuario(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Dui</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>NIT</th>
                                    <th>FechaDeNacimiento</th>
                                    <th>Email</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for = "usuario in arrayUsuario" :key="usuario.id">
                                    <td>
                                        <!-- boton actualizar -->
                                        <!-- al no poder entre '' se indica que se manda un objeto y con '' solo una cadena de texto -->
                                        <button type="button" @click="abrirModal('usuario','actualizar',usuario)" class="btn btn-warning btn-sm" >
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <button type="button" @click="eliminarUsuario(usuario)" class="btn btn-danger btn-sm" >
                                          <i class="icon-trash"></i>
                                        </button>
                                        
                                    </td>
                                    <td v-text = "usuario.dui"></td>
                                    <td v-text = "usuario.nombre"></td>
                                    <td v-text = "usuario.apellido"></td>
                                    <td v-text = "usuario.nit"></td>
                                    <td v-text = "usuario.fechaNacimiento"></td>
                                    <td v-text = "usuario.email"></td>
                                    <!-- <td v-text = "usuario.estado"></td> -->
                                    <td>
                                        <div v-if="usuario.estado">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page >1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page -1,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item " v-for ="page in pagesNumber" :key="page" :class="[page== isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                </li>
                                
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page" >
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page +1,buscar,criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade"  tabindex="-1" :class="{'mostrar':modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4><!-- El titulo del modal ira cambiando dinamicamente segun se registre o actualizen los usuarios -->
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row"><!-- para dui -->
                                    <label class="col-md-3 form-control-label" for="text-input">DUI</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="dui" class="form-control" placeholder="Numero de DUI">
                                        <!-- <span class="help-block">(*) Ingrese el dui del usuario</span> -->
                                    </div>
                                </div>
                                <div class="form-group row"><!-- para nombre -->
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombre" class="form-control" placeholder="Nombre">
                                        <!-- <span class="help-block">(*) Ingrese el nombre del usuario</span> -->
                                    </div>
                                </div>
                                <div class="form-group row"><!-- para apellido -->
                                    <label class="col-md-3 form-control-label" for="text-input">Apellido</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="apellido" class="form-control" placeholder="Apellido">
                                        <!-- <span class="help-block">(*) Ingrese el nombre del usuario</span> -->
                                    </div>
                                </div>
                                <div class="form-group row"><!-- para nit -->
                                    <label class="col-md-3 form-control-label" for="text-input">NIT</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nit" class="form-control" placeholder="Numero de nit">
                                        <!-- <span class="help-block">(*) Ingrese el nombre del usuario</span> -->
                                    </div>
                                </div>
                                <div class="form-group row"><!-- para fecha de nacimiento -->
                                    <label class="col-md-3 form-control-label" for="text-input">Fecha de nacimiento</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="fechaNacimiento" class="form-control" placeholder="dia-mes-año">
                                        <!-- <span class="help-block">(*) Ingrese el nombre del usuario</span> -->
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Estado</label>
                                    <div class="col-md-9">
                                        
                                        <input type="checkbox" v-model="estado" class="switch-input" value="1" >
                                    </div>
                                </div>

                                <div class="form-group row"><!-- para email -->
                                    <label class="col-md-3 form-control-label" for="email-input">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" v-model="email" class="form-control" placeholder="Enter Email">
                                    </div>
                                </div>
                                <div class="form-group row"><!-- para password OJO AQUI -->
                                    <label class="col-md-3 form-control-label" for="text-input">Password</label>
                                    <div class="col-md-9">
                                        <input type="password" v-model="password"  >
                                    </div>
                                </div>

                                <div v-show="errorUsuario" class="form-group row div-error" >
                                       <!-- aqui se mostraran los errores en el formulario --> 
                                       <div class="text-center text-error">
                                           <div v-for="error in errorMostrarMsjUsuario" :key="error" v-text="error">

                                           </div>
                                       </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarUsuario()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarUsuario()">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
            
        </main>
</template>

<script>
    export default {
        data(){
            
            return {
                usuario_id: 0,
                dui : '',
                nombre : '',
                apellido : '',
                nit : '',
                fechaNacimiento : '',
                estado : '',
                email : '',
                password : '',
                arrayUsuario : [], //esto es para que lo que resive el metodo listarUsuario se capture en ese array
                modal : 0 ,//indica si se mostrara o ocultara un modal
                tituloModal: '',
                tipoAccion : 0,
                errorUsuario : '',
                errorMostrarMsjUsuario : [],
                pagination : {
                    'total'             :0,
                    'current_page'      :0,
                    'per_page'          :0,
                    'last_page'         :0,
                    'from'              :0,
                    'to'                :0,
                },
                offset : 3,
                criterio : 'nombre', //para el campo de busqueda
                buscar: '',         //sirve para filtrar todos los registros
            }
        },
        computed :{
            isActived: function(){
                return this.pagination.current_page;
            },
            pagesNumber: function(){
                if(!this.pagination.to){
                    return [];
                }
                var from = this.pagination.current_page - this.offset;
                if(from <1){
                    from = 1;
                }
                var to= from + (this.offset *2);
                if(to >= this.pagination.last_page){
                    to=this.pagination.last_page;
                }
                var pagesArray = [];
                while(from <= to){
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        methods : {
            //la uri es de web.php con esto se obtienen todos los usuarios
            listarUsuario(page,buscar,criterio){
                let me = this;
                var url = '/usuario?page='+ page + '&buscar='+ buscar +'&criterio='+criterio;
               axios.get(url).then(function(response){
                /* axios.get('/usuario').then(function(response){ */
                  var respuesta = response.data;  
                   
                   me.arrayUsuario = respuesta.usuarios.data; //aqui se almacena lo retornado por la consulta axios q es parecido a ajax
                   me.pagination=respuesta.pagination;
                   //es decir todos los registros de usuario
               })
               .catch(function(error){ //si hay un error aqui se captura
                   console.log(error);
               }); 
            },

            cambiarPagina(page,buscar,criterio){
                let me = this;
                //actualiza la pagina actual
                me.pagination.current_page = page;
                //envia la peticion para visualizar la data de esa pagina
                me.listarUsuario(page,buscar,criterio);
            },


            registrarUsuario(){
                if(this.validarUsuario()){
                    return;
                }
                let me = this;//es para hacer referencia a este mismo archivo
                //ahora usando axios para guardar
                axios.post('/usuario/registrar',{
                    'dui' : this.dui,
                    'nombre' : this.nombre,
                    'apellido' : this.apellido,
                    'nit' : this.nit,
                    'fechaNacimiento' : this.fechaNacimiento,
                    'estado' : this.estado,
                    'email' : this.email,
                    'password' : this.password,
                }).then(function(response){
                    me.cerrarModal();
                    me.listarUsuario(1,'','nombre');//pagina, filtro, texto
                }).catch(function(error){
                    console.log(error);
                })
            },

            actualizarUsuario(){
                if(this.validarUsuario()){
                    return;
                }
                let me = this;//es para hacer referencia a este mismo archivo
                //ahora usando axios para actualizar
                axios.put('/usuario/actualizar',{
                    'id' : this.usuario_id,  
                    'dui' : this.dui,
                    'nombre' : this.nombre,
                    'apellido' : this.apellido,
                    'nit' : this.nit,
                    'fechaNacimiento' : this.fechaNacimiento,
                    'estado' : this.estado,
                    'email' : this.email,
                    'password' : this.password,
                }).then(function(response){
                    me.cerrarModal();
                    me.listarUsuario(1,'','nombre');
                }).catch(function(error){
                    console.log(error);
                })
            },
            eliminarUsuario(usuario){
                let me = this;
                console.log(usuario.id);
                axios.delete('/usuario/'+usuario.id,{
                    /* 'id' : this.usuario_id, */
                }).then(function(response){
                    console.log("usuarioeliminado");
                    me.listarUsuario();
                }).catch(function(response){
                    console.log(error);
                })
            },

            

            validarUsuario(){
                this.errorUsuario=0;
                this.errorMostrarMsjUsuario = [];
                if(!this.dui) this.errorMostrarMsjUsuario.push("El campo dui no puede estar vacio.");
                if(!this.nombre) this.errorMostrarMsjUsuario.push("El campo nombre no puede estar vacio.");
                if(!this.apellido) this.errorMostrarMsjUsuario.push("El campo apellido no puede estar vacio.");
                if(!this.nit) this.errorMostrarMsjUsuario.push("El campo nit no puede estar vacio.");
                if(!this.fechaNacimiento) this.errorMostrarMsjUsuario.push("El campo de fecha de nacimiento no puede estar vacio.");
                if(!this.email) this.errorMostrarMsjUsuario.push("El campo email no puede estar vacio.");
                if(!this.password) this.errorMostrarMsjUsuario.push("El campo password no puede estar vacio.");

                if(this.errorMostrarMsjUsuario.length) this.errorUsuario = 1; //significa que si tiene alguna longitud la cadena de MsjUsuario entonces se notificara el error
                return this.errorUsuario; 
            },

            cerrarModal(){
                this.modal=0;
                this.tituloModal = '';
                this.dui= "";
                this.nombre = "";
                this.apellido="";
                this.nit= "";
                this.fechaNacimiento= "";
                this.estado = false;//OJO AQUI LO MANDO FALSO POR SI NO CONFIGURA BIEN DESPUES    
                this.email = "";
                this.password = "";
            },
            //para abrir el modal , el modelo sera el de usuario, la accion abrir y la data es el objeto correspondiente a una fila de la tabla usuarios en la base de datos
            abrirModal(modelo,accion,data=[]){
                
                switch(modelo){
                    case "usuario":
                        {
                            switch (accion) 
                            {   
                                
                                case 'registrar':
                                    {
                                     this.modal = 1;
                                     this.tituloModal = "Registrar Usuario";
                                     this.dui= "";
                                     this.nombre = "";
                                     this.apellido="";
                                     this.nit= "";
                                     this.fechaNacimiento= "";
                                     this.estado = false;//OJO AQUI LO MANDO FALSO POR SI NO CONFIGURA BIEN DESPUES    
                                     this.email = "";
                                     this.password = "";
                                     this.tipoAccion = 1;
                                     break;
                                    }
                                case 'actualizar':
                                    {
                                        //console.log(data);
                                        this.usuario_id = data['id'];
                                        this.modal=1;
                                        this.tituloModal = "Actualizar Categoria";
                                        this.tipoAccion = 2;
                                        this.dui= data['dui'];
                                        this.nombre = data['nombre'];
                                        this.apellido=data['apellido'];
                                        this.nit= data['nit'];
                                        this.fechaNacimiento= data['fechaNacimiento'];
                                        this.estado = data['estado'];//OJO AQUI LO MANDO FALSO POR SI NO CONFIGURA BIEN DESPUES    
                                        this.email = data['email'];
                                        this.password = '';
                                        break;
                                    }
                                    
                            
                                
                            }
                        }
                }
            }
        },
        mounted() {
            /* console.log('Component mounted.') */
            this.listarUsuario(1,this.buscar,this.criterio);
        }
    }
</script>
<style >
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;/* color de fondo detras del modal */
         
    }
    .div-error{
       display: flex;
       justify-content: center ; 
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>
