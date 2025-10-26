# GitHub Copilot Instructions for IracingProject

## Project Overview
This is a PHP-based web application for managing and sharing iRacing car setups. The project aims to gather setup data for specific cars (currently focusing on the Mx5) and provide average setups for various tracks.

## Technology Stack
- **Backend**: PHP 8.2
- **Web Server**: Apache
- **Database**: MySQL (latest)
- **Containerization**: Docker and Docker Compose
- **Admin Tool**: phpMyAdmin (accessible on port 81)

## Project Structure
```
/src/               - Main application PHP files
  index.php         - Main landing page with routing
  login.php         - User authentication
  register.php      - User registration
  auth.inc.php      - Authorization guards
  config.inc.php    - Database configuration
  setuppage.php     - Setup data pages
  userpage.php      - User profile pages
  averagesetup.php  - Average setup calculations
  devcars.php       - Car data management
  dev.inc.php       - Development utilities

/templates/         - PHP templates for database operations
  insert.php        - Insert operation templates
  update.php        - Update operation templates
  delete.php        - Delete operation templates
  select.php        - Select operation templates

/images/            - Image assets

.env                - Environment configuration (not tracked)
.env.sample         - Sample environment configuration
docker-compose.yml  - Production Docker configuration
```

## Environment Configuration
The application uses environment variables for database configuration:
- `MYSQL_USER` - Database username
- `MYSQL_PASSWORD` - Database password
- `MYSQL_HOST` - Database host (typically 'mysql' in Docker environment)

Copy `.env.sample` to `.env` and configure before running.

## Development Setup
1. Copy `.env.sample` to `.env` and configure database credentials
2. Run `docker-compose up` to start the application
3. Access the application at `http://localhost`
4. Access phpMyAdmin at `http://localhost:81`

## Database Schema
The application uses two databases:
- `php` - Main application database (user accounts, sessions)
- `cars` - Car setup data and track information

## Coding Standards
- Use PHP opening tags: `<?php`
- Session management: Use `session_start()` at the beginning of pages requiring authentication
- Database connections: Use mysqli extension
- Authorization: Include `auth.inc.php` for protected pages
- Configuration: Use `config.inc.php` constants for database connections

## Security Practices
- Never commit `.env` files (already in `.gitignore`)
- Never commit database files in `/db` directory
- Never commit SSL certificates (`.key`, `.pem` files)
- Use prepared statements for database queries to prevent SQL injection
- Always validate and sanitize user input
- Use session-based authentication

## Authentication & Authorization
- Sessions are used for authentication state
- `$_SESSION['isUser']` - Indicates authenticated user
- `$_SESSION['isAdmin']` - Indicates administrator privileges
- Protected pages should include `auth.inc.php` for access control

## Routing
The application uses query parameter-based routing in `index.php`:
```php
?action=login    - Login page
?action=register - Registration page
```

## When Making Changes
1. **PHP Files**: Follow existing code structure and patterns
2. **Database Operations**: Use templates in `/templates/` as reference
3. **Environment Variables**: Add new variables to `.env.sample` with documentation
4. **Docker Configuration**: Test changes with `docker-compose up --build`
5. **Security**: Always consider security implications for user-facing features

## Testing
- Manual testing via Docker environment
- Test database operations through phpMyAdmin
- Verify user authentication flows work correctly
- Test on localhost before deployment

## Deployment
The application is containerized with Docker:
- Production: `docker-compose.yml`
- Development: `docker-compose_dev.yml`

## Common Tasks
### Adding a New Page
1. Create PHP file in `/src/`
2. Add route in `index.php` if needed
3. Include `auth.inc.php` if authentication required
4. Include `config.inc.php` for database access

### Database Operations
1. Reference templates in `/templates/` directory
2. Use mysqli with prepared statements
3. Handle errors appropriately
4. Close connections when done

### Modifying Docker Configuration
1. Update appropriate `docker-compose*.yml` file
2. Rebuild containers: `docker-compose up --build`
3. Verify all services start correctly

## Known Limitations
- Currently focused on Mx5 car setups
- Basic UI in early development stages
- Track expansion planned for future releases
