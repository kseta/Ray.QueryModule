# Ray.Query

Ray.Query converts SQL string into invokable DB objects.

## Installation

### Composer install

    $ composer require ray/query
 
### Module install

```php
use Ray\Di\AbstractModule;
use Ray\AuraSqlModule\AuraSqlModule;
use Ray\AuraSqlModule\AuraSqlQueryModule;

class AppModule extends AbstractModule
{
    protected function configure()
    {
        $this->install(new SqlQueryModule($sqlDir));
    }
}
```

### SQL files

$sqlDir/todo_insert.sql

```sql
INSERT INTO todo (id, title) VALUES (:id, :title)
```

$sqlDir/todo_item.sql

```sql
SELECT * FROM todo WHERE id = :id
```


### Usage

```php
class Todo
{
    /**
     * @var callable
     */
    private $todoInsert;
    
    /**
     * @var callable
     */
    private $todoItem;
    
    /**
     * @Named("todoInsert=todo_insert, todoItem=todo_item")
     */
    public function __construct(
        callable $todoInsert,
        callable $todoItem
    ){
        $this->todoInsert = $todoInsert;
        $this->todoItem = $todoItem;
    }
    
    public function get(string $uuid)
    {
        return ($this->todoItem)(['id' => $uuid]);
    }

    public function create(string $uuid, string $title)
    {
        ($this->todoInsert)([
            'id' => $uuid,
            'title' => $title
        ]);
    }
}
```

## Demo

```
php demo/run.php
```