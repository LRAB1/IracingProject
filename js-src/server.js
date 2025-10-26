const express = require('express');
const bodyParser = require('body-parser');
const cors = require('cors');
const path = require('path');
const SetupStorage = require('./services/SetupStorage');

const app = express();
const PORT = process.env.PORT || 3000;
const storage = new SetupStorage('./data');

app.use(cors());
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));
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

// Get setups by car and track
app.get('/api/setups/filter/:car/:track', async (req, res) => {
  try {
    const setups = await storage.getSetupsByCarAndTrack(req.params.car, req.params.track);
    res.json(setups);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// Get average setup for car and track
app.get('/api/setups/average/:car/:track', async (req, res) => {
  try {
    const average = await storage.getAverageSetup(req.params.car, req.params.track);
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

app.listen(PORT, () => {
  console.log(`iRacing Setup Manager running on port ${PORT}`);
  console.log(`Open http://localhost:${PORT} in your browser`);
});
