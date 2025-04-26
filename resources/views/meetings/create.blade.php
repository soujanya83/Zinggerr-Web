<div class="container mx-auto p-6 bg-gray-100 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-4">Create a Meeting</h1>
    <form method="POST" action="{{ route('meetings.create') }}" id="createMeetingForm" class="space-y-4">
        @csrf
        <div>
            <label for="meeting_name" class="block text-sm font-medium text-gray-700">Meeting Name</label>
            <input type="text" name="meeting_name" id="meeting_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <div>
            <label for="meeting_id" class="block text-sm font-medium text-gray-700">Meeting ID</label>
            <input type="text" name="meeting_id" id="meeting_id" value="{{ Str::random(10) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <div>
            <label for="meeting_admin_pw" class="block text-sm font-medium text-gray-700">Moderator Password</label>
            <input type="text" name="meeting_admin_pw" id="meeting_admin_pw" value="mp" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <div>
            <label for="meeting_attenduser_pw" class="block text-sm font-medium text-gray-700">Attendee Password</label>
            <input type="text" name="meeting_attenduser_pw" id="meeting_attenduser_pw" value="ap" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Create Meeting</button>
    </form>

    <!-- Keep the Join and Recordings forms as they are -->
    <h1 class="text-2xl font-bold mb-4 mt-6">Join a Meeting</h1>
    <form method="GET" action="{{ route('meetings.join') }}" class="space-y-4">
        <div>
            <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label>
            <input type="text" name="full_name" id="full_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <div>
            <label for="meeting_id" class="block text-sm font-medium text-gray-700">Meeting ID</label>
            <input type="text" name="meeting_id" id="meeting_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <div>
            <label for="is_moderator" class="block text-sm font-medium text-gray-700">Join as Moderator</label>
            <input type="checkbox" name="is_moderator" id="is_moderator" value="1" class="h-4 w-4 text-blue-600 border-gray-300 rounded">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Join Meeting</button>
    </form>

    <h1 class="text-2xl font-bold mb-4 mt-6">View Recordings</h1>
    <form method="GET" action="{{ route('meetings.recordings') }}" class="space-y-4">
        <div>
            <label for="meeting_id" class="block text-sm font-medium text-gray-700">Meeting ID</label>
            <input type="text" name="meeting_id" id="meeting_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Get Recordings</button>
    </form>

    <script>
        document.getElementById('createMeetingForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
            const response = await fetch('{{ route('meetings.create') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            const data = await response.json();
            if (response.ok) {
                alert('Meeting created! Meeting ID: ' + data.meetingId);
                window.location.href = '{{ route('bbb.room-link', ['meetingId' => ':meetingId']) }}'.replace(':meetingId', data.meetingId);
            } else {
                alert('Error: ' + data.message);
            }
        });
    </script>
</div>
</body>
</html>
