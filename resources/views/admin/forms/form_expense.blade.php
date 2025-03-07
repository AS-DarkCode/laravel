
        <!-- Expense Action form Sheet start-->

<div class="modal fade action-sheet" id="expenseSheet" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Record Expense</h5>
            </div>
            <div class="modal-body">
                <div class="action-sheet-content">
                    <form method="POST" action="">
                        @csrf
                        <div class="form-group basic">
                            <label class="label" for="item_name">Item Name</label>
                            <input type="text" class="form-control" id="item_name" name="item_name" placeholder="Enter item name" required>
                        </div>
                        <div class="form-group basic">
                            <label class="label" for="name">Paid By</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
                        </div>
                        <div class="form-group basic">
                            <label class="label" for="method">Method</label>
                            <select class="form-control custom-select" id="method" name="method">
                                <option value="cash">Cash</option>
                                <option value="online">Online</option>
                            </select>
                        </div>
                        <div class="form-group basic">
                            <label class="label" for="expense_date">Date</label>
                            <input type="date" class="form-control" id="expense_date" name="expense_date" required>
                        </div>
                        <div class="form-group basic">
                            <label class="label" for="amount">Amount</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">₹</span>
                                <input type="number" step="0.01" class="form-control" id="amount" name="amount" placeholder="Enter amount" required>
                            </div>
                        </div>
                        <div class="form-group basic">
                            <button type="submit" class="btn btn-primary btn-block btn-lg" name="expense-submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
        <!-- Expense Action form Sheet end-->