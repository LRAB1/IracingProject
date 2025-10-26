const fs = require('fs').promises;
const path = require('path');
const Setup = require('../models/Setup');

class SetupStorage {
  constructor(dataDir = './data') {
    this.dataDir = dataDir;
    this.setupsFile = path.join(dataDir, 'setups.json');
  }
  
  async ensureDataDir() {
    await fs.mkdir(this.dataDir, { recursive: true });
  }
  
  async loadSetups() {
    try {
      const data = await fs.readFile(this.setupsFile, 'utf8');
      return JSON.parse(data);
    } catch (err) {
      if (err.code === 'ENOENT') {
        return [];
      }
      throw err;
    }
  }
  
  async saveSetups(setups) {
    await this.ensureDataDir();
    await fs.writeFile(this.setupsFile, JSON.stringify(setups, null, 2));
  }
  
  async addSetup(setupData) {
    const setup = new Setup(setupData);
    const validation = setup.validate();
    
    if (!validation.valid) {
      throw new Error(`Validation failed: ${validation.errors.join(', ')}`);
    }
    
    const setups = await this.loadSetups();
    setups.push(setup.toJSON());
    await this.saveSetups(setups);
    
    return setup.toJSON();
  }
  
  async getSetupsByCarAndTrack(car, track) {
    const setups = await this.loadSetups();
    return setups.filter(s => s.car === car && s.track === track);
  }
  
  async getAllSetups() {
    return await this.loadSetups();
  }
  
  async getSetupById(id) {
    const setups = await this.loadSetups();
    return setups.find(s => s.id === id);
  }
  
  async updateSetup(id, updatedData) {
    const setups = await this.loadSetups();
    const index = setups.findIndex(s => s.id === id);
    
    if (index === -1) {
      throw new Error('Setup not found');
    }
    
    const updatedSetup = new Setup({ ...setups[index], ...updatedData, id });
    const validation = updatedSetup.validate();
    
    if (!validation.valid) {
      throw new Error(`Validation failed: ${validation.errors.join(', ')}`);
    }
    
    setups[index] = updatedSetup.toJSON();
    await this.saveSetups(setups);
    
    return setups[index];
  }
  
  async deleteSetup(id) {
    const setups = await this.loadSetups();
    const filteredSetups = setups.filter(s => s.id !== id);
    
    if (setups.length === filteredSetups.length) {
      throw new Error('Setup not found');
    }
    
    await this.saveSetups(filteredSetups);
    return true;
  }
  
  async getAverageSetup(car, track) {
    const setups = await this.getSetupsByCarAndTrack(car, track);
    
    if (setups.length === 0) {
      return null;
    }
    
    if (setups.length === 1) {
      return setups[0];
    }
    
    const numericFields = [
      'fuelLevel', 'frontToe', 'frontARB',
      'LF_Pressure', 'LF_SpringPerchOffset', 'LF_BumpStiffness', 'LF_ReboundStiffness', 'LF_Camber',
      'RF_Pressure', 'RF_SpringPerch', 'RF_BumpStiffness', 'RF_ReboundStiffness', 'RF_Camber',
      'RR_Pressure', 'RR_SpringPerch', 'RR_BumpStiffness', 'RR_ReboundStiffness', 'RR_Camber',
      'LR_Pressure', 'LR_SpringPerch', 'LR_BumpStiffness', 'LR_ReboundStiffness', 'LR_Camber',
      'rearToe', 'rearARB'
    ];
    
    const averaged = {
      car: car,
      track: track,
      setupName: `Average of ${setups.length} setups`,
      dateCreated: new Date().toISOString()
    };
    
    numericFields.forEach(field => {
      const sum = setups.reduce((acc, setup) => acc + (parseFloat(setup[field]) || 0), 0);
      averaged[field] = sum / setups.length;
    });
    
    return averaged;
  }
}

module.exports = SetupStorage;
