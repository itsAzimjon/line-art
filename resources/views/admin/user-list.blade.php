@extends('layouts.app')
@section('content')
<div class="mb-3">
    <input type="text" id="searchInput" class="form-control" placeholder="Qidirish...">
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Ism</th>
            <th scope="col">Rol</th>
            <th scope="col">Mutaxasislik</th>
            <th scope="col">Telefon</th>
            <th scope="col">Kridet</th>
            <th scope="col">Tahrir</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->role_id }}</td>
            <td>{{ $user->job }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->credit }}</td>
            <td class="d-flex">
                <a href="{{ route('user.edit.byadmin', ['user' => $user->id]) }}">
                    <span class="material-symbols-outlined h5">edit</span>
                </a>
                <form action="{{ route('user.delete.byadmin', ['user' => $user->id])}}" method="POST">
                @method('DELETE')
                @csrf
                    <button class="btn p-0 my-0 ml-2" onclick="return confirm('удалить?')"><span class="h5 material-symbols-outlined">delete</span></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById('searchInput');

        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                let found = false;
                row.querySelectorAll('td').forEach(cell => {
                    if (cell.textContent.toLowerCase().includes(searchTerm)) {
                        found = true;
                    }
                });
                row.style.display = found ? '' : 'none';
            });
        });
    });
</script>
@endsection

