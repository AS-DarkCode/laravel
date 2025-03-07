<div class="section wallet-card-section pt-1">
    <div class="wallet-card">
        <div class="balance">
            <div class="left">
                <a href="{{ route('manage_users') }}"><span class="title">Total Employees</span></a>
                <h1 class="total">12</h1>
            </div>
            <div class="right">
                <a href="{{ route('add_user.create') }}" class="button">
                    <ion-icon name="person-add-outline"></ion-icon>
                </a>
            </div>
        </div>
        <div class="wallet-footer">
            <!-- Payment Item -->
            <div class="item">
                <a href="{{ route('send.create') }}">
                    <div class="icon-wrapper bg-success">
                        <ion-icon name="paper-plane-outline"></ion-icon> 
                    </div>
                    <strong>Send</strong>
                </a>
            </div>

            <!-- Payment Item -->
            <div class="item">
                <a href="{{ route('receive.create') }}">
                    <div class="icon-wrapper bg-success">
                        <ion-icon name="download-outline"></ion-icon> 
                    </div>
                    <strong>Receive</strong>
                </a>
            </div>
            <!-- Other Items (unchanged) -->
            <div class="item">
                <a href="{{ route('expense.create') }}">
                    <div class="icon-wrapper bg-danger">
                        <ion-icon name="cash-outline"></ion-icon> 
                    </div>
                    <strong>Expenses</strong>
                </a>
            </div>
            <div class="item">
                <a href="{{ route('sites.create') }}">
                    <div class="icon-wrapper bg-primary">
                        <ion-icon name="construct-outline"></ion-icon> 
                    </div>
                    <strong>Create Site</strong>
                </a>
            </div>
        </div>
    </div>
</div>