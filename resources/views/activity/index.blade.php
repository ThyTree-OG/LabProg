@extends('layouts.admin')

@section('content')
<h1>Activities</h1>

<table id="activities" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Type</th>
            <th>Status</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($activities as $activity)
        <tr>
            <td>{{ $activity->name }}</td>
            <td>{{ $activity->description }}</td>
            <td>{{ $activity->type }}</td>
            <td>{{ $activity->status }}</td>
            <td>{{ $activity->start_date }}</td>
            <td>{{ $activity->end_date }}</td>
            <td>{{ $activity->created_at }}</td>
            <td>{{ $activity->updated_at }}</td>
            <td style="width: 20%;text-align:right;">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Options
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('activity.show', $activity->id) }}">
                            <i class="far fa-eye"></i> View</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('activity.edit', $activity->id) }}">
                            <i class="far fa-edit"></i> Edit</a>
                        </li>
                        <li>
                            <form class="dropdown-item" method="POST" action="{{ route('activity.destroy', $activity->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="bt-destroy" onclick="return confirm('Are you sure?')" type="submit">
                                    <i class="far fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<a class="btn btn-primary" href="{{ route('activity.create') }}">Add New Activity</a>

<script>
    $(document).ready(function() {
        $('#activities').DataTable();
    });
</script>
@endsection
