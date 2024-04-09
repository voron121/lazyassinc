<?php

namespace App\Controllers;

use App\Config;
use App\Models\TasksList;

/**
 * Controller for processing data which we are getting from the redmine API.
 */
class TaskListController
{
    private $taskListModel;

    private $date;

    public function __construct()
    {
        $this->date = isset($_POST['date']) ? $this->getDateInput() : $this->getTodayDate();
        $this->taskListModel = new TasksList($this->date);
    }

    /**
     * @return array
     */
    public function getTaskCollection(): array
    {
        return [
            'yesterday' => array_column($this->getLastTasksList(), null, 'id'),
            'today' => array_column($this->getToDoTasksList(), null, 'id'),
        ];
    }

    /**
     * @return string
     */
    public function getLastWorkDayLabel(): string
    {
        $today = date('l');
        if (in_array($today, ['Saturday','Sunday'])) {
            return 'В п\'ятницю:';
        } else {
            return 'Вчора:';
        }
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return Date('Y-m-d', $this->date);
    }


    /**
     * Getting tasks filter by date for yesterday or last  friday
     * @return array
     */
    private function getLastTasksList(): array
    {
        $tasks = $this->taskListModel->getLastTasks();
        return $this->unifyTaskList($tasks);
    }

    /**
     * Getting tasks which wasn't in work from the common tasks list
     * @return array
     */
    private function getToDoTasksList(): array
    {
        $tasks = $this->taskListModel->getToDoTasksList();
        return $this->unifyTaskList($tasks);
    }

    /**
     * Processing data which we are got from API and make them in more unify look
     * @param array $tasks
     * @return array
     */
    private function unifyTaskList(array $tasks): array
    {
        $list = [];
        array_walk($tasks, function($task) use (&$list){
            $list[] = [
                'id' => $task['id'],
                'subject' => $task['subject'],
                'name' => $task['id'] . ' ' . $task['subject'],
                'author' => $task['author']['name'],
                'status' => $task['status']['name'],
                'url' => $this->getTrackerIssuesUrl() . $task['id'],
                'description' => htmlentities($task['description'])
            ];
        });
        return $list;
    }

    /**
     * @return string
     * @throws \Exception
     */
    private function getTrackerIssuesUrl(): string
    {
        return Config::get('redmineHostUrl') . 'issues/';
    }

    /**
     * @return int
     */
    private function getDateInput(): int
    {
        return strtotime($_POST['date']);
    }

    /**
     * Getting data for request in unix time format.
     * If today is work day (monday - friday) - will return today date
     * If today is not work day - will return last friday date
     * @return int
     */
    private function getTodayDate(): int
    {
        $today = date('l');
        if (in_array($today, ['Saturday','Sunday'])) {
            return strtotime('last Friday');
        } else {
            return strtotime(date('Y-m-d'));
        }
    }
}