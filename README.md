# iRacing Setup Manager

A JavaScript-based web application for managing iRacing car setups. This application allows you to store, manage, and calculate average setups for different car and track combinations.

## Features

- **Add Setups**: Create and save detailed car setups with all parameters
- **Import Setups**: Import iRacing setup files (.sto format) from your computer
- **View Setups**: Browse all saved setups with detailed information
- **Average Setups**: Automatically calculate average values when multiple setups exist for the same car and track combination
- **User Confirmation**: Prompts for user confirmation before saving changes
- **Persistent Storage**: All setups are stored in a JSON file for persistence

## Setup Parameters

The application tracks comprehensive setup parameters including:

- General: Fuel level, front/rear toe, front/rear anti-roll bars
- Tire Pressures: All four corners (LF, RF, RR, LR)
- Spring Settings: Perch offsets for all corners
- Damper Settings: Bump and rebound stiffness for all corners
- Alignment: Camber settings for all corners

## Installation

1. Clone the repository
2. Install dependencies:
   ```bash
   npm install
   ```

## Running the Application

Start the server:
```bash
npm start
```

The application will be available at `http://localhost:3000`

## Usage

### Adding a Setup

1. Click "Add Setup" in the navigation
2. Fill in the car and track information
3. Enter all setup parameters
4. Click "Save Setup"
5. Confirm when prompted

### Importing Setups

1. Click "Import Setups" in the navigation
2. Click "Choose Setup Files" and select one or more iRacing setup files (.sto format)
3. Click "Import Selected Files"
4. Confirm when prompted
5. The system will parse and import the setup files, showing results for each file

**Note**: iRacing setup files are typically found in your Documents folder under `Documents\iRacing\setups\[car_name]\`. The importer supports the standard iRacing .sto file format and will automatically extract car and track information.

### Viewing Setups

1. Click "View Setups" in the navigation
2. Browse through your saved setups
3. Delete setups if needed

### Calculating Average Setup

1. Click "Average Setups" in the navigation
2. Enter the car name
3. Enter the track name
4. Click "Calculate Average"
5. The system will average all setups for that car/track combination

## API Endpoints

- `GET /api/setups` - Get all setups
- `GET /api/setups/:id` - Get a specific setup
- `GET /api/setups/filter/:car/:track` - Get setups for a specific car and track
- `GET /api/setups/average/:car/:track` - Get average setup for a car and track
- `POST /api/setups` - Create a new setup
- `POST /api/setups/import` - Import setups from .sto files (multipart/form-data)
- `PUT /api/setups/:id` - Update a setup
- `DELETE /api/setups/:id` - Delete a setup

## Data Storage

Setups are stored in a JSON file at `./data/setups.json`. This file is automatically created when the first setup is saved.

## Project Structure

```
IracingProject/
├── js-src/
│   ├── models/
│   │   └── Setup.js           # Setup data model
│   ├── services/
│   │   └── SetupStorage.js    # Storage service for managing setups
│   ├── public/
│   │   ├── index.html         # Main HTML interface
│   │   ├── styles.css         # Styling
│   │   └── app.js             # Frontend JavaScript
│   └── server.js              # Express server
├── package.json
└── README.md
```

## Technology Stack

- **Backend**: Node.js with Express
- **Frontend**: Vanilla JavaScript, HTML5, CSS3
- **Data Storage**: JSON file-based storage
- **Dependencies**: express, body-parser, cors

## License

ISC
