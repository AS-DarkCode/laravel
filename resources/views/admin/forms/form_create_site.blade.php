
        <!-- Create Site form Sheet start-->

<div class="modal fade action-sheet" id="createSiteSheet" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Side</h5>
            </div>
            <div class="modal-body">
                <div class="action-sheet-content">
                    <form method="POST" action="">
                        @csrf
                        <div class="form-group basic">
                            <label class="label" for="site_date">Date</label>
                            <input type="date" class="form-control" id="site_date" name="site_date" required>
                        </div>
                        <div class="form-group basic">
                            <label class="label" for="site_name">Site Name</label>
                            <input type="text" class="form-control" id="site_name" name="site_name" placeholder="Enter site name" required>
                        </div>
                        <div class="form-group basic">
                            <label class="label" for="site_location">Site Location</label>
                            <input type="text" class="form-control" id="site_location" name="site_location" placeholder="Enter site location" required>
                        </div>
                        <div class="form-group basic">
                            <label class="label" for="owner_name">Site Owner Name</label>
                            <input type="text" class="form-control" id="owner_name" name="owner_name" placeholder="Enter owner name" required>
                        </div>
                        <div class="form-group basic">
                            <label class="label" for="contractor_name">Contractor Name</label>
                            <input type="text" class="form-control" id="contractor_name" name="contractor_name" placeholder="Enter contractor name" required>
                        </div>
                        <div class="form-group basic">
                            <label class="label" for="site_area">Site Area (sq ft)</label>
                            <input type="number" step="0.01" class="form-control" id="site_area" name="site_area" placeholder="Enter site area" required>
                        </div>
                        <div class="form-group basic">
                            <button type="submit" class="btn btn-primary btn-block btn-lg" name="create-site-btn">Create Site</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
        <!-- Create Site form Sheet end-->
