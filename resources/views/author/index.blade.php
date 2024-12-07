@extends('layouts.admin')

@section('content')

<h1> Authors </h1>

<table id="authors" class="display" style="width:100%">
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Description</th>
            <th>Author Photo</th>
            <th>Nationality</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($authors as $author)
        <tr>
            <td>{{ $author->first_name }}</td>
            <td>{{ $author->last_name }}</td>
            <td>{{ $author->description }}</td>
            <td>{{ $author->author_photo_url }}</td>
            <td>{{ $author->nationality }}</td>
            <td>{{ $author->created_at }}</td>
            <td>{{ $author->updated_at }}</td>
            <td style="width: 20%;text-align:right;">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Options
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{ route('author.show', $author->id) }}">
                            <i class="far fa-eye"></i> View</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('author.edit', $author->id) }}">
                            <i class="far fa-edit"></i> Edit</a>
                        </li>
                        <li>
                            <form class="dropdown-item" method="POST" action="{{ route('author.destroy', $author->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="bt-destroy" onclick="return confirm('Are you sure?')" type="submit"><i class="far fa-trash-alt"></i> Delete</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<a class="btn btn-primary" href="{{ route('author.create') }}">Add Author</a>
<script>
    $(document).ready(function() {
        $('#authors').DataTable();
    });
</script>
@endsection