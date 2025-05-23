@extends('dashboard.layouts.layout')

@section('body')
<!-- Breadcrumb -->
<ol class="breadcrumb">
  <li class="breadcrumb-item">Dashboard</li>
  <li class="breadcrumb-item active">Scheduled Posts</li>
</ol>

<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row mt-4">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <strong>Your Scheduled Posts</strong>
          </div>

          <div class="card-body">
            @if(session('success'))
              <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered table-hover table-striped">
              <thead class="table-dark">
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Status</th>
                  <th>Scheduled Time</th>
                  <th>Platforms</th>
                  <th>Created At</th>
                </tr>
              </thead>
              <tbody>
                @forelse($posts as $index => $post)
                  <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $post->title }}</td>
                    <td>
                      @if($post->status === 'published')
                        <span class="badge bg-success">Published</span>
                      @elseif($post->status === 'scheduled')
                        <span class="badge bg-warning text-dark">Scheduled</span>
                      @else
                        <span class="badge bg-secondary">{{ ucfirst($post->status) }}</span>
                      @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($post->scheduled_time)->format('Y-m-d H:i') }}</td>
                    <td>
                      @foreach($post->platforms as $platform)
                        <span class="badge bg-info text-white">{{ $platform->name }}</span>
                      @endforeach
                    </td>
                    <td>{{ $post->created_at->format('Y-m-d H:i') }}</td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="6" class="text-center">No posts found.</td>
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
@endsection
