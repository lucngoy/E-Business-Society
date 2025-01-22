# **Local Business Directory**  
*An intuitive web application connecting local businesses with their customers.*  

## 🚀 **Project Overview**  
**Local Business Directory** is a web application developed using Laravel and MySQL. It aims to help small local businesses gain visibility by offering a user-friendly platform where they can showcase their profiles, receive reviews, and be discovered via advanced search and interactive mapping features.

## ✨ **Key Features**  
- **Business Management**: Add, update, and delete profiles for local businesses.  
- **Customer Reviews**: Users can leave ratings and reviews for businesses.  
- **Advanced Search**: Search by category, business name, or location.  
- **Dynamic Statistics**: Interactive dashboard displaying key metrics (number of businesses, reviews, etc.).  
- **Interactive Map**: Display businesses on a map with clickable markers.  
- **User Roles**: Authentication system with role management for administrators and business owners.  

## 🛠️ **Technologies Used**  
- **Backend Framework**: Laravel  
- **Database**: MySQL  
- **Frontend**: Blade, HTML, CSS, JavaScript  
- **Libraries and Tools**:  
  - Alpine.js for frontend interactivity  
  - AOS (Animate on Scroll) for animations  
  - TailwindCSS for styling  

## 📂 **Project Structure**  
```plaintext
├── app/                  # Controllers, Models, Services
├── resources/
│   ├── views/            # Blade views
│   ├── js/               # Custom scripts
│   ├── css/              # Custom styles
├── routes/
│   ├── web.php           # Application routes
├── database/
│   ├── migrations/       # MySQL migration files
│   ├── seeders/          # Initial data seeders
```

## 🚦 **Prerequisites**  
Ensure you have the following installed before running the project:  
- **PHP >= 8.1**  
- **Composer**  
- **Node.js & npm**  
- **MySQL**  
- **XAMPP or equivalent local server**  

## 🖥️ **Installation**  
1. Clone this repository:  
   ```bash
   git clone https://github.com/lucngoy/e-business-society.git
   cd e-business-society
   ```  
2. Install PHP dependencies using Composer:  
   ```bash
   composer install
   ```  
3. Install frontend dependencies using npm:  
   ```bash
   npm install
   npm run dev
   ```  
4. Configure the `.env` file:  
   - Database setup:  
     ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=local_business_directory
     DB_USERNAME=root
     DB_PASSWORD=your_password
     ```  
5. Run migrations and seeders:  
   ```bash
   php artisan migrate --seed
   ```  
6. Start the local server:  
   ```bash
   php artisan serve
   ```  
7. Access the application at [http://localhost:8000](http://localhost:8000).

## 📊 **Dashboard Overview**  
The dashboard displays global and role-specific statistics:  
- **Admin**: Total number of businesses, reviews, and users.  
- **Business Owner**: Overview of their businesses, reviews received, etc.

## 🛡️ **Security and Role Management**  
The authentication system manages multiple user roles:  
- **Admin**: Manages users, businesses, and reviews.  
- **Business Owner**: Manages their profiles and monitors specific statistics.  
- **Customer**: Searches for businesses and leaves reviews.

## 🤝 **Contributing**  
Contributions are welcome!  
1. Fork the repository.  
2. Create a feature branch:  
   ```bash
   git checkout -b feature/my-feature
   ```  
3. Submit a pull request.  

## 📧 **Contact**  
For questions or suggestions, feel free to reach out:  
- **Email**: [your-email@example.com](mailto:lucbanze.lb@gmail.com)  
- **GitHub**: [github.com/username](https://github.com/lucngoy)

---
