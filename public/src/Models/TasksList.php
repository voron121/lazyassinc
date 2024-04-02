<?php

namespace App\Models;

use App\Memcached;
use App\Models\DemoDataGenerator\DemoIssuesDataGenerator;
use \Redmine\Client\NativeCurlClient;
use App\Config;

/**
 * The main model for interacting with the redmine api
 */
class TasksList
{
    const MEMCACHED_TASK_LIST_KEY = 'memcached-tasks';

    private NativeCurlClient $client;

    private $memcached;

    private $date;

    public function __construct(int $date)
    {
        $this->date = $date;
        $this->memcached = Memcached::getInstance();
        $this->client = new NativeCurlClient(Config::get('redmineHostUrl'), Config::get('redmineApiKey'));
    }

    /**
     * Getting tasks filter by date for yesterday or last  friday
     * @return array
     */
    public function getLastTasks(): array
    {
        $dateForFilter = $this->date;
        $tasks = $this->getTaskList();
        return array_filter($tasks['issues'], function($item) use ($dateForFilter) {
            return strtotime($item['updated_on']) >= $dateForFilter;
        });
    }

    /**
     * Getting tasks which wasn't in work from the common tasks list
     * @return array
     */
    public function getToDoTasksList(): array
    {
        $lastTasksList = $this->getLastTasks();
        $tasks = $this->getTaskList();
        $tasksIds = array_column($lastTasksList, 'id', 'id');
        return array_filter($tasks['issues'], function($item) use ($tasksIds) {
            return !isset($tasksIds[$item['id']]);
        });
    }

    /**
     * Getting common tasks list form redmine API.
     * Use memcached like a storage
     * @return array
     */
    public function getTaskList(): array
    {
        if ($this->memcached->get(self::MEMCACHED_TASK_LIST_KEY)) {
            return $this->memcached->get(self::MEMCACHED_TASK_LIST_KEY);
        }

        if (getenv('ENVIRONMENT') === 'TEST') {
            $tasks = (new DemoIssuesDataGenerator())->getDemoData();
        } else {
            $tasks = $this->client->getApi('issue')->list([
                'assigned_to_id' => 'me',
                'limit' => '100'
            ]);
        }
        $this->memcached->set(self::MEMCACHED_TASK_LIST_KEY, $tasks);
        return $tasks;
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