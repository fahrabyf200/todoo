<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todolur - Daftar Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h2 class="card-title mb-4">Daftar Tugas (Todolur)</h2>

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('activities.store') }}" method="POST" class="mb-4">
                            @csrf
                            <div class="row g-2">
                                <div class="col-md-5">
                                    <input type="text" name="name" class="form-control"
                                        placeholder="Nama tugas..." required value="{{ old('name') }}">
                                </div>
                                <div class="col-md-5">
                                    <input type="text" name="description" class="form-control"
                                        placeholder="Deskripsi (opsional)..." value="{{ old('description') }}">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary w-100">Tambah</button>
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-hover table-bordered align-middle mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="width: 50px;">No</th>
                                        <th>Nama Tugas</th>
                                        <th>Deskripsi</th>
                                        <th style="width: 120px;">Status</th>
                                        <th style="width: 180px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($activities as $index => $activity)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td
                                                class="{{ $activity->is_completed ? 'text-decoration-line-through text-muted' : 'fw-semibold' }}">
                                                {{ $activity->name }}
                                            </td>
                                            <td class="text-muted">
                                                {{ $activity->description ?? '-' }}
                                            </td>
                                            <td class="text-center">
                                                @if ($activity->is_completed)
                                                    <span class="badge bg-success">Selesai</span>
                                                @else
                                                    <span class="badge bg-warning text-dark">Belum Selesai</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <form action="{{ route('activities.updateStatus', $activity) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                            class="btn btn-sm {{ $activity->is_completed ? 'btn-outline-secondary' : 'btn-success' }}">
                                                            {{ $activity->is_completed ? 'Batal' : 'Selesai' }}
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('activities.destroy', $activity) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus tugas ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-4">Belum ada tugas yang
                                                ditambahkan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
