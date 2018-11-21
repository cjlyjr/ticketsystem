# ticketsystem
This is a ticket system to report bugs in a e-commerce website



1. if you are a ticket's author,just click Ticket list and reply 

2. if you are a user,you need to register and login, then create new  and update and delete ticket 


3. when you download the ticket-system program, you need to check your env. connect to your mysql datebase. 
   my database name is ticketsystem, i use phpMyAdmin.
4. you need to check the below description to create your table.

5. if you use php artisan migrate,then need to check userposts table structure.

    ticketreply MEDIUMTEXT COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
    fileimg VARCHAR(191) COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL

---------------------------------------------------------------------------
 

-- phpMyAdmin
-- version 4.6.5.2
-- https://www.phpmyadmin.net/

-- Host: 127.0.0.1

-- PHP Version: 7.1.1

database: ticketsystem


-- --------------------------------------------------------


-- Table structure for table 'migrations'


CREATE TABLE migrations (
  id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  migration VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  batch INT(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




-- Table structure for table 'password_resets'


CREATE TABLE password_resets(
  email VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  token VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------


-- Table structure for table 'userposts'


CREATE TABLE userposts (
 id  INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 title VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
 ticketcontent MEDIUMTEXT COLLATE utf8mb4_unicode_ci NOT NULL,
 ticketreply MEDIUMTEXT COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
 created_at TIMESTAMP NULL DEFAULT NULL,
 updated_at TIMESTAMP NULL DEFAULT NULL,
 user_id INT(11) NOT NULL,
 fileimg VARCHAR(191) COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------


-- Table structure for table 'users'


CREATE TABLE users (
  id int(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  email VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  email_verified_at TIMESTAMP NULL DEFAULT NULL,
  password VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  remember_token VARCHAR(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


