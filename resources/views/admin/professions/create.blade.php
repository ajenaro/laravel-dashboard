@extends('admin.layouts.layout')

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Profesiones</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.professions.index') }}">Profesiones</a></li>
                    <li class="breadcrumb-item active">Añadir Profesión</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('content')

    <form method="POST" action="{{ route('admin.professions.store') }}">
        @csrf
        <div class="row">

            <div class="col-md-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Nueva Profesión</h3>
                    </div>
                    <div class="card-body">

                        @include('admin.professions._fields', ['btnText' => 'Crear Profesión'])

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

        </div>
    </form>

@endsection
