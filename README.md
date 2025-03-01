# To-Do List App

A simple and efficient To-Do List application built using **Laravel 10** and **Tailwind CSS**.

## Features

- Add, edit, and delete tasks
- Mark tasks as completed or in progress
- Role-based access control (Admin & Manager)
- Admin dashboard for managing users and tasks
- Manager dashboard for overseeing task progress
- User authentication 
- Responsive UI with Tailwind CSS

## Installation

### Prerequisites
- PHP 8.1 or higher
- Composer
- Node.js & npm
- MySQL or SQLite

### Steps

1. **Clone the repository**
   ```sh
   git clone https://github.com/alihassanmsf/To-Do-list.git
   cd To-Do-list
   ```

2. **Install dependencies**
   ```sh
   composer install
   npm install
   ```

3. **Set up environment**
   ```sh
   cp .env.example .env
   php artisan key:generate
   ```
   Configure the `.env` file with database credentials.

4. **Run migrations**
   ```sh
   php artisan migrate
   ```

5. **Run seeders** (to create roles and the admin user)
   ```sh
   php artisan db:seed --class=RolesTableSeeder
   php artisan db:seed --class=AdminSeeder
   ```

6. **Start the development server**
   ```sh
   php artisan serve
   ```
   The app should now be running at `http://127.0.0.1:8000`.

## Usage

### **User Registration & Role Assignment**
- Any user can **register** using the signup form.
- Only the **Admin** has the authority to **create and assign** the **Manager role** to a registered user.

### **Admin Functionalities**
- Create and manage **Managers**.
- Assign roles to users.
- Create, edit, and delete **tasks**.
- Track task progress from the **activity logs**.

### **Manager Functionalities**
- View and manage assigned **tasks**.
- Create and assign tasks to users.
- Track task progress through the **activity logs**.
- Mark tasks as **completed** or **in progress**.

### **Task Tracking**
- The **Admin and Manager** can monitor task activities from the **Activity Log**.
- The activity log records updates such as:
  - Task creation.
  - Status changes (e.g., In Progress → Completed).
  - Edits made to tasks.
## Screenshots

<img width="1399" alt="Screenshot 1446-09-01 at 11 29 29 PM" src="https://github.com/user-attachments/assets/baadfa83-c653-4943-b046-101e547d5b9f" />
<img width="1399" alt="Screenshot 1446-09-01 at 11 35 38 PM" src="https://github.com/user-attachments/assets/adc6664a-df41-4de3-9a9c-d054df5a8dab" />
<img width="1373" alt="Screenshot 1446-09-01 at 11 40 07 PM" src="https://github.com/user-attachments/assets/39f2a74b-21fe-46f4-81af-a751d837cee8" />
<img width="1404" alt="Screenshot 1446-09-01 at 11 51 28 PM" src="https://github.com/user-attachments/assets/ec4cb94d-f2f3-4382-bc4b-a1afa3639352" />





## Contributing

Feel free to fork this repository and make improvements. Contributions are welcome!

---

**Happy Coding! 🚀**
