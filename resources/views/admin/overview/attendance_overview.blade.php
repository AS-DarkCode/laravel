<div class="section mt-4">
    <div class="section-heading">
        <h2 class="title">Attendance Overview (Today)</h2>
        <a href="{{ url('attendance') }}" class="link">View Detailed</a>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="card text-center shadow-sm" style="background: linear-gradient(135deg, #28a745, #1d7a34); color: white; border-radius: 15px; padding: 20px;">
                <h5 class="mb-2">Present</h5>
                {{-- <h2 class="mb-0" style="font-size: 2.5rem; font-weight: bold;">{{ $presentCount }}</h2> --}}
            </div>
        </div>
        <div class="col-4">
            <div class="card text-center shadow-sm" style="background: linear-gradient(135deg, #dc3545, #b02a37); color: white; border-radius: 15px; padding: 20px;">
                <h5 class="mb-2">Absent</h5>
                {{-- <h2 class="mb-0" style="font-size: 2.5rem; font-weight: bold;">{{ $absentCount }}</h2> --}}
            </div>
        </div>
        <div class="col-4">
            <div class="card text-center shadow-sm" style="background: linear-gradient(135deg, #ffc107, #d39e00); color: white; border-radius: 15px; padding: 20px;">
                <h5 class="mb-2">Pending</h5>
                {{-- <h2 class="mb-0" style="font-size: 2.5rem; font-weight: bold;">{{ $pendingCount }}</h2> --}}
            </div>
        </div>
    </div>
</div>