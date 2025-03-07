{{-- <!-- Payment Action Form Sheet -->
<div class="modal fade action-sheet" id="paymentactions" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Record Payment</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="action-sheet-content">
                    <!-- resources/views/Admin/forms/form_payment.blade.php -->

<form method="POST" action="{{ route('payments.store') }}">
    @csrf
    <!-- Action -->
    <div class="form-group basic mb-3">
        <label class="label fw-semibold text-dark mb-2" for="action">Action</label>
        <select class="form-control shadow-sm rounded-3 custom-select @error('action') is-invalid @enderror" id="action" name="action" required>
            <option value="" disabled selected>Select Send or Receive</option>
            <option value="send" {{ old('action') == 'send' ? 'selected' : '' }}>Send</option>
            <option value="receive" {{ old('action') == 'receive' ? 'selected' : '' }}>Receive</option>
        </select>
        @error('action')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- To Whom (Recipient) -->
    <div class="form-group basic mb-3">
        <label class="label fw-semibold text-dark mb-2" for="recipient_id">To Whom</label>
        <select class="form-control shadow-sm rounded-3 custom-select @error('recipient_id') is-invalid @enderror" id="recipient_id" name="recipient_id" required>
            <option value="" disabled selected>Select recipient user or admin</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ old('recipient_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
            @endforeach
        </select>
        @error('recipient_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Details -->
    <div class="form-group basic mb-3">
        <label class="label fw-semibold text-dark mb-2" for="details">Details</label>
        <textarea class="form-control shadow-sm rounded-3 @error('details') is-invalid @enderror" id="details" name="details" placeholder="Enter payment details" rows="3" required>{{ old('details') }}</textarea>
        @error('details')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Method -->
    <div class="form-group basic mb-3">
        <label class="label fw-semibold text-dark mb-2" for="method">Payment Method</label>
        <select class="form-control shadow-sm rounded-3 custom-select @error('method') is-invalid @enderror" id="method" name="method" required>
            <option value="" disabled selected>Select payment method</option>
            <option value="cash" {{ old('method') == 'cash' ? 'selected' : '' }}>Cash</option>
            <option value="online" {{ old('method') == 'online' ? 'selected' : '' }}>Online</option>
        </select>
        @error('method')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Transaction Date -->
    <div class="form-group basic mb-3">
        <label class="label fw-semibold text-dark mb-2" for="transaction_date">Date/Time</label>
        <input type="datetime-local" class="form-control shadow-sm rounded-3 @error('transaction_date') is-invalid @enderror" id="transaction_date" name="transaction_date" value="{{ old('transaction_date') }}" required>
        @error('transaction_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Amount -->
    <div class="form-group basic mb-3">
        <label class="label fw-semibold text-dark mb-2" for="amount">Amount (₹)</label>
        <div class="input-group">
            <span class="input-group-text bg-light border-end-0 rounded-start-3">₹</span>
            <input type="number" step="0.01" class="form-control shadow-sm rounded-end-3 @error('amount') is-invalid @enderror" id="amount" name="amount" placeholder="Enter payment amount" value="{{ old('amount') }}" required>
        </div>
        @error('amount')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- By Whom (Sender) -->
    <div class="form-group basic mb-3">
        <label class="label fw-semibold text-dark mb-2" for="user_id">By Whom</label>
        <select class="form-control shadow-sm rounded-3 custom-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
            <option value="" disabled selected>Select sender user or admin</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
            @endforeach
        </select>
        @error('user_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Submit Button -->
    <div class="form-group basic mt-4">
        <button type="submit" class="btn btn-primary btn-block rounded-pill py-3 fw-semibold">Add Payment</button>
    </div>
</form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- * Payment Action Form Sheet -->     --}}