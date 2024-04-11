<?php
require_once 'vendor/autoload.php';

use App\Controllers\TaskListController;
use \App\Controllers\ToolBarController;

try {
    $ToolBar = new ToolBarController();
    $TaskListController = new TaskListController();
    $tasks      = $TaskListController->getTaskCollection();
    $list       = $tasks['yesterday'];
    $taskToDo   = $tasks['today'];
} catch (Throwable $throwable) {
    $_SESSION['error'] = $throwable->getMessage();
}
require_once __DIR__ . '/template/layouts/header.php';
?>

<?php if (isset($_SESSION['error'])): ?>
<div class="container-fluid p-4">
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Holy guacamole!</strong>
        <div>
            <?=$_SESSION['error']?>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['error']); exit;?>
</div>
<?php endif;?>

<div class="container-fluid shadow bg-body-tertiary pt-2 pb-2 fixed-top">
    <div class="row">
        <div class="col ps-4">
            <div class="row">
                <div class="col ps-4">
                    <h4 class="p-0 m-0">Lazy ass inc.</h4>
                </div>
                <div class="col text-end">
                    Filter by last update date:
                </div>
            </div>
        </div>
        <div class="col">
            <div class="col mx-auto"">
            <form action="/" method="post">
                <div class="row">
                    <div class="col-9">
                        <input
                            class="form-control form-control-sm"
                            name="date"
                            type="date"
                            data-date-format="DD MMMM YYYY"
                            value="<?=$TaskListController->getDate()?>"
                        />
                        <span id="startDateSelected"></span>
                    </div>
                    <div class="col-3">
                        <button class="btn bg-body-secondary btn-sm add-into-list">
                            <i class="bi bi-search"></i>
                            Filter tasks
                        </button>
                    </div>
                </div>
            </form>
        </div>
        </div>
        <div class="col pe-4">
            <div class="row pe-2">
                <div class="col-4 text-end">
                    Scheduled messages:
                </div>
                <div class="col-2 text-center">
                    <a class="btn badge bg-body-secondary scheduled-counter" role="button" tabindex="0"  title="Total scheduled messages">
                        <span><?=$ToolBar->getScheduledMessagesCount()?></span>
                    </a>
                    <div hidden>
                        <div id="scheduled-counter-content">
                            <table class="table table-dark table-sm">
                                <tr>
                                    <td>Messages will be sent today:</td>
                                    <td><span class="badge bg-success"><?=$ToolBar->getTodayScheduledMessagesCount()?></span></td>
                                </tr>
                                <tr>
                                    <td>The messages were not sent:</td>
                                    <td><span class="badge bg-body-secondary"><?=$ToolBar->getNotSentMessagesCount()?></span></td>
                                </tr>
                                <tr>
                                    <td>Total messages:</td>
                                    <td><span class="badge bg-body-secondary"><?=$ToolBar->getScheduledMessagesCount()?></span></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-6 text-end">
                    <button type="button" class="btn btn-sm btn-success w-100 generate-message-preview" data-bs-toggle="modal" data-bs-target="#messageGeneratorModal">
                        <i class="bi bi-chat-square-text-fill"></i>
                        Generate message
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid pt-5">
    <div class="row p-4">
    <div class="col-6">
        <table class="table table-dark table-sm">
            <thead>
                <tr>
                    <th class="align-middle" scope="col">
                        <div class="row">
                            <div class="col">
                                <h4 class="p-0 m-0">
                                    Yesterday (last week):
                                    <span class="badge bg-dark-subtle text-bg-secondary"><?=count($list)?></span>
                                </h4>
                            </div>
                        </div>
                    </th>
                    <th class="align-middle" scope="col">
                        <div class="col text-end task-item" data-id="yesterday">
                            <button class="btn bg-body-secondary btn-sm add-into-list" item-id="yesterday" list-id="yesterday" day="yesterday">
                                <i class="bi bi-chat-left-fill"></i>
                                Add additional comment
                            </button>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($list as $item):?>
                <tr class="align-middle">
                    <td>
                        <div class="task-item" data-id="<?=$item['id']?>">
                            <a href="<?=$item['url']?>" class="link-light link-offset-2 link-underline-opacity-0 link-underline-opacity-0-hover">
                                <?=$item['name']?>
                            </a>
                            <div>
                                <span>Author: </span>
                                <span class="badge bg-body-secondary"><?=$item['author']?></span>
                                <span>Status: </span>
                                <span class="badge bg-body-secondary"><?=$item['status']?></span>
                                <span>Description: </span>
                                <span class="btn badge bg-body-secondary" data-bs-toggle="popover" data-bs-placement="right" title="Description:" data-bs-content="<?=$item['description']?>">
                                    show
                                </span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="text-end" style="min-width: 265px;">
                            <div class="add-group-buttons">
                                <button class="btn bg-body-secondary btn-sm text-nowrap add-into-list" item-id="<?=$item['id']?>" list-id="yesterday" day="yesterday">
                                    <i class="bi bi-plus-square"></i>
                                    Add to yesterday
                                </button>
                                <button class="btn bg-body-secondary btn-sm text-nowrap add-into-list" item-id="<?=$item['id']?>" list-id="today" day="yesterday">
                                    <i class="bi bi-plus-square"></i>
                                    Add to today
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>

        <table class="table table-dark table-sm">
            <thead>
            <tr>
                <th class="align-middle" scope="col">
                    <div class="col">
                        <h4 class="p-0 m-0">
                            TODO:
                            <span class="badge bg-dark-subtle"><?=count($taskToDo)?></span>
                        </h4>
                    </div>
                </th>
                <th class="align-middle" scope="col">
                    <div class="col text-end task-item" data-id="today">
                        <button class="btn bg-body-secondary btn-sm add-into-list" item-id="today" list-id="today" day="today">
                            <i class="bi bi-chat-left-fill"></i>
                            Add additional comment
                        </button>
                    </div>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($taskToDo as $item):?>
                <tr class="align-middle">
                    <td>
                        <div class="task-item" data-id="<?=$item['id']?>">
                            <a href="<?=$item['url']?>" class="link-light link-offset-2 link-underline-opacity-0 link-underline-opacity-0-hover">
                                <?=$item['name']?>
                            </a>
                            <div>
                                <span>Author: </span>
                                <span class="badge bg-body-secondary"><?=$item['author']?></span>
                                <span>Status: </span>
                                <span class="badge bg-body-secondary"><?=$item['status']?></span>
                                <span>Description: </span>
                                <span class="btn badge bg-body-secondary" data-bs-toggle="popover" data-bs-placement="right" title="Description:" data-bs-content="<?=$item['description']?>">
                                    show
                                </span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="text-end" style="min-width: 265px;">
                            <div class="add-group-buttons">
                                <button class="btn bg-body-secondary btn-sm text-nowrap add-into-list" item-id="<?=$item['id']?>" list-id="yesterday" day="today">
                                    <i class="bi bi-plus-square"></i>
                                    Add to yesterday
                                </button>
                                <button class="btn bg-body-secondary btn-sm text-nowrap add-into-list" item-id="<?=$item['id']?>" list-id="today" day="today">
                                    <i class="bi bi-plus-square"></i>
                                    Add to today
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>

    <div class="col-6">
        <div class="row">
            <div class="col">
                <h4 class="p-0 m-0">Plan:</h4>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                <div id="yesterday">
                    <h4 class="pb-3"><?=$TaskListController->getLastWorkDayLabel()?></h4>
                </div>
                <div id="today">
                    <h4 class="pb-3">Сьогодні:</h4>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php require_once __DIR__ . '/template/layouts/footer.php'; ?>