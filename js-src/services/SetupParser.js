const path = require('path');

class SetupParser {
  /**
   * Parse an iRacing setup file (.sto format)
   * iRacing setup files are typically INI-style text files with sections
   */
  static parseSetupFile(fileContent, fileName) {
    try {
      // Extract car and track info from filename if possible
      // Typical format: carname_trackname.sto or just setupname.sto
      const fileNameWithoutExt = path.basename(fileName, '.sto');
      
      const lines = fileContent.split('\n');
      const setupData = {
        setupName: fileNameWithoutExt,
        car: '',
        track: ''
      };
      
      let currentSection = '';
      
      // Parse INI-style format
      for (let line of lines) {
        line = line.trim();
        
        // Skip empty lines and comments
        if (!line || line.startsWith(';') || line.startsWith('#')) {
          continue;
        }
        
        // Check for section headers
        if (line.startsWith('[') && line.endsWith(']')) {
          currentSection = line.substring(1, line.length - 1).toLowerCase();
          continue;
        }
        
        // Parse key=value pairs
        const equalIndex = line.indexOf('=');
        if (equalIndex > 0) {
          const key = line.substring(0, equalIndex).trim().toLowerCase();
          const value = line.substring(equalIndex + 1).trim();
          
          // Map iRacing setup keys to our data model
          this.mapSetupValue(setupData, key, value, currentSection);
        }
      }
      
      // If car/track not found in file, try to extract from filename
      if (!setupData.car || !setupData.track) {
        this.extractCarTrackFromFilename(setupData, fileNameWithoutExt);
      }
      
      // Set defaults for required fields if not found
      if (!setupData.car) setupData.car = 'Unknown Car';
      if (!setupData.track) setupData.track = 'Unknown Track';
      
      return setupData;
    } catch (error) {
      throw new Error(`Failed to parse setup file ${fileName}: ${error.message}`);
    }
  }
  
