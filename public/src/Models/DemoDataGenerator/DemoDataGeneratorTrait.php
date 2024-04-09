<?php

namespace App\Models\DemoDataGenerator;

trait DemoDataGeneratorTrait
{
    /**
     * @var array $issuesStatusList
     *
     * The list of issue statuses.
     * Each element in the array represents a single status.
     * - id: integer - The unique identifier of the status.
     * - name: string - The name of the status.
     * - is_closed: boolean - Indicates whether the status is closed or not.
     */
    private array $issuesStatusList = [
        [
            'id' => 1,
            'name' => 'New',
            'is_closed' => false
        ],
        [
            'id' => 2,
            'name' => 'In Progress',
            'is_closed' => false
        ],
        [
            'id' => 3,
            'name' => 'Testing',
            'is_closed' => false
        ],
        [
            'id' => 4,
            'name' => 'Done',
            'is_closed' => true
        ]
    ];

    /**
     * @var array $issuesPriority
     *
     * The list of issue priorities.
     * Each element in the array represents a single priority.
     * - id: integer - The unique identifier of the priority.
     * - name: string - The name of the priority.
     */
    private array $issuesPriority = [
        [
            'id' => 1,
            'name' => 'Normal'
        ],
        [
            'id' => 2,
            'name' => 'Emergency'
        ],
        [
            'id' => 3,
            'name' => 'Ass in fire'
        ],
    ];

    /**
     * @var array $issuesAuthors
     * An array containing information about issues authors.
     * Each element in the array represents a single author and has the following structure:
     *   - id: The ID of the author. This is an integer value.
     *   - name: The name and occupation of the author. This is a string value.
     */
    private array $issuesAuthors = [
        [
            'id' => 404,
            'name' => 'John Smith (Accountant)'
        ],
        [
            'id' => 501,
            'name' => 'Sarah Johnson (Software Engineer)'
        ],
        [
            'id' => 402,
            'name' => 'Jennifer Davis (Graphic Designer)'
        ],
        [
            'id' => 404,
            'name' => 'Tiffany Sparkle (Unicorn Trainer)'
        ],
        [
            'id' => 504,
            'name' => 'Billy Bob Jenkins (Professional Napper)'
        ],
        [
            'id' => 301,
            'name' => 'Sandy Beach (Beach Volleyball Coach)'
        ]
    ];

