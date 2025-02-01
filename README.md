

### **Blog System** 📝  
A web-based blog management system built with **Laravel** that enables user authentication, role-based access, post management, commenting, and an admin panel for enhanced control.

---

## **Features** 🚀  

✅ **User Authentication** - Register, login, logout, and social login (Google, Facebook).  
✅ **Role-Based Access** - Admin and regular users with different permissions.  
✅ **Post Management** - Create, read, update, and delete (CRUD) blog posts.  
✅ **Comments** - Users can comment on posts.  
✅ **Admin Panel** - Manage users, posts, and comments.  
✅ **Middleware Security** - Protect routes based on user roles.  
✅ **Performance Optimization** - Caching, eager loading, and query optimizations.  
✅ **Testing** - Laravel PHPUnit testing for controllers and models.  

---

## **Tech Stack** 🛠  

- **Backend:** Laravel 8+  
- **Database:** MySQL / PostgreSQL  
- **Authentication:** Laravel UI, Socialite (Google, Facebook)  
- **Admin Panel:** Role-based access using Middleware  
- **Caching & Optimization:** Laravel Cache, Query Optimization  
- **Testing:** Laravel PHPUnit  
- **API Support (Optional):** Laravel API resources for mobile integration  

---

## **Installation & Setup** 💻  

### **1. Clone the Repository**  
```sh
git clone https://github.com/12DeshmukhAish/Blog_System.git
cd Blog_System
```

### **2. Install Dependencies**  
```sh
composer install
```

### **3. Set Up Environment**  
Copy `.env.example` and create a new `.env` file:  
```sh
cp .env.example .env
```
Generate the application key:  
```sh
php artisan key:generate
```

### **4. Configure Database**  
Update the `.env` file with your database credentials:  
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```
Then, run migrations:  
```sh
php artisan migrate
```

### **5. Seed Default Data (Optional)**  
```sh
php artisan db:seed
```

### **6. Run the Application**  
```sh
php artisan serve
```
Access the app in your browser: **http://127.0.0.1:8000**

---

## **Usage Instructions** 📝  

### **1. User Authentication**  
- Register/Login with email and password.  
- Social login via Google & Facebook.  

### **2. Role-Based Permissions**  
- **Admin**: Can manage users, posts, and comments.  
- **Regular User**: Can create, edit, and delete their own posts.  

### **3. Managing Blog Posts**  
- Users can **create, edit, delete, and view** blog posts.  
- Soft delete is enabled for better post management.  

### **4. Comments**  
- Users can comment on posts.  
- Admins can manage all comments.  

### **5. Admin Panel**  
- Dashboard to manage users, posts, and comments.  
- Protected by middleware for **authorized access only**.  

---

## **Testing the Application** 🧪  
Run the test suite:  
```sh
php artisan test
```



### **Demo Video (Optional) 📽️**  
Upload a short video showcasing your project in action.

---

This **README.md** provides a **clear** and **structured** guide for your project. Let me know if you want any modifications! 🚀