  static mapSetupValue(setupData, key, value, section) {
    const numValue = parseFloat(value);
    
    // Map common iRacing setup keys to our model
    // Note: iRacing uses different naming conventions, so we map them
    
    // General information
    if (key === 'carpath' || key === 'car') {
      setupData.car = this.extractCarName(value);
    } else if (key === 'trackname' || key === 'track') {
      setupData.track = this.extractTrackName(value);
    } else if (key === 'setupname' || key === 'name') {
      setupData.setupName = value;
    }
    
    // Fuel
    else if (key.includes('fuel') && !isNaN(numValue)) {
      setupData.fuelLevel = numValue;
    }
    
    // Front toe
    else if ((key.includes('front') && key.includes('toe')) || key === 'toe-in(f)') {
      setupData.frontToe = numValue;
    }
    
    // Rear toe
    else if ((key.includes('rear') && key.includes('toe')) || key === 'toe-in(r)') {
      setupData.rearToe = numValue;
    }
    
    // Front ARB
    else if ((key.includes('front') && key.includes('arb')) || key === 'arbbladerf') {
      setupData.frontARB = Math.round(numValue);
    }
    
    // Rear ARB
    else if ((key.includes('rear') && key.includes('arb')) || key === 'arbbladerr') {
      setupData.rearARB = Math.round(numValue);
    }
    
    // Tire pressures - Left Front
    else if (key === 'lftirelpsi' || (key.includes('lf') && key.includes('pres'))) {
      setupData.LF_Pressure = numValue;
    }
    
    // Tire pressures - Right Front
    else if (key === 'rftirelpsi' || (key.includes('rf') && key.includes('pres'))) {
      setupData.RF_Pressure = numValue;
    }
    
    // Tire pressures - Right Rear
    else if (key === 'rrtirelpsi' || (key.includes('rr') && key.includes('pres'))) {
      setupData.RR_Pressure = numValue;
    }
    
    // Tire pressures - Left Rear
    else if (key === 'lrtirelpsi' || (key.includes('lr') && key.includes('pres'))) {
      setupData.LR_Pressure = numValue;
    }
    
    // Spring perch - Left Front
    else if (key.includes('lf') && (key.includes('perch') || key.includes('spring'))) {
      setupData.LF_SpringPerchOffset = numValue;
    }
    
    // Spring perch - Right Front
    else if (key.includes('rf') && (key.includes('perch') || key.includes('spring'))) {
      setupData.RF_SpringPerch = numValue;
    }
    
    // Spring perch - Right Rear
    else if (key.includes('rr') && (key.includes('perch') || key.includes('spring'))) {
      setupData.RR_SpringPerch = numValue;
    }
    
    // Spring perch - Left Rear
    else if (key.includes('lr') && (key.includes('perch') || key.includes('spring'))) {
      setupData.LR_SpringPerch = numValue;
    }
    
    // Dampers - Bump stiffness
    else if (key.includes('lf') && key.includes('bump')) {
      setupData.LF_BumpStiffness = numValue;
    } else if (key.includes('rf') && key.includes('bump')) {
      setupData.RF_BumpStiffness = numValue;
    } else if (key.includes('rr') && key.includes('bump')) {
      setupData.RR_BumpStiffness = numValue;
    } else if (key.includes('lr') && key.includes('bump')) {
      setupData.LR_BumpStiffness = numValue;
    }
    
    // Dampers - Rebound stiffness
    else if (key.includes('lf') && key.includes('rebound')) {
      setupData.LF_ReboundStiffness = numValue;
    } else if (key.includes('rf') && key.includes('rebound')) {
      setupData.RF_ReboundStiffness = numValue;
    } else if (key.includes('rr') && key.includes('rebound')) {
      setupData.RR_ReboundStiffness = numValue;
    } else if (key.includes('lr') && key.includes('rebound')) {
      setupData.LR_ReboundStiffness = numValue;
    }
    
    // Camber
    else if (key.includes('lf') && key.includes('camber')) {
      setupData.LF_Camber = numValue;
    } else if (key.includes('rf') && key.includes('camber')) {
      setupData.RF_Camber = numValue;
    } else if (key.includes('rr') && key.includes('camber')) {
      setupData.RR_Camber = numValue;
    } else if (key.includes('lr') && key.includes('camber')) {
      setupData.LR_Camber = numValue;
    }
  }
  
  static extractCarName(value) {
    // Extract car name from path or value
    // e.g., "cars/mx5/mx5.car" -> "Mazda MX-5"
    if (value.includes('mx5') || value.includes('mx-5')) {
      return 'Mazda MX-5';
    }
    // Extract last part of path
    const parts = value.split(/[/\\]/);
    const carPart = parts[parts.length - 1].replace('.car', '');
    return carPart.charAt(0).toUpperCase() + carPart.slice(1);
  }
  
  static extractTrackName(value) {
    // Extract track name from path or value
    const parts = value.split(/[/\\]/);
    const trackPart = parts[parts.length - 1].replace('.trk', '');
    return trackPart.split('_').map(word => 
      word.charAt(0).toUpperCase() + word.slice(1)
    ).join(' ');
  }
  
  static extractCarTrackFromFilename(setupData, fileName) {
    // Try to extract car and track from filename
    // Common patterns: "carname_trackname", "trackname", etc.
    const parts = fileName.split('_');
    
    if (parts.length >= 2) {
      if (!setupData.car) {
        setupData.car = parts[0].split(/[-\s]/).map(word => 
          word.charAt(0).toUpperCase() + word.slice(1)
        ).join(' ');
      }
      if (!setupData.track) {
        setupData.track = parts.slice(1).join(' ').split(/[-\s]/).map(word => 
          word.charAt(0).toUpperCase() + word.slice(1)
        ).join(' ');
      }
    }
  }
}

module.exports = SetupParser;
