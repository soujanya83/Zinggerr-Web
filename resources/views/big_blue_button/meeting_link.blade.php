<!DOCTYPE html>
<html>
<head>
    <title>Meeting Link</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Meeting Created Successfully</h2>
        <p>Your meeting (ID: {{ $meetingId }}) has been created. Below is the link to join the meeting:</p>

        <div class="input-group mb-3">
            <input type="text" class="form-control" id="meetingLink" value="{{ $joinUrl }}" readonly>
            <button class="btn btn-outline-secondary" type="button" onclick="copyLink()">Copy Link</button>
        </div>

        <a href="{{ $joinUrl }}" class="btn btn-primary">Join Meeting</a>
        <a href="{{ route('bbb.list') }}" class="btn btn-secondary">Back to Meeting List</a>
    </div>

    <script>
        function copyLink() {
            var copyText = document.getElementById("meetingLink");
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices
            navigator.clipboard.writeText(copyText.value)
                .then(() => {
                    alert("Meeting link copied to clipboard!");
                })
                .catch(err => {
                    console.error('Failed to copy: ', err);
                    alert("Failed to copy the link. Please copy it manually.");
                });
        }
    </script>
</body>
</html>
