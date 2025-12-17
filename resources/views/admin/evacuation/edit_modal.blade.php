<div class="modal fade" id="editEvacuationSiteModal{{ $site->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Make modal large -->
        <div class="modal-content">
            <form action="{{ route('admin.evacuation.update', $site->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Evacuation Site</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <!-- LEFT COLUMN: Map + Lat/Lon -->
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Location</label>
                            <div id="mapEdit{{ $site->id }}" style="height: 300px;"></div>

                            <div class="row mt-5">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Latitude</label>
                                        <input type="text" name="lat" class="form-control"
                                            id="latEdit{{ $site->id }}" value="{{ $site->lat }}" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Longitude</label>
                                        <input type="text" name="lon" class="form-control"
                                            id="lonEdit{{ $site->id }}" value="{{ $site->lon }}" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <p id="addressEdit{{ $site->id }}" class="form-control"
                                        style="background-color: #f8f9fa; min-height: 38px;">
                                        Loading...
                                    </p>
                                </div>
                            </div>


                        </div>

                        <!-- RIGHT COLUMN: Site info -->
                        <div class="col-lg-6 mb-3">
                            <div class="mb-3">
                                <label class="form-label">Site Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $site->name }}"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Capacity</label>
                                <input type="number" name="capacity" class="form-control" value="{{ $site->capacity }}"
                                    required>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="is_open"
                                    id="isOpen{{ $site->id }}" {{ $site->is_open ? 'checked' : '' }}>
                                <label class="form-check-label" for="isOpen{{ $site->id }}">Open</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update
                        Site</button>
                </div>
            </form>
        </div>
    </div>
</div>
