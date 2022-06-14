@extends('dashboard')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <!-- Basic Card Example -->
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Lista de cuentas propias</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <form action="{{ route('accounts.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="account_number">Numero de cuenta</label>
                                    <input type="number" name="account_number" class="form-control" id="account_number"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="balance">Saldo</label>
                                    <input type="number" name="balance" class="form-control" id="balance" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
