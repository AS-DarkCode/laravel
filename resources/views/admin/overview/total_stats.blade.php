<div class="section">
    <div class="row mt-2">
        <div class="col-6">
            <div class="stat-box">
                <div class="title">Total Income</div>
                <div class="value text-success">₹{{ number_format($dashboardSummary['total_income'] ?? 0, 2) }}</div>
            </div>
        </div>
        <div class="col-6">
            <div class="stat-box">
                <div class="title">Total Expenses</div>
                <div class="value text-danger">₹{{ number_format($dashboardSummary['total_expenses_all'] ?? 0, 2) }}</div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-6">
            <div class="stat-box">
                <div class="title">Pending Payments</div>
                <div class="value text-warning">₹{{ number_format($dashboardSummary['total_pending_payments'] ?? 0, 2) }}</div>
            </div>
        </div>
        <div class="col-6">
            <div class="stat-box">
                <div class="title">Net Balance</div>
                <div class="value">₹{{ number_format($dashboardSummary['net_balance'] ?? 0, 2) }}</div>
            </div>
        </div>
    </div>
</div>