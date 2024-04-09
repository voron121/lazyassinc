<?php

namespace App\Models;

/**
 * @var array $postInput The input containing the messages.
 */
class Messages
{
    private array $postInput;
    private bool $isScheduled;
    private array $schedulerParams;
    private array $messages;

    public function __construct(array $postInput)
    {
        $this->postInput = $postInput;
        $this->validatePostInput();
        $this->initialize();
    }

    /**
     * Validates the post input for message data.
     * Throws an exception if the data is not provided properly.
     *
     * @throws \Exception If the message data is not provided properly.
     */
    private function validatePostInput(): void
    {
        if (empty($this->postInput) || !isset($this->postInput['messages'])) {
            throw new \Exception('Message data is not provided properly');
        }
    }

    /**
     * Initializes the application.
     * Sets the scheduler status, scheduler parameters, and retrieves the messages list.
     *
     * @return void
     */
    private function initialize(): void
    {
        $this->isScheduled = $this->getSchedulerStatus();
        $this->schedulerParams = $this->isScheduled ? $this->getScheduler() : [];
        $this->messages = $this->getMessagesList();
    }

    /**
     * Retrieves the scheduler parameters.
     *
     * @return array The scheduler parameters.
     */
    public function getSchedulerParams(): array
    {
        return $this->schedulerParams;
    }

    /**
     * Checks if the action is scheduled.
     *
     * @return bool True if the action is scheduled, false otherwise.
     */
    public function isScheduled(): bool
    {
        return $this->isScheduled;
    }

    /**
     * Retrieves the messages stored in the class.
     *
     * @return array The array of stored messages.
     */
    public function getMessages(): array
    {
        return $this->messages;
    }

    /**
     * Retrieves the list of messages from the post input.
     *
     * @return array The list of messages.
     */
    private function getMessagesList(): array
    {
        return $this->postInput['messages'];
    }

    /**
     * Retrieves the scheduler information from the post input.
     * Throws an exception if the date or time is not provided.
     *
     * @return array The scheduler information consisting of date and time.
     * @throws \Exception If the schedule date or time is not provided.
     */
    private function getScheduler(): array
    {
        if ('' === $this->postInput['schedule']['date']) {
            throw new \Exception('Schedule date is not provided');
        }
        if ('' === $this->postInput['schedule']['time']) {
            throw new \Exception('Schedule time is not provided');
        }
        return [
            'date' => $this->postInput['schedule']['date'],
            'time' => $this->postInput['schedule']['time']
        ];
    }

    /**
     * Determines the status of the scheduler based on the post input.
     *
     * @return bool The status of the scheduler.
     */
    private function getSchedulerStatus(): bool
    {
        return $this->postInput['schedule']['isScheduler'] === 'true';
    }
}