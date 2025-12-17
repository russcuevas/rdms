<div class="modal fade" id="editAnnouncementModal{{ $announcement->id }}" tabindex="-1"
    aria-labelledby="editAnnouncementModalLabel{{ $announcement->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
<form action="{{ route('admin.announcements.update', $announcement->id) }}" method="POST" novalidate class="announcementForm">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editAnnouncementModalLabel{{ $announcement->id }}">Edit Announcement
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title{{ $announcement->id }}" class="form-label">Title</label>
                        <input type="text" name="title" id="title{{ $announcement->id }}" class="form-control"
                            value="{{ $announcement->title }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="body{{ $announcement->id }}" class="form-label">Body</label>
                        <textarea name="body" id="body{{ $announcement->id }}" rows="3" class="form-control" required>{{ $announcement->body }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="priority{{ $announcement->id }}" class="form-label">Priority</label>
                        <select name="priority" id="priority{{ $announcement->id }}" class="form-select" required>
                            <option value="normal" {{ $announcement->priority === 'normal' ? 'selected' : '' }}>Normal
                            </option>
                            <option value="high" {{ $announcement->priority === 'high' ? 'selected' : '' }}>High
                            </option>
                            <option value="critical" {{ $announcement->priority === 'critical' ? 'selected' : '' }}>
                                Critical</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" style="background-color: #1d4ed8 !important">Update Announcement</button>
                </div>
            </form>
        </div>
    </div>
</div>
