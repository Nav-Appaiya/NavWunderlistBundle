NavWunderlistBundle 
==========
A Symfony project created on May 15, 2016, 1:51 pm.

# Notes
- Wunderlist creation of tasks, lists and reminders with the Wunderlist API
- Client for handling resources and usefull methods on tasks,lists, and reminders
- Using Wunderlist with OAuth 2.0 with the GuzzleHttp client
- Goal is automated task creation on external events
- Uses Guzzle as Http Client

# Todo
- ~~Creating a Client for easy access to tasks/lists/etc.~~
 - ~~Automate tasks based on errors/problems with application~~
 - ~~Creating new tasks / lists for each application on controlcenter~~
	
# Examples
```

        // Get the Wunderlist Task Service
        $taskService = $this->get('nav_wunderlist.tasks');

        // You should probably want to give this your own implementation
        $client = $taskService->getWunderlistAccountForTesting();

        // Retrieve lists for user
        $lists = $taskService->getLists();

        // Retrieve tasks for a list
        $tasks = $taskService->getTasksForListId("WUNDERLIST-LIST-ID");

        // Retrieve files in a list
        $files = $taskService->getFilesForListId("WUNDERLIST-LIST-ID");

        // Create a new Task within a list
        $newTask = $taskService->createTask("WUNDERLIST-LIST-ID", "Nieuwe taak via API");

        // Create a new List
        $newList = $taskService->createList("Mijn nieuwe lijst");

```