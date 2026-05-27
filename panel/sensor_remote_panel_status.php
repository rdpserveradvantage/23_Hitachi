<div class="row">
   <div class="col-md-6 grid-margin stretch-card">
       <div class="card">
					  						  
		<div class="card-body">
		  <h4 class="card-title" style="color:#fff;">Sensor Remote Operations</h4>	  
		  
		  <div class="row">
			<div class="col-12">
			       <div class="table-responsive">
                    <table class="table">
                     
                      <tbody>
                        <tr>
                          <!--<td><input type="image" name="btnPing" id="btnPing" title="Ping" src="image/pingB.png" alt="Ping" align="left" onclick="PingStatus();return false;" style="padding: 7px;"></td>-->
                          <td><input type="image" name="btnArm" id="btnArm" title="Arm" src="image/ArmN.png" alt="Arm" align="left" onclick="soundOn('ARM');return false;" style="padding: 5px;"></td>
                          <td><input type="image" name="btnDisArm" id="btnDisArm" title="DisArm" src="image/DisArm.png" alt="DisArm" align="left" onclick="soundOff('DISARM');return false;" style="padding: 7px;"></td>
                          <td><input type="image" name="btnSirenON" id="btnSirenON" title="Siren ON" src="image/siron.png" alt="SirenON" align="left" onclick="soundOn('soundon');return false;" style="padding: 7px;"></td>
                          <td><input type="image" name="btnSirenOFF" id="btnSirenOFF" title="Siren OFF" src="image/sironoff.png" alt="SirenOFF" align="left" onclick="soundOff('soundoff');return false;" style="padding: 7px;"></td>
						  <td><input type="image" name="btnShutterOPEN" id="btnShutterOPEN" title="Shutter OPEN" src="image/ArmN.png" alt="ShutterOPEN" align="left" onclick="soundOn('SHUTTER OPEN');return false;" style="padding: 7px;"></td>
						                        
					   </tr>
                        <tr>
							<!--<td style="text-align:center">PING</td>-->
							<td style="text-align:center">ARM</td>
							<td style="text-align:center">DISARM</td>
							<td style="text-align:center">SOUNDON</td>
							<td style="text-align:center">SOUNDOFF</td>
							<td style="text-align:center;display:none;">FIRERESET</td>
							<td style="text-align:center;">SHOPEN</td>
						</tr>
						<tr>
                          <td><input type="image" name="btnShutterCLOSE" id="btnShutterCLOSE" title="Shutter CLOSE" src="image/DisArm.png" alt="ShutterCLOSE" align="left" onclick="soundOff('SHUTTER CLOSE');return false;" style="padding: 7px;"></td>
						  <td><span alt="START TALK" style="cursor:pointer;" onclick="soundOn('START TALK');return false;"><i class="fa fa-microphone fa-3x menu-icon"></i></span></td>
						  <td><span alt="STOP TALK" style="cursor:pointer;" onclick="soundOff('STOP TALK');return false;"><i class="fa fa-microphone-slash fa-3x menu-icon"></i></span></td>
							<!--<td><input type="image" name="btnFireReset" id="btnFireReset" title="Fire Reset" src="image/Fire_Reset.png" alt="FireReset" align="left" style="padding: 7px; display: none;">-->
						 <td><span alt="LIGHT ON" style="cursor:pointer;color:#0099CC;" onclick="soundOn('LIGHTon');return false;"><i class="fa fa-lightbulb fa-3x menu-icon"></i></span></td>
						  <td><span alt="LIGHT OFF" style="cursor:pointer;" onclick="soundOff('LIGHToff');return false;"><i class="fa fa-lightbulb fa-3x menu-icon"></i></span></td>
                    	</td>                       
					   </tr>
                        <tr>
							
							<td style="text-align:center;">SHCLOSE</td>
							<td style="text-align:center;">START TALK</td>
							<td style="text-align:center;">STOP TALK</td>
                            <td style="text-align:center;">LIGHT ON</td>
							<td style="text-align:center;">LIGHT OFF</td>
						</tr>
						
                        
                      </tbody>
					  
                    </table>
                  </div>
			</div>
			<div class="col-12">
			    <div class="card">
														  
					<div class="card-body">
					  <h6 class="card-title" id="shw"></h6>	
			        </div>
				</div>	
			</div>
		  </div>
		</div>
	  </div>
   </div>
   <div class="col-md-6 grid-margin stretch-card">
        
       <div class="card">
					  						  
		<div class="card-body">
		  <h4 class="card-title">Sensor Alarm Status</h4>	  
		  
		  <div class="row">
			<div class="col-12" id="sensor_alarm_status">
			  <div class="table-responsive">
				<table id="order-listing" class="table">
				  <thead>
					<tr>
						<th>SrNo</th><th>Alarm Type</th><th>Alarm Code</th>
						
					</tr>
				  </thead>
				  <tbody >
				  
				  </tbody>
				</table>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
   </div>
</div>
