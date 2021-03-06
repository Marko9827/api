  <p class="gold-era"><i class="glyphicon fas fa-fire"></i> Eronelit Fire Backup<span>Connected to the Eronelit space station</span></p>
  <div class="form-group">
      <button class="btn btn-info gold-era-backg" onclick="download_sc('create')"><i class="glyphicon fas fa-fire"></i> <?php echo lang("backup1"); ?></button>


  </div>
  <style>
      :root {
          --gold: #d07e06;
      }

      .gold-era-backg {
          background: linear-gradient(45deg, #d07e06, #4527A0) !important;
          border-color: var(--gold) !important;
          border: 0px solid transparent !important;
          color: #fff !important;
      }

      .gold-era {

          color: white !important;
          background: linear-gradient(45deg, #d07e06, #4527A0);
          font-size: -webkit-xxx-large;
          border-radius: 5px;
          padding: 10px;
          text-align: center;
          box-shadow: 0 0 2px 0 rgba(0, 0, 0, .2), 0 1px 10px 0 rgba(0, 0, 0, .1) !important;

      }

      .gold-era span {
          display: none;
          font-size: 12px;
          position: absolute;
          float: left;
          left: inherit;
          padding-right: 23px;
          width: max-content;
          text-transform: uppercase;
          margin-top: 59px;
          right: 0;
          font-family: arial;
      }

      .bgn-faa * {
          color: #4527A0 !important;
      }
  </style>

  <div class="table-responsive table-backup-response" style="margin-top: 15px;">


  </div>



  <div class="modal fade" id="exampleModal_view_post" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"><i class="far fa-eye"></i> <?php echo lang('dash_th_preview'); ?></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body modal-body-modaling-view">

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo lang('public_about_copyright_tr_title_close'); ?></button>
              </div>
          </div>
      </div>
  </div>
  <?php  ?>