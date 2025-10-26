# GitHub Copilot Instructions for IracingProject

## Project Overview
This is a dual-component web application for managing and sharing iRacing car setups:
- **PHP Application**: Web interface for managing car setups with user authentication
- **Node.js Application**: JSON-based API and frontend for setup management and averaging

The project gathers setup data for specific cars (currently focusing on the Mx5) and provides average setups for various tracks.

## Technology Stack

### PHP Application
- **Backend**: PHP 8.2
- **Web Server**: Apache
- **Database**: MySQL (latest)
- **Containerization**: Docker and Docker Compose
- **Admin Tool**: phpMyAdmin (accessible on port 81)

### Node.js Application
- **Backend**: Node.js with Express 5.1.0
- **Frontend**: Vanilla JavaScript, HTML5, CSS3
- **Data Storage**: JSON file-based storage (./data/setups.json)
- **Dependencies**: express, cors

## Project Structure
```
/src/               - PHP application files
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

/js-src/            - Node.js application files
  server.js         - Express server and API endpoints
  models/
    Setup.js        - Setup data model
  services/
    SetupStorage.js - Storage service for managing setups
  public/
    index.html      - Main HTML interface
    app.js          - Frontend JavaScript
    styles.css      - Styling

/templates/         - PHP templates for database operations
  insert.php        - Insert operation templates
  update.php        - Update operation templates
  delete.php        - Delete operation templates
  select.php        - Select operation templates
  boilerplate form.php - Form template

/images/            - Image assets
/data/              - JSON data storage (gitignored)

.env                - Environment configuration (not tracked)
.env.sample         - Sample environment configuration
docker-compose.yml  - Production Docker configuration
docker-compose_dev.yml - Development Docker configuration
package.json        - Node.js dependencies and scripts
```

## Environment Configuration
The application uses environment variables for database configuration:
- `MYSQL_USER` - Database username
- `MYSQL_PASSWORD` - Database password
- `MYSQL_HOST` - Database host (typically 'mysql' in Docker environment)

Copy `.env.sample` to `.env` and configure before running.

## Development Setup

### PHP Application (Docker)
1. Copy `.env.sample` to `.env` and configure database credentials
2. Run `docker-compose up` to start the application
3. Access the PHP application at `http://localhost`
4. Access phpMyAdmin at `http://localhost:81`

### Node.js Application (Standalone)
1. Install dependencies: `npm install`
2. Start the server: `npm start`
3. Access the application at `http://localhost:3000`

Note: Both applications can run independently or simultaneously on different ports.

## Database Schema

### PHP Application
The PHP application uses two MySQL databases:
- `php` - Main application database (user accounts and related data)
- `cars` - Car setup data and track information

Note: User sessions are managed via PHP's native session handling (session_start()), not stored in the database.

### Node.js Application
The Node.js application uses JSON file storage:
- `./data/setups.json` - Stores all setup data with persistence across restarts

## Coding Standards

### PHP Code
- Use PHP opening tags: `<?php`
- Session management: Use `session_start()` at the beginning of pages requiring authentication
- Database connections: Use mysqli extension with prepared statements
- Authorization: Include `auth.inc.php` for protected pages
- Configuration: Use `config.inc.php` constants for database connections
- Error handling: Handle database errors appropriately and provide user feedback

### JavaScript/Node.js Code
- Use ES6+ features and modern JavaScript syntax
- Use async/await for asynchronous operations
- Follow RESTful API conventions for endpoints
- Use Express middleware for request processing
- Handle errors with try/catch blocks and send appropriate HTTP status codes
- Use const/let, avoid var

## Security Practices
- Never commit `.env` files (already in `.gitignore`)
- Never commit database files in `/db` directory
- Never commit data files in `/data` directory
- Never commit SSL certificates (`.key`, `.pem` files)
- Never commit `node_modules` directory
- Use prepared statements for database queries to prevent SQL injection
- Always validate and sanitize user input on both client and server side
- Use session-based authentication for PHP application
- Implement proper error handling without exposing sensitive information
- Use HTTPS in production environments

## API Endpoints (Node.js Application)

The Node.js application provides these RESTful endpoints:

- `GET /api/setups` - Get all setups
- `GET /api/setups/:id` - Get a specific setup by ID
- `GET /api/setups/filter/:car/:track` - Get setups filtered by car and track
- `GET /api/setups/average/:car/:track` - Get average setup for a car/track combination
- `POST /api/setups` - Create a new setup
- `PUT /api/setups/:id` - Update an existing setup
- `DELETE /api/setups/:id` - Delete a setup

All endpoints return JSON responses and use appropriate HTTP status codes.

## Authentication & Authorization (PHP Application)
- Sessions are used for authentication state
- `$_SESSION['isUser']` - Indicates authenticated user
- `$_SESSION['isAdmin']` - Indicates administrator privileges
- Protected pages should include `auth.inc.php` for access control

Note: The Node.js application currently does not implement authentication.

## Routing
The application uses query parameter-based routing in `index.php`:
```php
?action=login    - Login page
?action=register - Registration page
```

## When Making Changes

### PHP Files
1. Follow existing code structure and patterns
2. Use templates in `/templates/` as reference for database operations
3. Include `auth.inc.php` if authentication required
4. Include `config.inc.php` for database access
5. Test changes with Docker environment (`docker-compose up --build`)

