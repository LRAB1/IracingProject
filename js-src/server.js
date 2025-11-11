const express = require('express');
const cors = require('cors');
const path = require('path');
const multer = require('multer');
const SetupStorage = require('./services/SetupStorage');
const SetupParser = require('./services/SetupParser');

const app = express();
const PORT = process.env.PORT || 3000;
const storage = new SetupStorage('./data');

// Configure multer for file uploads
const upload = multer({
  storage: multer.memoryStorage(),
  fileFilter: (req, file, cb) => {
    if (path.extname(file.originalname).toLowerCase() === '.sto') {
      cb(null, true);
    } else {
      cb(new Error('Only .sto files are allowed'));
    }
  }
});

app.use(cors());
app.use(express.json());
app.use(express.urlencoded({ extended: true }));
app.use(express.static(path.join(__dirname, 'public')));

// Get all setups
app.get('/api/setups', async (req, res) => {
  try {
    const setups = await storage.getAllSetups();
    res.json(setups);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// Get setup by ID
app.get('/api/setups/:id', async (req, res) => {
  try {
    const setup = await storage.getSetupById(req.params.id);
    if (!setup) {
      return res.status(404).json({ error: 'Setup not found' });
    }
    res.json(setup);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// Get setups by car and track with optional tire type filter
app.get('/api/setups/filter/:car/:track', async (req, res) => {
  try {
    const { car, track } = req.params;
    const { tireType } = req.query;
    const setups = await storage.getSetupsByCarAndTrack(car, track, tireType);
    res.json(setups);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// Get setups by tire type
app.get('/api/setups/tire/:tireType', async (req, res) => {
  try {
    const setups = await storage.getSetupsByTireType(req.params.tireType);
    res.json(setups);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// Get average setup for car and track with optional tire type filter
app.get('/api/setups/average/:car/:track', async (req, res) => {
  try {
    const { car, track } = req.params;
    const { tireType } = req.query;
    const average = await storage.getAverageSetup(car, track, tireType);
    if (!average) {
      return res.status(404).json({ error: 'No setups found for this car and track combination' });
    }
    res.json(average);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// Add new setup
app.post('/api/setups', async (req, res) => {
  try {
    const setup = await storage.addSetup(req.body);
    res.status(201).json(setup);
  } catch (err) {
    res.status(400).json({ error: err.message });
  }
});

// Update setup
app.put('/api/setups/:id', async (req, res) => {
  try {
    const setup = await storage.updateSetup(req.params.id, req.body);
    res.json(setup);
  } catch (err) {
    res.status(400).json({ error: err.message });
  }
});

// Delete setup
app.delete('/api/setups/:id', async (req, res) => {
  try {
    await storage.deleteSetup(req.params.id);
    res.json({ message: 'Setup deleted successfully' });
  } catch (err) {
    res.status(404).json({ error: err.message });
  }
});

// Import setups from uploaded files
app.post('/api/setups/import', upload.array('setupFiles', 50), async (req, res) => {
  try {
    if (!req.files || req.files.length === 0) {
      return res.status(400).json({ error: 'No files uploaded' });
    }
    
    const results = {
      imported: 0,
      failed: 0,
      errors: [],
      details: []
    };
    
    for (const file of req.files) {
      try {
        // Parse the setup file
        const fileContent = file.buffer.toString('utf-8');
        const setupData = SetupParser.parseSetupFile(fileContent, file.originalname);
        
        // Add the setup to storage
        const savedSetup = await storage.addSetup(setupData);
        results.imported++;
        results.details.push({
          setupName: savedSetup.setupName,
          car: savedSetup.car,
          track: savedSetup.track,
          tireType: savedSetup.tireType
        });
      } catch (err) {
        results.failed++;
        results.errors.push(`${file.originalname}: ${err.message}`);
      }
    }
    
    res.json(results);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

app.listen(PORT, () => {
  console.log(`iRacing Setup Manager running on port ${PORT}`);
  console.log(`Open http://localhost:${PORT} in your browser`);
});
