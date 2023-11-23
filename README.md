#  🎁 Advent of Code 2022 - PHP solutions  🎁

### Instalation
```bash
composer install
```

### Execute existing task

Parameters:

```
php run.php [day] [demo] [create]
```

* `day` - execute task day number (from input.txt)
* `demo (day)` - execute demo data (from demo.txt) 
* `create (day)` - create necessary files

Run demo for the first day
```bash
php run.php 1 demo
```

Run task for the first day
```bash
php run.php 1
```

### Create new task

Create new task and data for the first day
```bash
php run.php 1 create
```
- Task class will be created in `Days` folder
- Task data will be created in `data` folder

```
 🛑 input.txt should be not uploaded to repository  
```

### Configuration
There is small array in `task.php` file, nothing special
