@extends('dashboard')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('invalid'))
        <div class="alert alert-danger">
            {{ session('invalid') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- Page Heading -->
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-target="#modalpropias"
                data-toggle="modal">Transferencia entre cuentas propias</a>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-target="#modalTerceros"
                data-toggle="modal">Transferencia entre cuentas de teceros</a>
            <a href="{{ route('accounts.create') }}"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Crear nueva cuenta</a>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <!-- Basic Card Example -->
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Lista de cuentas</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Numero de cuenta</th>
                                        <th>Saldo</th>
                                        <th>Fecha de creación</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allAcounts as $account)
                                        <tr>
                                            <td>{{ $account->account_number }} </td>
                                            <td>{{ $account->balance }}</td>
                                            <td>{{ $account->created_at }} </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalpropias" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Transferencia entre cuentas propias</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('transfer.store') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        @if (count($allAcounts) > 1)
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="origing_account">Cuenta origen</label>
                                    <select id="origing_account" name="origing_account" class="form-control">
                                        <option selected>Seleccionar...</option>
                                        @foreach ($allAcounts as $account)
                                            <option value=" {{ $account->id }} "> {{ $account->account_number }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="destination_account">Cuenta destino</label>
                                    <select id="destination_account" name="destination_account" class="form-control">
                                        <option selected>Seleccionar...</option>
                                        @foreach ($allAcounts as $account)
                                            <option value=" {{ $account->id }} "> {{ $account->account_number }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="value">Valor</label>
                                    <input type="number" name="value" class="form-control" id="value" required>
                                </div>
                            </div>
                        @else
                            <div>Solo tiene 0 o 1 cuenta disponible </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Transferir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalTerceros" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Transferencia entre cuentas de terceros</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('transfer.store') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        @if (count($thirdAccounts) >= 1 && count($allAcounts) >= 1)
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="origing_account">Cuenta origen</label>
                                    <select id="origing_account" name="origing_account" class="form-control">
                                        <option selected>Seleccionar...</option>
                                        @foreach ($allAcounts as $account)
                                            <option value=" {{ $account->id }} "> {{ $account->account_number }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="destination_account">Cuenta destino</label>
                                    <select id="destination_account" name="destination_account" class="form-control">
                                        <option selected>Seleccionar...</option>
                                        @foreach ($thirdAccounts as $account)
                                            <option value=" {{ $account->id }} "> {{ $account->account_number }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="value">Valor</label>
                                    <input type="number" name="value" class="form-control" id="value" required>
                                </div>
                            </div>
                        @else
                            <div>Solo tiene 0 o 1 cuenta disponible </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Transferir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
