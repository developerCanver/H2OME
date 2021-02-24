<div>
    {{------------------------------ ingresar registro  -----------------------------------------}}

    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header p-3 mb-2 bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Uusario:

                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">imagen</label>
                        <input type="file" wire:model="photo" >
                        @error('photo') <span class="error">{{ $message }}</span> @enderror
                    </div>


                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" wire:model="name" class="form-control" placeholder="Pepito">

                    </div>
                    <div class="form-group">
                        <label for="name">Usuario</label>


                        <select wire:model="id_tipo" id="id_tipo">
                            {{-- <option selected="selected" disabled>-- Select --</option> --}}
                            <option value="2">User</option>
                            <option value="1">Admin</option>


                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Email </label>
                        <input type="email" class="form-control" wire:model="email" placeholder="Pepito@gmail.com">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" wire:model="password" class="form-control" name="password">

                    </div>

                    <button type="submit" wire:click="store" class="btn btn-primary">Registrar</button>
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Cancelar</button>

                </div>
            </div>
        </div>
    </div>

    {{-- fin crear usuario --}}



    <!--   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
       Ayuda Control de Usuario
     </button>
     
     Modal
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ayuda Control de Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <iframe width="100%" height="500" src="https://www.youtube.com/embed/nGOwJQ5Ti3M" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe> </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                </div>
            </div>
        </div>
    </div> -->
    <div class="container p-2">

        </h2>

        <div class="row justify-content-between">
            <div class="col-4">
                <label for="inputPassword6" class="col-form-label">Lista de usuarios registrados
                </label>
            </div>
            <div class="col-4">
                <div class="form-inline">
                    <input class="form-control mr-sm-2 d-flex justify-content-between"
                        wire:model.debounce.300ms="search" type="search" placeholder="Buscar usuario"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>

                </div>

            </div>
            <div class="col-4">
                @if ( Auth::user()->id_tipo=="1" )
                <h2>
                    <button type="button" class="btn btn-success float-right" data-toggle="modal"
                        data-target="#exampleModal" data-whatever="@mdo">Agregar user</button>

                </h2>
                @else
                <h2>Mis Datos
                </h2>
                @endif

            </div>
        </div>

    </div>



    <!-- Content here -->



    @if(session('data'))
    <div class="alert alert-success" role="alert">

        <strong>{{(session('data'))}}</strong> {{-- You should check in on some of those fields below. --}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif


    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Codigo</th>
                <th scope="col">Nombres</th>
                <th scope="col">Correo</th>
                <th scope="col">Opciones</th>

            </tr>
        </thead>
        <tbody>
            {{-- foreach espara recorrer el cilco de cuantos usuarios se tiene en la base de datos
       $users es la variable que traigo del controlador y recooro con la variable 
       que creo user  --}}
            @foreach ($users as $user)
            <tr>
                <th scope="row">{{$user->id}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>



                   
                    <button data-toggle="modal" data-target="#updateModal" wire:click="edit({{ $user->id }})" class="btn btn-primary btn-sm">Edit</button>
                    

                    @if ( Auth::user()->id_tipo=="1" )
                    <button onclick="MuestraAlert({{$user->id}})" class="btn btn-danger btn-sm">
                        Eliminar
                    </button>
                    @endif

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- modal para editar cada tarjeta--}}
    <div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
           <div class="modal-content">
            <div class="modal-header p-3 mb-2 bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Editar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <form>
                        <img src="/img/users/{{$user->photo}}" class="card-img-top mx-auto d-block" style="width: 200px;">

                        <div class="form-group">
                            <label for="">imagen</label>
                            <input type="file" wire:model="photo" >
                        @error('photo') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <input type="hidden" wire:model="user_id">
                            <label for="exampleFormControlInput1">Name</label>
                            <input type="text" class="form-control" wire:model="name" id="exampleFormControlInput1">
                            @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput2">Email address</label>
                            <input type="email" class="form-control" wire:model="email" id="exampleFormControlInput2">
                            @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" wire:model="password" class="form-control" name="password">
    
                        </div>
                      
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" wire:click.prevent="update({{$user->id}})" class="btn btn-primary" data-dismiss="modal">Actualizar</button>
                </div>
           </div>
        </div>
    </div>
        {{-- FIN ACTUALIZAR USUARIO  --}}

        <div class="row">
            <div class="mx-auto">
                {{ $users->links() }}
                {{-- PAGINACION CON EL METODO LINKS --}}
            </div>

        </div>

        <script>
            function MuestraAlert(id) {
                Swal.fire({
                    title: 'Esta seguro de eliminar ID ' + id + '?',
                    text: "Una vez borrado, no se podrá deshacer los cambios!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Continuar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        //console.log(id); 
                        @this.destroy(id);
                    }
                })
            }

        </script>
