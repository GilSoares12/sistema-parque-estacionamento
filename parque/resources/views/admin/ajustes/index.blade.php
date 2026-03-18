@extends('adminlte::page')


@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Ajustes do Sistema</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">Inicio</a></li>
                <li class="breadcrumb-item active">Ajustes</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->

<hr>

@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary ">
            <div class="card-header">
                <h3 class="card-title text-white">Preencher os campos do formulário</h3>

                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{url('admin/ajustes/create')}}" method="POST" enctype="multipart/form-data">
                @csrf    
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Nome do Sistema</label> <b> (*)</b>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-building"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" name="nome" id="nome"
                                            value="{{ old('nome', $ajuste->nome ?? '')}}" placeholder=" Ex: Sistema Parque XYZ" required>

                                    </div>
                                    @error('nome')
                                    <small style="color: red">{{$message}}</small>

                                    @enderror

                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="">Descrição</label> <b> (*)</b>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-align-left"></i>
                                            </span>
                                        </div>
                                        <textarea class="form-control" name="descricao" id="descricao" rows="1"
                                            placeholder=" Descrição do négocio..."
                                            required>{{ old('descricao',$ajuste->descricao ?? '')}}</textarea>


                                    </div>
                                    @error('descricao')
                                    <small style="color: red">{{$message}}</small>

                                    @enderror

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Filial</label> <b> (*)</b>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" name="filial" id="filial"
                                            value="{{ old('filial', $ajuste->filial ?? '')}}" placeholder=" Ex: Filial Central" required>

                                    </div>
                                    @error('filial')
                                    <small style="color: red">{{$message}}</small>

                                    @enderror

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Telefone</label> <b> (*)</b>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-phone"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" name="telefone" id="telefone"
                                            value="{{ old('telefone',$ajuste->telefone ?? '')}}" placeholder=" Ex: +224 9xx-xxx-xxx" required>

                                    </div>
                                    @error('telefone')
                                    <small style="color: red">{{$message}}</small>

                                    @enderror

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Direcão</label> <b> (*)</b>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-home"></i>
                                            </span>
                                        </div>
                                        <textarea class="form-control" name="direcao" id="direcao" rows="1"
                                            placeholder=" Direcão completa..." required>{{ old('direcao',$ajuste->direcao ?? '')}}</textarea>

                                    </div>
                                    @error('direcao')
                                    <small style="color: red">{{$message}}</small>

                                    @enderror

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="divisa">Moeda</label><b> (*)</b>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-dollar-sign"></i>
                                            </span>
                                        </div>
                                        <select class="form-control" name="divisa" id="divisa" required>
                                            <option value="">Selecione a moeada</option>
                                            <option value="KZ" {{old ('divisa',$ajuste->divisa ?? '') == 'KZ' ? 'selected' : '', }}>
                                                KZ: Kwanza
                                            </option>
                                            <option value="USD" {{old ('divisa',$ajuste->divisa ?? '') == 'USD' ? 'selected' : ''}}>
                                                USD: Dollar
                                            </option>
                                            <option value="EUR" {{old ('divisa',$ajuste->divisa ?? '') == 'EUR' ? 'selected' : ''}}>
                                                EUR: Euro
                                            </option>
                                        </select>
                                    </div>
                                    @error('divisa')
                                    <small style="color: red">{{$message}}</small>

                                    @enderror

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Correio Electronico</label> <b> (*)</b>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                        </div>
                                        <input type="email" class="form-control" name="correio" id="correio"
                                            value="{{ old('correio', $ajuste->correio ?? '')}}" placeholder=" info@tuaempresa.com" required>

                                    </div>
                                    @error('correio')
                                    <small style="color: red">{{$message}}</small>

                                    @enderror

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Página Web</label> <b> (*)</b>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-globe"></i>
                                            </span>
                                        </div>
                                        <input type="url" class="form-control" name="pagina_web" id="pagina_web"
                                            value="{{ old('pagina_web',$ajuste->pagina_web ?? '')}}" placeholder=" https://www.tuaempresa.com">

                                    </div>
                                    @error('pagina_web')
                                    <small style="color: red">{{$message}}</small>

                                    @enderror

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="logo">Logo Principal</label> 
                                    @if(!isset($ajuste) || !$ajuste->logo)
                                    <b> (*)</b>
                                    @endif
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-image"></i>
                                            </span>
                                        </div>
                                        <input type="file" class="form-control" name="logo" id="logo" accept="image/*"
                                            onchange="mostrar_imagem(event)" @if(!isset($ajuste) || !$ajuste->logo) required @endif>

                                    </div>
                                    <center>
                                        @if(isset($ajuste) && $ajuste->logo)
                                        <img id="preview1" src="{{ asset('storage/logos/'.$ajuste->logo)}}" alt="" style="max-width:100px; margin-top:10px;">
                                    
                                        @else
                                        <img id="preview1" src="" alt="" style="max-width:100px; margin-top:10px;">
                                    
                                        @endif
                                        </center>
                                    @error('logo')
                                    <small style="color: red">{{$message}}</small>

                                    @enderror

                                </div>
                            </div>
                            <script>
                            const mostrar_imagem = e =>
                                document.getElementById('preview1').src = URL.createObjectURL(e.target.files[0]);
                            </script>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="logo">Logo para Auto</label> 
                                    @if(!isset($ajuste) || !$ajuste->logo_auto)
                                    <b> (*)</b>
                                    @endif
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-car"></i>
                                            </span>
                                        </div>
                                        <input type="file" class="form-control" name="logo_auto" id="logo_auto"
                                            accept="image/*" onchange="mostrar_imagem2(event)" @if(!isset($ajuste) || !$ajuste->logo_auto) required @endif>
>
                                    </div>

                                    <center>
                                        @if(isset($ajuste) && $ajuste->logo_auto)
                                        <img id="preview2" src="{{ asset('storage/logos/'.$ajuste->logo_auto)}}" alt="" style="max-width:100px; margin-top:10px;">
                                    
                                        @else
                                        <img id="preview2" src="" alt="" style="max-width:100px; margin-top:10px;">
                                    
                                        @endif
                                        
                                    </center>

                                    @error('logo_auto')
                                    <small style="color: red">{{$message}}</small>

                                    @enderror

                                </div>
                            </div>
                            <script>
                            const mostrar_imagem2 = e =>
                                document.getElementById('preview2').src = URL.createObjectURL(e.target.files[0]);
                            </script>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-danger">(*) Campos obrigatórios</p>
                        <button type="submit" class="btn btn-primary float-right">
                            <i class="fas fa-save"></i>
                            Guardar
                        </button>
                    </div>
                </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@stop

@section('css')
{{-- Add here extra stylesheets --}}
{{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script>
console.log("Hi, I'm using the Laravel-AdminLTE package!");
</script>
@stop