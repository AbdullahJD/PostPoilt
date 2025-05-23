<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Post</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Poppins', sans-serif;
    }
    .form-container {
      max-width: 700px;
      margin: 50px auto;
      background: #fff;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    .form-title {
      font-size: 28px;
      font-weight: 600;
      margin-bottom: 25px;
      text-align: center;
      color: #4158d0;
    }
    .form-check-label {
      margin-right: 15px;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <div class="form-title">Schedule a New Post</div>
    <form method="POST" action="/posts" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" required>
      </div>

      <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
      </div>

      <div class="mb-3">
        <label for="image" class="form-label">Upload Image</label>
        <input type="file" class="form-control" id="image" name="image">
      </div>

      <div class="mb-3">
        <label for="scheduled_time" class="form-label">Scheduled Time</label>
        <input type="datetime-local" class="form-control" id="scheduled_time" name="scheduled_time" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Select Platforms</label><br>

        @forelse(auth()->user()->platforms as $platform)
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="platforms[]" value="{{ $platform->type }}" id="{{ $platform->type }}">
            <label class="form-check-label" for="{{ $platform->type }}">{{ $platform->name }}</label>
          </div>
        @empty
          <p class="text-danger">You haven't selected any platforms yet. <a href="/settings/platforms">Manage Platforms</a></p>
        @endforelse
      </div>

      <div class="text-center">
        <button type="submit" class="btn btn-primary px-5">Schedule Post</button>
      </div>
    </form>
  </div>
</body>
</html>