### JavaScript/Node.js Files
1. Follow existing code patterns in `js-src/`
2. Update models in `/models` for data structure changes
3. Update services in `/services` for business logic
4. Update API endpoints in `server.js` for new routes
5. Test changes by running `npm start` and verifying endpoints

### Environment Variables
1. Add new variables to `.env.sample` with documentation
2. Never commit actual `.env` file
3. Document the purpose of each variable

### Docker Configuration
1. Update appropriate `docker-compose*.yml` file
2. Rebuild containers: `docker-compose up --build`
3. Verify all services start correctly
4. Test connections between services

### General Guidelines
- Make minimal, focused changes
- Always consider security implications for user-facing features
- Test thoroughly before committing
- Update documentation if adding new features or changing workflows

## Testing

### PHP Application
- Manual testing via Docker environment
- Test database operations through phpMyAdmin at `http://localhost:81`
- Verify user authentication flows work correctly
- Test on localhost before deployment
- Check error handling and edge cases

### Node.js Application
- Manual testing via browser at `http://localhost:3000`
- Test API endpoints using browser dev tools or curl
- Verify JSON responses have correct structure
- Test CRUD operations for setups
- Verify average calculation logic

### Testing Workflow
1. Start the appropriate environment (Docker for PHP, `npm start` for Node.js)
2. Test new features manually
3. Test edge cases and error conditions
4. Verify existing functionality still works
5. Check console/logs for errors

Note: Currently no automated test suite exists. Manual testing is the primary validation method.

## Deployment
The applications can be deployed in different ways:

### PHP Application (Containerized)
- Production: `docker-compose.yml`
- Development: `docker-compose_dev.yml`
- Run: `docker-compose up -d` for detached mode
- Stop: `docker-compose down`
- Logs: `docker-compose logs -f`

### Node.js Application (Standalone)
- Install dependencies: `npm install`
- Start: `npm start` (runs on port 3000 by default)
- Environment: Set `PORT` environment variable to change port
- Data: Ensure `./data` directory exists and is writable

## Build & Run Commands

### PHP Application
```bash
# Start all services
docker-compose up

# Start in detached mode
docker-compose up -d

# Rebuild containers
docker-compose up --build

# Stop services
docker-compose down

# View logs
docker-compose logs -f apache
docker-compose logs -f mysql
```

### Node.js Application
```bash
# Install dependencies
npm install

# Start server
npm start

# The server will run on http://localhost:3000
```

## Linting
Currently, no linters are configured for this project. When adding linting:
- For PHP: Consider PHP CodeSniffer or PHP-CS-Fixer
- For JavaScript: Consider ESLint with appropriate configs
- Add linting scripts to package.json and document in this file

## Common Tasks

### Adding a New PHP Page
1. Create PHP file in `/src/`
2. Add route in `index.php` if needed
3. Include `auth.inc.php` if authentication required
4. Include `config.inc.php` for database access
5. Follow existing patterns for session management
6. Test in Docker environment

### Adding a New API Endpoint (Node.js)
1. Open `js-src/server.js`
2. Add new route following RESTful conventions
3. Use async/await for database operations
4. Handle errors with try/catch
5. Return appropriate HTTP status codes
6. Test endpoint with curl or browser dev tools

### Database Operations (PHP)
1. Reference templates in `/templates/` directory
2. Use mysqli with prepared statements
3. Handle errors appropriately
4. Close connections when done
5. Test through phpMyAdmin first if unsure

### Modifying Setup Data Model (Node.js)
1. Update `js-src/models/Setup.js` for data structure
2. Update `js-src/services/SetupStorage.js` for storage logic
3. Update frontend in `js-src/public/app.js` if UI changes needed
4. Test thoroughly as this affects data persistence

### Modifying Docker Configuration
1. Update appropriate `docker-compose*.yml` file
2. Rebuild containers: `docker-compose up --build`
3. Verify all services start correctly
4. Test inter-service connectivity

### Working with Both Applications
1. Run PHP app: `docker-compose up` (ports 80, 81)
2. Run Node.js app in separate terminal: `npm start` (port 3000)
3. Both can run simultaneously on different ports
4. Choose the appropriate app based on the task

## Known Limitations
- Currently focused on Mx5 car setups
- Basic UI in early development stages
- Track expansion planned for future releases
- No automated test suite (manual testing only)
- Node.js application lacks authentication/authorization
- No linting configuration currently in place
- PHP and Node.js apps are separate (not integrated)

## Troubleshooting

### PHP Application
- **Cannot connect to database**: Verify `.env` file exists with correct credentials
- **Port 80 already in use**: Stop other services using port 80 or change port in docker-compose.yml
- **phpMyAdmin not accessible**: Ensure mysql service is running first
- **Session issues**: Check that session_start() is called at page beginning

### Node.js Application
- **Port 3000 in use**: Set PORT environment variable to use different port
- **Module not found**: Run `npm install` to install dependencies
- **Data not persisting**: Ensure `./data` directory exists and is writable
- **CORS errors**: CORS is enabled by default, check browser console for details

## File Locations
- PHP source: `/src/`
- Node.js source: `/js-src/`
- Templates: `/templates/`
- Images: `/images/`
- Data storage: `./data/` (gitignored)
- Database files: `./db/` (gitignored)
- Environment config: `.env` (gitignored, use `.env.sample` as template)
