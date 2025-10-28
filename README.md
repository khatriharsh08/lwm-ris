# ♻️ Local Waste Management & Recycling Information System (LWM-RIS)

## 🧾 Project Overview

**Local Waste Management & Recycling Information System (LWM-RIS)** is a **web-based system** built using **CodeIgniter 4 (PHP MVC Framework)** and **MySQL**.
It helps promote **waste segregation** and **recycling awareness** within local communities.

The application provides a **single-page public interface** showing all key information — waste categories, recycling centers, and upcoming events — and an **admin dashboard** for managing all data.

---

## 🌍 Key Highlights

* ✅ **Single-Page Public Frontend:** All content is shown on one clean home page.
* 🔐 **Secure Admin Panel:** Manage waste info, centers, and events.
* ♻️ **Awareness Focused:** Educate citizens on proper waste segregation.
* 📱 **Responsive Layout:** Built with Bootstrap 5 for all screen sizes.

---

## 👥 Roles & Access

### 👨‍💼 Admin Panel

**URL:** `/admin/login`

**Features**

* Secure admin authentication
* Manage:

  * Waste Categories (Dry / Wet / Hazardous)
  * Recycling Centers (Name, Address, City, Contact)
  * Events / Seminars (Title, Description, Date, Venue, Poster)
  * Contact / Feedback Messages
* Dashboard for quick overview
* Manage static pages (Privacy Policy, Terms, etc.)

---

### 👤 Public Interface

**URL:** `/`

**Features**

* All sections displayed in one scrollable page:

  * Introduction / Awareness Message
  * Waste Segregation Info
  * Nearby Recycling Centers
  * Upcoming Events (view only, no registration)
  * Contact Form
* No user registration or login required

---

## 🧠 Core Features

| Feature                | Description                                            | Access |
| ---------------------- | ------------------------------------------------------ | ------ |
| Waste Segregation Info | Explains how to separate dry, wet, and hazardous waste | Public |
| Recycling Centers      | Displays verified local recycling centers              | Public |
| Events & Seminars      | Shows event details only (no registration)             | Public |
| Contact Form           | Sends feedback messages to admin                       | Public |
| Admin Dashboard        | Manages all backend data                               | Admin  |

---

## 🧩 Project Structure (CodeIgniter 4)

```
/app
  /Controllers
    Home.php
    Admin.php
    AdminWaste.php
    AdminCenters.php
    AdminEvents.php
    Messages.php
    Contact.php
  /Models
    WasteModel.php
    CenterModel.php
    EventModel.php
    MessageModel.php
    AdminModel.php
  /Views
    /public
      home.php
    /admin
      login.php
      dashboard.php
      manage_waste.php
      manage_centers.php
      manage_events.php
      messages.php
/public
  /assets
    /css
    /js
    /images
  /damoimage
    1.jpeg → 13.jpeg
/app/Config
  Database.php
  Routes.php
  App.php
```

---

## 🗃️ Database Structure

| Table               | Columns                                           | Description       |
| ------------------- | ------------------------------------------------- | ----------------- |
| `admin_users`       | id, username, password_hash                       | Admin credentials |
| `waste_categories`  | id, type, description, image                      | Waste info        |
| `recycling_centers` | id, name, address, city, contact                  | Centers list      |
| `events`            | id, title, description, date, venue, poster_image | Events info       |
| `contact_messages`  | id, name, email, message, submitted_at            | User feedback     |

---

## 🧰 Tools & Technologies

* **Framework:** CodeIgniter 4 (PHP 8+)
* **Frontend:** HTML5, CSS3, Bootstrap 5, JavaScript
* **Backend:** PHP (MVC – CodeIgniter 4)
* **Database:** MySQL
* **Server:** Apache (XAMPP / WAMP / Laragon)
* **Version Control:** Git & GitHub

---

## 🚀 Installation

1. **Clone Repository**

   ```bash
   git clone https://github.com/yourusername/lwm-ris.git
   cd lwm-ris
   ```

2. **Set Up Environment**

   * Copy `.env.example` → `.env`
   * Update your DB credentials:

     ```
     database.default.hostname = localhost
     database.default.database = lwm_ris
     database.default.username = root
     database.default.password =
     database.default.DBDriver = MySQLi
     ```

3. **Create Database**

   * Create a new MySQL database named `lwm_ris`
   * Import the provided SQL file (if available)

4. **Run Application**

   ```bash
   php spark serve
   ```

   Visit → [http://localhost:8080](http://localhost:8080)

5. **Access Admin Panel**

   * Go to: `/admin/login`
   * Use admin credentials stored in the database

---

## 💡 Future Enhancements

* Google Maps integration for centers
* Center search and filter
* Image optimization
* Dark/Light mode

---


## 🖼️ Demo Screenshots

Preview images from the `Damo Image` folder:

<p align="center">
  <img src="Damo Image/1.jpeg" width="200">
  <img src="Damo Image/2.jpeg" width="200">
  <img src="Damo Image/3.jpeg" width="200">
  <img src="Damo Image/4.jpeg" width="200">
  <img src="Damo Image/5.jpeg" width="200">
  <img src="Damo Image/6.jpeg" width="200">
  <img src="Damo Image/7.jpeg" width="200">
  <img src="Damo Image/8.jpeg" width="200">
  <img src="Damo Image/9.jpeg" width="200">
  <img src="Damo Image/10.jpeg" width="200">
  <img src="Damo Image/11.jpeg" width="200">
  <img src="Damo Image/12.jpeg" width="200">
  <img src="Damo Image/13.jpeg" width="200">
</p>

---

## ⚠️ Declaration

> This project is developed for **educational and demonstration purposes only**.
> The information (such as recycling centers, events, and waste data) is **sample content** and **may not be accurate or real**.
> Please do not rely on this data for actual waste management or public service use.
