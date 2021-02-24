@extends('layouts.app')

@section('content')
<div class="container">
    <ul class="nav nav-pills justify-content-center">
        <li class="nav-item">
            <a class="nav-link " href="{{route('estancia.index',  ['tags_id' => $hogar->id_hogar]) }}">
                Estancia
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="{{route('almacenamiento.index',  ['stock_id' => $hogar->id_hogar]) }}">
                Almacenamiento
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('factura.index',  ['stock_id' => $hogar->id_hogar]) }}">
                Facturas
            </a>
        </li>
    </ul>

    <h2>Almacenamiento
     
    </h2>

    @if($stocks ?? '')
    <div class="alert alert-primary" role="alert">
        Hogar
        {{$hogar->nombreHogar}}

    </div>
    @endif

    @if(session('data'))
    <div class="alert alert-success" role="alert">

        <strong>{{(session('data'))}}</strong> {{-- You should check in on some of those fields below. --}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif




<div class="row">
    {{--  -------------  -------------------registros----------------------- --}}

    <div class="row cards" style="width: auto; margin: auto auto;">
        {{-- 'medidor', 'codigo', 'consumoPromedio','saldoPromedio','fechaFactura', --}}
        @foreach ($stocks as $stock)


        {{--**************************** tanque******************************* --}}
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Tanque</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Tanque:</div>
                            <a class="dropdown-item" data-toggle="modal"
                            data-target="#editfactura{{$stock->id_almacenamiento}}" data-whatever="@mdo" >Actualizar</a>
            
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">


                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row no-gutters">
                              <div class="col-md-4">
                                <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxAPDw8PDxAQDg8PDw0PEA4QDw8NDQ4OFREWFhURFRUYHSggGBolGxUVITEhJSkrMi4uGB8zODMtNygtLisBCgoKDg0OFxAQGisdHR0tLS0tLSsrKy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLf/AABEIAPIA0AMBEQACEQ
                                EDEQH/xAAcAAADAAIDAQAAAAAAAAAAAAAAAQIDBAUGBwj/xABCEAABAwICBgcECAQFBQAAAAABAAIDBBESIQUGEzFBUQciYXGBkaEyUrHBFCNCYnKCktFDorLCFTNTk/A0VGPh8f/EABoBAQACAwEAAAAAAAAAAAAAAAABAgMEBQb/xAArEQEAAgIBAwQCAgICAwAAAAAAAQIDEQQSITEFE0FRIjJCYRRxUpEzobH/2gAMAwEAAhEDEQA/APcUAgEAgEAgSAQCAQS6
                                Ro3kDvICalG4YHaRgG+aId8jB81PTP0jqj7Y3aXphvqIB3zRj5p02+jrr9txrgcwbg53GYIULIdMxu9zR3uAU9Mz8K9Vfs2zNO5zT3OBTpmPg6qz8rULBAIGgEC
                                QCAQNAkDQCAQJAINesrooGF80jImNFy57g0eqmtZt4hS161jcy6XpXpOp4yW08T6g++fqovDifJbmPg3t3ns0MvqeOvavd1yr6Sa599m2KEcLNxu83Zei2a+n1jy07eqXnxDiajW7SEntVMmfBtmD+UBZo4dI+GC3qGWflx8mkal/t
                                SyO73vPzWSOLT6YZ5mT7YXySO3uJVo49fpWeVkn5T1uat7NVP8AIv8AYIPNPZqf5F/tmfpSrLNmK2aNjRhDA91sNt29auStYt+rfw5LTXvZxb4H+0ZBIe32vUq9Jn6Y8k0+1RPLTvwnmMvVZ+0+YYNz8S5Wk0/VxWDKmVnL6xxHqsV+Njt5hkryc1PFnMUuvmko9820A4Pjjd62v6rXtwqfDPT1LLHlzmj+lKQWFRTtd96NxYfI3Wvbg
                                z8Nunqcfyh2fRuv9BNYGQwOPCYYR+oZLXtx71+G3j5uG/zp2WCdkjQ6NzXtO5zHB7T3ELBMabUTE+GRE7CBoBAIEgaBIMVRUMjBc97WAZkuIAUxEz4RNoiO7zfWLXmeQujpCKeLdtndaZ/aB9kevcuhh49I727y5eflZJ7Vnph0ateZHF0sz5n83kuN/Erer28RpzMsxP8AKZaoasnU1ux2U9SslZNydhnzU7lHYrJ3TsWUGysgWAXvYFVmsLRaYXlyHqnSnr/pDmA8FOkdSdkPLMInqlZvzTcqpIVQ2tBO
                                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" class="card-img" alt="...">
                              </div>
                              <div class="col-md-8">
                                <div class="card-body">
                                  <h5 class="card-title">Nombre Almacenamiento</h5>
                                  <p class="card-text">{{$stock->nombreAlmacenamiento}}</p>
                                  <h5 class="card-title">Capacidad</h5>
                                  <p class="card-text"><small class="text-muted">{{$stock->capacidadAlmacenamiento}} Litros</small></p>
                                
                                 <h5 class="card-title">Nivel</h5>
                                  <p class="card-text"><small class="text-muted">{{$stock->nivel}}</small></p>
                                </div>
                              </div>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- modal tanque --}}
        <div class="modal fade" id="editfactura{{$stock->id_almacenamiento}}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
        
                    <div class="modal-header p-3 mb-2 bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Tanque</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
        
        
                    <form action="{{ route('almacenamiento.update', $stock->id_almacenamiento)}}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Nombre tanque:</label>
                                <input type="text" class="form-control" name="nombreAlmacenamiento" value="{{$stock->nombreAlmacenamiento}}">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Capacidad Litros:</label>
                                <input type="text" class="form-control" name="capacidadAlmacenamiento" value="{{$stock->capacidadAlmacenamiento}}">
                            </div>
                           
                        </div>
                        <input type="hidden" class="form-control" name="id_almacenamiento" value="{{$stock->id_almacenamiento}}">
                        <input type="hidden" class="form-control" name="hogar_id" value="{{$stock->id_hogar}}">
                        <input type="hidden" class="form-control" name="boton" value="1">
                        {{-- boton si es 1 se cambia los datos de solo tanque --}}


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
 {{--**********************fin ****** tanque******************************* --}}

        {{-- Stoci --}}
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Stock</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Stock:</div>
                            
                            <a class="dropdown-item" data-toggle="modal"
                            data-target="#editstock{{$stock->id_stock}}" data-whatever="@mdo" >Actualizar</a>
                            {{-- <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a> --}}
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">


                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row no-gutters">
                              <div class="col-md-4">
                                <img src="data:image/jpeg;base64,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
                                dXyHPtrsRhN5JLankqAOKCXlrAI3GiknkRHnn0Re0kk0Vl3QBUdGHyiRm1XyhKZm0jfCQooCZl4lQBFCRnQwBMno9NXvOG7TfCnkIvDoJbEAEovJCKBQCiK+yAO1o08lyXqp1Tq0uPtrWtKG1FbTy21ApbokAFNBTMAE4mAPm2jj1Zq1rUWA5MszKpZoKxEu2lVwKA3YYfZV1mNKUFOaTOa11pUqLnFa17vNGYfU4orWoqUo1JOZj1Eklcj5aUpSeVJ3tmESVIgBAkQAgBSBFwoIC5EgnrgSZB1Xzld5iLkTlPeT5wv56vvH2wuW4Zct75gvr+er7xhchly3vmQXFHMnvMLkL3vMDEkEXR1QIuRNIAQJEAIAQAgDas60HJdwOtmih15Eb0kbwYrKCmrmXpVZ0pZcHrR1LLaTL6SITLp6NE/KdM+0MkOC+Qum7FNOa1dceTJXO4+thLKipXXXo+oXr2rl/CILlY0LQlcpMNKFUrm7QQriFTToPgYAwZlbWlUBhpUo8hICW3nS6hwJTgOkaQkpcUBTEKTepugDs6P2L5tLpbLhWqq1uLIoXHHVqccXQHCqlKNNwoIA+fadSblkzqLUlym5Nuty81LrF5Dt8GiwNyqJVj1neFKBIhpNXM9dKdH1svLW00roDQpIqoJwF4HekVrnHpUaylFXvWfN2yxypTbjH4eZXo3OAQJEAIAQAgBACAEAIAQAgBACAEAIAQAgBAEgVNBiTu3wHgWnRzR9xF6ZfZFxtta0pXgVLSKpJRnTA58I5K9ZXXRes9WwWKTnl1I6lhfv8v2YeSSz1zKF20+50kzN30igupZabcKOjQOJQOwDfUnhPePpCiDgnPu8YAregZHm7wO155P9/nbu+ALGjDb7K4wBBSrdWm7HdAHzvy2uVk5UH8ul/wBVyAM9I7amJaeeDThCdTVOsnFtO45dlI76VKM6avR8/arVVpWmWQ9WrVswRre70s7/ADmUTXets3Vc6YekxbNTj2Jcyml0anzqevevf+yVWbZ7gq1NqaPzXU4d9B6YZdWOMb/IZmyT7FRrz9/7HvOeULzLrLo+iuh9FPGGkR+pNB9G1H2JRlxNJ3RmcT/QKP1aK9Bi6r03tMZWG0RxgzRdkHkbTTieaFD1RdTi8GYSpVI4xfJmsrDPDnFjN6sRWAvECRACAEAIAQArAi9GSEk5AnkKwJSbwNpmy317LLh+wr2RR1IrFo1jQqywi+TN9rRScV/Q3frKSPXWKO0U1tN49H2iX03ebRsnRO4KvzTDfC9eV3GkV0i/sxbNOr8n5k4x98CEsWY1tuOvq6kC6k9uHphfWlsSGTYqeMnLy1e+YVpQlsXZWWaZ+kReX3+0mGYcu27xpyhqowUfHF++Zlo/PuvOvl1xS/5K+MTgME5DIdkUtEIxp6ltNejqs6lpvm2/hf5R0fIsspsOVpv6f/UuxwnvF5KbuIz9sAVvQNAMu8rf55Pn9LdgCxo1890AQXSMBuwgD5G08m05yZtObquVkXixKMV1VupIq4oZEmqVdvUnG9ODnK5GNorxo03N7DXtKdU+6p1dLyjkMhQUA7gI9SEVFXI+VrVZVZucsWa0WMxAAYGoz698Bg7zcZtWYRsvODhfUR3ExR04vFI2jaKscJPmbzWlc4kU6YkcUoPqrFHQpvYbRt9oX1fZGy3pnMjApaV9ZHsMV0aGy806yrbbnw9QnSr50pLq+xT2w0fdJk9YX404mJ0iYJqqz2OzD9mGZlsmyumU3jRj74EqtyUP/D2xyV/4wzVTvsnSrP8Awr3wJVbUlT/Z6a/X/hDNVO+TpNm/hXMJtuSA/wBnpP2/4QzVTvjSbN/CuZCbdlR/w9o81f8AjDNT77IdqobKK98ANJGgapkGBzx/ZhmZd9hW2Cwox98CV6Wq+TLS6OSIaOtrZPWMl2YRXAhzTSbIoC2n6qPaTDRqZHWVo2XLgajuk84oUL6gOoBKfQKxdUKa2GUrdaH9b+xoPTzq9p1aualEd1YuoRWCMJVaku1J82a4EWM7hAkQB0LEtLzd2+UBaVJUhaTvQqlaccIzq08uNxvZq7oVMu6/ZwN7RFXuRaiJBtalyE+2p6VBNSysAqUgE40oN/WnfWvltNO5n1UJqcVJYM+oJTdN4/isQWK3oIirDyv77Pn9LdgCyK18t3rgCQ8BhTLDugD47KNokZuasiZPRtTb5mJJ8/FlS6DoidxwSndiD85MaUqmRK857VQVem4YHlPSa2XFNOCikmhGYxFQQeoggx6cZKSvR8tUpypycJYo14sUEAIEiAEAIAQAgBACAEAIAQAgBACAEAIAQAgDdsizVTDvRpUE0BUpRySlNKnjnlFKk1CN7NrPQlXnkL2je0VpadrNTTQIkLNbUywtWHTuqTdUoVGVDXsT86g8qUnJtvafVU4KnFRWC1H1NNa62UQXK3oJXoHqbPns/wB3nbsAWRX0O2kASLu+ld/OAPnXlwZCZOVOZ8+Ypwqlz2QBu6SJkXplxDqlsPC78JS82vUFKjdhQbss47aTqRgmta3HiWtWadaUZtxkrtex6tvteZxn9E5il9q4+jcptQPgfVWNVaIYPU/E5J9H1Ur4XSW9P3/s4swwts3VpUg9SgUnxjZNPA45RlDVJXeeo84kgQAgBACAEAIECBIgBACAEAIAQAgATAg2pOznnvi2lq4gYfeOHjFZTjHFmtOjUqdiLfvfgdr3q9EAubfbZB+SDecPIZV5VjHP36oK87FYMhX15qK5v3zOjZM5K0falmiAJd5RdXtroAKdYGtXdyjGvGeTlTfA7bDVoZzN0Y7L73i8P36GXkUResOV4dP/AKh2OQ9Yu4Ve1fxhAFb0EXSXeT/fZ8fpbsAWQ6nGvqgCQzXGuePfAHzny2oIk5Wv5dL/AKrkAaWmp/l732P8tMenZ/lo+X6Q/wAmXD8I5EtMrbN5takHrSSmvOmcatJ4nLCcoO+La8jtM6XzQTdWUOp6nEA+KaeNYxdng8NXkdseka6V0rpLxX6PRNtSSx8NIgH5zSrvgLvpiM3UXZlzJ0mzz7dK7/q/6ISzZi/6V9rgU3h4A+mF9ZbExk2KWEpR+/8Apk+4Esr4u0GuSxdPiqGdmsYMaJQfZrLj/ZI0OdV8W8wvksj1Q0mO1Mnq2o+zKL4nkdDpzchKuS0+ukTpNMq+jbQti5ngvRacBp0B7FIP7UTn6e8o7BaF9H4/Z5r0cmxnLr8D6DE56nvK6FaO4yDo/N/k7n3YnPQ3kaJX7jCdH5s/7u592GehvGiV+4zJGjc2cpdfgPSYjPU95OhWjuP7fs9EaKzhNOgPapA/aiM/T3llYLQ/p+6/Z7+86bG0lCeax6qxGk0zRdG2jclxM1aJKTi5My6Pt1PdQRGkJ4Jjq+S7c4riY+40mnFc+kjqbQVHwJhnKjwhzGjWddqquC/sKNmIy84ePGiB+yYn/wCz3Ii+xR70vt+jL3xMNijEi0k7lr11eivjEZmT7UmTplOHy6SXi9b98TVm9KJtwULpSOpACPEa3jFo0KcdhnUt1eerKu8tXr9zjqUSSSSScycSeZMbHJi72dvRL4x//lX/AEJjmtXy+J6PRf8Akf8Al/lHa8iySbDlabun/wBS7Hnn0ReSb2AzgCt6BqAl3hv88nx+luwBY06u1v7YAgtk4jIwB8/8tja1Wc27dJTLzLDy6DEITeST3rEAaWlTPSuees/CS7wQpDicU7ABCvmmo3x6FmnFxUdp870lQnGq6l3wvbw2lfjpPNEAIEiAEARdHVC8rcj1Q8pOypQ5Ej0RFyLqUlg2eqbQeGTzo/xF+2IyI7lyLKrUWEnzf7PX3Zmfyh376j6TEZuG5F1aay+t8zP3emsvOHPvGIzUNyJ0uv32Pd2a/KHfvGGahuQ0qv33zPM2vMf17v8A1FD0GJzcNyKu0Vn9b5s8lTzpzdcPNaj64nJjuRXO1O8+bPFaycyTzNfTFsCjbeJgAIEXImBIgBACAECDt2arzOXmJ2Y+DZ6B1CSrAuKWBdSgHMkinbzjktU43ZKxPY6LoTU841crrvPD9Hf8lLDktYcqFIVeuuLugVUQ46taMOspUk9scJ7hYzaZGIlpiv1UHwvwBx9FVOMMuJdlXwpUzNOigQdV2YccQdvOihhAHdlJ4uKurZdR9JaUpT4KMAbZWoYDLdhAEPIS8ktqSCkgggioIIoQRvGMAfOZvQSbkHFOWNM3ErNVyj2swonO7XZ9P0gMIA4U9b7bJu2rZb8mr+uY12TXf83PcCTG8LROPicNXo+hU13XPw93HtKtyMyKylpS6yckOnoXOVFZ90bxta2o4KnRM12JJ+eo2XdGJtIqGSpPWgpWD3GvhGqr03tOSdhtEfpv8jmPSziNtC0/WSoekRqpJ4M5pQlHtJrzR4gxJS9EwJEAIAQIECRACBAgSIAQBBMCL0bDMk6vYbWrklR8QIq5RWLNI05y7MW+DOk3ovNlN5TYbT85xSUD018Izdemtp0wsFol9N3maM07Z0uCZm0majNDALy69VU5dojGVrWxHXT6Jk+3Ll+3+ibPttb+FkWS46d0zN6rY+kBUJPXga8IwnXnLaehRsNGlrSve96zv2X5PnX30zFsTHnTidhhOEs0c9mgv05Cu+sYnYfQwbmGfhAC7d1s/wCMALtdfw5QA2+FPXAE9NTCmWHdABRB2M+GGEAARSh2vGu7GAMaChDgrXccecAVq1fJ/ZkySp6TaxzUgdEo9Rq2QTAHBV5JWWzekp2dlR1Id1B2YE98ABorbrX83tpLoG55kDvUbxMAa7stpCnBctZkyd+CkqPaq6IspyWDM5UqcsYp8DUXMWij47RttX5qYQO67ei+eqbzF2Kzv6Eay7Tu/HaPTyfzanHB4ACLK0VN5k+jbO/p+7/Z4rt2TG1ZNqoH5uv6xidJqFeq7P48zBekNmfklqJ5tI9sTpU/Aq+iqG98/QwVpLY9Ni0QeLSInSp7kR1TR3y+36CdJLI+ZaR5NIhpU9yHVNHfL7fozRpDZv5Hai+TSPbEaVPwLLoqh48/Q9EW5KHFFkWqsfmyP1TEaTUJ6rs+58z2btJS/idHZ1X51bjf6wiHaKm8uujrOvp+7/ZsIftNeDOjjKD1uvtqpzCikxXPVN7NFYrOvoXI3GpTSJWCGrMluqiVFQ7QFCsUcm8WbxpwjgkuB7nQ+2nf5zbZbB+SyyBzAUCkiKlyW/JFKrN6bmZuaH9q8bvDAa3jAFjsrQiz5Ygy8m0kjJRTfX95yqvGALAqh2PDDCAJqKU+V415wBCcNvsrjABIIOtl3wAINajZ8OOEAFY7HbTCAJCk76V34b4Awls+yAJVt9ogCZrdAGTux3QAY2e+AMJXfAEDb7TAEzWfZAGczl2wARsdh9cARKnPsgDFs6/fAB863dAGc0cBAA7HZACVyPOAPOX2oAObfaPVAGU1u7fVAGTmx2D1QAl9mAMJXPsgCDt9sATNZiAM39nugA1sd8AYyu/s9cAeTmZ5mAP/2Q==" class="card-img" alt="...">
                              </div>
                              <div class="col-md-8">
                                <div class="card-body">
                                  <h6 class="card-title">Máximo</h6>
                                  <p class="card-text"><small class="text-muted">{{$stock->maximo}} Litros</small></p>
                                  <h6 class="card-title">Media</h6>
                                  <p class="card-text"><small class="text-muted">{{$stock->media}} Litros</small></p>
                                  <h6 class="card-title">Mínimo</h6>
                                  <p class="card-text"><small class="text-muted">{{$stock->minimo}} Litros</small></p>
                                  
                                </div>
                              </div>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- actualizar stock  xon modal--}}
        <div class="modal fade" id="editstock{{$stock->id_stock}}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
        
                    <div class="modal-header p-3 mb-2 bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Stock</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
        
        
                    <form action="{{ route('almacenamiento.update', $stock->id_stock)}}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Máxima:</label>
                                <input type="text" class="form-control" name="maximo" value="{{$stock->maximo}}">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Media:</label>
                                <input type="text" class="form-control" name="media" value="{{$stock->media}}">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Baja:</label>
                                <input type="text" class="form-control" name="minimo" value="{{$stock->minimo}}">
                            </div>
                           
                        </div>
                        <input type="hidden" class="form-control" name="hogar_id" value="{{$stock->id_hogar}}">
                        <input type="hidden" class="form-control" name="boton" value="2">
                         {{-- boton si es 2 se cambia los datos de solo stock --}}

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>


    </div>
</div>
@endforeach

</div>

@endsection
