<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
  <div class="content">
    <div class="row">

      <?php hooks()->do_action('before_staff_myprofile'); ?>
      <div class="col-md-12">
        <div class="panel_s">

          <div class="panel-body">
            <h4 class="no-margin">
              <?php echo _l('ai_resume_analyzer'); ?>
            </h4>
            <hr class="hr-panel-heading" />
            <form action="<?php echo admin_url('hrm/ai_resume_analyzer'); ?>" enctype="multipart/form-data" method="post">
              <input type="hidden" name="csrf_token_name" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="candidate_name" class="control-label"><?php echo _l('candidate_name'); ?></label>
                  <input type="text" name="candidate_name" id="candidate_name" class="form-control" required />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="resume" class="control-label"><?php echo _l('upload_resume_file'); ?></label>
                  <input type="file" name="resume" id="resume" class="form-control" required />
                </div>
              </div>
              <div class="col-md-3"><button type="submit" class="btn btn-primary"><?php echo _l('analyze_resume'); ?></button></div>
            </form>
            <div class="table mtop-10">
              <table class="table table-stripped">
                <thead>
                  <tr>
                    <th><?php echo _l('candidate_name'); ?></th>
                    <th><?php echo _l('upload_resume_file'); ?></th>
                    <th><?php echo _l('ai_resume_analyzer'); ?></th>
                    <th><?php echo _l('actions'); ?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($analyses as $analysis){ ?>
                  <tr>
                    <td><?php echo $analysis['candidate_name']; ?></td>
                    <td><a href="<?php echo site_url('uploads/resumes/'.$analysis['resume_file']); ?>" target="_blank"><?php echo $analysis['resume_file']; ?></a></td>
                    <td><div style="max-height:300px; overflow:auto;"><?php echo $analysis['response']; ?></div></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>  
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<?php init_tail(); ?>
</body>

</html>