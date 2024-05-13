# Pullo: Premium and Limited-Edition Sneaker Resale Web Application

## Table of Contents
1. [Project Overview](#project-overview)
2. [Features and User Modules](#features-and-user-modules)
3. [Database Design](#database-design)
4. [Web Forms and Associated Database Interactions](#web-forms-and-associated-database-interactions)
5. [Implementation and Presentation](#implementation-and-presentation)
6. [Development Environment](#development-environment)
7. [Contributing](#contributing)

## Project Overview
Pullo is a web application designed for the resale of premium and limited-edition sneakers like Jordans, and Yeezys. The platform caters to enthusiasts and collectors, providing a specialized marketplace for buying and selling high-demand footwear.

## Features and User Modules
### General Features:
- User authentication (login and registration)
- Product browsing and search functionality
- Shopping cart and checkout process
- Order history and tracking
- Profile management

### User Modules:
#### Customer Module (End-users)
- **Registration:** Users can create their accounts by providing necessary details.
- **Login:** Authenticated access to their accounts.
- **View and Add to Cart:** Browse available items, add them to the cart, and proceed to checkout.
- **Order History:** View past orders and their statuses.
- **Profile Management:** Update personal information and manage addresses.

#### Admin Module (Administrators)
- **Product Management:** Add, update, and remove products.
- **Category Management:** Add and edit product categories.
- **Order Management:** View and modify user orders.
- **User Management:** View, edit, or delete user accounts, upgrade users to admin status.
- **Analytics Dashboard:** View basic analytics on sales and user activities.

## Database Design
The database schema supports all user activities and ensures efficient data retrieval and storage. Relationships between tables are correctly defined to maintain data integrity and optimize query performance.

- **ER Diagram:** Attached as an SVG file in the submission zip.

## Web Forms and Associated Database Interactions
### Module 1: Customer
| Web Form           | Database Table | Activity                                           |
|--------------------|----------------|----------------------------------------------------|
| `register.php`     | Customer       | New user information entered into database         |
| `login.php`        | Customer       | Registered user can login to checkout items        |
| `cart.php`         | Customer       | Add, edit items in cart; login required            |
| `checkout.php`     | Customer       | Checkout items in the cart                         |
| `shoes.php`        | Customer       | View available products and add them to the cart   |
| `orderHistory.php` | Customer       | View the order history; login required             |
| `profile.php`      | Customer       | Update user profile information                    |

### Module 2: Admin
| Web Form           | Database Table | Activity                                           |
|--------------------|----------------|----------------------------------------------------|
| `addProduct.php`   | Admin          | Add new products or update existing ones           |
| `viewOrders.php`   | Admin          | View current orders                                |
| `editUser.php`     | Admin          | Edit user information                              |

## Implementation and Presentation
- **Video Presentation Links:**
  - Part One: `CSCI-N342-Presentation1.mp4`
  - Part Two: `CSCI-N342-Presentation2.mp4`
- Both presentations demonstrate the application's functionality and database interactions as outlined in the project documentation.

## Development Environment
To set up a local development environment:
1. Clone the repository.
2. Install dependencies (e.g., PHP, MySQL).
3. Configure your web server (e.g., Apache, Nginx).
4. Import the database schema from the provided script.
5. Adjust the database connection settings in the application configuration files.
---