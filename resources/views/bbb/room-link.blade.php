<!DOCTYPE html>
<html>
<head>
    <title>Meeting Room Created</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container mx-auto p-6 bg-gray-100 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4">Meeting Room Created</h1>
        <p class="mb-4">Meeting ID: {{ $meetingId }}</p>
        <h2 class="text-xl font-semibold mb-2">Join Links:</h2>
        <div class="mb-4">
            <p><strong>Moderator Link:</strong> <a href="{{ $joinUrl }}" target="_blank" class="text-blue-500 hover:underline">{{ $joinUrl }}</a></p>
            <button onclick="navigator.clipboard.writeText('{{ $joinUrl }}')" class="bg-gray-500 text-white px-2 py-1 rounded-md mt-2">Copy Moderator Link</button>
        </div>
        <div>
            <p><strong>Attendee Link:</strong> <a href="{{ $attendeeJoinUrl }}" target="_blank" class="text-blue-500 hover:underline">{{ $attendeeJoinUrl }}</a></p>
            <button onclick="navigator.clipboard.writeText('{{ $attendeeJoinUrl }}')" class="bg-gray-500 text-white px-2 py-1 rounded-md mt-2">Copy Attendee Link</button>
        </div>
        <a href="{{ route('meetings.index') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Back to Meetings</a>
    </div>
</body>
</html>
