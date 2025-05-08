# 🛒 WholesaleMart – PHP & MySQL Based Wholesale Ordering Platform

**WholesaleMart** is a PHP and MySQL-powered web application designed for wholesalers and retailers. It features product listings, user authentication, dealer/retailer dashboards, and basic order functionality. This project uses a simple MVC-style folder structure with core PHP.

---

## 📁 Project Structure

```
Wholesalemart-project/
│
├── Controller/           # Handles form submissions and backend logic
├── Model/                # Database interaction functions
├── Sql/                  # SQL dump to create necessary database tables
├── auth/                 # Registration and login handling
├── component/            # Shared components (header, navbar, footer, etc.)
├── dealer/               # Dealer-specific dashboard and functionality
├── retailer/             # Retailer dashboard and order options
├── public/               # Public assets (CSS, JS, images)
├── index.php             # Homepage of the application
└── register_login.php    # Handles login and registration forms
```

---

## 👥 User Roles

- **Retailer**
  - Register and log in
  - Browse available wholesale products
  - Place orders

- **Dealer**
  - Log in to manage and list products
  - View and manage orders

- *(Optional Admin role can be added in future)*

---

## 🚀 Getting Started (Local Setup)

### ✅ Requirements

- PHP 7.x or higher
- MySQL/MariaDB
- Apache Server (XAMPP, WAMP, LAMP, etc.)

### 📥 Installation Steps

#### 1. Clone the Repository

```bash
git clone https://github.com/saugatpoudel100/Wholesalemart-project.git
cd Wholesalemart-project
```

Or extract the project into your local server's web directory (e.g., `htdocs` in XAMPP).

#### 2. Create the Database

- Open `phpMyAdmin`
- Create a new database: `wholesalemart`
- Import the SQL file found in the `Sql/` directory

#### 3. Configure Database Connection

Open the DB connection file inside `Model/` (e.g., `Model/db.php`) and update:

```php
$host = "localhost";
$user = "root";
$password = "";
$database = "wholesalemart";

$conn = mysqli_connect($host, $user, $password, $database);
```

#### 4. Start the Server

Run Apache and MySQL using XAMPP/WAMP, and open the project in your browser:

```
http://localhost/Wholesalemart-project/index.php
```

---

## 🔐 Authentication

- Handled via `register_login.php` and `/auth/` directory
- Simple login system using PHP sessions
- Role-based redirection for `dealer` and `retailer`

---

## ⚙️ Features Overview

| Feature                     | Description                                      |
|----------------------------|--------------------------------------------------|
| 🧾 User Registration        | Retailers can register for bulk order access     |
| 🔐 Login System             | Role-based login with session management         |
| 🛍️ Product Management       | Dealers can list and update wholesale products   |
| 📦 Order Placement          | Retailers can browse and place bulk orders       |
| 📊 Separate Dashboards      | Individual dashboards for retailers and dealers  |
| 🧱 Component-based Design   | Reusable layout and component templates          |

---

## 🧠 Future Enhancements

- Admin dashboard for site control
- Order tracking and status updates
- Email notifications
- Responsive/mobile design
- Product search and filtering
- Password encryption (hashing)

---



## 🙋‍♂️ Author & Contact

Created by **[Saugat Poudel](https://github.com/saugatpoudel100)**  
📧 Email: *sauggupoudel100@gmail.com*  
🔗 GitHub: [https://github.com/saugatpoudel100](https://github.com/saugatpoudel100)

---

> ✅ Feel free to fork this repository and customize it as per your business needs!
