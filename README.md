# Blog API

[![Repository](https://img.shields.io/badge/GitHub-MachineKe%2Fyii2__blog__api-blue?logo=github)](https://github.com/MachineKe/yii2_blog_api)

> **Note:**  
> The API is currently served from the **frontend application URL** (e.g., `http://localhost:8080/` or `http://frontend.local/`).

A RESTful API for a blog platform, providing endpoints to manage posts and comments.  
Built with Yii2, supporting authentication, access control, and standard CRUD operations.

**Repository:** [https://github.com/MachineKe/yii2_blog_api](https://github.com/MachineKe/yii2_blog_api)

---

## 🚀 Authentication

- **HTTP Bearer Token** authentication is required for creating, updating, and deleting posts or comments.
- Obtain a token by registering and logging in (user endpoints not shown here).
- Pass the token in the `Authorization` header:  
  ```
  Authorization: Bearer <access_token>
  ```

---

## 📚 Endpoints

### Posts

| Method | Endpoint                | Description                        | Auth Required |
|--------|------------------------|------------------------------------|--------------|
| GET    | `/posts`               | List all posts                     | No           |
| GET    | `/posts/{id}`          | Get a single post                  | No           |
| POST   | `/posts`               | Create a new post                  | Yes          |
| PUT    | `/posts/{id}`          | Update a post (owner only)         | Yes          |
| PATCH  | `/posts/{id}`          | Partially update a post (owner)    | Yes          |
| DELETE | `/posts/{id}`          | Delete a post (owner only)         | Yes          |
| GET    | `/posts/{id}/comments` | List comments for a given post     | No           |

### Comments

| Method | Endpoint                  | Description                        | Auth Required |
|--------|--------------------------|------------------------------------|--------------|
| GET    | `/comments`              | List all comments                  | No           |
| GET    | `/comments?postid=1`     | List comments for post with ID=1   | No           |
| GET    | `/comments/{id}`         | Get a single comment               | No           |
| POST   | `/comments`              | Create a new comment               | Yes          |
| PUT    | `/comments/{id}`         | Update a comment (owner only)      | Yes          |
| PATCH  | `/comments/{id}`         | Partially update a comment (owner) | Yes          |
| DELETE | `/comments/{id}`         | Delete a comment (owner only)      | Yes          |

---

## 🔒 Access Control

- Only the creator of a post or comment can update or delete it.
- All users can view posts and comments.

---

## 📝 Example Requests

**Get all posts**
```http
GET /posts
Accept: application/json
```

**Create a post**
```http
POST /posts
Authorization: Bearer <access_token>
Content-Type: application/json

{
  "title": "My First Post",
  "body": "This is the content of the post."
}
```

**Get comments for a post**
```http
GET /posts/1/comments
Accept: application/json
```

**Create a comment**
```http
POST /comments
Authorization: Bearer <access_token>
Content-Type: application/json

{
  "post_id": 1,
  "body": "Nice post!"
}
```

---

## ⚙️ Setup Instructions

1. **Install dependencies**
   ```sh
   composer install
   ```

2. **Configure your database**  
   Edit `common/config/main.php` with your DB settings.

3. **Run migrations**
   ```sh
   php yii migrate
   ```

4. **Serve the frontend API** (default port 8080)
   ```sh
   php yii serve --port=8080 --docroot=frontend/web
   ```
   The API is available at: [http://localhost:8080/](http://localhost:8080/)

5. **Serve the backend application** (default port 8081)
   ```sh
   php yii serve --port=8081 --docroot=backend/web
   ```
   The backend is available at: [http://localhost:8081/](http://localhost:8081/)

---

## 🌐 Optional: Using Virtual Hosts (vhosts)

You can configure Apache virtual hosts to serve the frontend and backend under separate local domains (e.g., `frontend.local`, `backend.local`). This is useful for development and mimics production environments.

### 1. Edit your hosts file

Add the following lines to your `C:\Windows\System32\drivers\etc\hosts` file (run your editor as Administrator):

```hosts
127.0.0.1   frontend.local
127.0.0.1   backend.local
```

### 2. Configure Apache vhosts (XAMPP example)

Edit your Apache `httpd-vhosts.conf` file (commonly found at `C:\xampp\apache\conf\extra\httpd-vhosts.conf`) and add:

```apache
<VirtualHost *:80>
    DocumentRoot "D:/xamp/htdocs/yii2_blog_api/frontend/web"
    ServerName frontend.local
    <Directory "D:/xamp/htdocs/yii2_blog_api/frontend/web">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>

<VirtualHost *:80>
    DocumentRoot "D:/xamp/htdocs/yii2_blog_api/backend/web"
    ServerName backend.local
    <Directory "D:/xamp/htdocs/yii2_blog_api/backend/web">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

### 3. Restart Apache

Restart Apache from the XAMPP control panel for the changes to take effect.

### 4. Access your applications

- **API (frontend):** [http://frontend.local/](http://frontend.local/)
- **Backend:** [http://backend.local/](http://backend.local/)

> Ensure your `frontend/web/.htaccess` and `backend/web/.htaccess` files exist to enable URL rewriting.

---
