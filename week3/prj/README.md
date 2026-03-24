# User Profile System (PHP)

## Overview

This is a simple User Profile Management System built using pure PHP (without a database).  
User information is stored in a JSON file. The system allows users to log in, update their bio, and upload a profile avatar. If no avatar is uploaded, a default image will be displayed automatically.

---

## Features

- Session-based login system  
- Edit user bio  
- Upload avatar (JPG, PNG, GIF only)  
- Default avatar fallback  
- JSON-based data storage  
- Basic XSS protection using htmlspecialchars()  
- Clean and organized file structure  

---

## Project Structure


project/
│
├── assets/
│ │ └── style.css
│ │ └── default-avatar.png
│
├── includes/
│ ├── config.php
│ ├── auth.php
│ ├── functions.php
│
├── pages/
│ ├── login.php
│ ├── logout.php
│ ├── profile.php
│
└── README.md


---

## Default Avatar Setup

Create the folder:


assets/images/


Add a default image named:


default-avatar.png


Final path:


assets/images/default-avatar.png


If a user has no uploaded avatar, this image will be displayed automatically.

---

## Avatar Upload Rules

- Allowed file types:
  - image/jpeg
  - image/png
  - image/gif
- Uploaded files are stored in:

assets/uploads/

- Files are renamed using:

time() + original filename


---

## How It Works

1. User data is loaded from:

data/users.json


2. When the profile form is submitted:
- The bio is updated.
- If an avatar is selected:
  - Validate file type.
  - Move file to uploads folder.
  - Save file path into JSON.
- Save updated data.

3. If no avatar exists, the system displays:

../assets/images/default-avatar.png


---

## Requirements

- PHP 7+
- Local server (XAMPP, Apache, etc.)
- Write permission for:
- assets/uploads/
- data/users.json

---

## Security

- XSS prevention using htmlspecialchars()
- File type validation
- Session authentication
- Clean execution (no duplicated code)

---

## Future Improvements

- Password hashing
- File size validation
- Delete old avatar when uploading a new one
- Add user registration
- Replace JSON storage with MySQL database

---

## Author

Student PHP Practice Project