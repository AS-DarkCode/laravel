
@if (session('success'))
<div class="modal fade show" id="successModal" tabindex="-1" role="dialog" style="display: block;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success">Success</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                {{ session('success') }}
            </div>
        </div>
    </div>
</div>
<script>
    setTimeout(() => {
        document.getElementById("successModal").style.display = "none";
    }, 3000);
</script>
@endif

@if ($errors->any())
<div class="modal fade show" id="errorModal" tabindex="-1" role="dialog" style="display: block;">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">Errors</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-danger">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<script>
    setTimeout(() => {
        document.getElementById("errorModal").style.display = "none";
    }, 3000);
</script>
@endif
