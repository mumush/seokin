<div class="allDescriptions">

    <div class="row">

        <?php echo $this->Session->flash(); ?>

    </div>

    <h1 class="sectionHeading"><i class="fa fa-external-link"></i> Assign Job Number</h1>

    <div class="row">

        <div class="col-lg-6">

            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>Title</th>
                        <th>Wage</th>
                        <th>Department</th>
                        <th>Number</th>
                    </tr>

                    <?php foreach ($sameDeptDescs as $desc): ?>

                            <tr>
                                <td><?php echo $desc['Description']['title']; ?></td>
                                <td><?php echo $desc['Description']['wage']; ?></td>
                                <td><?php echo $desc['Department']['name']; ?></td>
                                 <td><?php echo $desc['Description']['number']; ?></td>
                            </tr>


                    <?php endforeach; ?>

                </table>
            </div>

        </div>

        <div class="col-lg-5 col-lg-offset-1">

            <div class="row assignNumber">

                <h3><i class="fa fa-check-circle"></i> <?php echo $assignDesc['Description']['title']; ?></h3>
                <h3><i class="fa fa-check-circle"></i> $<?php echo $assignDesc['Description']['wage']; ?></h3>
                <h3><i class="fa fa-plus-circle"></i> Add Job Number</h3>


                <?php echo $this->Form->create( false , array('action' => 'approve') );
                        
                    echo $this->Form->input('jobnumber', array('class' => 'form-control input-lg', 'label' => false, 'maxlength' => '6', 'default' => $assignDesc['Description']['number'] ));

                    echo $this->Form->input('jobid', array('type' => 'hidden', 'default' => $assignDesc['Description']['id'] ) );

                    echo $this->Form->submit('Assign Job Number', array('class' => 'btn btn-success btn-lg') );
                ?>

                <?php echo $this->Form->end(); ?>

            </div>

        </div>

    </div>


</div>



