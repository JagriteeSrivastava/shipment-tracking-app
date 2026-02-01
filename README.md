# Shipment Tracking Web Application

A modern, glassmorphism-styled shipment tracking application built with **Laravel 11**. This application allows users to create, track, and manage shipments with real-time status updates and a premium user interface.

## 🚀 Features

### Core Functionality
-   **Dashboard**: View all shipments with pagination, global search, and status badges.
-   **Shipment Details**: Comprehensive view of sender/receiver info and a vertical timeline of status updates.
-   **Dynamic Data Entry**: Create new shipments and update statuses (Pending, In Transit, Delivered) with location data.

### Advanced Features
-   **Yajra DataTables**: Server-side processing for efficient handling of large datasets.
-   **Smart Filtering**: Dedicated "Filter by Tracking #" alongside global search.
-   **Auto-Generated Tracking**: Unique, read-only tracking numbers generated securely on creation.
-   **SweetAlert Notifications**: Interactive popup notifications for success/error states.

### UI/UX Design
-   **Glassmorphism**: Modern, semi-transparent card designs with blur effects.
-   **Responsive**: Fully adaptive layout for desktop and mobile.
-   **High Contrast**: Accessible status badges with distinct colors (Orange, Blue, Green).

## 🛠️ Technology Stack

-   **Backend**: Laravel 11, PHP 8.2+
-   **Frontend**: Blade Templates, Vanilla CSS (Glassmorphism), Bootstrap 5 (Grid/Pagination)
-   **Database**: MySQL
-   **Libraries**:
    -   `yajra/laravel-datatables`
    -   `realrashid/sweet-alert`

## ⚙️ Installation

1.  **Clone the repository**
    ```bash
    git clone https://github.com/JagriteeSrivastava/shipment-tracking-app.git
    cd shipment-tracking-app
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    npm install && npm run build
    ```

3.  **Environment Setup**
    -   Copy `.env.example` to `.env`.
    -   Configure your database credentials in `.env`.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Database Migration & Seeding**
    ```bash
    php artisan migrate --seed
    ```

5.  **Run the Application**
    ```bash
    php artisan serve
    ```
    Visit `http://localhost:8000` to view the app.

## ✅ Running Tests

The application includes a comprehensive test suite (Feature & Unit tests).
```bash
php artisan test
```

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
