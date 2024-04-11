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
                <div class="row pt-3 top-line-dark">
                    <div class="col-3 align-items-center">
                        Date and time of publication:
                    </div>
                    <div class="col-3 align-items-center">
                        <input type="date" name="schedule-date" class="form-control form-control-sm">
                    </div>
                    <div class="col-3 align-items-center">
                        <input type="time" name="schedule-time" class="form-control form-control-sm" step="3600">
                    </div>
                    <div class="col-3 align-items-center">
                        <input class="form-check-input" type="checkbox" id="send-by-schedule">
                        <label class="form-check-label" for="send-by-schedule">Published according to schedule</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
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