# Laravel Lumen Exam Session Demo

## Exam Session REST API application

* This system provides API's to Get, Create, Update and Delete Exams
* Attributes for Exam Session model
    * Code (unique): Exam code
    * Name: Name of the exam
    * Start Time
    * End Time

* Exam Session may have one or more Exams

## Developer Information


### API's
API | HTTP | Auth | API Link | Query String |
|---|---|---|---|---|
| Exam | GET | `NONE` | 'api/v1/exams' | 'YES' |
| Exam | GET | `NONE` | 'api/v1/exams/{examId}' | 'NO' |
| Exam | POST | `NONE` | 'api/v1/exams' | 'NO' |
| Exam | PUT | `NONE` | 'api/v1/exams/{examId}' | 'NO' |
| Exam | DELETE | `NONE` | 'api/v1/exams/{examId}' | 'NO' |

### Environment

> Laravel Lumen Version 6.2.0
>
>***
> PHP Version 7.3.5
>
>***
### Installation
* Run `$ composer install`
### Environment File Setup
* MySql Database used

* A Laravel Lumen Generator added
    * Look at https://github.com/flipboxstudio/lumen-generator
    * Following Artisan commands are made available

          ----------------------------------------------------
          key:generate      Set the application key

          make:command      Create a new Artisan command
          make:controller   Create a new controller class
          make:event        Create a new event class
          make:job          Create a new job class
          make:listener     Create a new event listener class
          make:mail         Create a new email class
          make:middleware   Create a new middleware class
          make:migration    Create a new migration file
          make:model        Create a new Eloquent model class
          make:policy       Create a new policy class
          make:provider     Create a new service provider class
          make:seeder       Create a new seeder class
          make:test         Create a new test class
* Run `php artisan migrate --seed` to migrate and seed

### Useage
* Look at the API's index for information on CRUD operations.
* Look at the controllers for validation using Lumen validator for Create and Update operations.
---
      'code' => 'required|unique:exams|min:5|max:20',
      'name' => 'required|min:5|max:50',
      'start_time' => 'required|date_format:Y-m-d H:i:s',
      'end_time' => 'required|date_format:Y-m-d H:i:s',
---
* HATEOAS implemented
    * Look at `"links"` field in the response
    * Example `/api/v1/exams/1` response
    ---
        {
            "id": 1,
            "code": "5R8R1j2g",
            "name": "NB1XwbUCSE",
            "start_time": "2019-11-23 09:00:00",
            "end_time": "2019-11-23 12:00:00",
            "links": [
                {
                    "ref": "exam",
                    "href": "/api/v1/exams/1",
                    "action": "PUT"
                },
                {
                    "ref": "exam",
                    "href": "/api/v1/exams/1",
                    "action": "DELETE"
                },
                {
                    "rel": "exams",
                    "href": "/api/v1/exams",
                    "action": "GET"
                }
            ]
        }
    ---
