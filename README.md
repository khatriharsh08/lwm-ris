# ♻️ LWM-RIS

**Local Waste Management & Recycling Information System** — A CodeIgniter 4 web application promoting waste segregation and recycling awareness in local communities.

---

## ✨ Features

### 🌐 Public Website

- Single-page informative home displaying waste categories, recycling centers & events
- Waste type details (Dry, Wet, Hazardous)
- State-wise recycling center listing
- Upcoming events & seminars
- Contact form for user feedback

### 🔐 Admin Panel

- Secure authentication with password reset
- Dashboard with statistics overview
- **Waste Categories** — Add/Edit/Delete waste types
- **Recycling Centers** — Manage centers with location details
- **Events & Seminars** — Manage community events with posters
- **Contact Messages** — View and manage user submissions
- **Reports** — Generate PDF reports for events & centers
- **Activity Logs** — Track admin actions (Master Admin only)
- **Admin Management** — Create/manage admin users (Master Admin only)
- Profile management

---

## 🛠️ Tech Stack

| Layer     | Technology                           |
| --------- | ------------------------------------ |
| Framework | CodeIgniter 4 (PHP 8+)               |
| Database  | MySQL                                |
| Frontend  | Bootstrap 5, HTML5, CSS3, JavaScript |
| Server    | Apache (XAMPP / WAMP / Laragon)      |

---

## 📁 Project Structure

```
app/
├── Controllers/
│   ├── admin/          # Admin controllers
│   └── front/          # Public controllers
├── Models/             # Database models
├── Views/
│   ├── admin/          # Admin panel views
│   └── front/          # Public website views
└── Config/
    ├── Routes.php
    └── Database.php
database/
└── lwm_ris.sql         # Database schema
public/
└── assets/             # CSS, JS, Images
```

---

## 🗄️ Database Schema

| Table                  | Description                  |
| ---------------------- | ---------------------------- |
| `lwm_user`             | Admin users & authentication |
| `lwm_wastecategories`  | Waste category types         |
| `lwm_recyclingcenters` | Recycling center locations   |
| `lwm_events`           | Events & seminars            |
| `lwm_contactmessages`  | Contact form submissions     |
| `lwm_activity_logs`    | Admin action audit trail     |
| `password_resets`      | Password reset tokens        |
| `migrations`           | CodeIgniter migrations       |

---

## 🚀 Installation

1. **Clone the repository**

   ```bash
   git clone https://github.com/yourusername/lwm-ris.git
   cd lwm-ris
   ```

2. **Configure environment**

   ```bash
   cp env .env
   ```

   Update `.env` with your database credentials:

   ```
   database.default.hostname = localhost
   database.default.database = lwm_ris
   database.default.username = root
   database.default.password =
   database.default.DBDriver = MySQLi
   ```

3. **Import database**

   ```bash
   mysql -u root -p < database/lwm_ris.sql
   ```

4. **Run the application**
   ```bash
   php spark serve
   ```
   Visit: http://localhost:8080

---

## 🔑 Default Login Credentials

| Role             | Email             | Password |
| ---------------- | ----------------- | -------- |
| **Master Admin** | master@lwmris.com | password |
| **Admin**        | admin@lwmris.com  | password |

> ⚠️ **Important:** Change these passwords after first login!

---

## 🔗 Routes

| URL                | Description                 |
| ------------------ | --------------------------- |
| `/`                | Public home page            |
| `/login`           | Admin login                 |
| `/dashboard`       | Admin dashboard             |
| `/wastecategory`   | Manage waste categories     |
| `/recyclingcenter` | Manage recycling centers    |
| `/eventsseminar`   | Manage events               |
| `/contactmessage`  | View messages               |
| `/report`          | Generate reports            |
| `/admins`          | Manage admins (Master only) |
| `/activitylog`     | View logs (Master only)     |

---

## 👥 User Roles

| Role             | Access                            |
| ---------------- | --------------------------------- |
| **Public**       | View website, submit contact form |
| **Admin**        | Manage all content modules        |
| **Master Admin** | Admin management + Activity logs  |

---

## 📄 License

This project is for educational purposes only.

---

<p align="center">Made with ❤️ using CodeIgniter 4</p>