    /**
     * @var array $taskList
     * An array containing information about tasks.
     * Each element in the array represents a single task and has the following structure:
     *   - title: The title of the task. This is a string value.
     *   - description: The description of the task. This is a string value.
     */
    private array $taskList = [
        [
            'title' => 'Hunt for the Elusive Unicorn Bug',
            'description' => 'Embark on a mythical quest to locate the legendary Unicorn Bug, rumored to bring eternal happiness and perfect code. Caution: May involve traversing through enchanted forests of spaghetti code and dodging trolls in the form of legacy systems.'
        ],
        [
            'title' => 'Operation: Find Waldo in the Codebase',
            'description' => 'Join forces with fellow developers in a challenging game of \'Where\'s Waldo?\' as you scour the codebase for that one elusive line causing all the trouble. Bonus points for finding Waldo\'s cousin, Wally, and his pet dog, Woof.'
        ],
        [
            'title' => 'Unleash the Kraken of Code Comments',
            'description' => 'Summon the ancient Kraken of Code Comments to unleash its wrath upon the codebase. Beware: Once awakened, the Kraken will leave no line of code uncommented, sparing none in its path of verbosity.'
        ],
        [
            'title' => 'Operation: Debug the Bermuda Triangle Bug',
            'description' => 'Embark on a perilous expedition to debug the Bermuda Triangle Bug, where lines of code mysteriously vanish without a trace. Equip yourself with a compass, a map, and a healthy dose of skepticism as you navigate through the fog of confusion.'
        ],
        [
            'title' => 'Dance of the Seven Merge Conflicts',
            'description' => 'Join in the intricate choreography of the Dance of the Seven Merge Conflicts as you attempt to resolve conflicts between branches. Will you emerge victorious, or will you be left in a tangled mess of conflicting changes?'
        ],
        [
            'title' => 'Operation: Tame the Wild Wild West of Documentation',
            'description' => 'Saddle up and ride into the Wild Wild West of Documentation as you attempt to corral unruly README files and elusive API docs. Prepare to face off against outlaws like \'Documentation Not Found\' and \'Outdated Readme.txt\' in this epic showdown of clarity versus chaos.'
        ],
        [
            'title' => 'Code Cleanup Extravaganza: The Great Spring Cleaning',
            'description' => 'Roll up your sleeves and don your dust mask as you embark on a code cleanup extravaganza to rid the codebase of cobwebs, dust bunnies, and deprecated functions. Channel your inner Marie Kondo and spark joy in every line of code.'
        ],
        [
            'title' => 'Operation: Rescue the Princess from the Tower of Legacy Systems',
            'description' => 'Don your armor and sharpen your sword as you embark on a noble quest to rescue the princess—your application—from the clutches of the dreaded Tower of Legacy Systems. Scale the walls of outdated technology, slay dragons of unsupported frameworks, and emerge victorious with your modernized codebase.'
        ],
        [
            'title' => 'The Great Emoji Migration: 😂🚀🦄',
            'description' => 'Embark on a whimsical journey to migrate the codebase to the land of emojis, where laughter reigns supreme, rockets signify performance improvements, and unicorns frolic in fields of optimized algorithms. Will you bring joy to the hearts of developers or descend into chaos and confusion?'
        ],
        [
            'title' => 'Operation: Escape from XML Hell',
            'description' => 'Brace yourself for a harrowing escape from the fiery pits of XML Hell, where tags multiply like rabbits and closing brackets lurk in the shadows. Navigate through the labyrinth of nested elements and tangled schemas as you seek freedom in the land of JSON enlightenment.'
        ],
        [
            'title' => 'The Great Coffee Run: A Tale of Java and JavaScript',
            'description' => 'Embark on a caffeine-fueled adventure as you navigate the treacherous terrain of Java and JavaScript. Will you emerge victorious with a cup of perfectly brewed coffee, or will you be lost in a maze of callback functions and compiler errors?'
        ],
        [
            'title' => 'Operation: Conquer the Kingdom of NoSQL',
            'description' => 'Prepare for battle as you march into the Kingdom of NoSQL, where data reigns supreme and schemas are but distant memories. Will you emerge victorious, forging a new empire of document stores and key-value pairs, or will you be vanquished by the armies of relational purists?'
        ],
        [
            'title' => 'The Firewall Follies: A Comedy of Access Denied',
            'description' => 'Embark on a side-splitting journey through the Firewall Follies, where access is denied, permissions are revoked, and security rules seem to have a mind of their own. Will you navigate the labyrinth of network restrictions unscathed, or be left banging your head against the firewall?'
        ],
        [
            'title' => 'Operation: Defeat the Infinite Loop of Procrastination',
            'description' => 'Prepare for battle against the dreaded Infinite Loop of Procrastination, where time stands still and deadlines loom ominously on the horizon. Will you break free from the cycle of distraction and emerge victorious, or be forever trapped in the quagmire of unfinished tasks?'
        ],
        [
            'title' => 'The SQL Symphony: A Performance of Queries and Indexes',
            'description' => 'Take center stage in the SQL Symphony as you conduct a performance of queries and indexes. Will your database schema sing harmoniously, or will you be drowned out by the cacophony of full table scans and unoptimized queries?'
        ],
        [
            'title' => 'Operation: Navigate the Cloud Atlas',
            'description' => 'Embark on an epic journey through the Cloud Atlas, where servers roam the skies and data flows like rivers in the ether. Will you chart a course to the summit of scalability, or be lost in the mists of distributed computing?'
        ],
        [
            'title' => 'The Epic Saga of the Forbidden Dependencies',
            'description' => 'Prepare for a quest of epic proportions as you journey to the Forbidden Dependencies, where circular references and version conflicts reign supreme. Will you emerge unscathed, armed with dependency injection and modular design, or be swallowed whole by the abyss of runtime errors?'
        ],
        [
            'title' => 'Operation: Battle the Denial-of-Service Dragon',
            'description' => 'Summon your courage and prepare for battle against the fearsome Denial-of-Service Dragon, whose fiery breath threatens to engulf your servers in a blaze of downtime. Will you emerge victorious, armed with firewalls and rate limiting, or be reduced to ashes by the onslaught of malicious traffic?'
        ],
        [
            'title' => 'The Legend of the Magic Wand Tool: A Tale of Selections and Layers',
            'description' => 'Embark on a magical journey with the Wand Tool, where selections and layers intertwine in a dance of pixel-perfect precision. Will you wield the power of the Pen Tool with finesse, or be forever lost in the labyrinth of rasterized images and bezier curves?'
        ],
        [
            'title' => 'Operation: Navigate the Quantum Realm of Quantum Computing',
            'description' => 'Prepare for a mind-bending journey into the Quantum Realm of Quantum Computing, where qubits defy the laws of classical physics and algorithms exist in a state of superposition. Will you unlock the secrets of quantum supremacy, or be trapped in a state of quantum entanglement forever?'
        ]
    ];

    /**
     * Generate random date in interval between today and week ago
     * @return string
     * @throws \Exception
     */
    public function getIssueRandomStartDate(): string
    {
        $startDate = strtotime(date('Y-m-d h:m:i'));
        $date = new \DateTime(date('Y-m-d h:m:i'));
        $endDate = strtotime($date->modify('-7 days')->format('Y-m-d h:m:i'));
        return date('Y-m-d h:m:i', random_int($endDate, $startDate));
    }

    /**
     * Generate random status for task
     * @return array
     */
    public function getIssueRandomStatus(): array
    {
        return $this->issuesStatusList[array_rand($this->issuesStatusList)];
    }

    /**
     * Generate random priority status for task
     * @return array
     */
    public function getIssueRandomPriority(): array
    {
        return $this->issuesPriority[array_rand($this->issuesPriority)];
    }

    /**
     * Generate array with authors
     * @return array
     */
    public function createAuthors(): array
    {
        $authors = [];
        foreach ($this->issuesAuthors as $i => $iValue) {
            $id = $i > 0 ?? 1;
            $authors[] = [
                'id' => $id,
                'name' => $this->issuesAuthors[$i],
            ];
        }
        return $authors;
    }

    /**
     * Generate task body (title and description for task)
     * @return array
     */
    public function getIssueTask(): array
    {
        return $this->taskList[array_rand($this->taskList)];
    }

    /**
     * Generate random author for task
     * @return array
     */
    public function getIssueRandomAuthor(): array
    {
        return $this->issuesAuthors[array_rand($this->issuesAuthors)];
    }
}