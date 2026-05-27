<div class="row">
<div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title" style="color:#fff;">Escalation Matrix</h4>
                  <div class="row">
                    <div class="col-md-12 mx-auto">
                      <ul class="nav nav-pills nav-pills-custom" id="pills-tab-custom" role="tablist">
                        <li class="nav-item" onclick="getEscalationDetail(1)" >
                          <a class="nav-link active show" id="pills-home-tab-custom" data-toggle="pill" href="#pills-health" role="tab" aria-controls="pills-home" aria-selected="false">
                            Two Way
                          </a>
                        </li>
                        <li class="nav-item" onclick="getEscalationDetail(2)">
                          <a class="nav-link" id="pills-profile-tab-custom" data-toggle="pill" href="#pills-career" role="tab" aria-controls="pills-profile" aria-selected="false">
                            Bank
                          </a>
                        </li>
                        <li class="nav-item" onclick="getEscalationDetail(3)">
                          <a class="nav-link" id="pills-contact-tab-custom" data-toggle="pill" href="#pills-music" role="tab" aria-controls="pills-contact" aria-selected="false">
                            HK
                          </a>
                        </li>
                        <li class="nav-item" onclick="getEscalationDetail(4)">
                          <a class="nav-link" id="pills-vibes-tab-custom" data-toggle="pill" href="#pills-vibes" role="tab" aria-controls="pills-vibes" aria-selected="false">
                            Service
                          </a>
                        </li>
                        <li class="nav-item" onclick="getEscalationDetail(5)">
                          <a class="nav-link" id="pills-energy-tab-custom" data-toggle="pill" href="#pills-energy" role="tab" aria-controls="pills-energy" aria-selected="true">
                            RA
                          </a>
                        </li>
						<li class="nav-item" onclick="getEscalationDetail(6)">
                          <a class="nav-link" id="pills-police-tab-custom" data-toggle="pill" href="#pills-police" role="tab" aria-controls="pills-police" aria-selected="true">
                            Police
                          </a>
                        </li>
                      </ul>
                      <div class="tab-content tab-content-custom-pill" id="pills-tabContent-custom">
                        <div class="tab-pane fade active show" id="pills-health" role="tabpanel" aria-labelledby="pills-home-tab-custom" >
                            <?php include("escalation_matrix_table.php"); ?>
                        </div>
                        <div class="tab-pane fade" id="pills-career" role="tabpanel" aria-labelledby="pills-profile-tab-custom" >
                             <?php include("escalation_matrix_table.php"); ?>
                        </div>
                        <div class="tab-pane fade" id="pills-music" role="tabpanel" aria-labelledby="pills-contact-tab-custom" >
                             <?php include("escalation_matrix_table.php"); ?>
                        </div>
                        <div class="tab-pane fade" id="pills-vibes" role="tabpanel" aria-labelledby="pills-vibes-tab-custom" >
                            <?php include("escalation_matrix_table.php"); ?>
                        </div>
                        <div class="tab-pane fade" id="pills-energy" role="tabpanel" aria-labelledby="pills-energy-tab-custom" >
                             <?php include("escalation_matrix_table.php"); ?>
                        </div>
						<div class="tab-pane fade" id="pills-police" role="tabpanel" aria-labelledby="pills-police-tab-custom" >
                             <?php include("escalation_matrix_table.php"); ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</div>			