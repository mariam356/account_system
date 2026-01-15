<div v-if="showModal" id="confirm-modal-loading-show" class="modal text-left"
     style="display: block; background: rgba(0,0,0,0.5)" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
            <div class="modal-body">
                <p id="message-loading-or-error">
                    @{{ loadingMessage }}
                    <i class="la la-spinner spinner"></i>
                </p>
            </div>
        </div>
    </div>
</div>
