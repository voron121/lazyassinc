<!-- Modal -->
<div class="modal fade" id="messageGeneratorModal" tabindex="-1" aria-labelledby="messageGeneratorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="messageGeneratorModalLabel">Message generator</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row" id="telegramMessageAlert"></div>
                <div class="row">
                    <div class="col-6 message-preview"></div>
                    <div class="col-6 hidden"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-light btn-sm" data-dismiss="modal">Make better with AI (coming soon)</button>
                <button type="button" class="btn btn-primary btn-sm js-send-telegram-message">
                    <i class="bi bi-send-fill"></i>
                    Send in telegram
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener('load', function () {
        Registry.set('messagesCollection', <?=json_encode($tasks)?>);
    });
</script>
<script src="/template/js/registry.js"></script>
<script src="/template/js/messages.js"></script>
<script src="/template/js/main.js"></script>
</body>
</html>