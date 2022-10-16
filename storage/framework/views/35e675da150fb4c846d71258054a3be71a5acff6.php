<table>
    <tr>
        <td colspan="6">DEPENSES DU : <?php echo e(date("d/m/Y" , strtotime($start_date)) .' AU '. date("d/m/Y" , strtotime($end_date))); ?> </td>
    </tr>
</table>

<table>
    <thead>
        <tr>
            <th>N°</th>
            <th>Motif</th>
            <th>Cycle</th>
            <th>Montant</th>
            <th>Année Académique</th>
            <th>Bénéficiaire</th>
            <th>Date de creation</th>
            <th>Par</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e(++$key); ?></td>
                <td><?php echo e($expense->motif); ?></td>
                <td><?php echo e($expense->cycle); ?></td>
                <td><?php echo e(\App\Helpers\FormatNumberToLetter::formatNumber($expense->amount).' F CFA'); ?></td>
                <td><?php echo e($expense->academic_years->name); ?></td>
                <td><?php echo e($expense->receiver); ?></td>
                <td><?php echo e($expense->created_at); ?></td>
                <td><?php echo e($expense->users->lastname.' '.$expense->users->firstname); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <tr>
                <td colspan="6"></td>
            </tr>
            <tr>
                <td colspan="3">MONTANT TOTAL</td>
                <td><?php echo e(\App\Helpers\FormatNumberToLetter::formatNumber($expenses->sum('amount')).' F CFA'); ?></td>
                <td colspan="4"></td>
            </tr>
    </tbody>
</table><?php /**PATH C:\wamp64\www\review\cspyramides\resources\views/exports/expense.blade.php ENDPATH**/ ?>