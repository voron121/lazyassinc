## Hello

This is a simple pet project which was born because I am so lazy ass 
to write messages by hands 

## What this think is doing?

This project displays two lists of tasks from the Redmine task tracker:

1. The first list includes tasks that were changed either today or last Friday (tasks worked on today).
2. The second list contains all tasks except those changed today or last Friday (tasks not worked on today).

You can add any task to the list of tasks worked on yesterday or 
to the list of tasks to be worked on tomorrow. 
You can then generate a message to send to a Telegram channel.

Yep, that's pretty much it for now. Maybe in the future, 
I'll add some AI functionality  like improving comments using AI, 
but that's not guaranteed at all.

## How to Use or RTFM (Read the Fucking Manual):

You can add any task to the list of tasks worked on yesterday or to the list of tasks to be worked on tomorrow by simply pressing a button.

For each task, you can add a comment like: "Yesterday, I completed what I planned, and today I will work on what I planned."

After that, click the "Generate Message" button. You will see a preview of the message in a modal window.

To send the message to Telegram, click the button in the modal window.

---

## Installation

### Notice:
This brief instruction is only for deploying the project on a local machine. 
If you want to use it on a web server, you'll need to deal with some 
domain magic. But that's a whole different journey with black jack
and courtesans.

### Step one: docker

```bash
docker compose build
```

```bash
docker compose up -d
```

### Step Two: Install Libraries
After that, enter the Docker container:

```bash
docker exec -it redmine_telegram_bot bash
```

And into docker run the command:

```bash
composer install
```

### Step three: add hosts:

Add the following line to your machine's hosts file:

```bash
127.0.0.1 app.loc
```
### Step Four: Configuration
- Rename the file public/src/Config.php.example to public/src/Config.php.
- Enter your credentials into the file.

### Step Five: .ENV (Yep, it's not so fast) 
In the project root directory you can change ENVIRONMENT variable value in file .env
to use test or production environment.
By default, value of variable ENVIRONMENT is TEST. This is means that you will
get demo data.
If you want to use your credentials for redmine and get real data
from them - just change ENVIRONMENT into PRODUCTION

Examples:
For test environment with demo data:
```bash
ENVIRONMENT=TEST
```
For production environment with real data
```bash
ENVIRONMENT=PRODUCTION
```

### Enjoy

If everything's is ok - you can open this super-duper cool things
just a visiting http://app.loc 
---
### How to get Telegram channel ID (for private channels):
- Step 1: Add your bot to your Telegram channel.
- Step 2: Send any message in your Telegram channel from any client.
- Step 3: Visit https://api.telegram.org/bot<BOT_TOKEN>/getUpdates (replace <BOT_TOKEN> with your actual Telegram bot token).
- Step 4: Copy the channel_id from the response.
---
## Useful links:
- [All answers](https://google.com)
- [Docker Documentation](https://docs.docker.com/)
- [Composer Documentation](https://getcomposer.org/doc/01-basic-usage.md)
- [Redmine home page](https://www.redmine.org/)
- [Redmine API Documentation](https://www.redmine.org/projects/redmine/wiki/rest_api)
- [Telegram Bot API PHP Lib Documentation](https://packagist.org/packages/longman/telegram-bot)
- [PHP Telegram Bot Api Documentation](https://packagist.org/packages/telegram-bot/api)

---
## P.S.:
No tech support available. 
If something doesn't work, just use Google and the error message text :)

