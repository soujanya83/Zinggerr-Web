<h1>Recordings</h1>
@foreach ($recordings as $recording)
    <div>
        <p>Recording: {{ $recording['name'] }}</p>
        <a href="{{ $recording['playbackUrl'] }}" target="_blank">View Recording</a>
    </div>
@endforeach
