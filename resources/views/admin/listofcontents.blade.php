@extends('layouts.admin')

@section('content')
<div class="container my-4">
    <h1 class="mb-4">Content List</h1>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Type</th>
                <th>File</th>
                <th>External Link</th>
                <th>Tags</th>
                <th>Platform</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contents as $content)
                <tr>
                    <td>{{ $content->id }}</td>
                    <td>{{ $content->title }}</td>
                    <td>{{ Str::limit($content->description, 50) }}</td>
                    <td>{{ ucfirst($content->type) }}</td>
                    <td>
                        @if($content->file_path)
                            <a href="{{ $content->file_path }}" target="_blank">View</a>
                        @endif
                    </td>
                    <td>
                        @if($content->external_link)
                            <a href="{{ $content->external_link }}" target="_blank">Open</a>
                        @endif
                    </td>
                    <td>{{ Str::limit($content->tags, 30) }}</td>
                    <td>
                        @php
                            $platforms = is_array($content->platform) 
                                ? $content->platform 
                                : json_decode($content->platform, true);

                            $colors = [
                                'facebook' => 'primary',
                                'whatsapp' => 'success',
                                'telegram' => 'info',
                                'instagram' => 'danger',
                                'tiktok' => 'dark',
                            ];
                        @endphp

                        @if(!empty($platforms))
                            @foreach($platforms as $p)
                                <span class="badge bg-{{ $colors[$p] ?? 'secondary' }}">
                                    {{ ucfirst($p) }}
                                </span>
                            @endforeach
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td>{{ $content->start_date }}</td>
                    <td>{{ $content->end_date }}</td>
                    <td>
                        @if($content->status_id == 1)
                            <span class="badge bg-success">Active</span>
                        @elseif($content->status_id == 2)
                            <span class="badge bg-warning">Pending</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </td>
                    {{-- <td>
                        <a href="{{ route('contents.edit', $content->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('contents.destroy', $content->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $contents->links() }}
    </div>
</div>
@endsection
