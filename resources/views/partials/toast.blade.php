@if(session('success') || session('error'))
    <div class="toast-container">
        @if(session('success'))
            <div class="toast toast-success" id="toast-success">
                <span class="toast-message">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="toast toast-error" id="toast-error">
                <span class="toast-message">{{ session('error') }}</span>
            </div>
        @endif
    </div>
@endif