<?php

namespace App\Models\DemoDataGenerator;

/**
 * Class DemoIssuesDataGenerator
 * @package AppBundle\Generator
 */
class DemoIssuesDataGenerator extends DemoDataGenerator
{
    use DemoDataGeneratorTrait;

    protected array $demoData;

    /**
     * @return array
     */
    public function getDemoData(): array
    {
        $this->demoData = [];
        $taskCounter = count($this->taskList);
        for ($i = 0; $i <= $taskCounter; $i++) {
            $this->demoData['issues'][] = $this->getTaskItem();
        }
        $this->demoData['total_count'] = $taskCounter;
        $this->demoData['offset'] = 0;
        $this->demoData['limit'] = 100;
        return $this->demoData;
    }

    /**
     * @return array
     * @throws \Exception
     */
    private function getTaskItem(): array
    {
        $item = [];
        $item['id'] = rand(100, 1000);
        $item['project'] = [
            'id' => 500,
            'name' => 'Redmine to telegram message generator'
        ];
        $item['tracker'] = [
            'id' => 404,
            'name' => 'Tasks'
        ];
        $item['status'] = $this->getIssueRandomStatus();
        $item['priority'] = $this->getIssueRandomPriority();
        $item['author'] = $this->getIssueRandomAuthor();
        $item['assigned_to'] = [
            'id' => 418,
            'name' => 'John John Jackson'
        ];
        $item['fixed_version'] = [
            'id' => false
        ];
        $item['parent'] = [
            'id' => false
        ];
        $item['subject'] = $this->getIssueTask()['title'];
        $item['description'] = $this->getIssueTask()['description'];
        $item['start_date'] = $this->getIssueRandomStartDate();
        $item['due_date'] = $this->getIssueRandomStartDate();
        $item['done_ratio'] = 0;
        $item['is_private'] = false;
        $item['estimated_hours'] = 0;
        $item['total_estimated_hours'] = 0;
        $item['spent_hours'] = 0;
        $item['total_spent_hours'] = 0;
        $item['created_on'] = $this->getIssueRandomStartDate();
        $item['updated_on'] = $this->getIssueRandomStartDate();
        return $item;
    }
}