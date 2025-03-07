<div class="section mt-4">
    <div class="section-heading">
        <h2 class="title">Current Working Fields</h2>
        <a href="{{ url('worker-fields') }}" class="link">View All</a>
    </div>
    <div class="row">
        <div class="col-12">
            @if (empty($workingFields))
                <p class="text-muted">No recent working fields found.</p>
            @else
                @foreach ($workingFields as $field)
                    <div class="card mb-3" style="border: none; border-left: 5px solid #007bff; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                        <div class="card-body d-flex align-items-center">
                            <ion-icon name="construct-outline" style="font-size: 2rem; color: #007bff; margin-right: 15px;"></ion-icon>
                            <div>
                                <h5 class="mb-0">{{ $field['user_name'] }}</h5>
                                <p class="text-muted mb-0">{{ $field['site_name'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>