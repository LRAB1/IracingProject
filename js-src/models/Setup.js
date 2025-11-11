class Setup {
  constructor(data) {
    this.id = data.id || Date.now().toString();
    this.car = data.car || '';
    this.track = data.track || '';
    this.setupName = data.setupName || '';
    this.dateCreated = data.dateCreated || new Date().toISOString();
    this.tireType = data.tireType || 'dry'; // 'dry' or 'wet'
    
    // Setup parameters
    this.fuelLevel = parseFloat(data.fuelLevel) || 0;
    this.frontToe = parseFloat(data.frontToe) || 0;
    this.frontARB = parseInt(data.frontARB) || 0;
    
    // Left Front
    this.LF_Pressure = parseFloat(data.LF_Pressure) || 0;
    this.LF_SpringPerchOffset = parseFloat(data.LF_SpringPerchOffset) || 0;
    this.LF_BumpStiffness = parseFloat(data.LF_BumpStiffness) || 0;
    this.LF_ReboundStiffness = parseFloat(data.LF_ReboundStiffness) || 0;
    this.LF_Camber = parseFloat(data.LF_Camber) || 0;
    
    // Right Front
    this.RF_Pressure = parseFloat(data.RF_Pressure) || 0;
    this.RF_SpringPerch = parseFloat(data.RF_SpringPerch) || 0;
    this.RF_BumpStiffness = parseFloat(data.RF_BumpStiffness) || 0;
    this.RF_ReboundStiffness = parseFloat(data.RF_ReboundStiffness) || 0;
    this.RF_Camber = parseFloat(data.RF_Camber) || 0;
    
    // Right Rear
    this.RR_Pressure = parseFloat(data.RR_Pressure) || 0;
    this.RR_SpringPerch = parseFloat(data.RR_SpringPerch) || 0;
    this.RR_BumpStiffness = parseFloat(data.RR_BumpStiffness) || 0;
    this.RR_ReboundStiffness = parseFloat(data.RR_ReboundStiffness) || 0;
    this.RR_Camber = parseFloat(data.RR_Camber) || 0;
    
    // Left Rear
    this.LR_Pressure = parseFloat(data.LR_Pressure) || 0;
    this.LR_SpringPerch = parseFloat(data.LR_SpringPerch) || 0;
    this.LR_BumpStiffness = parseFloat(data.LR_BumpStiffness) || 0;
    this.LR_ReboundStiffness = parseFloat(data.LR_ReboundStiffness) || 0;
    this.LR_Camber = parseFloat(data.LR_Camber) || 0;
    
    this.rearToe = parseFloat(data.rearToe) || 0;
    this.rearARB = parseInt(data.rearARB) || 0;
  }
  
  validate() {
    const errors = [];
    
    if (!this.car) errors.push('Car is required');
    if (!this.track) errors.push('Track is required');
    if (!this.setupName) errors.push('Setup name is required');
    
    return {
      valid: errors.length === 0,
      errors: errors
    };
  }
  
  toJSON() {
    return {
      id: this.id,
      car: this.car,
      track: this.track,
      setupName: this.setupName,
      dateCreated: this.dateCreated,
      tireType: this.tireType,
      fuelLevel: this.fuelLevel,
      frontToe: this.frontToe,
      frontARB: this.frontARB,
      LF_Pressure: this.LF_Pressure,
      LF_SpringPerchOffset: this.LF_SpringPerchOffset,
      LF_BumpStiffness: this.LF_BumpStiffness,
      LF_ReboundStiffness: this.LF_ReboundStiffness,
      LF_Camber: this.LF_Camber,
      RF_Pressure: this.RF_Pressure,
      RF_SpringPerch: this.RF_SpringPerch,
      RF_BumpStiffness: this.RF_BumpStiffness,
      RF_ReboundStiffness: this.RF_ReboundStiffness,
      RF_Camber: this.RF_Camber,
      RR_Pressure: this.RR_Pressure,
      RR_SpringPerch: this.RR_SpringPerch,
      RR_BumpStiffness: this.RR_BumpStiffness,
      RR_ReboundStiffness: this.RR_ReboundStiffness,
      RR_Camber: this.RR_Camber,
      LR_Pressure: this.LR_Pressure,
      LR_SpringPerch: this.LR_SpringPerch,
      LR_BumpStiffness: this.LR_BumpStiffness,
      LR_ReboundStiffness: this.LR_ReboundStiffness,
      LR_Camber: this.LR_Camber,
      rearToe: this.rearToe,
      rearARB: this.rearARB
    };
  }
}

module.exports = Setup;
