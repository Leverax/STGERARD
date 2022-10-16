<table>
    <tr>
        <?php if(isset($schoolings_recap)): ?>
            <td colspan="11">RECAPITULATIF TOTAL DU : <?php echo e(date("d/m/Y" , strtotime($start_date)) .' AU '. date("d/m/Y" , strtotime($end_date))); ?> </td>
        <?php endif; ?>

        <?php if(isset($schoolings_sold)): ?>
            <td colspan="11">RECAPITULATIF DES SOLDES DU : <?php echo e(date("d/m/Y" , strtotime($start_date)) .' AU '. date("d/m/Y" , strtotime($end_date))); ?> </td>
        <?php endif; ?>

        <?php if(isset($schoolings_unsold)): ?>
            <td colspan="11">RECAPITULATIF DES NON SOLDES DU : <?php echo e(date("d/m/Y" , strtotime($start_date)) .' AU '. date("d/m/Y" , strtotime($end_date))); ?> </td>
        <?php endif; ?>
    </tr>
</table>

<table>
    <thead>
        <tr>
            <th>N°</th>
            
            <th>Classe</th>
            <th>Elève</th>
            <th>Montant payé</th>
            <th>Arriéré payé</th>
            <th>Arriéré restant</th>
            <th>Reste</th>
            <th>Total dû</th>
            <th>Statut</th>
            <th>Date de creation</th>
            <th>Par</th>
        </tr>
    </thead>
    <tbody>

        <?php 
            $amount         = 0;
            $backward       = 0;
            $backward_rest  = 0;
            $rest           = 0;
            $total          = 0;
        ?>

        <?php if(isset($schoolings_recap)): ?>
            
            <?php $__currentLoopData = $schoolings_recap; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $schooling): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e(++$key); ?></td>
                    
                    <td><?php echo e($schooling->classrooms->name); ?></td>
                    <td><?php echo e($schooling->students->lastname.' '.$schooling->students->firstname.' ('.$schooling->students->matricule.')'); ?></td>
                    <td><?php echo e(\App\Helpers\FormatNumberToLetter::formatNumber($schooling->schooling_details->sum('amount') ).' F CFA'); ?></td>
                    <td><?php echo e(\App\Helpers\FormatNumberToLetter::formatNumber($schooling->schooling_details->sum('backward')).' F CFA'); ?></td>
                    <td><?php echo e(\App\Helpers\FormatNumberToLetter::formatNumber($schooling->backward - $schooling->schooling_details->sum('backward')).' F CFA'); ?></td>
                    <td><?php echo e(\App\Helpers\FormatNumberToLetter::formatNumber($schooling->rest).' F CFA'); ?></td>
                    <td><?php echo e(\App\Helpers\FormatNumberToLetter::formatNumber($schooling->total + $schooling->backward).' F CFA'); ?></td>
                    <td> 
                        <?php if($schooling->rest > 0): ?> 
                            <span class="badge badge-danger">Reste</span>  
                        <?php else: ?> 
                            <span class="badge badge-success">Soldé</span> 
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($schooling->created_at->format('d-m-Y')); ?></td>
                    <td><?php echo e($schooling->users->lastname.' '.$schooling->users->firstname); ?></td>
                </tr>

                <?php 
                    $amount         = $amount + $schooling->schooling_details->sum('amount') ;
                    $backward       = $backward + $schooling->schooling_details->sum('backward');
                    $backward_rest  = $backward_rest + ($schooling->backward - $schooling->schooling_details->sum('backward'));
                    $rest           = $rest + $schooling->rest;
                    $total          = $total + $schooling->total + $schooling->backward;
                ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                

        <?php endif; ?>

        <?php if(isset($schoolings_sold)): ?>
            <?php $__currentLoopData = $schoolings_sold; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $schooling): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e(++$key); ?></td>
                    
                    <td><?php echo e($schooling->classrooms->name); ?></td>
                    <td><?php echo e($schooling->students->lastname.' '.$schooling->students->firstname.' ('.$schooling->students->matricule.')'); ?></td>
                    <td><?php echo e(\App\Helpers\FormatNumberToLetter::formatNumber($schooling->schooling_details->sum('amount') ).' F CFA'); ?></td>
                    <td><?php echo e(\App\Helpers\FormatNumberToLetter::formatNumber($schooling->schooling_details->sum('backward')).' F CFA'); ?></td>
                    <td><?php echo e(\App\Helpers\FormatNumberToLetter::formatNumber($schooling->backward - $schooling->schooling_details->sum('backward')).' F CFA'); ?></td>
                    <td><?php echo e(\App\Helpers\FormatNumberToLetter::formatNumber($schooling->rest).' F CFA'); ?></td>
                    <td><?php echo e(\App\Helpers\FormatNumberToLetter::formatNumber($schooling->total + $schooling->backward).' F CFA'); ?></td>
                    <td> 
                        <?php if($schooling->rest > 0): ?> 
                            <span class="badge badge-danger">Reste</span>  
                        <?php else: ?> 
                            <span class="badge badge-success">Soldé</span> 
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($schooling->created_at->format('d-m-Y')); ?></td>
                    <td><?php echo e($schooling->users->lastname.' '.$schooling->users->firstname); ?></td>
                </tr>

                <?php 
                    $amount         = $amount + $schooling->schooling_details->sum('amount') ;
                    $backward       = $backward + $schooling->schooling_details->sum('backward');
                    $backward_rest  = $backward_rest + ($schooling->backward - $schooling->schooling_details->sum('backward'));
                    $rest           = $rest + $schooling->rest;
                    $total          = $total + $schooling->total + $schooling->backward;
                ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            

        <?php endif; ?>

        <?php if(isset($schoolings_unsold)): ?>
            <?php $__currentLoopData = $schoolings_unsold; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $schooling): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e(++$key); ?></td>
                    
                    <td><?php echo e($schooling->classrooms->name); ?></td>
                    <td><?php echo e($schooling->students->lastname.' '.$schooling->students->firstname.' ('.$schooling->students->matricule.')'); ?></td>
                    <td><?php echo e(\App\Helpers\FormatNumberToLetter::formatNumber($schooling->schooling_details->sum('amount') ).' F CFA'); ?></td>
                    <td><?php echo e(\App\Helpers\FormatNumberToLetter::formatNumber($schooling->schooling_details->sum('backward')).' F CFA'); ?></td>
                    <td><?php echo e(\App\Helpers\FormatNumberToLetter::formatNumber($schooling->backward - $schooling->schooling_details->sum('backward')).' F CFA'); ?></td>
                    <td><?php echo e(\App\Helpers\FormatNumberToLetter::formatNumber($schooling->rest).' F CFA'); ?></td>
                    <td><?php echo e(\App\Helpers\FormatNumberToLetter::formatNumber($schooling->total + $schooling->backward).' F CFA'); ?></td>
                    <td> 
                        <?php if($schooling->rest > 0): ?> 
                            <span class="badge badge-danger">Reste</span>  
                        <?php else: ?> 
                            <span class="badge badge-success">Soldé</span> 
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($schooling->created_at->format('d-m-Y')); ?></td>
                    <td><?php echo e($schooling->users->lastname.' '.$schooling->users->firstname); ?></td>
                </tr>

                <?php 
                    $amount         = $amount + $schooling->schooling_details->sum('amount') ;
                    $backward       = $backward + $schooling->schooling_details->sum('backward');
                    $backward_rest  = $backward_rest + ($schooling->backward - $schooling->schooling_details->sum('backward'));
                    $rest           = $rest + $schooling->rest;
                    $total          = $total + $schooling->total + $schooling->backward;
                ?>
                
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            

        <?php endif; ?>
            

        <tr>
            <td colspan="11"></td>
        </tr>
        <tr>
            <td colspan="3">TOTAL</td>
            <td><?php echo e(\App\Helpers\FormatNumberToLetter::formatNumber($amount).' F CFA'); ?></td>
            <td><?php echo e(\App\Helpers\FormatNumberToLetter::formatNumber($backward).' F CFA'); ?></td>
            <td><?php echo e(\App\Helpers\FormatNumberToLetter::formatNumber($backward_rest).' F CFA'); ?></td>
            <td><?php echo e(\App\Helpers\FormatNumberToLetter::formatNumber($rest).' F CFA'); ?></td>
            <td><?php echo e(\App\Helpers\FormatNumberToLetter::formatNumber($total).' F CFA'); ?></td>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td colspan="11"></td>
        </tr>
        <tr>
            <td colspan="3">MONTANT TOTAL PAYE</td>
            <td colspan="2"><?php echo e(\App\Helpers\FormatNumberToLetter::formatNumber($amount + $backward).' F CFA'); ?></td>
            <td colspan="5"></td>
        </tr>



    </tbody>
</table><?php /**PATH C:\server_xampp\htdocs\csiledesroses\resources\views/exports/schooling.blade.php ENDPATH**/ ?>