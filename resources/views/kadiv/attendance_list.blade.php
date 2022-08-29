@extends('layouts.master')

@section('content')
    <div class="container-fluid px-4">
        <div class="row g-3 align-items-center mt-5 justify-content-between">
            <span class="row col-auto">
                <div class="col-auto">
                    <a href="{{ route('meetings.index') }}" class="badge border-0 bg-white px-2 rounded-3 shadow-cs"><i
                            class="fa-solid fa-2x fa-angle-left text-muted"></i></a>
                </div>
                <div class="col-auto">
                    <h5 class="fw-normal">List Kehadiran Anggota • Pertemuan {{ $meeting->pertemuan }}</h5>
                </div>
            </span>
            <span class="row col-auto">
                <form action="{{ route('list-presence', $meeting->token) }}">
                    <span class="row col-auto">
                        <div class="col-auto">
                            <input type="search" value="{{ request('search') }}" id="search" class="form-control"
                                name="search" placeholder="Cari">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary px-4">Cari</button>
                        </div>
                    </span>
                </form>
            </span>
        </div>
        <div class="row shadow-cs rounded-4 bg-white px-2 mx-1 my-3">
            <div class="table-responsive">
                <table class="table">
                    <tr class="border-bottom border-dark">
                        <th class="py-3">No</th>
                        <th class="py-3 col-4">Nama</th>
                        <th class="py-3">Waktu Presensi</th>
                        <th class="py-3">Status</th>
                        <th class="py-3 text-center">Aksi</th>
                    </tr>
                    @if ($presence->count() > 0)
                        @foreach ($presence as $presences)
                            <tr class="align-middle">
                                <td class="align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle">{{ $presences->user->name }}</td>
                                <td class="align-middle">{{ $presences->created_at->format('H:i:s') }} WIB</td>
                                @if ($presences->status === 'Hadir')
                                    <td class="text-truncate align-middle"><span
                                            class="badge bg-success">{{ $presences->status }}</span></td>
                                @elseif ($presences->status === 'Izin')
                                    <td class="text-truncate align-middle"><span
                                            class="badge bg-warning text-dark">{{ $presences->status }}</span></td>
                                @elseif ($presences->status === 'Sakit')
                                    <td class="text-truncate align-middle"><span
                                            class="badge bg-info text-dark">{{ $presences->status }}</span></td>
                                @elseif ($presences->status === 'Alpha')
                                    <td class="text-truncate align-middle"><span
                                            class="badge bg-danger">{{ $presences->status }}</span></td>
                                @endif
                                <td class="d-flex justify-content-center">
                                    <a href="{{ route('detail-presence', [$presences->nim, $presences->meetings->slug]) }}"
                                        class="ms-3 col-md-8 btn btn-primary text-light my-2">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center text-danger">Data tidak ditemukan</td>
                        </tr>
                    @endif
                </table>
            </div>

            {{ $presence->links('vendor.pagination.custom') }}

        </div>
    </div>
@endsection
