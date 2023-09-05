@extends('layouts.admin')

@section('content')
    <div class="d-sm-flex justify-content-between">
        <div>
            <h5 class="text-white font-weight-bold mb-0 d-none" id="filterLabel"></h5>
        </div>
        <div class="d-flex">
            <div class="dropdown d-inline">
                <a href="javascript:;" class="btn btn-outline-dark dropdown-toggle text-white border-white"
                    data-bs-toggle="dropdown" id="navbarDropdownMenuLink2">
                    Update Status <i class="fas fa-edit ms-2"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3" aria-labelledby="navbarDropdownMenuLink2"
                    data-popper-placement="left-start">

                    <li><a class="dropdown-item border-radius-md filter" data-filter="1"
                            href="{{ route('pengguna.update.status', ['id' => $user->id, 'status' => '1']) }}">
                            Active</a>
                    </li>
                    <li><a class="dropdown-item border-radius-md filter" data-filter="0"
                            href="{{ route('pengguna.update.status', ['id' => $user->id, 'status' => '0']) }}">
                            InActive</a>
                    </li>
                    <li>
                        <hr class="horizontal dark my-2">
                    </li>
                    <li><a class="dropdown-item border-radius-md filter text-danger" data-filter="2"
                            href="{{ route('pengguna.update.status', ['id' => $user->id, 'status' => '2']) }}">
                            Blocked</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-3">
                    <div class="container">
                        <h6 class="mb-3">Personal Information</h6>
                        <ul class="list-group">
                            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-3 text-sm">{{ $user->name }}</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="d-flex flex-column">
                                                <span class="mb-2 text-xs">
                                                    Email Address:
                                                    <span class="text-dark font-weight-bold">{{ $user->email }}</span>
                                                </span>
                                                <span class="mb-2 text-xs">
                                                    Phone Number:
                                                    <span
                                                        class="text-dark font-weight-bold">{{ $user->phone ?? '-' }}</span>
                                                </span>
                                                <span class="text-xs">
                                                    Email Verified:
                                                    <span class="text-dark font-weight-bold">
                                                        <span
                                                            class="badge bg-gradient-{{ $user->email_verified_at ? 'dark' : 'danger' }}">
                                                            {{ $user->email_verified_at ? 'Verified' : 'Unverified' }}
                                                        </span>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex flex-column">
                                                <span class="mb-2 text-xs">
                                                    Bergabung:
                                                    <span
                                                        class="text-dark font-weight-bold">{{ $user->created_at->format('d F Y') }}</span>
                                                </span>
                                                <span class="mb-2 text-xs">
                                                    Social Login:
                                                    <span class="text-dark font-weight-bold">
                                                        <span
                                                            class="badge bg-gradient-{{ $user->social_id ? 'dark' : 'danger' }}">
                                                            {{ $user->social_id ? 'Set' : 'Unset' }}
                                                        </span>
                                                    </span>
                                                </span>
                                                <span class="mb-2 text-xs">
                                                    Status:
                                                    <span class="text-dark font-weight-bold">
                                                        <span
                                                            class="badge bg-gradient-{{ $user->status == 0 ? 'dark' : ($user->status == 1 ? 'primary' : 'danger') }}">
                                                            {{ $user->status == 0 ? 'Inactive' : ($user->status == 1 ? 'Active' : 'Blocked') }}
                                                        </span>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-6 text-center">
                            <div class="border-dashed border-1 border-secondary border-radius-md py-3">
                                <h6 class="text-primary text-gradient mb-0">Saldo</h6>
                                <h4 class="font-weight-bolder"><span class="small">Rp. </span><span id="state1"
                                        countto="{{ number_format($user->saldo, 0, ',', '.') }}">{{ number_format($user->saldo, 0, ',', '.') }}</span>
                                </h4>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6 text-center">
                            <div class="border-dashed border-1 border-secondary border-radius-md py-3">
                                <h6 class="text-primary text-gradient mb-0">Transaksi</h6>
                                <h4 class="font-weight-bolder"><span id="state2"
                                        countto="{{ $user->transaksi->count() }}">{{ $user->transaksi->count() }}</span>
                                </h4>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6 text-center mt-4 mt-lg-0">
                            <div class="border-dashed border-1 border-secondary border-radius-md py-3">
                                <h6 class="text-primary text-gradient mb-0">Selesai</h6>
                                <h4 class="font-weight-bolder"><span id="state3"
                                        countto="{{ $user->transaksi->where('status', 'success')->count() }}">{{ $user->transaksi->where('status', 'success')->count() }}</span>
                                </h4>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6 text-center mt-4 mt-lg-0">
                            <div class="border-dashed border-1 border-secondary border-radius-md py-3">
                                <h6 class="text-primary text-gradient mb-0">Other</h6>
                                <h4 class="font-weight-bolder"><span id="state4"
                                        countto="{{ $user->transaksi->where('status', '!=', 'success')->count() }}">{{ $user->transaksi->where('status', '!=', 'success')->count() }}</span>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-4">
            <div class="card mb-4">
                <div class="card-header pb-0 p-3">
                    <h6>History Transaksi</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Order Id
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Jenis</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Total Harga</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($user->transaksi as $item)
                                    <tr>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $item->order_id }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">
                                                {{ $item->jenis == 'purchase' ? 'Purchase' : 'Deposit' }}
                                            </p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm font-weight-bold mb-0">
                                                Rp. {{ number_format($item->total_harga, 0, ',', '.') }}
                                            </p>
                                        </td>
                                        <td class="align-middle text-end">
                                            <p class="text-sm font-weight-bold mb-0">
                                                <span
                                                    class="badge bg-gradient-{{ $item->status == 'success'
                                                        ? 'dark'
                                                        : ($item->status == 'pending'
                                                            ? 'warning'
                                                            : ($item->status == 'process'
                                                                ? 'primary'
                                                                : ($item->status == 'failed'
                                                                    ? 'danger'
                                                                    : ($item->status == 'expired'
                                                                        ? 'secondary'
                                                                        : ($item->status == 'cancel'
                                                                            ? 'info'
                                                                            : 'secondary'))))) }}">
                                                    {{ $item->status }}
                                                </span>

                                            </p>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
