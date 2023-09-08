# iNote - PHP CRUD Application


iNote is a simple PHP-based CRUD (Create, Read, Update, Delete) application for managing notes. It allows users to add, view, edit, and delete notes in a user-friendly interface. The application is built using Bootstrap 5 and integrated with DataTables for smooth pagination and table presentation.

## Live Demo


## Technologies Used

- PHP
- MySQL
- Bootstrap 5
- DataTables

## Getting Started

To run this application on your local machine, follow these steps:

1. Clone the repository from GitHub:

```bash
git clone https://github.com/TanzimHossain2/iNote-PHP.git
```

2. Set up a local development environment with PHP and MySQL.

3. Import the `notes.sql` file into your MySQL database to create the necessary table.

4. Update the database connection settings in the `index.php` file:

```php
$servername = "localhost";
$username = "root";
$password = "";
$database = "notes";
```

5. Open the application in your web browser:

```bash
# Replace [path-to-project] with the actual path to the project directory
cd [path-to-project]
```

## Features

- Create new notes with a title and description.
- View a paginated table of existing notes using DataTables.
- Edit existing notes and update their title and description.
- Delete notes from the database.



## Contributing

Contributions to iNote are welcome! If you find any bugs or want to suggest new features, please open an issue or submit a pull request.


## Acknowledgments

- DataTables: [https://datatables.net/](https://datatables.net/)
- Bootstrap: [https://getbootstrap.com/](https://getbootstrap.com/)

## Contact

For any inquiries or questions, please reach out to us at [tanzimhossain2@gmail.com](mailto:tanzimhossain2@gmail.com).