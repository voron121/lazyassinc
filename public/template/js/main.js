/**
 * Create HTML snippet for single message
 * @param message
 * @return {string}
 */
function generateMessagePreviewSnippet(message)
{
    let preview = '<div>';
    if (typeof message.id !== 'undefined') {
        preview += '<a href="' + message.url + '">' + message.name + '</a><br>';
    }
    preview += message.comment;
    preview += '<br><br></div>';
    return preview;
}

/**
 * Create HTML preview for messages into modal window
 */
function generateMessage()
{
    const days = ['yesterday', 'today'];
    let messagesSnippets = '';
    for (let i = 0; i <= days.length; i++) {
        const dayName = $('#' + days[i]).find('h4').text();
        messagesSnippets += '<span id="message-day-' + days[i] + '"><b>' + dayName + '</b></span><br><br>'
        const messages = Messages.get(days[i]);
        for (const key in messages) {
            if (messages.hasOwnProperty(key)) {
                messagesSnippets += generateMessagePreviewSnippet(messages[key]);
            }
        }
    }
    $('.message-preview').html('').append(messagesSnippets);
}

/**
 * Sending message into telegram channel
 */
function sendTelegramMessage()
{
    const isScheduler = document.getElementById('send-by-schedule');
    let data = {
      'messages' : {
          'yesterday' : {
              'dayTitle' : $('#message-day-yesterday').text(),
              'messages' : Messages.get('yesterday')
          },
          'today' : {
              'dayTitle' : $('#message-day-today').text(),
              'messages' : Messages.get('today')
          }
      },
      'schedule' : {
          'isScheduler' : isScheduler.checked ? true : false
      }
    };
    if (isScheduler.checked) {
        data.schedule.date = $('input[name=schedule-date]').val();
        data.schedule.time = $('input[name=schedule-time]').val();
    }
    $.ajax({
        url : '/src/ajax/telegram.php',
        type : 'post',
        dataType : 'json',
        data : data,
        success: function(response) {
            showAlert(response.message, response.status, 'telegramMessageAlert');
            if ('success' === response.status) {
                $('.js-send-telegram-message').prop('disabled', true);
            }
        },
        error: function (response) {
            showAlert(response.message, response.status, 'telegramMessageAlert');
        }
    });
}

/**
 * Create an object with empty snippet
 * @return {HTMLDivElement}
 */
function getSnippet()
{
    let snippet = document.createElement("div");
    let snippetBody = document.createElement("div");
    let snippetTitle = document.createElement("div");
    let textarea = document.createElement("textarea");
    let snippetFooter = document.createElement("div");
    let removeButton = document.createElement("button");

    snippet.classList.add("card", "mt-2", "mb-3", "item-message", "shadow","bg-body-tertiary");
    snippetBody.classList.add("card-body", "pt-2", "pb-2");
    snippetTitle.classList.add("card-title");
    snippetFooter.classList.add("col", "text-end");
    removeButton.classList.add("btn", "btn-danger", "btn-sm", "mt-2", "remove");
    textarea.classList.add("form-control", "task-comment");
    textarea.setAttribute("rows", "3");
    textarea.setAttribute("cols", "30");

    removeButton.append(document.createTextNode("Remove"));
    snippetFooter.append(removeButton);
    snippetBody.append(snippetTitle, textarea, snippetFooter);
    snippet.append(snippetBody);

    return snippet;
}

/**
 * Adding task into list:
 * - Add task into Message obj
 * - Fill snippet and add them on the page
 * - Disable add button for added task
 */
function addTaskIntoToDoList()
{
    const dayId     = $(this).attr('day');
    const listId    = $(this).attr('list-id');
    const itemId    = $(this).attr('item-id');
    const message   = Registry.get('messagesCollection')[dayId][itemId];
    const title = typeof message !== 'undefined' ? message.name : 'Additional comment';
    const messageObj = {
        [itemId] : typeof message !== 'undefined' ? message : {}
    };
    // Add data into Message obj
    Messages.append(listId, messageObj);
    // Add some attributes and data into dom elements
    let snippet = $(getSnippet());
    snippet.find('.card-title').text(title);
    snippet.find('.remove').attr('list-id', listId);
    snippet.find('.remove').attr('item-id', itemId);
    snippet.find('textarea').attr('list-id', listId);
    snippet.find('textarea').attr('item-id', itemId);
    // Do some interactive with UI
    $('#' + listId).append(snippet);
    $(this).prop('disabled', true);
}

/**
 * Add comment for item into Message obj
 */
function appendComment()
{
    const listId    = $(this).attr('list-id');
    const itemId    = $(this).attr('item-id');
    const comment   = $(this).val().trim();
    let messages    = Object.assign({}, Messages.get(listId));
    if (typeof messages[itemId] !== 'undefined') {
        messages[itemId] = Object.assign({}, messages[itemId]);
        messages[itemId].comment = comment;
    }
    Messages.set(listId, messages);
}

/**
 * Remove task into list:
 * - Remove task into Message obj
 * - Remove snippet from page
 * - Enable add button for current task item
 */
function removeItemFromToDoList()
{
    const snippet   = $(this).closest(".item-message");
    const listId    = $(this).attr('list-id');
    const itemId    = $(this).attr('item-id');
    let messages    = Messages.get(listId);
    delete messages[itemId];
    snippet.remove();
    Messages.set(listId, messages);
    $('.add-into-list[item-id=' + itemId + '][list-id=' + listId + ']').prop('disabled', false);
}

/**
 * Processed alert message
 * @param message
 * @param status
 * @param position
 */
function showAlert(message, status, position)
{
    const type = status === 'success' ? 'success' : 'warning';
    const alertPlaceholder = document.getElementById(position)
    const wrapper = document.createElement('div')
    document.getElementById(position).innerHTML = "";
    wrapper.innerHTML = [
        `<div class="alert alert-${type} alert-dismissible" role="alert">`,
        `   <div>${message}</div>`,
        '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
        '</div>'
    ].join('');
    alertPlaceholder.append(wrapper)
}

window.addEventListener('load', function ()
{
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    const popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    })
    document.getElementById('messageGeneratorModal').addEventListener('hide.bs.modal', () => {
        document.getElementById('telegramMessageAlert').innerHTML = "";
        $('.js-send-telegram-message').prop('disabled', false);
    })
    $(document).on('click', '.add-into-list', addTaskIntoToDoList);
    $(document).on('click', '.remove', removeItemFromToDoList);
    $(document).on('blur', '.task-comment', appendComment);
    $(document).on('click', '.generate-message-preview', generateMessage);
    $(document).on('click', '.js-send-telegram-message', sendTelegramMessage);
});