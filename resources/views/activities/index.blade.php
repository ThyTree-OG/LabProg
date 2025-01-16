@extends('layouts.admin')

@section('content')

<h1> Books </h1>

<table id="books" class="display" style="width:100%">
<thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Authors</th>
            <th>Cover URL</th>
            <th>Read Time</th>
            <th>Rating Medio</th>
            <th>Age Group</th>
            <th>Is Active</th>
            <th>Access Level</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($books as $book)
        <tr>
            <td>{{ $book->title }}</td>
            <td>{{ $book->description }}</td>
            <td>
                @foreach($book->authors as $author)
                    {{ $author->first_name }} {{ $author->last_name }}
                    @if(!$loop->last), @endif
                @endforeach
            </td>
            <td>{{ $book->cover_url }}</td>
            <td>{{ $book->read_time }}</td>
            <td>{{ $book->rating_medio }}</td>
            <td>{{ $book->age_group }}</td>
            <td>{{ $book->is_active }}</td>
            <td>{{ $book->access_level }}</td>
            <td>{{ $book->created_at }}</td>
            <td>{{ $book->updated_at }}</td>
            <td style="width: 20%;text-align:right;">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Options
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{ route('book.showAdmin', $book->id) }}">
                            <i class="far fa-eye"></i> View</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('book.edit', $book->id) }}">
                            <i class="far fa-edit"></i> Edit</a>
                        </li>
                        <li>
                            <form class="dropdown-item" method="POST" action="{{ route('book.destroy', $book->id) }}">
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
<a class="btn btn-primary" href="{{ route('book.create') }}">Add New Book</a>
<script>
    $(document).ready(function() {
        $('#books').DataTable();
    });
</script>
@endsection